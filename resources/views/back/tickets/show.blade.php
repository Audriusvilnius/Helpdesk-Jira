@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="container">
            <div class="justify-content-center">

                @include('alerts.alert-success')
                @include('alerts.alert-danger')

                <div class="card-header card-header justify-content-between align-content-between d-flex ">
                    <h4 class="up text-center"
                        style="background-color: {{ $ticket->ticketsImportant->important_bc }};color:{{ $ticket->ticketsImportant->important_tc }};border-color:{{ $ticket->ticketsStatus->status_bc }};">
                        {{ $ticket->id }}</h4>
                    <h2 class="text-light ms-5 me-5 text-center">{!! nl2br(e($ticket->title)) !!}</h2>
                </div>
                <div class="card-header card-header justify-content-end align-content-end d-flex my-5">
                    @can('ticket-edit')
                        <a class="text-decoration-none text-black container-btn bg-outline float-start"
                            href="{{ url()->previous() }}">
                            <span>Back</span>
                        </a>
                        <a class="text-decoration-none text-black container-btn shadow bg-warning d-flex"
                            href="{{ route('board-tickets') }}">Board</a>
                        <a class="text-decoration-none text-black container-btn shadow bg-info d-flex"
                            href="{{ route('tickets.create') }}">New Ticket</a>
                    @endcan
                </div>
            </div>
            <form action="{{ route('ticket-message') }}" method="post">
                <input type="hidden" name="id" value="{{ $ticket->id }}">
                <div class="col-md-12 d-flex">
                    <div class="card-body">
                        <textarea class="form-control" placeholder="{{ __('Leave message here') }}" name="message_json" rows="7"
                            cols="50"></textarea>
                    </div>
                </div>
                <div class="col-md-12 d-flex">
                    <div class="card-body">
                        <button type="submit"
                            class="btn btn-index bg-success text-white float-end mt-3">{{ __('Send') }}</button>
                    </div>
                </div>
                @csrf
            </form>
            @if ($message)
                @foreach ($message as $id => $data)
                    <div class="col-md-12 mt-4">
                        <div id={{ $id }} class="card mt-2 mb-2 d-flex justify-content-md-between shadow">
                            <div class="col-md-3 z-3 position-absolute text-center"
                                style="transform: translateX(0px) translateY(-5px);">
                                <div class="rounded-2 p-0 bg-dark-subtle shadow">
                                    <h5 class="text-muted ms-3 me-3 p-1"> {{ $data['user_name'] }}</h5>
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
@endsection
