<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jalan2Kuy.id - Homepage Admin</title>

    <style>
        /* ================= GLOBAL ================= */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('/assets/gambar/bgfix2.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            padding-bottom: 50px;
        }

        /* Container */
        .dashboard-container {
            padding: 100px 30px 30px 30px; /* Padding atas disesuaikan untuk navbar */
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Statistik */
        .stats-container {
            display: grid;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        /* Baris 1: 3 Kolom */
        .stats-row-1 {
            grid-template-columns: repeat(3, 1fr);
        }
        
        /* Baris 2: 2 Kolom */
        .stats-row-2 {
            grid-template-columns: repeat(2, 1fr);
            margin-bottom: 35px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            font-size: 18px;
            color: #555;
            margin-bottom: 15px;
        }

        .card p {
            font-size: 30px;
            font-weight: bold;
            color: #1e88e5;
        }

        /* Bottom Section (Charts) */
        .bottom-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 35px;
        }

        .chart-section {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        .chart-section h2 {
            margin-bottom: 20px;
            font-size: 20px;
            color: #333;
            text-align: center;
        }

        /* Table */
        .activity-section {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        .activity-section h2 {
            margin-bottom: 20px;
            font-size: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead {
            background: #1e88e5;
            color: white;
        }

        table th,
        table td {
            padding: 15px;
            text-align: left;
        }

        table tbody tr {
            border-bottom: 1px solid #ddd;
        }

        table tbody tr:hover {
            background: #f5f5f5;
        }

        /* Badge Status Transaksi */
        .badge {
            padding: 5px 12px;
            border-radius: 20px;
            color: white;
            font-size: 14px;
            font-weight: bold;
        }
        .bg-success { background: #26c48a; }
        .bg-warning { background: #f39c12; }
        .bg-danger { background: #e74c3c; }

        /* Responsive */
        @media(max-width: 900px) {
            .bottom-section, .stats-row-1, .stats-row-2 {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    @include('partials.navbarAdmin')

    <div class="dashboard-container">

        <div class="stats-container stats-row-1">
            <div class="card">
                <h3>Total Destinasi Wisata</h3>
                <p>{{ $totalDestinasi }}</p>
            </div>
            <div class="card">
                <h3>Total Event</h3>
                <p>{{ $totalEvent }}</p>
            </div>
            <div class="card">
                <h3>Total Pengguna Aktif</h3>
                <p>{{ $totalPengguna }}</p>
            </div>
        </div>

        <div class="stats-container stats-row-2">
            <div class="card">
                <h3>Total Tiket Terjual</h3>
                <p>{{ $totalTiketTerjual }}</p>
            </div>
            <div class="card">
                <h3>Total Pendapatan (Revenue)</h3>
                <p>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="bottom-section">
            
            <div class="chart-section">
                <h2>Grafik Pendapatan (6 Bulan Terakhir)</h2>
                <canvas id="revenueChart"></canvas>
            </div>

            <div class="chart-section">
                <h2>Grafik Pendaftaran Pengguna Baru (6 Bulan Terakhir)</h2>
                <canvas id="userChart"></canvas>
            </div>

        </div>

        <div class="activity-section">
            <h2>Transaksi Terbaru</h2>
            <div style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>ID Order</th>
                            <th>Nama User</th>
                            <th>Total Bayar</th>
                            <th>Status</th>
                            <th>Tanggal Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentTransactions as $trx)
                            <tr>
                                <td>{{ $trx->orderID }}</td>
                                <td>{{ $trx->nameUser ?? 'User Terhapus' }}</td>
                                <td>Rp {{ number_format($trx->totalPrice, 0, ',', '.') }}</td>
                                <td>
                                    @if($trx->paymentStatus == 'success')
                                        <span class="badge bg-success">Berhasil</span>
                                    @elseif($trx->paymentStatus == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @else
                                        <span class="badge bg-danger">Gagal</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($trx->orderDate)->format('d M Y, H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center;">Belum ada transaksi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    @include('partials.footer')

    <script>
        // Tangkap data array dari Controller yang sudah diproses
        const labels = {!! json_encode($chartLabels) !!};
        const revenueData = {!! json_encode($revenueData) !!};
        const newUserData = {!! json_encode($newUserData) !!};

        // 1. Konfigurasi Chart Pendapatan
        const ctxRev = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctxRev, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Pendapatan (Rp)',
                    data: revenueData,
                    borderColor: '#26c48a',
                    backgroundColor: 'rgba(38, 196, 138, 0.2)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3 // Membuat garis sedikit melengkung (smooth)
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                }
            }
        });

        // 2. Konfigurasi Chart Pengguna Baru
        const ctxUser = document.getElementById('userChart').getContext('2d');
        new Chart(ctxUser, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pengguna Baru',
                    data: newUserData,
                    borderColor: '#1e88e5',
                    backgroundColor: 'rgba(30, 136, 229, 0.2)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 } // Pastikan angkanya bulat (orang)
                    }
                }
            }
        });
    </script>
</body>

</html>