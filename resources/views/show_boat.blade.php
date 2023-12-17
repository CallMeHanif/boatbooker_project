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

    <style>
    .center-video {
        display: block;
        margin: 0 auto;
    }
</style>

</head>

<body>
    <x-navbar_user />

    <!-- DETAIL -->
    <div class="container-fluid">
        <div class="card border-0 shadow-lg rounded pb-4">
            <div class="row">
                <div class="col-lg-6">
                    <img src="{{ url('Storage/' . $car->boat_img) }}" class="w-100">
                </div>
                <div class="col-lg-6 mt-4 ps-3 d-flex flex-column justify-content-around">
                    <div class="row px-3">
                        <h1 class="fw-bold">{{ $car->category }} - {{ $car->name }}</h1>
                        <p class="fs-3 fw-semibold">Rp {{ $car->price }} /hari</p>
                    </div>
                    <form action="{{ route('add_order', $car) }}" method="post" class="">
                        @csrf
                        <div class="row px-3">
                            <div class="date-input mb-3">
                                <label for="dateFirst" class="fs-4 fw-semibold mb-1" style="color: #0d7c5d;">Tanggal
                                    Pinjam</label>
                                <input type="date" name="rent_date" class="form-control" id="dateFirst">
                            </div>
                            <div class="date-input">
                                <label for="dateFirst" class="fs-4 fw-semibold mb-1" style="color: #0d7c5d;">Tanggal
                                    Kembali</label>
                                <input type="date" name="return_date" class="form-control" id="dateFirst">
                            </div>
                        </div>
                        <div class="detail-btn ms-3 pt-3">
                            @php
                            $disableButton = $CarReturns->where('date_of_return', null)->count() >= 2;
                            @endphp

                            @if (!$disableButton)
                            <button class="btn btn-rent" type="submit">Sewa Sekarang</button>
                            @else
                            <button class="btn btn-rent" type="submit" disabled>Sewa Sekarang</button>
                            <p style="color: red;">Maximum 2 ongoing orders!</p>
                            @endif
                        </div>
                    </form>

                    @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <p style="color: red; margin-left:20px;">Tanggal Pinjam harus lebih awal dari tanggal
                        kembali</p>
                    @endforeach

                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="container-lg">
        <div class="card border-0 shadow-lg rounded mt-5">
            <h5 class="ms-3 mt-4 text-center">Detail Produk</h5>

            <hr>
            <div class="detail-product row text-center" style="justify-content: center;">
                <div class="col-lg-3 col-4">
                    <p class="mb-1">Kategori</p>
                    <p>{{ $car->category }}</p>
                </div>
                <div class="col-lg-3 col-4">
                    <p class="mb-1">Nama</p>
                    <p> {{ $car->name }}</p>
                </div>
                <div class="col-lg-3 col-4">
                    <p class="mb-1">Kapasitas</p>
                    <p>{{ $car->capacity }} orang</p>
                </div>
                <div class="col-lg-3 col-4">
                    <p class="mb-1">Bahan Bakar</p>
                    <p>{{ $car->fuel }}</p>
                </div>
            </div>

            <div class="video" style="margin-top: 12px; position: relative;">
                @if($car->boat_vid)
                <video class="center-video" width="70%" height="auto" controls>
                    <source src="{{ url('storage/' . $car->boat_vid) }}"
                        type="video/{{ pathinfo($car->boat_vid, PATHINFO_EXTENSION) }}">
                    Your browser does not support the video tag.
                </video>

                @else
                    <p style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">Video tidak tersedia</p>
                @endif
            </div>

            <hr>
            <div class="detail-desc mt-2">
                <h3 class="fs-3 fw-semibold ms-5">Deskripsi</h3>
                <p class="fs-6 text-secondary px-5 py-4">Nikmati petualangan laut yang tak terlupakan dengan kapal kami,
                    sebuah pesona laut yang dirancang untuk memberikan pengalaman mewah dan kenangan indah.
                    Kapal kami, yang dinamai "Ocean Explorer", adalah pilihan ideal untuk acara eksklusif,
                    liburan pribadi, dan perjalanan romantis. <br><br>

                    1. Keanggunan yang Luar Biasa: Ocean Explorer hadir dengan desain yang anggun dan interior yang
                    mewah.
                    Setiap detailnya mencerminkan keindahan dan kenyamanan, memberikan pengalaman berlayar yang tak
                    tertandingi. <br>

                    2. Fasilitas Modern: Dilengkapi dengan fasilitas modern, termasuk kamar tidur mewah, ruang tamu yang
                    luas,
                    dapur lengkap, dan area bersantai yang menyajikan pemandangan laut yang memukau. <br>

                    3. Kru Profesional: Layani setiap kebutuhan Anda dengan kru berpengalaman kami yang siap memberikan
                    pelayanan prima.
                    Mereka akan memastikan perjalanan Anda berlangsung mulus dan memuaskan. <br>

                    4. Kelengkapan Hiburan: Kapal dilengkapi dengan sistem hiburan mutakhir, termasuk layar plasma,
                    sistem audio berkualitas tinggi, dan akses Wi-Fi, memastikan Anda tetap terhibur selama perjalanan.
                    <br><br>

                    Kapal ini adalah perwujudan dari kemajuan teknologi otomotif yang menyatukan performa tinggi,
                    keamanan, kenyamanan, efisiensi, dan keindahan dalam satu paket yang mengagumkan
                </p>
            </div>
        </div>
    </div>
    <!-- DETAIL END -->
    <x-footer_user />



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>
    < </body>

</html>