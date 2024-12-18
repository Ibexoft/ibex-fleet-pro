<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('panelslayout/custom/css/login.css') }}">
    <title>Reset Password</title>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <div class="form-container">
                <form method="POST" action="{{ route('login') }}">
                    <h1>Ibex Fleet Pro</h1>
                    <h2>Reset Password</h1>
                    <p>Enter your new credetials.</p>
                    @csrf
                    <input id="new_password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="new_password" value="{{ old('email') }}" required autocomplete="email" autofocus
                        placeholder="New password">
                    @csrf
                    <input id="confirm_new_password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="confirm_new_password" required autocomplete="current-password" placeholder="Confirm new password">
                    <div class="error-message">
                        @error('password')
                            <span role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Confirm</button>
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
