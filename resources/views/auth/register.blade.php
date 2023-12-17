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
        .hidden {
            display: none;
        }

        .curBackground {
            border-bottom: 3px solid #0e926d;
            padding: 2px;
        }
    </style>
</head>

<body>
    <div class=" container-fluid login-container d-flex justify-content-center align-items-center">
        <div class="row login-session">
            <div class="login-left col-lg-6 p-0 shadow-sm">
                <img src="{{ asset('user/img/loginpage_boatbooker.png') }}">
            </div>
            <div class="login-right col-lg-6 col-md-12 d-flex flex-column justify-content-center align-items-center">
                <img src="{{ asset('user/img/logo_boatbooker.png') }}" width="60" height="60">

                <div class="mt-4 w-75 register-content">

                    <h3 class="text-center mb-3">Register</h3>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-floating mb-3">
                            <input id="name" type="text"
                                class="form-control  @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" required autocomplete="name" autofocus
                                placeholder="@mairoaijo">
                            <label for="name" class="">{{ __('Name') }}</label>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" placeholder="kjsadfl;sfd">
                            <label for="email" class="">{{ __('Email Address') }}</label>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    
                        <div class="form-floating mb-3">
                            <input id="call_num" type="text"
                                class="form-control @error('call_num') is-invalid @enderror" name="call_num"
                                value="" required autocomplete="email" placeholder="fdjk">
                            <label for="call_num" class="">Call Number</label>
                            @error('call_num')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password" placeholder="passowrd">
                            <label for="password" class="">{{ __('Password') }}</label>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password"
                                placeholder="dlkjlkdfj">
                            <label for="password-confirm" class="">{{ __('Confirm Password') }}</label>
                        </div>

                        <div class="register-btn d-flex justify-content-center mt-5">
                            <button class="btn btn-register btn-lg px-5 py-2 rounded-pill " type="submit">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script>
        const loginLink = document.getElementById("forLogin");
        const registerLink = document.getElementById("forRegist");
        const loginContent = document.querySelector(".login-content");
        const registerContent = document.querySelector(".register-content");

        // Tampilkan login-content, sembunyikan register-content saat halaman dimuat
        loginLink.classList.add("curBackground");
        loginContent.classList.remove("hidden");
        registerContent.classList.add("hidden");

        // Tampilkan login-content saat tautan "Login" diklik
        loginLink.addEventListener("click", function() {
            loginLink.classList.add("curBackground");
            loginContent.classList.remove("hidden");
            registerContent.classList.add("hidden");
            registerLink.classList.remove("curBackground");
        });

        // Tampilkan register-content saat tautan "Register" diklik
        registerLink.addEventListener("click", function() {
            loginLink.classList.remove("curBackground");
            loginContent.classList.add("hidden");
            registerContent.classList.remove("hidden");
            registerLink.classList.add("curBackground");
        });
    </script>
</body>

</html>
