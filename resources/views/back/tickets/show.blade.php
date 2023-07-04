@extends('layouts.app')
@section('content')
    <div class="container pt-5 my-5 ">
        <div class="justify-content-center">

            @include('alerts.alert-success')
            @include('alerts.alert-danger')

            <div class="card-header card-header justify-content-between align-content-between d-flex ">
                <h4 class="up text-center">{{ $ticket->id }}</h4>
                <h2 class="text-light ms-5 me-5 mb-5">{!! nl2br(e($ticket->title)) !!}</h2>
                @can('ticket-create')
                    <span class="float-end ">
                        <a class="btn btn-primary d-flex justify-content-center align-content-center m-2"
                            href="{{ route('tickets.index') }}">Back</a>
                    </span>
                @endcan
            </div>
            <form action="{{ route('ticket-message') }}" method="post">
                <input type="hidden" name="id" value="{{ $ticket->id }}">
                <div class="col-md-12 d-flex">
                    <div class="card-body">
                        <textarea class="form-control" placeholder="{{ __('Leave coments here') }}" name="message_json" rows="7"
                            cols="50"></textarea>
                    </div>
                </div>
                <div class="col-md-12 d-flex">
                    <div class="card-body">
                        <button type="submit" class="btn btn-warning float-end mt-3">{{ __('Send') }}</button>
                    </div>
                </div>
                @csrf
            </form>
        </div>
    </div>
    <div class="col-md-12">
        <div class=" container mb-2">
            <div class="justify-content-center">
                @if ($message)
                    @foreach ($message as $id => $data)
                        <div class="col-md-12 mt-4">
                            <div id={{ $id }} class="card mt-2 mb-2 d-flex justify-content-md-between shadow">
                                <div class="col-md-3 z-3 position-absolute text-center "
                                    style="transform: translateX(10px) translateY(-20px) ">
                                    <div class=" lead rounded-2 p-0 bg-dark-subtle">
                                        <strong class=" text-muted"> {{ $data['user_name'] }}</strong>
                                    </div>
                                </div>
                                <div class="row g-0 p-3 bg-body-tertiary rounded">
                                    <div class="col-md-12 d-flex">
                                        <div class="card-body ms-5 me-5">
                                            <p class="text-black"> {!! nl2br(e($data['message'])) !!}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 d-flex">
                                        <div class="card-body ms-5 me-5">
                                            <small class="float-end text-muted">{{ $data['date'] }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
