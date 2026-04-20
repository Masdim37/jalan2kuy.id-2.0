<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jalan2kuy.id - My Ticket</title>

    <link rel="stylesheet" href="{{ asset('css/tikets/tiket.css') }}">
</head>

<body>

    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Section Ticket --}}
    <section class="ticket-page">
        <h1 class="ticket-title">MY TICKET</h1>
        <div class="ticket-container">

            {{-- Ticket Card Polos --}}
            @for($i = 1; $i <= 5; $i++)
                <div class="ticket-card">
                    <div class="ticket-left">
                        <div class="ticket-header"></div>
                        <div class="ticket-info">
                            <div class="info-box"></div>
                            <div class="info-box"></div>
                        </div>
                    </div>

                    <div class="ticket-right">
                        <div class="date-box"></div>
                        <div class="date-box"></div>
                        <div class="date-box"></div>
                        <button class="btn-ticket"></button>
                    </div>
                </div>
            @endfor
        </div>
    </section>
    {{-- Footer --}}
    @include('partials.footer')

</body>
</html>