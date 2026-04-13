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
        <h1>Ganti Password</h1>
        <!-- Form registrasi akun admin baru -->
        <form id="lupaPassForm" action="{{ url('/reset-password-proses') }}" method="POST">
            @csrf

            <!-- Input password dengan fitur show/hide -->
            <div class="password-container">
                <input type="password" name="password" id="password" placeholder="Kata Sandi" required>
                <i class="fa fa-eye toggle-password" onclick="togglePassword('password', this)"></i>
            </div>
            @error('password') <span class="error-msg">{{ $message }}</span> @enderror

            <!-- Input konfirmasi password dengan toggle -->
            <div class="password-container" style="margin-top: 15px; margin-bottom: 15px;">
                <input type="password" name="password_confirmation" id="password_confirmation"
                    placeholder="Konfirmasi Kata Sandi" required>
                <i class="fa fa-eye toggle-password" onclick="togglePassword('password_confirmation', this)"></i>
            </div>

            <!-- Tombol submit registrasi -->
            <button type="submit">Kirim</button>
        </form>
    </div>

    <script>
        // Tombol kembali
        document.getElementById('backButton').addEventListener('click', function () {
            window.location.href = "{{ url('/verifikasi-otp') }}";
        });

        function togglePassword(inputId, icon) {
            const input = document.getElementById(inputId);
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash"); // Ganti ikon jadi mata dicoret
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye"); // Kembali ke ikon mata biasa
            }
        }
    </script>

</body>

</html>