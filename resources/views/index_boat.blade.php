<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BoatBooker</title>
    <link rel="icon" href="{{ asset('user/img/logo.png') }}" sizes="50">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
</head>

<body>
    <x-navbar_user />

    <div class="container mt-3">
        <form action="{{ route('search') }}" method="GET">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari kapal..." name="q" value="{{ request('q') }}">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
            </div>
        </form>
    </div>

    <!-- RENT -->
    <div class="rent container-lg mt-5 riwayat-body">
        <div class="row mt-4">
            @foreach ($cars as $car)
            <div class="col-lg-4 col-sm-6 mt-4">
                <div class="card border-0 shadow-lg">
                    <img src="{{ url('storage/' . $car->boat_img) }}" class="card-img-top"
                        style="height: 200px; object-fit: cover;" alt="...">
                    <div class="card-body" style="height: 150px;">
                        <h5 class="card-title">{{ $car->name }}</h5>
                        <p class="rent-merk">{{ $car->category }}</p>
                    </div>

                    <p class="rent-price fw-semibold d-flex justify-content-center">Rp {{ $car->price }} /hari</p>

                    @if(auth()->user() && auth()->user()->is_admin !== 1)
                        @if ($car->status == 'Tersedia')
                        <form action="{{ route('show_boat', $car) }}" method="get">
                            <button type="submit"
                                class="btn btn-rent border-0 rounded-0 rounded-bottom p-2 fw-semibold w-100">
                                Detail Kapal
                            </button>
                        </form>
                        @else
                        <button type="button" class="btn btn-rent border-0 rounded-0 rounded-bottom p-2 fw-semibold w-100"
                        style="background-color: #FF0000; color: white;" disabled>
                            {{ $car->status }}
                        </button>
                        @endif
                    @endif

                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- RENT END -->

    <x-footer_user />

    <script src="{{ asset('user/js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>
</body>

</html>