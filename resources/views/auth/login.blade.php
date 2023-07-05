@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mt-5 pe-5">
                    <img src="{{ asset('/assets/images/undraw_remotely_2j6y.svg') }}" alt="Image" class="img-fluid my-5">
                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4 ">
                                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                                    @if (Route::has('login'))
                                        @auth
                                            <a href="{{ route('home') }}" class="ml-4 text-decoration-none text-black">
                                                <h3>Home</h3>
                                            @else
                                                <a href="{{ route('register') }}" class="ml-4 text-decoration-none text-black">
                                                    <button class="fs-5 btn btn-block btn-success">Sign Up</button>
                                                </a>
                                            @endauth
                                    @endif
                                </div>
                                <p class="mb-4 mt-4 fw-normal text-black">Log in to your Helpdesk account to contribute to
                                    JRA, get
                                    help in
                                    the support forum, or rate and review.</p>
                            </div>
                            @if (Route::has('login'))
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group first">
                                        <label for="username">{{ __('Email Address') }}</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group last mb-4">
                                        <label for="password">{{ __('Password') }}</label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password" id="password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="fs-5 btn btn-block btn-warning">{{ __('Login') }}
                                        </button>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <span class="d-block my-4 text-muted"> </span>
                                        <a class="my-5" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </form>
                            @endauth

                            <div class="social-login my-5">
                                <a href="#" class="facebook">
                                    <span class="icon-facebook mr-3"></span>
                                </a>
                                <a href="#" class="twitter">
                                    <span class="icon-twitter mr-3"></span>
                                </a>
                                <a href="#" class="google">
                                    <span class="icon-google mr-3"></span>
                                </a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
