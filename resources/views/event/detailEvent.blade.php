<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jalan2Kuy.id - {{ $event->name }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/event/detailEvent.css') }}">
</head>

<body>

    {{-- Navbar --}}
    @include('partials.navbar')

    <section class="event-detail">
        <div class="event-box" id="eventBox">

            {{-- Judul Event --}}
            <h2 class="event-title">{{ $event->name }}</h2>

            {{-- Konten Detail Event --}}
            <div id="eventDetailContent">
                <div class="event-content">

                    {{-- Bagian Kiri: Deskripsi Teks --}}
                    <div class="event-text">
                        {{-- Menampilkan deskripsi dengan format baris baru --}}
                        <p>{!! nl2br(e($event->description)) !!}</p>
                        
                        {{-- Form Beli Tiket (Mengarah ke route checkout) --}}
                        <form action="{{ route('checkout', $event->eventID) }}" method="POST" style="margin-top: 20px;">
                            @csrf
                            
                            {{-- Input Jumlah Tiket --}}
                            <div style="margin-bottom: 15px;">
                                <label for="qty" style="font-weight: bold;">Jumlah Tiket:</label>
                                <input type="number" id="qty" name="qty" value="1" min="1" max="10" style="padding: 8px; width: 70px; border-radius: 5px; border: 1px solid #ccc; margin-left: 10px;">
                            </div>
                            
                            <button type="submit" class="btn-ticket" style="border: none; cursor: pointer; width: 100%;">
                                Beli Tiket
                            </button>
                        </form>
                    </div>

                    {{-- Bagian Kanan: Gambar, Info Singkat & Map --}}
                    <div class="event-side">
                        <img src="{{ asset('storage/' . $event->imagePath) }}" alt="{{ $event->name }}">
                        
                        <div class="event-info">
                            {{-- Lokasi --}}
                            <p><i class="fa-solid fa-location-dot"></i> {{ $event->location }}</p>
                            <br>
                            <ul>
                                {{-- Media Social --}}
                                <li>
                                    <strong>Social Media :</strong>
                                    <a href="https://www.instagram.com/{{ $event->socialMedia }}" target="_blank"
                                        style="color: blue; text-decoration: none;">
                                        {{ '@' . $event->socialMedia }}
                                    </a>
                                </li>
                                {{-- Tanggal --}}
                                <li>
                                    <strong>Tanggal :</strong>
                                    {{ $event->startDate ? \Carbon\Carbon::parse($event->startDate)->format('d M Y') : '-' }}
                                    -
                                    {{ $event->endDate ? \Carbon\Carbon::parse($event->endDate)->format('d M Y') : '-' }}
                                </li>

                                {{-- Jam --}}
                                <li>
                                    <strong>Jam :</strong>
                                    {{ \Carbon\Carbon::parse($event->startTime)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($event->endTime)->format('H:i') }}
                                </li>

                                {{-- Harga --}}
                                <li>
                                    <strong>Tiket Masuk :</strong> Rp
                                    {{ number_format($event->entranceFee, 0, ',', '.') }}
                                </li>
                            </ul>
                        </div>

                        {{-- maps--}}
                        <div class="map-container">
                            <iframe src="https://maps.google.com/maps?q={{ urlencode($event->location) }}&output=embed"
                                loading="lazy">
                            </iframe>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    @include('partials.footer')

</body>

</html>