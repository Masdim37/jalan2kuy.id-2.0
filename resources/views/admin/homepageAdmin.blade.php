<!-- resources/views/admin/homepageAdmin.blade.php -->

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
</head>

<body>

<div class="dashboard-layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="sidebar-logo">
            jalan2kuy.id
        </div>

        <div class="menu-title">
            MAIN MENU
        </div>

        <ul class="sidebar-menu">

            <li class="active">
                Dashboard
            </li>

            <li>
                Event
            </li>

            <li>
                Destination
            </li>

            <li>
                Transaksi
            </li>

            <li>
                Tiket
            </li>

            <li>
                User
            </li>

            <li>
                Laporan
            </li>

            <li>
                Logout
            </li>

        </ul>

    </aside>


    <!-- MAIN -->
    <main class="main-wrapper">

        <!-- TOPBAR -->
        <div class="topbar">

            <div>
                <h1>Dashboard Admin</h1>
                <p>Monitoring Website Wisata & Event</p>
            </div>

            <div class="topbar-right">

                <div class="notif">
                    3
                </div>

                <div class="profile">
                    A
                </div>

            </div>

        </div>


        <!-- STATS -->
        <div class="stats-grid">

            <div class="stats-card green">
                <h3>Revenue</h3>
                <h2>Rp 23.569.000</h2>
                <span>↑ 12.5%</span>
            </div>

            <div class="stats-card purple">
                <h3>Total Transaksi</h3>
                <h2>3.435</h2>
                <span>↑ 8.2%</span>
            </div>

            <div class="stats-card blue">
                <h3>User</h3>
                <h2>1.245</h2>
                <span>↑ 5.7%</span>
            </div>

            <div class="stats-card orange">
                <h3>Pending Payment</h3>
                <h2>47</h2>
                <span>↓ 2.1%</span>
            </div>

        </div>


        <!-- CHART -->
        <div class="chart-grid">

            <!-- SALES -->
            <div class="chart-box large-chart">

                <div class="box-title">
                    Statistik Penjualan Tiket
                </div>

                <div class="fake-chart">

                    <div class="line blue-line"></div>
                    <div class="line green-line"></div>

                </div>

            </div>


            <!-- PIE -->
            <div class="chart-box pie-box">

                <div class="box-title">
                    Traffic Sources
                </div>

                <div class="pie-chart"></div>

                <div class="legend">

                    <span>
                        <div class="dot blue"></div>
                        Direct
                    </span>

                    <span>
                        <div class="dot green"></div>
                        Social
                    </span>

                    <span>
                        <div class="dot orange"></div>
                        Referral
                    </span>

                </div>

            </div>

        </div>


        <!-- BOTTOM -->
        <div class="bottom-grid">

            <!-- ACTIVITY -->
            <div class="activity-box">

                <div class="box-title">
                    Recent Activity
                </div>

                <div class="activity-item">

                    <div class="circle blue-bg"></div>

                    <div>
                        <h4>New Order Received</h4>
                        <p>Order tiket berhasil dibuat</p>
                    </div>

                </div>


                <div class="activity-item">

                    <div class="circle green-bg"></div>

                    <div>
                        <h4>User Baru Registrasi</h4>
                        <p>User berhasil membuat akun</p>
                    </div>

                </div>


                <div class="activity-item">

                    <div class="circle orange-bg"></div>

                    <div>
                        <h4>Payment Pending</h4>
                        <p>Menunggu pembayaran QRIS</p>
                    </div>

                </div>

            </div>


            <!-- TABLE -->
            <div class="product-box">

                <div class="box-title">
                    Top Event
                </div>

                <table>

                    <thead>

                        <tr>
                            <th>Event</th>
                            <th>Tiket</th>
                            <th>Revenue</th>
                            <th>Status</th>
                        </tr>

                    </thead>

                    <tbody>

                        <tr>
                            <td>Sorak Sorai Fest</td>
                            <td>245</td>
                            <td>Rp 12JT</td>
                            <td>
                                <span class="status success">
                                    Active
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>Sendratari Ramayana</td>
                            <td>189</td>
                            <td>Rp 9JT</td>
                            <td>
                                <span class="status success">
                                    Active
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>Jazz Pantai Festival</td>
                            <td>98</td>
                            <td>Rp 4JT</td>
                            <td>
                                <span class="status warning">
                                    Low
                                </span>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </main>

</div>

</body>
</html>