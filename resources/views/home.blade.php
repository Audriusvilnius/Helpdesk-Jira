@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container position-relative">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('/assets/images/undraw_remotely_2j6y.svg') }}" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <div class="row justify-content-evenly align-content-center">
                        <h3 class="fw-lighter text-white text-center mt-3 my-5">Your Helpdesk account tickets status and
                            progres.
                        </h3>
                        {{-- <div class="col-md-12 "> --}}
                        <a href="{{ route('tickets.index') }}"
                            class="text-decoration-none text-black container-btn shadow ">
                            All
                        </a>
                        {{-- </div> --}}
                        {{-- <div class="col-md-12 "> --}}
                        <a href="{{ route('tickets.index') }}"
                            class="text-decoration-none text-black container-btn shadow bg-warning">
                            Open
                        </a>
                        {{-- </div> --}}
                        {{-- <div class="col-md-12 "> --}}
                        <a href="{{ route('tickets.index') }}"
                            class="text-decoration-none text-white container-btn shadow bg-danger">
                            Waiting
                        </a>
                        {{-- </div> --}}
                        {{-- <div class="col-md-12 "> --}}
                        <a href="{{ route('tickets.index') }}"
                            class="text-decoration-none text-white container-btn shadow bg-success">
                            Closed
                        </a>
                        {{-- </div> --}}
                        {{-- <div class="col-md-12 "> --}}
                        <a href="{{ route('tickets.index') }}"
                            class="text-decoration-none text-white container-btn shadow bg-primary">
                            Cancel
                        </a>
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
