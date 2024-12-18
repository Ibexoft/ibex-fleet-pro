@extends('website.layouts.app')


@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-9 p-md-5 px-4 py-5 bg-white order-md-1 order-2">
                <h4>My Profile</h4>
                <form method="POST" enctype="multipart/form-data" action="{{ route('profile.update') }}">
                    @csrf
                    <div class="row mt-2">
                        <div class="col-12 col-md-4 mt-3">
                            <label class="form-label input-label" for="first_name">First Name<span aria-hidden="true"
                                    class="required">*</span></label>
                            <input type="text" class="form-control p-2 @error('first_name') is-invalid @enderror"
                                id="first_name" name="first_name" value="{{ old('first_name', $user->driver->first_name) }}"
                                required placeholder="Enter First Name" />
                            @error('first_name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4 mt-3">
                            <label class="form-label input-label" for="last_name">Last Name<span aria-hidden="true"
                                    class="required">*</span></label>
                            <input type="text" class="form-control p-2 @error('last_name') is-invalid @enderror"
                                id="last_name" name="last_name" value="{{ old('last_name', $user->driver->last_name) }}"
                                required placeholder="Enter Last Name" />
                            @error('last_name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4 mt-3">
                            <label class="form-label input-label" for="">Email<span aria-hidden="true"
                                    class="required">*</span></label>
                            <input type="email" class="form-control p-2 @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email', $user->email) }}" required
                                placeholder="Enter Email" />
                            @error('email')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 mt-3">
                            <label class="form-label input-label" for="">Password<small class="text-muted"> (Leave
                                    blank if you
                                    want to keep previous password)</small></label>
                            <input type="password" class="form-control p-2 @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Password" />
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <label class="form-label input-label" for="">Confirm Password</label>
                            <input type="password" class="form-control p-2" value="{{ old(' password_confirmation ') }}"
                                id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" />
                        </div>
                    </div>
                    <div class="row d-flex mt-3 justify-content-end">
                        <div class="col-auto">
                            <button class="btn btn-danger submit-btn account-update-btn rounded-0"
                                type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-4 col-lg-3 my-md-0 my-5 order-md-2 order-1">
                <div class="pb-5 text-white account-profile-card">
                    <div class="img-container text-center pt-5 px-5">
                        <h4 class="mb-3 text-truncate text-white">Hi,<br> {{ auth()->user()->name }}!</h4>
                    </div>
                    <div class="mt-2 pt-2">
                        <ul class="text-white p-0">
                            <hr class="m-0">
                            <a href="{{ route('profile') }}" class="text-white">
                                <li class="p-2 active cursor-pointer">
                                    <i class="bi bi-info-circle mx-2"></i>
                                    My Profile
                                </li>
                            </a>
                            <hr class="m-0">
                            <a href="{{ route('reservations') }}" class="text-white">
                                <li class="p-2">
                                    <i class="bi bi-calendar4-range mx-2"></i>
                                    Reservations
                                </li>
                            </a>
                            <hr class="m-0">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
