<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('panelslayout/custom/css/login.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('panelslayout/plugins/fontawesome-free/css/all.min.css') }}">
    <title>Login Form</title>

    {{-- {!! htmlScriptTagJsApi([
        'callback_then' => 'callbackThen',
        'callback_catch' => 'callbackCatch',
    ]) !!} --}}
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <div class="form-container">
                <form method="POST" action="{{ route('login') }}" id="dashboard-login-form">
                    @csrf
                    <h1>Ibex Fleet Pro</h1>
                    <h2>Login</h1>
                        <p>Enter your credentials to access your account.</p>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="Email">
                        @csrf
                        <div class="feild-wrapper">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password" placeholder="Password">
                            <div class="icon-wrapper">
                                <i toggle="#password" class="fa fa-eye toggle-password"></i>
                            </div>
                        </div>
                        <div class="error-message">
                            @error('email')
                                <span role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                            @error('password')
                                <span role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- <div class="forget_password" >
                        <a href="/forgotten-password">Forgotten Password?</a>
                    </div> --}}

                        <button type="submit" class="btn btn-primary">Log In</button>
                </form>
            </div>
            <div class="layout-container">
                <div class="car-img">
                    <img src="{{ asset('panelslayout/dist/img/car.png') }}" alt="car">
                </div>
                <h1 class="h2-car">IBEX FLEET PRO</h1>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('panelslayout/plugins/jquery/jquery.min.js') }}"></script>
    <script>
        $(".toggle-password").click(function() {

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));

            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }

        });
    </script>

    <script type="text/javascript">
        function callbackThen(response) {
            response.json().then(function(data) {

                let forms = ['dashboard-login-form'];

                forms.forEach(function(formId) {
                    let form = document.getElementById(formId);
                    if (data.success && data.score >= 0.6) {
                        form.addEventListener('submit', function(event) {
                            form.submit();
                        });
                    } else {
                        form.addEventListener('submit', function(event) {
                            event.preventDefault();
                            alert('recaptcha error');
                        });
                    }
                });
            });
        }

        function callbackCatch(error) {
            console.error('Error:', error);
        }
    </script>
</body>

</html>
