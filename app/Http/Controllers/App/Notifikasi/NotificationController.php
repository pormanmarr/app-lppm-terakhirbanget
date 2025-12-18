<?php

namespace App\Http\Controllers\App\Notifikasi;

use App\Http\Controllers\Controller;
use App\Models\NotifikasiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class NotificationController extends Controller
{
    /**
     * Menampilkan halaman daftar notifikasi lengkap
     */
    public function index()
    {
        $user = Auth::user();
        
        $notifications = NotifikasiModel::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('app/notifications/notification-page', [
            'pageName' => 'Notifikasi',
            'notifications' => $notifications
        ]);
    }

    /**
     * Menandai satu notifikasi sebagai sudah dibaca
     */
   public function markAsRead($id)
    {
        $notif = NotifikasiModel::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $notif->update(['is_read' => true]);

        // 🔥 PERBAIKAN DISINI: Cek 'url_target'
        if ($notif->url_target) {
            return Inertia::location($notif->url_target);
        }

        return back();
    }

    /**
     * Menandai SEMUA notifikasi sebagai sudah dibaca
     */
    public function markAllAsRead()
    {
        NotifikasiModel::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return back();
    }

    /**
     * Menghapus notifikasi lama (Cleanup)
     */
    public function cleanupNotifications()
    {
        // Hapus notifikasi yang sudah dibaca dan lebih lama dari 30 hari
        NotifikasiModel::where('user_id', Auth::id())
            ->where('is_read', true)
            ->where('created_at', '<', now()->subDays(30))
            ->delete();

        return back()->with('success', 'Notifikasi lama berhasil dibersihkan.');
    }
}