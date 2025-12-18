<!DOCTYPE html>
<html>
<head>
    <title>Formulir 1 - Hasil Review</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 12pt; line-height: 1.5; }
        .header { text-align: center; margin-bottom: 20px; position: relative; } /* Tambahkan position relative */
        
        /* UPDATE CSS LOGO AGAR RAPI */
        .header img { 
            width: 80px; 
            position: absolute; 
            left: 10px; /* Geser sedikit agar tidak mepet kiri */
            top: 5px; 
        }
        
        .header h2 { margin: 0; font-size: 14pt; font-weight: bold; margin-left: 60px; /* Geser teks agar tidak tertutup logo */ }
        .header p { margin: 0; font-size: 10pt; margin-left: 60px; }
        
        .line { border-bottom: 3px solid black; margin-top: 10px; margin-bottom: 2px; }
        .line-thin { border-bottom: 1px solid black; margin-bottom: 20px; }
        
        /* ... (CSS LAINNYA TETAP SAMA) ... */
        .title { text-align: center; font-weight: bold; margin: 30px 0; text-transform: uppercase; }
        .content-table { width: 100%; margin-bottom: 20px; }
        .content-table td { vertical-align: top; padding: 5px 0; }
        .label { width: 150px; }
        .separator { width: 10px; }
        .box-container { 
            margin-top: 10px; 
            border: 1px solid black; 
            min-height: 300px; 
            padding: 10px; 
            /* Tambahkan ini agar box bisa membesar ke bawah jika teks sangat panjang */
            height: auto; 
        }
        .box-title { font-weight: bold; text-decoration: underline; margin-bottom: 10px; display: block; }
        .review-text { 
            /* PERBAIKAN DISINI */
            width: 100%;                /* Pastikan lebar mengikuti container */
            white-space: pre-wrap;      /* Menjaga enter user, TAPI tetap wrap text panjang */
            word-wrap: break-word;      /* Memaksa kata yang sangat panjang untuk turun */
            overflow-wrap: break-word;  /* Standar modern untuk break-word */
            text-align: justify;        /* Opsional: Agar rata kiri kanan lebih rapi */
        }
        .footer { margin-top: 50px; width: 100%; }
        .signature-box { float: right; width: 250px; text-align: center; }
        .signature-space { height: 80px; display: flex; align-items: center; justify-content: center; font-style: italic; color: #555; font-size: 10pt; }
        .system-note { clear: both; margin-top: 20px; font-size: 9pt; font-style: italic; color: #555; border-top: 1px solid #ccc; padding-top: 5px; }
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

    <div style="font-size: 10pt; margin-bottom: 10px;">Formulir 1. Hasil Review</div>

    <div class="title">HASIL REVIEW</div>

    <table class="content-table">
        <tr>
            <td class="label">Nama Pemakalah</td>
            <td class="separator">:</td>
            <td>{{ $dosen_nama }}</td>
        </tr>
        <tr>
            <td class="label">Judul Makalah</td>
            <td class="separator">:</td>
            <td>{{ $judul_makalah }}</td>
        </tr>
    </table>

    <p><strong>Hasil Review</strong> <em>(silahkan menggunakan lembar tambahan jika diperlukan).</em></p>

    <div class="box-container">
        <span class="box-title">Hasil review:</span>
        <div class="review-text">
            {{ $catatan_review ?? 'Tidak ada catatan khusus.' }}
        </div>
    </div>

    <div class="footer">
        <div class="signature-box">
            <p>Laguboti, {{ \Carbon\Carbon::parse($tanggal_review)->translatedFormat('d F Y') }}</p>
            <p>Reviewer</p>
            
            <div class="signature-space">
                <br><br>
                Signed ({{ $reviewer_nama }})
            </div>

            <p>( {{ $reviewer_nama }} )</p>
        </div>
    </div>

    <div class="system-note">
        *Form ini tidak perlu tanda tangan basah karena dibuat dan divalidasi oleh sistem SPDRS.
    </div>

</body>
</html>