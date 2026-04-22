<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Tiket</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/tiket/tiket.css') }}">
</head>

<body>

    {{-- Navbar --}}
    @include('partials.navbar')

    <div class="container-booking">

        {{-- LEFT --}}
        <div class="left">

            <div class="event-title">
                {{ $event->name }}
            </div>

            <h3>Pemesanan Tiket</h3>

            <p>Quantity</p>

            <div class="qty-box">
                <button type="button" onclick="minus()">-</button>
                <input type="text" id="qty" value="1" readonly>
                <button type="button" onclick="plus()">+</button>
            </div>

            <label>
                <input type="checkbox" id="check">
                *Catatan : Yakin ingin melanjutkan pembelian tiket ini?
            </label>

            <button class="btn-beli" onclick="beliTiket()">
                Beli Tiket
            </button>

        </div>

        {{-- RIGHT --}}
        <div class="right">

            <img src="{{ asset('storage/' . $event->imagePath) }}" alt="{{ $event->name }}">

            <div class="info">

                <p>
                    <i class="fa-solid fa-location-dot"></i>
                    {{ $event->location }}
                </p>

                <p>
                    <strong>Social Media :</strong>
                    <a href="https://www.instagram.com/{{ $event->socialMedia }}" target="_blank">
                        {{ '@' . $event->socialMedia }}
                    </a>
                </p>

                <p>
                    <strong>Tanggal :</strong>
                    {{ \Carbon\Carbon::parse($event->startDate)->format('d M Y') }}
                    -
                    {{ \Carbon\Carbon::parse($event->endDate)->format('d M Y') }}
                </p>

                <p>
                    <strong>Jam :</strong>
                    {{ \Carbon\Carbon::parse($event->startTime)->format('H:i') }}
                    -
                    {{ \Carbon\Carbon::parse($event->endTime)->format('H:i') }}
                </p>

                <p>
                    <strong>Tiket Masuk :</strong>
                    Rp {{ number_format($event->entranceFee, 0, ',', '.') }}
                </p>

            </div>
        </div>

    </div>

    {{-- Footer --}}
    @include('partials.footer')

    {{-- SCRIPT --}}
    <script>
        function plus() {
            let qty = document.getElementById('qty');
            qty.value = parseInt(qty.value) + 1;
        }

        function minus() {
            let qty = document.getElementById('qty');
            if (qty.value > 1) {
                qty.value = parseInt(qty.value) - 1;
            }
        }

        function beliTiket() {
            let check = document.getElementById('check');
            let qty = parseInt(document.getElementById('qty').value);

            if (!check.checked) {
                alert('⚠️ Centang konfirmasi terlebih dahulu!');
                return;
            }

            let namaEvent = "{{ $event->name }}";
            let harga = {{ $event->entranceFee }};
            let total = qty * harga;

            Swal.fire({
                background: '#f8f1f1',
                width: '650px',
                showConfirmButton: false,
                html: `
                    <div style="text-align:left; padding:10px;">
                        <h3 style="margin-bottom:20px;">Konfirmasi Pembelian</h3>

                        <h2 style="margin:0; font-size:24px;">${namaEvent}</h2>

                        <p style="margin:5px 0; font-size:18px;">
                            ${qty}x Rp.${harga.toLocaleString('id-ID')}
                            <span style="float:right; font-weight:bold;">
                                Rp.${total.toLocaleString('id-ID')}
                            </span>
                        </p>

                        <br>

                        <p style="font-weight:bold;">PEMBAYARAN VIA</p>

                        <img 
                            src="https://images.seeklogo.com/logo-png/39/2/quick-response-code-indonesia-standard-qris-logo-png_seeklogo-391791.png"
                            width="140"
                            style="margin-top:10px;"
                        >

                        <br><br>

                        <button onclick="bayarSekarang()"
                            style="
                                width:100%;
                                padding:12px;
                                background:#16c4b0;
                                color:white;
                                border:none;
                                border-radius:8px;
                                font-size:16px;
                                cursor:pointer;">
                            Bayar Sekarang
                        </button>
                    </div>
                `
            });
        }

        function bayarSekarang() {
            let qty = document.getElementById('qty').value;

            window.location.href ="/payment/{{ $event->eventID }}?qty=" + qty;
        }
    </script>

</body>
</html>