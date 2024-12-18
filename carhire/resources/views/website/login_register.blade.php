@extends('website.layouts.app')

@section('content')
    <div class="container mt-5 login-register-container">
        <div class="row">
            <div class="col-12 col-md-6 bg-white p-0 p-xl-5 mb-5" id="login">
                <div class="p-5">
                    <div>
                        <h3>Login</h3>
                        <hr class="border border-danger border-1 rounded opacity-50 mt-5 w-25">
                        <small class="sub-text">Sign in to Continue Your Journey with us.</small>
                    </div>
                    <div class="mt-5">
                        <form id="login-form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <!-- Email input -->
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label input-label" for="email">Email address <span
                                        class="required">*</span></label>
                                <input type="email" name="email"
                                    class="form-control p-2 @error('email', 'login') is-invalid @enderror"
                                    placeholder="name@example.com" />
                            </div>
                            <!-- Password input -->
                            <div data-mdb-input-init class="form-outline mt-3">
                                <label class="form-label input-label" for="password">Password <span
                                        class="required">*</span></label>
                                <input type="password"
                                    class="form-control p-2 @error('password', 'login') is-invalid @enderror"
                                    name="password" required placeholder="Enter your password" />
                            </div>
                            <div class="error-message text-danger mt-3">
                                @error('email', 'login')
                                    <span role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                                @error('password', 'login')
                                    <span role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-auto d-flex mt-3 justify-content-end">
                                <button id="login-submit" class="btn btn-danger login-reg-submit-btn"
                                    type="submit">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 p-xl-5" id="register">
                <div class="p-5">
                    <div>
                        <h3>Register Now</h3>
                        <hr class="border border-danger border-1 rounded opacity-50 mt-5 w-25">
                        <small class="sub-text">Create an account for easy bookings and personalized services!</small>
                    </div>
                    <div class="mt-5">
                        <form id="register-form" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row mt-lg-3">
                                <div class="col-12 col-lg-6">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label input-label" for="first_name">First name <span
                                                class="required">*</span></label>
                                        <input type="text"
                                            class="form-control p-2 @error('first_name', 'register') is-invalid @enderror"
                                            name="first_name" required placeholder="e.g., John" />
                                        @error('first_name', 'register')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label input-label" for="last_name">Last name <span
                                                class="required">*</span></label>
                                        <input type="text"
                                            class="form-control p-2 @error('last_name', 'register') is-invalid @enderror"
                                            name="last_name" required placeholder="e.g., Doe" />
                                        @error('last_name', 'register')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-lg-3">
                                <div class="col-12 col-lg-6">
                                    <!-- Email input -->
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label input-label" for="email">Email address <span
                                                class="required">*</span></label>
                                        <input type="email"
                                            class="form-control p-2 @error('email', 'register') is-invalid @enderror"
                                            name="email" required placeholder="name@example.com" />
                                        @error('email', 'register')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label input-label" for="contact">Phone <span
                                                class="required">*</span></label>
                                        <input type="tel" pattern="[0-9]{10}"
                                            class="form-control p-2 @error('contact', 'register') is-invalid @enderror"
                                            name="contact" required placeholder="Format: XXXXXXXXXX" />
                                        @error('contact', 'register')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-lg-3">
                                <div class="col-12 col-lg-6 mt-2">
                                    <!-- Password input -->
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label input-label" for="password">Password <span
                                                class="required">*</span></label>
                                        <input type="password"
                                            class="form-control p-2 @error('password', 'register') is-invalid @enderror"
                                            name="password" required placeholder="Enter your password" />
                                        @error('password', 'register')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mt-2">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label input-label" for="password-confirm">Confirm
                                            Password <span class="required">*</span></label>
                                        <input type="password" class="form-control p-2" name="password_confirmation"
                                            required placeholder="Confirm your password" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto d-flex mt-3 justify-content-end">
                                <button id="register-submit" class="btn btn-danger login-reg-submit-btn"
                                    type="submit">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function callbackThen(response) {
            response.json().then(function(data) {

                let forms = ['login-form', 'register-form'];

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
@endsection
