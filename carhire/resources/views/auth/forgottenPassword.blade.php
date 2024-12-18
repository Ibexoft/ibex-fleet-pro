<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('panelslayout/custom/css/login.css') }}">
    <title>Forgotten Password</title>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <div class="form-container">
                <form method="POST" action="{{ route('login') }}">
                    <h1>Ibex Fleet Pro</h1>
                    <h2>Forgotten Password</h1>
                    <p>Enter your email address.</p>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                        placeholder="Email">

                    <div class="error-message">
                        @error('email')
                            <span role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Send reset link</button>
                </form>
            </div>
            <div class="layout-container">
                <div class="car-img">
                    <img src="{{ asset('panelslayout/dist/img/car.png') }}" alt="car">
                </div>
                <h2 class="h2-car">IBEX FLEET PRO</h2>
            </div>
        </div>
    </div>
</body>

</html>
