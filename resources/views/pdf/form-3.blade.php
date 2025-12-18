<!DOCTYPE html>
<html>
<head>
    <title>Formulir 3. Surat Permohonan Pendanaan Registrasi Seminar</title>
    <style>
        /* Margin Atas dibuat 4.5cm agar Header Muat di setiap halaman */
        @page {
            margin: 4.5cm 2.5cm 2.5cm 2.5cm;
            size: A4;
        }
        
        body { font-family: 'Times New Roman', Times, serif; font-size: 12pt; line-height: 1.3; }
        
        /* --- HEADER FIXED (AGAR MUNCUL DI TIAP HALAMAN) --- */
        header {
            position: fixed;
            top: -4cm; /* Naik ke area margin atas */
            left: 0;
            right: 0;
            height: 3.5cm;
            text-align: center;
        }

        .header-content {
            position: relative;
            width: 100%;
        }
        
        .header-content img { width: 100px; position: absolute; left: 10px; top: 0; } 
        .header-content h2 { margin: 0; font-size: 14pt; font-weight: bold; margin-left: 90px; }
        .header-content p { margin: 0; font-size: 10pt; margin-left: 90px; }
        
        .line { border-bottom: 3px solid black; margin-top: 10px; margin-bottom: 2px; }
        .line-thin { border-bottom: 1px solid black; margin-bottom: 0px; }

        /* --- FOOTER FIXED (AGAR MUNCUL DI TIAP HALAMAN) --- */
        footer {
            position: fixed; 
            bottom: -1.5cm; 
            left: 0; 
            right: 0;
            height: 1cm;
            font-size: 9pt; 
            font-style: italic; 
            color: #555;
            border-top: 1px solid #ccc; 
            padding-top: 5px;
        }

        /* --- BODY CONTENT --- */
        .form-title { font-size: 11pt; margin-bottom: 10px; font-weight: bold; margin-top: 10px; }
        .date-right { text-align: right; margin-bottom: 10px; }

        /* --- TABEL --- */
        .content-table { width: 100%; margin-bottom: 10px; border-collapse: collapse; }
        .content-table td { vertical-align: top; padding: 2px 0; }
        .label { width: 180px; }
        .separator { width: 10px; text-align: center; }
        
        .box {
            display: inline-block; width: 12px; height: 12px; border: 1px solid #000;
            text-align: center; line-height: 10px; font-size: 10px; margin-right: 5px;
            font-family: sans-serif;
        }

        /* --- TANDA TANGAN --- */
        .signature-table { width: 100%; margin-top: 30px; margin-bottom: 20px; page-break-inside: avoid; }
        .signature-table td { vertical-align: top; width: 50%; text-align: center; }

        .signature-box { 
            width: 80%; 
            margin: 0 auto;
            text-align: left; 
        }
        
        .signature-name-line { 
            height: 60px; 
            display: flex;
            align-items: center;
            justify-content: center; 
        }

        .system-signed-text {
            font-size: 10pt;
            font-style: italic;
            color: #555;
            text-align: center;
            padding-top: 20px;
        }

        /* --- CEKLIS ARTEFAK --- */
        .checklist-header {
            text-align: left; 
            font-weight: bold; 
            margin-bottom: 10px; 
            margin-top: 10px; 
        }
        
        .checklist-table { width: 100%; border-collapse: collapse; border: 1px solid black; }
        .checklist-table th, .checklist-table td { border: 1px solid black; padding: 5px; font-size: 11pt; }
        .checklist-table th { background-color: #f0f0f0; text-align: center; font-weight: bold; }
        .center { text-align: center; }
    </style>
</head>
<body>

    <header>
        <div class="header-content">
            <img src="{{ public_path('img/Logodel.png') }}" alt="Logo Del">
            <h2>INSTITUT TEKNOLOGI DEL</h2>
            <p>Jl. Sisingamangaraja, Kec. Laguboti, Kab. Toba Samosir – 22381</p>
            <p>Sumatera Utara, Indonesia</p>
            <p>Telp: (0632) 331234, Fax: (0632) 331116</p>
            <p>Website: www.del.ac.id, Email: lppm@del.ac.id</p>
            <div class="line"></div>
            <div class="line-thin"></div>
        </div>
    </header>

    <footer>
        *Form ini tidak perlu tanda tangan basah karena dibuat oleh sistem.
    </footer>

    <main>
        <div class="form-title">Formulir 3. Surat Permohonan Pendanaan Registrasi Seminar</div>

        <div class="date-right">
            Laguboti, {{ \Carbon\Carbon::parse($seminar->created_at)->translatedFormat('d F Y') }}
        </div>

        <table class="content-table" style="width: auto;">
            <tr>
                <td style="width: 80px;">Perihal</td>
                <td class="separator">:</td>
                <td><strong>Surat Permohonan Pendanaan Registrasi Seminar</strong></td>
            </tr>
            <tr>
                <td>Lampiran</td>
                <td class="separator">:</td>
                <td>Artefak Paper</td>
            </tr>
        </table>

        <div style="margin: 15px 0;">
            Kepada Yth.<br>
            <strong>Ketua LPPM Institut Teknologi Del</strong><br>
            di-<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tempat
        </div>

        <p>Saya yang bertanda tangan di bawah ini:</p>

        <table class="content-table">
            <tr>
                <td class="label">Nama</td>
                <td class="separator">:</td>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <td class="label">NIDN</td>
                <td class="separator">:</td>
                <td>{{ $profil->nidn ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Prodi</td>
                <td class="separator">:</td>
                <td>{{ $profil->prodi ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Sinta ID</td>
                <td class="separator">:</td>
                <td>{{ $profil->sinta_id ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Scopus ID</td>
                <td class="separator">:</td>
                <td>{{ $profil->scopus_id ?? '-' }}</td>
            </tr>
        </table>

        <p>Dengan ini memohon agar disetujui pendanaan registrasi makalah dengan rincian sebagai berikut:</p>

        <table class="content-table">
            <tr>
                <td class="label">Judul Makalah</td>
                <td class="separator">:</td>
                <td>{{ $seminar->judul_makalah }}</td>
            </tr>
            <tr>
                <td class="label">Nama Forum</td>
                <td class="separator">:</td>
                <td>{{ $seminar->nama_forum }}</td>
            </tr>
            <tr>
                <td class="label">Institusi Penyelenggara</td>
                <td class="separator">:</td>
                <td>{{ $seminar->institusi_penyelenggara }}</td>
            </tr>
            <tr>
                <td class="label">Waktu Pelaksanaan</td>
                <td class="separator">:</td>
                <td>{{ \Carbon\Carbon::parse($seminar->tanggal_mulai)->translatedFormat('d F Y') }} s/d {{ \Carbon\Carbon::parse($seminar->tanggal_selesai)->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td class="label">Tempat Pelaksanaan</td>
                <td class="separator">:</td>
                <td>{{ $seminar->tempat_pelaksanaan }}</td>
            </tr>
            <tr>
                <td class="label">Mesin Pengindex</td>
                <td class="separator">:</td>
                <td>{{ $seminar->mesin_pengindex ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Biaya Registrasi</td>
                <td class="separator">:</td>
                <td>Rp {{ number_format($seminar->biaya_registrasi, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="label">Website Penyelenggara</td>
                <td class="separator">:</td>
                <td>{{ $seminar->website_penyelenggara ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label" style="vertical-align: top;">Luaran</td>
                <td class="separator" style="vertical-align: top;">:</td>
                <td>
                    <?php $l = $seminar->kewajiban_penelitian['kategori_luaran'] ?? ''; ?>
                    <table style="width: 100%;">
                        <tr>
                            <td width="50%"><span class="box">{{ $l == 'Prosiding Nasional' ? 'v' : '' }}</span> Prosiding Nasional</td>
                            <td width="50%"><span class="box">{{ $l == 'Jurnal Nasional' ? 'v' : '' }}</span> Jurnal Nasional</td>
                        </tr>
                        <tr>
                            <td><span class="box">{{ $l == 'Prosiding Internasional' ? 'v' : '' }}</span> Prosiding Internasional</td>
                            <td><span class="box">{{ str_contains($l, 'Jurnal Nasional Terakreditasi') ? 'v' : '' }}</span> Jurnal Nas. Terakreditasi</td>
                        </tr>
                        <tr>
                            <td><span class="box">{{ str_contains($l, 'Prosiding Internasional Terindeks') ? 'v' : '' }}</span> Pros. Int. Terindeks</td>
                            <td><span class="box">{{ $l == 'Jurnal Internasional' ? 'v' : '' }}</span> Jurnal Internasional</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><span class="box">{{ str_contains($l, 'Jurnal Internasional Terindeks') ? 'v' : '' }}</span> Jurnal Int. Terindeks</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <p>Demikian surat permohonan ini saya sampaikan, terima kasih.</p>

        <table class="signature-table">
            <tr>
                <td>
                    Hormat Saya,
                    <div class="signature-box">
                        <div class="signature-name-line">
                            <div class="system-signed-text">
                                Signed ({{ $user->name }})
                            </div>
                        </div>
                        <div style="text-align: center;">({{ $user->name }})</div>
                    </div>
                </td>

                <td>
                    Diketahui,<br>
                    Ketua Program Studi,
                    
                    <div class="signature-box">
                        <div class="signature-name-line">
                            <div class="system-signed-text">
                                {{-- Jika Kaprodi ketemu, tampilkan Signed. Jika tidak, kosong --}}
                                @if(isset($kaprodi_nama) && strpos($kaprodi_nama, '...') === false)
                                    Signed ({{ $kaprodi_nama }})
                                @else
                                    <br><br> @endif
                            </div>
                        </div>
                        <div style="text-align: center;">({{ $kaprodi_nama ?? '...........................................' }})</div>
                    </div>
                </td>
            </tr>
        </table>

        <div class="checklist-header">
            Ceklis Artefak
        </div>

        <table class="checklist-table">
            <thead>
                <tr>
                    <th style="width: 30px;">No</th>
                    <th>Artefak Paper</th>
                    <th>Link Google Drive</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $links = $seminar->kewajiban_penelitian['link_artefak'] ?? [];
                    $labels = [
                        "Bukti review oleh sesama dosen",
                        "Bukti submit paper ke penyelenggara",
                        "Bukti makalah diterima (LoA)",
                        "Catatan reviewer panitia",
                        "Bukti registrasi keikutsertaan mengikuti seminar",
                        "Softcopy versi final paper"
                    ];
                @endphp
                @foreach($labels as $index => $label)
                <tr>
                    <td class="center">{{ $index + 1 }}.</td>
                    <td>{{ $label }}</td>
                    <td>
                        @if(!empty($links[$index]))
                            <a href="{{ $links[$index] }}" target="_blank" style="color: blue; text-decoration: underline; word-break: break-all;">
                                {{ $links[$index] }}
                            </a>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>

</body>
</html>