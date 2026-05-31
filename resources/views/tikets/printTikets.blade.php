<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Tiket - {{ $tiket->tiketID }}</title>
    <!-- Panggil CSS bawaan web kamu -->
    <link rel="stylesheet" href="{{ asset('css/tikets/tiket.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        /* Sembunyikan navbar, footer, dan tombol HANYA SAAT masuk mode print kertas/PDF */
        @media print {
            .no-print, nav, header, footer, .navbar { display: none !important; }
            body { background-color: white !important; padding: 0 !important; }
            .container { padding: 0 !important; margin: 0 !important; }
            .ticket-card { box-shadow: none !important; border: 1px solid #ddd !important; border-left: 6px solid #16c4b0 !important; }
        }
    </style>
</head>
<body onload="window.print()">

    <!-- Panggil Navbar bawaan -->
    @include('partials.navbar')

    <!-- Pakai container asli bawaan web -->
    <div class="container" style="padding: 100px 20px; min-height: 80vh; max-width: 900px; margin: 0 auto;">
        
        <!-- Tombol Batal & Print -->
        <div class="no-print" style="margin-bottom: 30px; display: flex; align-items: center; gap: 10px;">
            <a href="/MyTiket" style="background-color: #e74c3c; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 14px; box-shadow: 0 2px 4px rgba(231, 76, 60, 0.2);">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
            <button onclick="window.print()" style="background-color: #3498db; color: white; padding: 10px 20px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; font-size: 14px; box-shadow: 0 2px 4px rgba(52, 152, 219, 0.2);">
                <i class="fa-solid fa-print"></i> Cetak Tiket Ulang
            </button>
        </div>

        <!-- Desain Asli Tiket Buatan Temanmu -->
        <div class="ticket-card" style="background: white; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.08); display: flex; overflow: hidden; border-left: 6px solid #16c4b0;">
            
            <div style="padding: 20px; flex: 1;">
                <span style="font-size: 12px; color: gray; font-weight: bold; text-transform: uppercase;">ID TIKET: {{ $tiket->tiketID }}</span>
                <h3 style="margin: 5px 0 10px 0; color: #222; font-size: 20px;">{{ $tiket->event->name ?? 'Nama Event Tidak Tersedia' }}</h3>
                
                <p style="margin: 5px 0; color: #555; font-size: 14px;"><i class="fa-solid fa-user" style="width: 20px; color: #16c4b0;"></i> <strong>Pemesan:</strong> {{ Session::get('user_name') }}</p>
                <p style="margin: 5px 0; color: #555; font-size: 14px;"><i class="fa-solid fa-calendar-days" style="width: 20px; color: #16c4b0;"></i> {{ $tiket->event->startDate ?? '-' }} s/d {{ $tiket->event->endDate ?? '-' }}</p>
                <p style="margin: 5px 0; color: #555; font-size: 14px;"><i class="fa-solid fa-clock" style="width: 20px; color: #16c4b0;"></i> {{ isset($tiket->event->startTime) ? date('H:i', strtotime($tiket->event->startTime)) : '-' }} - {{ isset($tiket->event->endTime) ? date('H:i', strtotime($tiket->event->endTime)) : '-' }} WIB</p>
                <p style="margin: 5px 0; color: #555; font-size: 14px;"><i class="fa-solid fa-location-dot" style="width: 20px; color: #16c4b0;"></i> {{ $tiket->event->location ?? '-' }}</p>
                <p style="margin: 15px 0 0 0; color: #333; font-weight: bold; font-size: 15px;">Harga: Rp {{ number_format($tiket->price, 0, ',', '.') }}</p>
            </div>

            <div style="padding: 20px; background: #fdfdfd; border-left: 2px dashed #ddd; display: flex; flex-direction: column; justify-content: center; align-items: center; min-width: 200px; text-align: center;">
                
                <span style="background-color: #2ecc71; color: white; padding: 6px 14px; border-radius: 20px; font-weight: bold; font-size: 12px; display: inline-block; margin-bottom: 15px;">
                    <i class="fa-solid fa-circle-check"></i> Sudah Dibayar
                </span>

                <!-- Kotak Khusus QR Code Nanti -->
                <div style="border: 2px solid #ddd; width: 100px; height: 100px; display: flex; align-items: center; justify-content: center; background: white; border-radius: 8px; margin-bottom: 15px;">
                    <i class="fa-solid fa-qrcode" style="font-size: 60px; color: #ccc;"></i>
                </div>
                
                <div style="font-size: 11px; color: #27ae60; font-weight: bold;">Tiket Siap Digunakan</div>

            </div>
        </div>

    </div>

    <!-- Panggil Footer bawaan -->
    @include('partials.footer')

</body>
</html>