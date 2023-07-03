@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('/assets/images/undraw_remotely_2j6y.svg') }}" alt="Image" class="img-fluid">
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
                                                    <h3 class="fs-3">Sign In</h3>
                                                </a>
                                            @endauth
                                    @endif
                                </div>

                                <p class="mb-4 text-black">Lorem ipsum dolor sit amet elit. Sapiente sit eosconsectetur
                                    adipisicing.</p>
                            </div>

                            @if (Route::has('login'))
                                @auth
                                @else
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

                                        <button type="submit" class="btn btn-block btn-warning">{{ __('Login') }}
                                        </button>
                                        @if (Route::has('password.request'))
                                            <span class="d-block my-4 text-muted"> </span>
                                            <a class="my-5" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    @endauth
                            @endif

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

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
