@extends('layouts.app')

@section('content')
    <div class="container pt-5 pb-5 my-5">
        <div class="col-md-6">
            <img src="{{ asset('/assets/images/undraw_remotely_2j6y.svg') }}" alt="Image" class="img-fluid">
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{-- <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div> --}}
            </div>
        </div>
    </div>
    </div>
@endsection
