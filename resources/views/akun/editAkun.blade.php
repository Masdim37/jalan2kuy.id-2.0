<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jalan2kuy.id - Edit Account</title>
    <link rel="stylesheet" href="{{ asset('css/akun/editAkun.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

    <!-- Header halaman edit akun dengan tombol kembali, ikon user, dan judul -->
<header class="header">
    <a href="{{ url('/Account') }}" style="color: inherit; text-decoration: none;">
        <i class="fa-solid fa-arrow-left back"></i>
    </a>
    
    <i class="fa-solid fa-user icon"></i>
    <h1>Edit Account</h1>
</header>

    <!-- Container utama untuk form edit data akun user -->
<main class="form-container">

    <!-- Form untuk memperbarui data akun user -->
    <form id="editForm" class="form-box" action="{{ url('/Update-Profile') }}" method="POST">
        @csrf
        @method('PUT') <div class="input-group">
            <input type="text" name="nameUser" placeholder="Name" required value="{{ old('nameUser', $user->nameUser) }}">
            @error('nameUser') <span class="error-msg">{{ $message }}</span> @enderror
        </div>

        <!-- Input email user -->
        <div class="input-group">
            <input type="email" name="email" placeholder="Email" required value="{{ old('email', $user->email) }}">
            @error('email') <span class="error-msg">{{ $message }}</span> @enderror
        </div>

        <!-- Radio button untuk memilih jenis kelamin user -->
        <div class="gender-section">
            <label>Jenis Kelamin</label>
            <div class="radio-group">
                <label>
                    <input type="radio" name="gender" value="1" {{ (old('gender', $user->gender) == 1) ? 'checked' : '' }} required> 
                    Laki-laki
                </label>
                
                <label>
                    <input type="radio" name="gender" value="0" {{ (old('gender', $user->gender) == 0) ? 'checked' : '' }} required> 
                    Perempuan
                </label>
            </div>
            @error('gender') <span class="error-msg">{{ $message }}</span> @enderror
        </div>

        <!-- Input nomor telepon user -->
        <div class="input-group">
            <input type="tel" name="phone" placeholder="Nomor Telepon" required value="{{ old('phone', $user->phone) }}">
            @error('phone') <span class="error-msg">{{ $message }}</span> @enderror
        </div>

        <!-- Card Tanggal Lahir -->
        <div class="input-group">
            <input type="date" name="birthDate" 
                value="{{ old('birthDate', isset($user->birthDate) ? \Carbon\Carbon::parse($user->birthDate)->format('Y-m-d') : '') }}">
            
            @error('birthDate') 
                <span class="error-msg">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Input username user -->
        <div class="input-group">
            <input type="text" name="username" placeholder="Username" required value="{{ old('username', $user->username) }}">
            @error('username') <span class="error-msg">{{ $message }}</span> @enderror
        </div>

        <!-- Input password user -->
        <div class="input-group">
            <input type="password" name="password" placeholder="Password Baru (Kosongkan jika tidak ingin ubah)" value="{{ old('password') }}">
            <small style="font-size: 11px; color: #666; display:block; margin-top: 5px;">*Isi hanya jika ingin mengganti password</small>
            @error('password') <span class="error-msg">{{ $message }}</span> @enderror
        </div>

        <!-- Tombol simpan perubahan -->
        <button type="submit" class="save-btn">Save Changes</button>
    </form>
</main>

</body>
</html>