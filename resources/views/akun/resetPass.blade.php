<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ganti Password Baru</title>
    <link rel="stylesheet" href="{{ asset('css/akun/lupapass.css') }}">
</head>
<body>
    <div class="form-container">
        <h1>Password Baru</h1>
        <h4>Masukkan password baru Anda</h4>
        <form action="{{ url('/reset-password-proses') }}" method="POST">
            @csrf
            <input type="password" name="password" placeholder="Password Baru" required>
            <input type="password" name="password_confirmation" placeholder="Ulangi Password Baru" required>
            @if($errors->has('password')) 
                <p style="color:red; font-size:12px;">{{ $errors->first('password') }}</p> 
            @endif
            <button type="submit">Simpan & Login</button>
        </form>
    </div>
</body>
</html>