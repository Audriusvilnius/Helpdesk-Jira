@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container position-relative">
            <div class="row">
                <div class="col-md-6 mt-5 pe-5">
                    <img src="{{ asset('/assets/images/undraw_remotely_2j6y.svg') }}" alt="Image" class="img-fluid my-5">
                </div>
                <div class="col-md-6">
                    <div class="row justify-content-evenly align-content-center">
                        <h3 class="h1-responsive text-white font-weight-bold text-center">Your Helpdesk Ticets</h3>
                        <p class="fw-lighter text-white text-center mt-3">Your Helpdesk account tickets
                            status and
                            progres.
                        </p>
                        <a href="{{ route('tickets.create') }}"
                            class="text-decoration-none text-black container-btn shadow bg-warning">
                            Create
                        </a>
                        <a href="{{ route('open-tickets') }}"
                            class="text-decoration-none text-black container-btn shadow bg-info">
                            Open
                        </a>
                        <a href="{{ route('suspendet-tickets') }}"
                            class="text-decoration-none text-white container-btn shadow bg-danger">
                            Suspendet
                        </a>
                        <a href="{{ route('close-tickets') }}"
                            class="text-decoration-none text-white container-btn shadow bg-success">
                            Closed
                        </a>
                        @if (Auth::user()->role == 'admin')
                            <a href="{{ route('tickets.index') }}"
                                class="text-decoration-none text-black container-btn shadow ">
                                All
                            </a>
                        @endif

                        <section class="mb-4">
                            <h3 class="h1-responsive text-white font-weight-bold text-center my-4 mt-5">Contact us</h3>
                            <p class="fw-lighter text-white text-center mt-3">Do you have any questions? Please do not
                                hesitate to contact us directly. Our team will come back to you within
                                a matter of hours to help you.</p>
                            @include('alerts.alert-success')
                            <div class="row">
                                <div class="col-md-12 mb-md-0 mb-5">
                                    <form method="POST" action="{{ route('contact.us.store') }}" id="contactUSForm">
                                        {{-- {{ csrf_field() }} --}}
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="md-form mb-0">
                                                    <input type="text" name="name" class="form-control"
                                                        placeholder="Name" value="{{ old('name') }}">
                                                    @if ($errors->has('name'))
                                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    @endif
                                                    <label for="name" class="text-white-50">Your name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="md-form mb-0">
                                                    <input type="text" name="email" class="form-control"
                                                        placeholder="Email" value="{{ old('email') }}">
                                                    @if ($errors->has('email'))
                                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                                    <label for="email" class="text-white-50">Your email</label>
                                                </div>
                                            </div>
                                            <!--Grid column phone-->
                                            {{-- <div class="col-md-4">
                                                <div class="md-form mb-0">
                                                    <input type="text" name="phone" class="form-control"
                                                        placeholder="Phone" value="{{ old('phone') }}">
                                                    @if ($errors->has('phone'))
                                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                                    @endif
                                                    <label for="email" class="text-white">Phone</label>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="md-form mb-0">
                                                    <input type="text" name="subject" class="form-control"
                                                        placeholder="Subject" value="{{ old('subject') }}">
                                                    @if ($errors->has('subject'))
                                                        <span class="text-danger">{{ $errors->first('subject') }}</span>
                                                    @endif
                                                    <label for="subject" class="text-white-50">Subject</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="md-form">
                                                <textarea type="text" name="message" rows="5" placeholder="Leave message here"class="form-control md-textarea">{{ old('message') }}</textarea>
                                                @if ($errors->has('message'))
                                                    <span class="text-danger">{{ $errors->first('message') }}</span>
                                                @endif
                                                <label for="message" class="text-white-50">Your message</label>
                                            </div>
                                        </div>
                                        <div class="form-group text-center">
                                            <button class="btn btn-success btn-submit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="status"></div>
                            </div>
                            <!--Grid column personal info-->
                            {{-- <div class="col-md-3 text-center">
                                <ul class="list-unstyled mb-0">
                                    <li><i class="bi bi-geo"></i></i>
                                        <p>Vilnius, LT 1119, Lithuania</p>
                                    </li>
                                    <li>
                                        <i class="bi bi-telephone"></i>
                                        <p>+ 370 698 73063</p>
                                    </li>
                                    <li><i class="bi bi-envelope"></i></i>
                                        <p>audrius@ivko.org</p>
                                    </li>
                                </ul>
                            </div> --}}
                    </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
