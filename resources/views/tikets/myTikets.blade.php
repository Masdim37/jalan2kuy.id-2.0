<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jalan2kuy.id - My Ticket</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/tikets/tiket.css') }}">
    
    <style>
        /* Reset margin bawaan browser supaya navbar tidak ada celah putih */
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
        }
        /* Penyesuaian agar teks berada di tengah kotak desain frontend */
        .ticket-header, .info-box, .date-box {
            display: flex;
            align-items: center;
            color: #ffffff; /* Memastikan teks berwarna putih agar terbaca */
            padding: 5px 15px;
        }
    </style>
</head>

<body>

    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Section Ticket --}}
    <section class="ticket-page">
        <h1 class="ticket-title">MY TICKET</h1>
        <div class="ticket-container">

            {{-- Pesan Notifikasi jika berhasil bayar --}}
            @if(session('success'))
                <div style="text-align: center; background-color: #16c4b0; color: white; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Mulai Looping Data Tiket Asli dari Database --}}
            {{-- Mulai Looping Data Tiket Asli dari Database --}}
            @forelse($tikets as $tiket)
                <div class="ticket-card" style="margin-bottom: 20px;">
                    <div class="ticket-left">
                        {{-- Nama Event (Di atas kotak abu-abu) --}}
                        <div class="ticket-header" style="padding: 10px 20px; display: flex; align-items: center; overflow: hidden;">
                            <h2 style="margin: 0; color: white; font-size: 1.2rem; white-space: nowrap; text-overflow: ellipsis; overflow: hidden; width: 100%;">
                                {{ $tiket->event->name ?? 'Event Tidak Diketahui' }}
                            </h2>
                        </div>
                        
                        <div class="ticket-info">
                            {{-- ID Tiket (Di kotak abu-abu pertama) --}}
                            <div class="info-box" style="padding: 5px 15px; display: flex; align-items: center; justify-content: center;">
                                <span style="font-weight: bold; color: #333; font-size: 0.9rem;">
                                    ID: {{ $tiket->tiketID }}
                                </span>
                            </div>
                            
                            {{-- Lokasi Event (Di kotak abu-abu kedua) --}}
                            <div class="info-box" style="padding: 5px 15px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                <span style="color: #333; font-size: 0.8rem; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;">
                                    <i class="fa-solid fa-location-dot"></i> {{ Str::limit($tiket->event->location ?? '-', 20) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="ticket-right">
                        {{-- Tanggal Event --}}
                        <div class="date-box" style="display: flex; align-items: center; padding: 0 10px;">
                            <span style="color: white; font-size: 0.9rem; font-weight: bold;">
                                <i class="fa-regular fa-calendar"></i> {{ $tiket->event ? \Carbon\Carbon::parse($tiket->event->startDate)->format('d M Y') : '-' }}
                            </span>
                        </div>
                        
                        {{-- Waktu Event --}}
                        <div class="date-box" style="display: flex; align-items: center; padding: 0 10px;">
                            <span style="color: white; font-size: 0.9rem;">
                                <i class="fa-regular fa-clock"></i> {{ $tiket->event ? \Carbon\Carbon::parse($tiket->event->startTime)->format('H:i') : '-' }} WIB
                            </span>
                        </div>
                        
                        {{-- Status Tiket --}}
                        <div class="date-box" style="display: flex; align-items: center; padding: 0 10px;">
                            <span style="color: white; font-size: 0.9rem;">
                                Status: {{ $tiket->tiketStatus == 1 ? 'Aktif' : 'Digunakan' }}
                            </span>
                        </div>
                        
                        {{-- Harga atau Action --}}
                        <button class="btn-ticket" style="font-weight: bold; cursor: default;">
                            Rp {{ number_format($tiket->price, 0, ',', '.') }}
                        </button>
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 50px; color: #333; width: 100%;">
                    <h3>Kamu belum memiliki tiket yang aktif.</h3>
                    <p>Silakan lakukan pembelian tiket terlebih dahulu.</p>
                </div>
            @endforelse

        </div>
    </section>
    
    {{-- Footer --}}
    @include('partials.footer')

</body>
</html>