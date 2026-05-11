<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Admin</title>
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
        }

        /* ================= BODY ================= */
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #15514A;
            padding-top: 85px;
        }

        /* ================= NAVBAR ================= */
        .navbar {
            background-color: #15514A;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 40px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 85px;
            z-index: 1000;

            /* 🔥 HILANGKAN GARIS */
            box-shadow: none;
            border: none;
        }

        /* ================= LOGO ================= */
        .logo img {
            height: 55px;
            width: auto;
            display: block;
            filter: brightness(0) invert(1);
        }

        /* ================= NAV LINKS & ADMIN ================= */
        .nav-links {
            display: flex;
            gap: 40px;
        }

        /* Gabungkan styling untuk link navbar, link logout, dan teks admin */
        .nav-links a,
        .admin a,
        .admin .admin-text {
            color: white;
            text-decoration: none;
            font-size: 20px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: color 0.3s ease;
        }

        /* Mengatur wadah admin agar elemennya sejajar */
        .admin {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Kursor default untuk teks admin karena bukan tombol/link */
        .admin .admin-text {
            cursor: default;
        }

        /* Efek hover hanya untuk link */
        .nav-links a:hover,
        .admin a:hover {
            color: #b7f7d8;
        }

        /* Styling untuk garis pemisah | */
        .admin .divider {
            color: white;
            font-size: 20px;
            opacity: 0.6;
            /* Dibuat sedikit redup agar lebih elegan */
            user-select: none;
        }

        /* ================= ICONS ================= */
        .home,
        .destinasi,
        .event,
        .gallery,
        .akun {
            width: 18px;
            height: 18px;
            display: inline-block;
            background-size: cover;
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 900px) {
            .nav-links {
                gap: 30px;
            }

            .nav-links a,
            .admin a,
            .admin .admin-text,
            .admin .divider {
                font-size: 18px;
            }
        }

        @media (max-width: 700px) {
            .navbar {
                padding: 10px 20px;
                height: 75px;
            }

            body {
                padding-top: 75px;
            }

            .logo img {
                height: 45px;
            }

            .nav-links {
                gap: 20px;
            }

            .nav-links a,
            .admin a,
            .admin .admin-text,
            .admin .divider {
                font-size: 16px;
            }
        }

        @media (max-width: 550px) {
            body {
                padding-top: 130px;
            }

            .navbar {
                height: auto;
                flex-direction: column;
                gap: 12px;
                padding: 12px 20px;
            }

            .nav-links {
                order: 3;
                flex-wrap: wrap;
                justify-content: center;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">

        <div class="logo">
            <a href="{{ url('/admin/Homepage') }}">
                <img src="{{ asset('assets/gambar/icon/logo.png') }}" alt="jalan2kuy.id logo">
            </a>
        </div>

        <div class="nav-links">
            <a href="{{ url('/admin/Homepage') }}"><i class="home"></i> Home</a>
            <a href="{{ url('/admin/Destination') }}"><i class="destinasi"></i> Destination</a>
            <a href="{{ url('/admin/Event') }}"><i class="event"></i> Event</a>
            <a href="{{ url('/admin/Gallery') }}"><i class="gallery"></i> Gallery</a>
        </div>

        <div class="admin">
            <span class="admin-text"><i class="akun"></i> Admin</span>
            <span class="divider">|</span>

            <!-- Link Logout yang dimodifikasi -->
            <a href="{{ url('/admin/logout') }}" class="logout-link"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>

            <!-- Form tersembunyi untuk mengirim request POST -->
            <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>


    </nav>

</body>

</html>
