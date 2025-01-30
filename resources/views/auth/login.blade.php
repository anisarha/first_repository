<html>
<head>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .container-fluid {
            height: 100%;
            position: relative;
        }
        .left-panel {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ffffff;
        }
        .right-panel {
            background-color: #f43535;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .right-panel img {
            max-width: 100%;
            height: auto;
        }
        .form-container {
            max-width: 300px;
            width: 100%;
            text-align: center;
        }
        .form-container h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .form-container .form-control {
            margin-bottom: 15px;
        }
        .form-container .btn {
            width: 100%;
        }
        .app-title {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        .app-title i {
            font-size: 24px;
            margin-right: 10px;
        }
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 80px;
            color: rgba(178, 173, 173, 0.3);
            white-space: nowrap;
            z-index: 1;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="watermark">SPESIFIKASI SIMS</div>
        <div class="row h-100">
            <div class="col-md-6 left-panel">
                <div class="form-container">
                    <div class="app-title">
                        <i class="fas fa-shopping-bag"></i>
                        <span>SIMS Web App</span>
                    </div>
                    <h1>Masuk atau buat akun untuk memulai</h1>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Input Email -->
                        <div class="mb-3">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" placeholder="Masukkan email anda" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Input Password -->
                        <div class="mb-3">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                   name="password" placeholder="Masukkan password anda" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Remember Me Checkbox -->
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mb-0">
                            <button type="submit" class="btn btn-danger">
                                {{ __('Masuk') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Lupa Kata Sandi?') }}
                                </a>
                            @endif
                        </div>
                    </form>

                </div>
            </div>
            <div class="col-md-6 right-panel">
                <img alt="3D illustration of a person running with geometric shapes in the background" height="500" src="{{ asset('backend/dist/images/Frame.png') }}" width="500"/>
            </div>
        </div>
    </div>
</body>
</html>
