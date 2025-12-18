<!DOCTYPE html>
<html>
<head>
    <title>Formulir 2. Pernyataan Telah Dilakukan Perbaikan Sesuai Hasil Review</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 12pt; line-height: 1.5; }
        .header { text-align: center; margin-bottom: 20px; position: relative; }
        .header img { width: 80px; position: absolute; left: 10px; top: 5px; }
        .header h2 { margin: 0; font-size: 14pt; font-weight: bold; margin-left: 60px; }
        .header p { margin: 0; font-size: 10pt; margin-left: 60px; }
        .line { border-bottom: 3px solid black; margin-top: 10px; margin-bottom: 2px; }
        .line-thin { border-bottom: 1px solid black; margin-bottom: 20px; }
        
        .title { text-align: center; font-weight: bold; margin: 30px 0 50px 0; font-size: 14pt; }
        
        .content-table { width: 100%; margin-bottom: 30px; }
        .content-table td { vertical-align: top; padding: 3px 0; }
        .label { width: 150px; }
        .separator { width: 10px; }
        .underline-dynamic { border-bottom: 1px dashed black; padding-bottom: 1px; width: 100%; display: inline-block; }
        .main-text { margin-top: 30px; margin-bottom: 20px; }

        .signature-section { margin-top: 80px; width: 100%; }
        .signature-box { float: right; width: 250px; text-align: left; }
        
        .signature-name-line { 
            /* Dibuat lebih tinggi untuk menampung teks signed */
            height: 80px; 
            text-align: center; 
            font-size: 12pt;
        }

        /* Penanda Tanda Tangan Digital yang Tampil di Area TTD */
        .system-signed-text {
            font-size: 10pt;
            font-style: italic;
            color: #555;
            text-align: center;
            /* Posisikan di area tanda tangan */
            padding-top: 25px; 
        }

        /* Catatan di Footer yang sama di setiap halaman */
        .system-note { 
            position: fixed;
            bottom: 30px; /* Posisi di bawah */
            left: 0;
            right: 0;
            padding: 5px 0;
            text-align: left;
            font-size: 9pt; 
            font-style: italic; 
            color: #555; 
            border-top: 1px solid #ccc; 
            margin-top: 10px; 
        }

        /* Style untuk Halaman 2 (Catatan Perbaikan) */
        .page-break { page-break-before: always; }
        .catatan-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .catatan-table th, .catatan-table td { border: 1px solid black; padding: 10px; text-align: left; vertical-align: top; }
        .catatan-table th { background-color: #f0f0f0; }
        .catatan-content { white-space: pre-wrap; word-wrap: break-word; }
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ public_path('img/Logodel.png') }}" alt="Logo Del">
        <h2>INSTITUT TEKNOLOGI DEL</h2>
        <p>Jl. Sisingamangaraja, Kec. Laguboti, Kab. Toba Samosir – 22381</p>
        <p>Sumatera Utara, Indonesia</p>
        <p>Telp: (0632) 331234, Fax: (0632) 331116</p>
        <p>Website: www.del.ac.id, Email: lppm@del.ac.id</p>
    </div>
    <div class="line"></div>
    <div class="line-thin"></div>

    <div style="font-size: 10pt; margin-bottom: 10px;">Formulir 2. Pernyataan Telah Dilakukan Perbaikan Sesuai Hasil Review</div>

    <div class="title">Surat Pernyataan Reviewer</div>

    <p>Saya yang bertanda tangan di bawah ini:</p>

    <table class="content-table">
        <tr>
            <td class="label">Nama</td>
            <td class="separator">:</td>
            <td><span class="underline-dynamic">{{ $reviewer_nama }}</span></td>
        </tr>
        <tr>
            <td class="label">NIDN</td>
            <td class="separator">:</td>
            <td><span class="underline-dynamic">{{ $reviewer_nidn ?? 'NIDN Reviewer' }}</span></td>
        </tr>
        <tr>
            <td class="label">Program Studi</td>
            <td class="separator">:</td>
            <td><span class="underline-dynamic">{{ $reviewer_prodi ?? 'Program Studi Reviewer' }}</span></td>
        </tr>
    </table>

    <p class="main-text">
    Dengan ini menyatakan dan menerangkan bahwa telah me-*review* makalah dengan rincian
    dibawah ini dan menyatakan bahwa Pemakalah telah melakukan perbaikan sesuai dengan 
    hasil *review* (terlampir).
    </p>

    <table class="content-table">
        <tr>
            <td class="label">Nama Pemakalah</td>
            <td class="separator">:</td>
            <td><span class="underline-dynamic">{{ $dosen_nama }}</span></td>
        </tr>
        <tr>
            <td class="label">Judul Makalah</td>
            <td class="separator">:</td>
            <td><span class="underline-dynamic">{{ $judul_makalah }}</span></td>
        </tr>
    </table>

    <p>
    Demikian surat pernyataan ini saya buat dengan sebenarnya untuk dipergunakan
    seperlunya.
    </p>

    <div class="signature-section">
        <div class="signature-box">
            <p style="text-align: center;">Laguboti, {{ \Carbon\Carbon::parse($tanggal_persetujuan)->translatedFormat('d F Y') }}</p>
            <p style="text-align: center;">Hormat saya,</p>
            <p style="text-align: center;"><em>Reviewer</em></p>
            
            <div class="signature-name-line">
                <div class="system-signed-text">
                    Signed ({{ $reviewer_nama }})
                </div>
            </div>
            
            <div style="text-align: center;">
                ({{ $reviewer_nama }})
            </div>
        </div>
    </div>
    

    <div class="page-break"></div>
    
    <div class="header">
        <img src="{{ public_path('img/Logodel.png') }}" alt="Logo Del">
        <h2>INSTITUT TEKNOLOGI DEL</h2>
        <p>Jl. Sisingamangaraja, Kec. Laguboti, Kab. Toba Samosir – 22381</p>
        <p>Sumatera Utara, Indonesia</p>
        <p>Telp: (0632) 331234, Fax: (0632) 331116</p>
        <p>Website: www.del.ac.id, Email: lppm@del.ac.id</p>
    </div>
    <div class="line"></div>
    <div class="line-thin"></div>

    <p style="font-size: 10pt; margin-bottom: 20px;">Catatan Perbaikan</p>

    <table class="catatan-table">
        <thead>
            <tr>
                <th style="width: 50%;">Catatan Reviewer</th>
                <th style="width: 50%;">Status Perbaikan (Balasan Dosen)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($catatan_pairs as $pair)
            <tr>
                <td class="catatan-content">
                    {!! $pair['catatan'] !!} 
                </td>
                <td class="catatan-content">
                    {!! $pair['balasan'] !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="system-note" style="padding-left: 10px;">
        *Form ini tidak perlu tanda tangan karena dibuat oleh sistem.
    </div>

</body>
</html>