<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jalan2Kuy.id - Pembayaran</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <!-- Kalau temanmu punya CSS khusus buat payment, bisa di-uncomment nanti -->
    {{-- <link rel="stylesheet" href="{{ asset('css/payments/payments.css') }}"> --}}
</head>

<!-- Tambah margin 0 di body untuk ngakalin celah putih tanpa merusak CSS frontend temanmu -->
<body style="margin: 0; padding: 0; background-color: #f8f9fa;">

    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Konten Pembayaran --}}
    <div style="padding: 80px 20px; text-align: center; min-height: 70vh;">
        <div style="background: white; padding: 40px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); display: inline-block; min-width: 450px; text-align: left;">
            <h2 style="color: #16c4b0; text-align: center; margin-bottom: 20px;">Menunggu Pembayaran...</h2>
            <hr>
            
            <div style="margin: 20px 0; font-size: 18px;">
                <p><strong>Order ID:</strong> {{ $orderID }}</p>
                <p><strong>Nama Event:</strong> {{ $event->name }}</p>
                <p><strong>Jumlah Tiket:</strong> {{ $qty }}</p>
                <p><strong>Total Tagihan:</strong> <span style="color: #e74c3c; font-weight: bold;">Rp {{ number_format($total, 0, ',', '.') }}</span></p>
            </div>
            
            <!-- Form untuk menembak ke route bypass -->
            <form action="{{ route('dummy.pay', $orderID) }}" method="POST">
                @csrf
                <button type="submit" style="background-color: #16c4b0; color: white; padding: 15px 40px; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; font-size: 16px; width: 100%;">
                    Simulasikan Pembayaran Sukses
                </button>
            </form>
            
            <p style="margin-top: 15px; font-size: 12px; color: gray; text-align: center;">*Tombol ini hanya untuk simulasi bypass (Progress Video).</p>
        </div>
    </div>

    {{-- Footer --}}
    @include('partials.footer')

</body>

</html>