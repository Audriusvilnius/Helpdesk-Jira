@extends('layouts.app')
@section('content')
<div class="container pt-5 my-5 ">
    <div class="justify-content-center">

        @include('alerts.alert-success')
        @include('alerts.alert-danger')

        <div class="card-header card-header justify-content-between align-content-between d-flex ">
            <h4 class="up text-center">{{$ticket->id}}</h4>
            <h2 class="text-light ms-5 me-5 mb-5">{!! nl2br(e($ticket->title)) !!}</h2>
            @can('role-create')
            <span class="float-end ">
                <a class="btn btn-primary d-flex justify-content-center align-content-center m-2" href="{{ route('tickets.index') }}">Back</a>
            </span>
            @endcan
        </div>
        <form action="{{ route('ticket-message') }}" method="post">
            <input type="hidden" name="id" value="{{ $ticket->id }}">
            <div class="col-md-12 d-flex">
                <div class="card-body">
                    <textarea class="form-control" placeholder="{{ __('Leave coments here') }}" name="message_json" rows="7" cols="50"></textarea>
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
<div class="col-md-12 d-flex">
    <div class="container mb-2">
        <strong class="text-muted"> {{$ticket->user_id}}:{{$ticket->created_at}}</strong>
        <div class="justify-content-center">
            <div class="card">
                <div class="card-body">
                    <div class="lead">
                    </div>
                    {!! nl2br(e($ticket->message_json)) !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
