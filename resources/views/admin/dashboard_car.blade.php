<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('user/img/logo.png') }}">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/style.css') }}">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

    <title>List Kapal</title>
</head>

<body>
    <x-sidebar-admin />
    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Boat</h1>                
            </div>

            <a href="{{ route('create_car') }}" class="btn-download">
                <i class='bx bxs-bus'></i>
                <span class="text">Add Boat</span>
            </a>
        </div>

        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Table Boat</h3>
                </div>

                <table id="myTable" class="">
                    <thead>
                        <tr>
                            <th>Kapal</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga/Hari</th>
                            <th>Kapasitas</th>
                            <th>Bahan Bakar</th>
                            <th>Status</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cars as $car)
                            <tr>
                                <td>{{ $car->id }}</td>
                                <td>{{ $car->name }}</td>
                                <td>{{ $car->category }}</td>
                                <td>{{ $car->price }}</td>
                                <td>{{ $car->capacity }}</td>
                                <td>{{ $car->fuel }}</td>
                                <td>{{ $car->status }}</td>
                                <td><img src="{{ url('storage/'.$car->boat_img) }}" alt=""
                                        style="border-radius:0; width:100px; height:100px;">
                                </td>
                                <td class="d-flex align-items-center justify-content-center">

                                    <form action="{{ route('edit_car', $car) }}" method="get">
                                        @csrf

                                        <button type="submit" class="btn btn-primary">
                                            <i class="bx bx-edit" style="color:green; font-size: 20px;"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('delete_car', $car) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            <i class="bx bx-trash" style="color:red; font-size: 20px;"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </main>
    <!-- MAIN -->
    </section>
    <!-- CONTENT -->


    <script src="{{ asset('admin/assets/script.js') }}"></script>
    <script type="text/javascript">
    $(document).ready( function () {
    $('#myTable').DataTable();
    } );
    </script>
</body>

</html>