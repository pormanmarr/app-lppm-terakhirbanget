<?php

namespace App\Http\Controllers\App\HRD;

use App\Http\Controllers\Controller;
use App\Models\SeminarModel;
use App\Models\NotifikasiModel;
use App\Helper\ToolsHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class HRDController extends Controller
{
    // ====================================================
    // 1. DASHBOARD HRD (LIST REQUEST SURAT TUGAS)
    // ====================================================
    public function index()
    {
        // Ambil pengajuan yang butuh Surat Tugas (menunggu) atau sudah selesai (riwayat)
        $suratTugasList = SeminarModel::with(['dosen.user'])
            ->whereIn('status_progress', ['menunggu_surat_tugas', 'selesai'])
            ->orderBy('updated_at', 'desc')
            ->get();

        return Inertia::render('app/hrd/hrd-home-page', [
            'pageName' => 'Penerbitan Surat Tugas',
            'suratTugasList' => $suratTugasList
        ]);
    }

    // ====================================================
    // 2. HALAMAN UPLOAD SURAT TUGAS
    // ====================================================
    public function createUpload($id)
    {
        $seminar = SeminarModel::with(['dosen.user'])->findOrFail($id);

        // Validasi Status
        if ($seminar->status_progress !== 'menunggu_surat_tugas') {
            return redirect()->route('hrd.surat-tugas.index')
                ->with('error', 'Pengajuan ini tidak dalam status menunggu surat tugas.');
        }

        return Inertia::render('app/hrd/surat-tugas-upload-page', [
            'seminar' => $seminar
        ]);
    }

    // ====================================================
    // 3. PROSES SIMPAN SURAT (FINALISASI)
    // ====================================================
    public function storeUpload(Request $request, $id)
    {
        $request->validate([
            'file_surat' => 'required|file|mimes:pdf|max:5120', // Maks 5MB
            'nomor_surat' => 'required|string|max:100',
        ], [
            'file_surat.required' => 'File surat tugas wajib diunggah.',
            'nomor_surat.required' => 'Nomor surat wajib diisi.'
        ]);

        DB::beginTransaction();
        try {
            $seminar = SeminarModel::findOrFail($id);

            // 1. Upload File
            $path = $request->file('file_surat')->store('surat-tugas', 'public');

            // 2. Simpan Data ke Metadata
            $meta = $seminar->kewajiban_penelitian ?? [];
            $meta['surat_tugas'] = [
                'file_path' => $path,
                'nomor_surat' => $request->nomor_surat,
                'tanggal_terbit' => now()->toDateString(),
                'diterbitkan_oleh' => auth()->user()->name
            ];

            // 3. Update Status -> SELESAI (Final State)
            $seminar->update([
                'kewajiban_penelitian' => $meta,
                'status_progress' => 'selesai'
            ]);

            // 4. Notifikasi ke Dosen
            if ($seminar->dosen) {
                NotifikasiModel::create([
                    'id' => ToolsHelper::generateId(),
                    'user_id' => $seminar->dosen->user_id,
                    'judul' => 'Surat Tugas Terbit',
                    'pesan' => 'Surat Tugas Anda telah diterbitkan oleh HRD. Proses pengajuan selesai.',
                    'tipe' => 'success',
                    'is_read' => false,
                    'url_target' => route('dosen.seminar.step6', $seminar->id) // Arahkan ke halaman download surat
                ]);
            }

            DB::commit();
            return redirect()->route('hrd.surat-tugas.index')
                ->with('success', 'Surat Tugas berhasil diterbitkan. Alur selesai.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses: ' . $e->getMessage());
        }
    }
}