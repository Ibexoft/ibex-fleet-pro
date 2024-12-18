@extends('website.layouts.app')


@section('content')

    <div class="container mt-4 bg-white">
        <div class="col-6 mx-auto text-center py-5">
            <div>
                <h1 class="mb-4">Forgot Your Password?</h1>

                <hr class="border border-danger border-1 rounded opacity-100 mt-2 mb-2 w-25 m-auto">

                <p class="mb-5">Enter your registered email address to set a new password.<br>We will send the password
                    change link
                    to your email address.</p>
            </div>
            <form class="col-9 m-auto">
                <fieldset class="mb-3 w-70">
                    <label for="email" class="form-label">E-mail address</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
                </fieldset>

                <button type="submit" class="btn btn-danger">Password reset</button>
            </form>
        </div>
    </div>
    
@endsection
