<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jalan2Kuy.id - Pembayaran Gagal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body style="margin: 0; padding: 0; background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('/assets/gambar/bgfix2.jpg'); background-size: cover;  background-position: center; background-attachment: fixed;  min-height: 100vh;">
    @include('partials.navbar')

    <div style="padding: 100px 20px; text-align: center; min-height: 70vh;">
        <div style="background: white; padding: 50px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); display: inline-block; min-width: 500px;">
            <h2 style="margin-bottom: 30px;">Pembayaran Gagal / Timeout!</h2>
            
            <!-- Icon Silang Merah -->
            <i class="fa-solid fa-circle-xmark" style="color: #ff3366; font-size: 120px; margin-bottom: 30px;"></i>
            
            <p style="font-weight: bold; color: #333; margin-bottom: 30px;">
                Pembayaran Tiket Gagal atau Waktu Habis.<br>Silahkan Kembali ke Menu Awal.
            </p>
            
            <a href="/Homepage" style="display: inline-block; background-color: #333; color: white; padding: 12px 30px; text-decoration: none; border-radius: 8px; font-weight: bold;">
                Kembali ke Beranda
            </a>
        </div>
    </div>

    @include('partials.footer')
</body>
</html>