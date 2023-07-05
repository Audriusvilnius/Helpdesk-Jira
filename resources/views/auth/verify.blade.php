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
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif
                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }},
                            <div class="form-group first">
                                <form method="POST" action="{{ route('verification.resend') }}">
                                    @csrf
                                    <button type="submit" class="fs-5 btn btn-block btn-warning"> {{ __('Register') }}
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
    </div>
@endsection
