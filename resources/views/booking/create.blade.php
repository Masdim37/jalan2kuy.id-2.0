<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/event/detailEvent.css') }}">
</head>

<body>

    {{-- Navbar --}}
    @include('partials.navbar')

    <section class="event-detail">
        <div class="event-box" id="eventBox">

            <div id="eventDetailContent">
            </div>
        </div>
    </section>

    {{-- Footer --}}
    @include('partials.footer')

</body>

</html>