<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jalan2kuy.id - Admin Login</title>

    <link rel="stylesheet" href="{{ asset('css/akun/loginAdmin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

<div class="background-shape"></div>

<div class="login-container">

    <!-- LEFT SIDE -->
    <div class="login-left">
        <h1>Admin Panel</h1>
        <p>
            Selamat datang kembali di dashboard admin Jalan2Kuy.id
        </p>

        <div class="admin-icon">
            <i class="fa-solid fa-user-shield"></i>
        </div>
    </div>

    <!-- RIGHT SIDE -->
    <div class="login-right">

        <button class="back-btn" id="backButton">
            <i class="fa-solid fa-arrow-left"></i>
        </button>

        <h2>Login</h2>
        <p class="subtitle">Masuk untuk melanjutkan</p>

        @if(session('error'))
            <div class="alert error">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ url('/admin/login-proses') }}" method="POST">
            @csrf

            <div class="input-group">
                <i class="fa-solid fa-user"></i>
                <input 
                    type="text" 
                    name="username" 
                    placeholder="Username"
                    required
                    value="{{ old('username') }}"
                >
            </div>

            <div class="input-group password-group">
                <i class="fa-solid fa-lock"></i>

                <input 
                    type="password" 
                    name="password"
                    id="passwordLogin"
                    placeholder="Password"
                    required
                >

                <span class="toggle-pass-login" onclick="togglePasswordLogin()">
                    <i class="fa fa-eye"></i>
                </span>
            </div>

            <button type="submit" class="btn-login">
                Masuk
            </button>

        </form>

    </div>
</div>

<script>
    document.getElementById('backButton').addEventListener('click', function() {
        window.location.href = "{{ url('/') }}";
    });

    function togglePasswordLogin() {
        const passInput = document.getElementById('passwordLogin');
        const icon = document.querySelector('.toggle-pass-login i');

        if (passInput.type === "password") {
            passInput.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            passInput.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>

</body>
</html>