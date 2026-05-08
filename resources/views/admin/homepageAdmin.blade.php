<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jalan2Kuy.id - Homepage Admin</title>
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
</head>
<body>

    @include('partials.navbarAdmin')

    <div class="dashboard-container">

        <!-- Statistik -->
        <div class="stats-container">

            <div class="card">
                <h3>Total Penjualan Tiket</h3>
                <p>1.250</p>
            </div>

            <div class="card">
                <h3>Jumlah Event</h3>
                <p>35</p>
            </div>

            <div class="card">
                <h3>Destinasi Wisata</h3>
                <p>18</p>
            </div>

            <div class="card">
                <h3>Akun Terdaftar</h3>
                <p>2.430</p>
            </div>

        </div>

        <!-- Konten bawah -->
        <div class="bottom-section">

            <!-- Event populer -->
            <div class="popular-event">
                <h2>Event Paling Banyak Dikunjungi</h2>

                <div class="event-card">
                    <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb" alt="Event">
                    
                    <div class="event-info">
                        <h3>Festival Dieng Culture</h3>
                        <p>Total Pengunjung: 850 orang</p>
                        <p>Tiket Terjual: 720 tiket</p>
                    </div>
                </div>
            </div>

            <!-- Grafik sederhana -->
            <div class="chart-section">
                <h2>Statistik Pengunjung</h2>

                <div class="chart">

                    <div class="bar">
                        <span>Jan</span>
                        <div class="fill jan"></div>
                    </div>

                    <div class="bar">
                        <span>Feb</span>
                        <div class="fill feb"></div>
                    </div>

                    <div class="bar">
                        <span>Mar</span>
                        <div class="fill mar"></div>
                    </div>

                    <div class="bar">
                        <span>Apr</span>
                        <div class="fill apr"></div>
                    </div>

                    <div class="bar">
                        <span>Mei</span>
                        <div class="fill mei"></div>
                    </div>

                </div>
            </div>

        </div>

        <!-- Tabel aktivitas -->
        <div class="activity-section">

            <h2>Aktivitas Terbaru</h2>

            <table>
                <thead>
                    <tr>
                        <th>Nama User</th>
                        <th>Event</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Andi</td>
                        <td>Festival Dieng</td>
                        <td>Sukses</td>
                        <td>07 Mei 2026</td>
                    </tr>

                    <tr>
                        <td>Siti</td>
                        <td>Jazz Baturaden</td>
                        <td>Sukses</td>
                        <td>06 Mei 2026</td>
                    </tr>

                    <tr>
                        <td>Raka</td>
                        <td>Camping Serayu</td>
                        <td>Pending</td>
                        <td>06 Mei 2026</td>
                    </tr>
                </tbody>
            </table>

        </div>

    </div>

    @include('partials.footer')

</body>
</html>