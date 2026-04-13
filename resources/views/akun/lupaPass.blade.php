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
        <h4>Masukkan email untuk mengirim kode reset</h4>
        <!-- Form registrasi akun admin baru -->
        <form id="lupaPassForm" action="{{ url('/lupaPassProses') }}" method="POST">
            @csrf

            <!-- Input email -->
            <input type="email" name="email" placeholder="Masukkan Email" required value="{{ old('email') }}">
            @error('email') <span class="error-msg">{{ $message }}</span> @enderror

            <!-- Tombol submit  -->
            <button type="submit">Kirim</button>
        </form>
    </div>

    <script>
        // Tombol kembali
        document.getElementById('backButton').addEventListener('click', function () {
            window.location.href = "{{ url('/') }}";
        });
    </script>

</body>

</html>