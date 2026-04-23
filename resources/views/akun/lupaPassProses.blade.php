<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>jalan2kuy.id - Lupa Password</title>

    <link rel="stylesheet" href="{{ asset('css/akun/lupapass.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <!-- Navbar berisi tombol kembali ke halaman login dan logo -->
    <header class="navbar">
        <button class="back-btn" id="backButton" type="button">
            <img src="{{ asset('assets/gambar/icon/return.png') }}" alt="kembali">
        </button>
        <div class="logo">
            <img src="{{ asset('assets/gambar/icon/logo.png') }}" alt="Logo jalan2kuy.id">
        </div>
    </header>

    <div class="form-container">
        <h1>Lupa Password</h1>
        <h4>Masukkan Code Yang Sudah Dikirim Lewat Email {{ session('reset_email') }}</h4>
        <form id="registerForm" action="{{ url('/verifikasi-otp-proses') }}" method="POST">
            @csrf

            <!-- Input kode -->
            <input type="text" name="code" placeholder="Masukkan Code" required value="{{ old('code') }}">
            @error('code') <span class="error-msg">{{ $message }}</span> @enderror

            <!-- link -->
            <div class="link-box">
                @if (session('otp-resent'))
                    <div class="timer" id="countdown">00:15 Untuk Memberi Code Lagi</div>
                    <a href="{{ url('resend-otp') }}">Resend Code?</a>
                @else
                    <div class="timerNot" id="countdownNot"></div>
                    <a href="{{ url('resend-otp') }}">Resend Code?</a>
                @endif
            </div>

            <!-- Tombol submit registrasi -->
            <button type="submit">Kirim</button>
        </form>
    </div>

    <script>
        // Tombol kembali
        document.getElementById('backButton').addEventListener('click', function () {
            window.location.href = "{{ url('/lupaPass') }}";
        });

        // Timer resend code
        let time = {{ $expired ?? 15 }};

        let countdown = setInterval(function () {

            let minute = Math.floor(time / 60);
            let second = time % 60;

            minute = minute < 10 ? "0" + minute : minute;
            second = second < 10 ? "0" + second : second;

            document.getElementById("countdown").innerHTML =
                minute + ":" + second;
            time--;

            if (time < 0) {
                clearInterval(countdown);
                clearInterval(autoCheck);
            }
        }, 1000);
    </script>

</body>

</html>