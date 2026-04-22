<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jalan2kuy.id - Payments</title>

    <link rel="stylesheet" href="{{ asset('css/payments/payments.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

@include('partials.navbar')

<div class="payment-container">

    <div class="payment-box">

        <h2>Pembayaran QRIS</h2>

        <p class="desc">
            Scan kode QR berikut menggunakan aplikasi
            E-Wallet / Mobile Banking untuk menyelesaikan pembayaran.
        </p>

        <div class="payment-content">

            <!-- LEFT -->
            <div class="left-payment">

                <div class="qr-wrapper">

                    <img
                        id="qrImage"
                        src="{{ $qr ?? asset('assets/qrSementara.jpg') }}"
                        alt="QR Payment">

                </div>

                <a
                    href="{{ $qr ?? asset('assets/qrSementara.jpg') }}"
                    target="_blank"
                    download="QRIS-Payment.png"
                    class="btn-download">

                    Download QR

                </a>

            </div>


            <!-- RIGHT -->
            <div class="right-payment">

                <div class="timer-title">
                    Bayar Sebelum
                </div>

                <div class="timer" id="countdown">
                    05:00
                </div>

                <div class="status pending" id="paymentStatus">
                    Menunggu Pembayaran...
                </div>

                <div class="detail-box">

                    <div class="detail-item">
                        <span>Nama Event</span>
                        <span>{{ $event->name ?? 'Nama Event' }}</span>
                    </div>

                    <div class="detail-item">
                        <span>Jumlah Tiket</span>
                        <span>{{ $qty ?? 1 }}</span>
                    </div>

                    <div class="detail-item">
                        <span>Total Bayar</span>
                        <span>
                            Rp {{ number_format($total ?? 100000,0,',','.') }}
                        </span>
                    </div>

                    <div class="detail-item">
                        <span>Order ID</span>
                        <span>{{ $order_id ?? 'ORD123456' }}</span>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@include('partials.footer')

<script>

/* ===================================
   TIMER
=================================== */

let time = {{ $expired ?? 300 }};

let countdown = setInterval(function(){

    let minute = Math.floor(time / 60);
    let second = time % 60;

    minute = minute < 10 ? "0"+minute : minute;
    second = second < 10 ? "0"+second : second;

    document.getElementById("countdown").innerHTML =
        minute + ":" + second;

    time--;

    if(time < 0){

        clearInterval(countdown);
        clearInterval(autoCheck);

        document.getElementById("countdown").innerHTML =
            "Expired";

        document.getElementById("paymentStatus").innerHTML =
            "Pembayaran Kadaluarsa";

        document.getElementById("paymentStatus").className =
            "status expired";

        showPaymentStatus('expired');
    }

},1000);



/* ===================================
   AUTO CHECK PAYMENT
=================================== */

let autoCheck = setInterval(function(){
    fetch("/check-payment/{{ $order_id ?? 'ORD123456' }}")
    .then(response => response.json())
    .then(data => {
        if(data.status == "success"){
            clearInterval(autoCheck);
            clearInterval(countdown);
            document.getElementById("paymentStatus").innerHTML =
                "Pembayaran Berhasil";
            document.getElementById("paymentStatus").className =
                "status success";
            showPaymentStatus('success');
        }
        else if(data.status == "failed"){
            clearInterval(autoCheck);
            clearInterval(countdown);
            showPaymentStatus('failed');
        }
    })
    .catch(error => {
        console.log(error);
    });
},3000);



/* ===================================
   POPUP STATUS
=================================== */

function showPaymentStatus(status){
    if(status == "success"){
        Swal.fire({
            icon:'success',
            title:'Pembayaran Berhasil!',
            text:'Silahkan lihat tiket yang sudah dibeli.',
            confirmButtonColor:'#16c4b0',
            confirmButtonText:'Ke Halaman Event',
            allowOutsideClick:false
        }).then(() => {
            window.location.href = "/Event";
        });
    }
    else if(status == "failed"){
        Swal.fire({
            icon:'error',
            title:'Pembayaran Gagal!',
            text:'Pembayaran gagal. Silahkan coba lagi.',
            confirmButtonColor:'#e74c3c',
            confirmButtonText:'Ke Halaman Event',
            allowOutsideClick:false
        }).then(() => {
            window.location.href = "/Event";
        });
    }
    else if(status == "expired"){
        Swal.fire({
            icon:'warning',
            title:'Timeout!',
            text:'Anda melewati batas waktu pembayaran.',
            confirmButtonColor:'#f39c12',
            confirmButtonText:'Ke Halaman Event',
            allowOutsideClick:false
        }).then(() => {
            window.location.href = "/Event";
        });
    }
}

</script>

</body>
</html>