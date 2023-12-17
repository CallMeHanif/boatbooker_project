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

    <title>Dashboard Rental</title>
    <style>
        .order {
            margin: 0 auto;
            width: 500px;
            border: 1px solid #ccc;
            padding: 1rem;
        }

        .head {
            background-color: #f9f9f9;
            padding: 0.5rem;
            margin-bottom: 1rem;
        }

        .container {
            padding: 0.5rem;
        }

        p {
            margin-bottom: 0.5rem;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 0.5rem;
            border-radius: 0.25rem;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0069d9;
        }
    </style>
</head>

<body>
    <x-sidebar-admin />
    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Order</h1>
            </div>

        </div>

        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Bukti Pembayaran</h3>

                </div>

                <table id="myTable" class="">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>User ID</th>
                            <th>Nama Kustomer</th>
                            <th>Jumlah Pembayaran</th>
                            <th>Kapal</th>
                            <th>Status Pembayaran</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>

                            <td>{{ $order->id }}</td>
                            <td>{{ $order->payment->user_id }}</td>
                            <td>{{ $order->payment->user->name }}</td>
                            <td>{{ $order->payment->cost }}</td>
                            <td>{{ $order->car->name }}</td>
                            <td>@if ($order->payment->is_paid)
                                <p>Sudah Lunas</p>
                                @else
                                <p>Belum Lunas</p>
                                @endif
                            </td>
                            <td>{{ $order->return_date }}</td>
                            <td>{{ $order->rent_date }}</td>
                            <td>
                                @if ($order->payment->payment_receipt == null)
                                Belum ada pembayaran
                                @else
                                <a href="{{ url('storage/' . $order->payment->payment_receipt) }}" style="font-size: 14px;">Cek Pembayaran</a>
                                @if ($order->payment->is_paid == true)
                                <p style="color: Green; font-size: 14px;">Pembayaran Lunas</p>
                                @else
                                <form action="{{ route('confirmPayment', $order->payment) }}" method="post">

                                    @csrf
                                    <button type="submit" style="margin-top: 4px; background: green;">Konfirmasi Pembayaran</button>
                                </form>

                                <form action="{{ route('cancel_order', $order->id) }}" method="post">
                                    @csrf
                                    @method('post')
                                    <button type="submit" style="margin-top: 4px; background: red; width: 100%; padding: 10px; box-sizing: border-box;" class="btn btn-danger mt-2 w-100">
                                        Batalkan
                                    </button>
                                </form>
                                @endif
                                @endif
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
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>