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

    <title>BoatBooker</title>
    <style>
        .form-group {
            margin-bottom: 1rem;
        }

        label {
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 0.5rem;
            border-radius: 0.25rem;
            border: 1px solid #ccc;
            margin-bottom: 0.5rem;
        }

        input[type="file"] {
            width: 100%;
            padding: 0.5rem;
            border-radius: 0.25rem;
            border: 1px solid #ccc;
            margin-bottom: 0.5rem;
        }

        button {
            width: 100%;
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

        .toast {
            display: none;
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: red;
            color: white;
            padding: 15px;
            border-radius: 5px;
            z-index: 1000;
        }

        input.invalid-email {
            border: 2px solid red;
        }
    </style>
</head>

<body>
    <x-sidebar-admin />
    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>User</h1>
            </div>

        </div>

        <div class="table-data">
            <div class="order">
                <form role="form" method="post" action="{{ route('update_user', $user) }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label>Name : </label>
                        <input class="form-control" type="text"name="name"value="{{ $user->name }}" />
                        <label>Email : </label>
                        <input class="form-control" type="text"name="email"value="{{ $user->email }}" oninput="validateEmail(this)" />
                        <label>Password : </label>
                        <input class="form-control"type="password" name="password" />
                        <label>Role : </label>
                        <div class="custom-select" style="width:100%;">
                            <select style="font-size: 16px ; padding: 6px 5px; margin: 8px 0px; width:100%; border-radius: 0.25rem; border: 1px solid #ccc;" name="is_admin"
                                id="" class="form-control" >
                                
                                    @if ($user->is_admin == '1')
                                        <option value="1" selected>Admin</option>
                                        <option value="0" >User</option>
                                    @else
                                        <option value="1" >Admin</option>
                                        <option value="0" selected>User</option>
                                    @endif</option>
                            </select><br>
                        <label>Phone Number: </label>
                        <input class="form-control" type="text"name="call_num"value="{{ $user->call_num }}" oninput="validatePhoneNumber(this)" />
                        </div>

                        <button class="btn btn-success" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="emailErrorToast" class="toast">
            <div class="toast-body">
                Masukkan Email yang Valid
            </div>
        </div>

        <div id="phoneErrorToast" class="toast">
            <div class="toast-body">
                Please enter only numbers for the phone number.
            </div>
        </div>

        <div id="customToast" class="toast">
            Ini adalah toast manual
        </div>
    </main>
    <!-- MAIN -->
    </section>
    <!-- CONTENT -->


    <script src="{{ asset('admin/assets/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function showToast(message) {
            var toast = document.getElementById('customToast');
            toast.textContent = message;
            toast.style.display = 'block';

            setTimeout(function () {
                toast.style.display = 'none';
            }, 3000);
        }

        function validatePhoneNumber(input) {
            var numericValue = input.value.replace(/[^0-9]/g, '');

            if (input.value !== numericValue) {
                showToast('Hanya Masukkan Angka!');
                input.value = numericValue;
            }
        }

        function validateEmail(input) {
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var isValid = emailRegex.test(input.value);

            if (!isValid) {
                showToast('Masukkan Email yang Valid');
                input.classList.add('invalid-email');
            } else {
                input.classList.remove('invalid-email');
            }
        }
    </script>
</body>

</html>
