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
                                <button type="submit" class="btn btn-block btn-warning"> {{ __('Register') }}
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
