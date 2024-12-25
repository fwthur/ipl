<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Cetak Tiket {{ $transaction->uuid }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    {{-- Ticket --}}
    <section id="ticket">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto my-auto mt-5">
                    <div class="card border-0 shadow-sm rounded">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 mx-auto my-auto text-center">
                                    <h2 class="fw-bold">{{ date('d', strtotime($transaction->tanggal)) }}</h2>
                                    <p>{{ date('M Y', strtotime($transaction->tanggal)) }}</p>
                                </div>
                                <div class="col-md-9">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Ticket --}}
</body>
</html>
