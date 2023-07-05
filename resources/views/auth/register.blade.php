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
                                <h3 class="text-back fs-3">{{ __('Sign Up') }}</h3>
                                <p class="mb-4 mt-4 fw-normal text-black">Sign Up to your Helpdesk account to contribute to
                                    JRA, get
                                    help in
                                    the support forum, or rate and review.</p>
                            </div>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group first">
                                    <label for="name">{{ __('Name') }}</label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">{{ __('Email Address') }}</label>
                                    <input input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">{{ __('Password') }}</label>

                                    <input id="password" type="password"
                                        class="form-control  @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group last mb-4">
                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>

                                    <input id="password-confirm" type="password" class="form-control"
                                        name=" password_confirmation" required autocomplete="new-password">
                                </div>
                                <button type="submit" class="fs-5 btn btn-block btn-warning">
                                    {{ __('Sign Up') }}
                                </button>

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

{{-- <a href="{{ route('login') }}" class="text-decoration-none text-black float-end">
        <span class="fs-5 btn btn-block btn-success">Log In</span>
    </a> --}}
