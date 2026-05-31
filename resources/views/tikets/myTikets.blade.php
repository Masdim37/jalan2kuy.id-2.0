<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jalan2Kuy.id - My Tickets</title>
    <link rel="stylesheet" href="{{ asset('css/tikets/tiket.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

    @include('partials.navbar')

    <div class="container" style="padding: 100px 20px; min-height: 80vh; max-width: 900px; margin: 0 auto;">
        <h2 style="color: #333; margin-bottom: 30px;"><i class="fa-solid fa-ticket" style="color: #16c4b0; margin-right: 10px;"></i> Tiket Saya</h2>

        @if(session('success'))
            <div style="background-color: #d4edda; color: #155724; padding: 12px; border-radius: 6px; margin-bottom: 20px; font-weight: bold; font-size: 14px;">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background-color: #f8d7da; color: #721c24; padding: 12px; border-radius: 6px; margin-bottom: 20px; font-weight: bold; font-size: 14px;">
                <i class="fa-solid fa-circle-xmark"></i> {{ session('error') }}
            </div>
        @endif

        @forelse($tikets as $tiket)
            <div class="ticket-card" style="background: white; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.08); margin-bottom: 20px; display: flex; overflow: hidden; border-left: 6px solid #16c4b0;">
                
                <div style="padding: 20px; flex: 1;">
                    <span style="font-size: 12px; color: gray; font-weight: bold; text-transform: uppercase;">ID TIKET: {{ $tiket->tiketID }}</span>
                    <h3 style="margin: 5px 0 10px 0; color: #222; font-size: 20px;">{{ $tiket->event->name ?? 'Nama Event Tidak Tersedia' }}</h3>
                    
                    <p style="margin: 5px 0; color: #555; font-size: 14px;"><i class="fa-solid fa-calendar-days" style="width: 20px; color: #16c4b0;"></i> {{ $tiket->event->startDate ?? '-' }} s/d {{ $tiket->event->endDate ?? '-' }}</p>
                    
                    <p style="margin: 5px 0; color: #555; font-size: 14px;"><i class="fa-solid fa-clock" style="width: 20px; color: #16c4b0;"></i> {{ isset($tiket->event->startTime) ? date('H:i', strtotime($tiket->event->startTime)) : '-' }} - {{ isset($tiket->event->endTime) ? date('H:i', strtotime($tiket->event->endTime)) : '-' }} WIB</p>
                    
                    <p style="margin: 5px 0; color: #555; font-size: 14px;"><i class="fa-solid fa-location-dot" style="width: 20px; color: #16c4b0;"></i> {{ $tiket->event->location ?? '-' }}</p>
                    <p style="margin: 5px 0; color: #333; font-weight: bold; font-size: 15px;">Harga: Rp {{ number_format($tiket->price, 0, ',', '.') }}</p>
                </div>

                <div style="padding: 20px; background: #fdfdfd; border-left: 2px dashed #ddd; display: flex; flex-direction: column; justify-content: center; align-items: center; min-width: 200px; text-align: center;">
                    
                    @if($tiket->tiketStatus == 1)
                        <span style="background-color: #2ecc71; color: white; padding: 6px 14px; border-radius: 20px; font-weight: bold; font-size: 12px; display: inline-block; margin-bottom: 15px;">
                            <i class="fa-solid fa-circle-check"></i> Sudah Dibayar
                        </span>
                        <div style="font-size: 11px; color: #27ae60; font-weight: bold;">Tiket Siap Digunakan</div>
                    
                    @elseif($tiket->tiketStatus == 0)
                        <span style="background-color: #f1c40f; color: #333; padding: 6px 14px; border-radius: 20px; font-weight: bold; font-size: 12px; display: inline-block; margin-bottom: 8px;">
                            <i class="fa-solid fa-clock"></i> Pending
                        </span>
                        <div style="font-size: 11px; color: #b7950b; font-weight: bold; margin-bottom: 12px;">Menunggu Transfer</div>
                        
                        <div style="display: flex; gap: 6px; width: 100%; justify-content: center;">
                            <a href="{{ route('payment.continue', $tiket->orderID) }}" style="background-color: #16c4b0; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 11px; font-weight: bold; display: inline-block; box-shadow: 0 2px 4px rgba(22,196,176,0.2);">
                                <i class="fa-solid fa-money-bill-wave"></i> Bayar
                            </a>

                            <form action="{{ route('payment.cancel', $tiket->orderID) }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin membatalkan pesanan ini?')" style="margin: 0; padding: 0;">
                                @csrf
                                <button type="submit" style="background-color: #e74c3c; color: white; padding: 6px 12px; border: none; border-radius: 6px; font-size: 11px; font-weight: bold; cursor: pointer; display: inline-block;">
                                    <i class="fa-solid fa-trash-can"></i> Batal
                                </button>
                            </form>
                        </div>
                    
                    @else
                        <span style="background-color: #e74c3c; color: white; padding: 6px 14px; border-radius: 20px; font-weight: bold; font-size: 12px; display: inline-block; margin-bottom: 15px;">
                            <i class="fa-solid fa-circle-xmark"></i> Dibatalkan / Expired
                        </span>
                        <div style="font-size: 11px; color: #c0392b; font-weight: bold;">Transaksi Hangus</div>
                    @endif

                </div>
            </div>
        @empty
            <div style="text-align: center; padding: 50px; background: white; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                <i class="fa-solid fa-ticket-simple" style="font-size: 60px; color: #ccc; margin-bottom: 15px;"></i>
                <p style="color: #666; font-size: 16px; font-weight: bold;">Kamu belum memesan tiket apapun.</p>
                <a href="/" style="display: inline-block; margin-top: 10px; background: #16c4b0; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">Cari Event Menarik</a>
            </div>
        @endforelse

        @if($tikets->hasPages())
            <div style="margin-top: 40px; display: flex; justify-content: center; align-items: center; gap: 10px;">
                @if ($tikets->onFirstPage())
                    <button style="background: #e0e0e0; color: #aaa; padding: 10px 20px; border: none; border-radius: 6px; cursor: not-allowed; font-weight: bold;" disabled>
                        <i class="fa-solid fa-arrow-left"></i> Sebelumnya
                    </button>
                @else
                    <a href="{{ $tikets->previousPageUrl() }}" style="background: #16c4b0; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: bold; box-shadow: 0 2px 5px rgba(22,196,176,0.3);">
                        <i class="fa-solid fa-arrow-left"></i> Sebelumnya
                    </a>
                @endif

                <span style="font-weight: bold; font-size: 14px; color: #555; background: #eee; padding: 10px 15px; border-radius: 6px;">
                    Halaman {{ $tikets->currentPage() }} dari {{ $tikets->lastPage() }}
                </span>

                @if ($tikets->hasMorePages())
                    <a href="{{ $tikets->nextPageUrl() }}" style="background: #16c4b0; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: bold; box-shadow: 0 2px 5px rgba(22,196,176,0.3);">
                        Berikutnya <i class="fa-solid fa-arrow-right"></i>
                    </a>
                @else
                    <button style="background: #e0e0e0; color: #aaa; padding: 10px 20px; border: none; border-radius: 6px; cursor: not-allowed; font-weight: bold;" disabled>
                        Berikutnya <i class="fa-solid fa-arrow-right"></i>
                    </button>
                @endif
            </div>
        @endif

    </div>

    @include('partials.footer')

</body>
</html>