<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kontrak</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('output/assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link id="theme-style" rel="stylesheet" href="{{ asset('output/assets/css/orbit-2.css') }}">
    <style>
        body, html {
            margin: 20;
            padding: 10;
        }

        /* Tambahkan gaya CSS berikut untuk memberikan garis bawah pada judul section */
        .section-title {
            border-bottom: 2px solid #000; /* Ganti warna sesuai kebutuhan */
            width: 100%; /* Menetapkan lebar garis bawah agar mencapai ujung halaman */
            padding-bottom: 10px; /* Sesuaikan sesuai kebutuhan */
            margin-bottom: 20px; /* Sesuaikan sesuai kebutuhan */
        }
        .main-wrapper {
            background: #fff;
            padding: 80px;
            padding-right: 90px;
            min-height: 100vh;
        }
        .wrapper {
            max-width: 900px;
            margin: auto;
            position: relative;
            -webkit-box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            -moz-box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="contract-container">
        <h2>Kontrak Kerja</h2>

        <p>Pada hari ini, {{ now()->format('d F Y') }}, kami yang bertanda tangan di bawah ini:</p>

        <div class="parties">
            <div class="party">
                <p><strong>Penyewa:</strong>  Hafidzon</p>
                <p><strong>Alamat:</strong> 5802 Florine Keys Suite 259 West Audreytown, PA 38905</p>
            </div>

            <div class="party">
                <p><strong>Asisten Rumah Tangga:</strong>  Lala </p>
                <p><strong>Layanan:</strong>  Pembersihan</p>
            </div>
        </div>

        <h3>1. Pekerjaan</h3>
        <p>Asisten Rumah Tangga akan melakukan tugas-tugas berikut:</p>
        <ul>
            <li>Membersihkan rumah</li>
            <li>Mengurus kebersihan dan keamanan rumah</li>
            <li>Melakukan tugas-tugas rumah tangga lainnya sesuai kesepakatan</li>
        </ul>

        <h3>2. Gaji dan Tunjangan</h3>
        <p>Penyewa akan membayar gaji kepada Asisten Rumah Tangga sebesar 480.000 setiap minggu.</p>
        <p>Asisten Rumah Tangga berhak atas tunjangan kesehatan dan cuti sesuai dengan ketentuan yang berlaku.</p>

        <h3>3. Waktu Kerja</h3>
        <p>Asisten Rumah Tangga akan bekerja selama 8 jam per hari, 6 hari per minggu, dimulai dari pukul 06.00 hingga pukul 14.00.</p>

        <h3>4. Kewajiban dan Hak</h3>
        <p>Penyewa dan Asisten Rumah Tangga setuju untuk saling menghormati hak dan kewajiban masing-masing sesuai dengan peraturan yang berlaku.</p>

        <p>Demikianlah kontrak kerja ini dibuat dengan sebenarnya oleh kedua belah pihak sebagai bentuk kesepakatan bersama.</p>

        <div class="signatures">
            <div class="signature">
                <p>Hafidzon</p>
                <img src="{{ asset('signature/penyewa.png') }}" alt="Signature Penyewa">
            </div>

            <div class="signature">
                <p>Lala</p>
                <img src="{{ asset('signature/asisten.png') }}" alt="Signature Asisten Rumah Tangga">
            </div>
        </div>
    </div>
</body>

</html>
