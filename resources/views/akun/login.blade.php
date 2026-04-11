<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jalan2kuy.id - Login</title>

    <link rel="stylesheet" href="{{ asset('css/akun/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<div class="container">

    <!-- ================= LEFT SIDE ================= -->
    <div class="left-side">

        <!-- logo -->
        <div class="logo-box">
            <img src="{{ asset('assets/gambar/icon/logo.png') }}" alt="logo">
        </div>
    </div>

    <!-- ================= RIGHT SIDE ================= -->
    <div class="right-side">
        <div class="login-card">
            <h2>Login</h2>
            <!-- pesan error -->
            @if(session('error'))
                <div class="alert-error">
                    {{ session('error') }}
                </div>
            @endif

            <!-- pesan sukses -->
            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- form login -->
            <form action="{{ url('/login-proses') }}" method="POST">
                @csrf

                <!-- username -->
                <div class="input-group">
                    <input 
                        type="text"
                        name="username"
                        placeholder="Username"
                        required
                        value="{{ old('username') }}">
                </div>

                <!-- password -->
                <div class="input-group password-wrapper">
                    <input 
                        type="password"
                        name="password"
                        id="passwordLogin"
                        placeholder="Kata Sandi"
                        required>

                    <i class="fa fa-eye toggle-pass-login"
                        onclick="togglePasswordLogin()"></i>
                </div>

                <!-- link -->
                <div class="link-box">
                    <a href="{{ url('/register') }}">Register akun?</a>
                    <a href="#">Lupa Password?</a>
                </div>

                <!-- tombol -->
                <button type="submit" class="btn-login">
                    Masuk
                </button>

            </form>

        </div>

    </div>

</div>

<script>
/* tombol kembali */
document.getElementById('backButton').addEventListener('click', function () {
    window.location.href = "{{ url('/') }}";
});

/* show hide password */
function togglePasswordLogin() {
    const input = document.getElementById('passwordLogin');
    const icon = document.querySelector('.toggle-pass-login');

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
</script>

</body>
</html>