<?php

namespace App\Http\Middleware;

use App\Helper\ToolsHelper;
use App\Http\Api\UserApi;
use App\Models\HakAksesModel;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek Token Autentikasi dari Session Lokal
        $authToken = ToolsHelper::getAuthToken();
        if (empty($authToken)) {
            return redirect()->route('auth.login');
        }

        // ==================================================================
        // 🔥 OPTIMASI PERFORMANCE (CACHE SESSION)
        // ==================================================================
        $apiUser = Session::get('temp_api_user_data');

        if (!$apiUser) {
            // 2. Ambil Data User dari API Kampus (IT Del) HANYA jika tidak ada di cache session
            try {
                $response = UserApi::getMe($authToken);
            } catch (\Exception $e) {
                return redirect()->route('auth.login')->with('error', 'Gagal terhubung ke API Kampus');
            }

            if (!isset($response->data->user)) {
                return redirect()->route('auth.login');
            }

            $apiUser = $response->data->user;
            
            // Simpan ke session selama 10 menit agar search cepat & stabil
            Session::put('temp_api_user_data', $apiUser); 
        }

        // 3. Sinkronisasi User API ke Laravel Auth
        // User harus sudah ada di database (dibuat via Seeder atau mekanisme registrasi resmi)
        $localUser = User::find($apiUser->id);

        if ($localUser) {
            // Hanya lakukan login jika user BELUM login di sesi Laravel saat ini
            // atau jika User ID di sesi berbeda dengan data API baru.
            if (!Auth::check() || Auth::id() !== $localUser->id) {
                Auth::login($localUser);
            }
            
            // Hydrate Hak Akses (Wajib dijalankan agar properti 'roles' tersedia)
            $this->hydrateUserRoles($localUser, $request);

        } else {
             // Fallback logic untuk user tamu/baru yang belum terdaftar di DB lokal
             // Mereka bisa login tapi tidak punya Role (akses kosong)
             $auth = $apiUser;
             $akses = HakAksesModel::where('user_id', $auth->id)->first();
             $userRoles = isset($akses->akses) ? array_map('trim', explode(',', $akses->akses)) : [];
             
             $auth->akses = $userRoles;
             $auth->roles = $userRoles;
             
             $request->attributes->set('auth', $auth);
        }

        // 4. LOGIKA CEK ROLE (RBAC)
        if (empty($roles)) {
            return $next($request);
        }

        // Ambil user dari attributes request yang PASTI sudah di-hydrate
        $userObj = $request->attributes->get('auth');
        $currentUserRoles = $userObj->roles ?? []; // Default array kosong jika null

        // Pastikan tipe data array
        if (!is_array($currentUserRoles)) {
            $currentUserRoles = [];
        }

        foreach ($roles as $role) {
            // Support pipe: "LppmKetua|LppmAnggota"
            $roleGroup = explode('|', $role);
            foreach ($roleGroup as $r) {
                if (in_array(trim($r), $currentUserRoles)) {
                    return $next($request);
                }
            }
        }

        abort(403, 'Anda tidak memiliki hak akses untuk halaman ini.');
    }

    /**
     * Helper untuk inject roles ke user object dan request attributes
     */
    private function hydrateUserRoles($user, $request)
    {
        $akses = HakAksesModel::where('user_id', $user->id)->first();
        $userRoles = isset($akses->akses) ? array_map('trim', explode(',', $akses->akses)) : [];
        
        // Inject properti dinamis
        $user->akses = $userRoles;
        $user->roles = $userRoles;

        // Update instance di Auth Facade juga agar sinkron di Controller
        if (Auth::check() && Auth::id() === $user->id) {
            Auth::setUser($user);
        }

        // Update atribut request agar bisa diakses controller lain jika perlu
        $request->attributes->set('auth', $user);
        $request->merge(['user' => $user]);
    }
}