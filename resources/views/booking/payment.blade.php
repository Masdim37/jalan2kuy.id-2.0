<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jalan2Kuy.id - Pembayaran</title>
    <link rel="stylesheet" href="{{ asset('css/payments/checkout.css') }}">
    <!-- Script WAJIB Midtrans -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
</head>
<body style="margin: 0; padding: 0; background-color: #f8f9fa;">
    @include('partials.navbar')

    <div style="padding: 100px 20px; text-align: center; min-height: 70vh;">
        <div style="background: white; padding: 40px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); display: inline-block; min-width: 450px; text-align: left;">
            <h3 style="margin-top:0;">Konfirmasi Pembelian</h3>
            <p style="font-weight: bold; font-size: 18px; margin-bottom: 5px;">{{ $event->name }}</p>
            <div style="display: flex; justify-content: space-between; margin-bottom: 30px; color: gray;">
                <span>{{ $qty }}x Rp.{{ number_format($event->entranceFee, 0, ',', '.') }}</span>
                <span style="font-weight: bold; color: black;">Rp.{{ number_format($total, 0, ',', '.') }}</span>
            </div>
            
            <button id="pay-button" style="background-color: #16c4b0; color: white; padding: 15px 40px; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; font-size: 16px; width: 100%;">
                Bayar Sekarang
            </button>
        </div>
    </div>

    @include('partials.footer')

    <!-- Logika Redirect setelah dari Popup Midtrans -->
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function () {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    // Arahkan ke halaman Sukses
                    window.location.href = "{{ route('payment.success', $orderID) }}";
                },
                onPending: function(result){
                    // Jika QRIS di-close tapi belum dibayar, bisa diarahkan ke halaman tiket pending
                    window.location.href = "/MyTiket"; 
                },
                onError: function(result){
                    // Arahkan ke halaman Gagal
                    window.location.href = "{{ route('payment.failed', $orderID) }}";
                },
                onClose: function(){
                    console.log('User menutup popup tanpa menyelesaikan pembayaran');
                }
            });
        };
    </script>
</body>
</html>