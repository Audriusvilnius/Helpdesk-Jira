@extends('layouts.app')
@section('content')
    <div class="container pt-5 pb-5 my-5">
        <div class="justify-content-center">

            @include('alerts.alert-success')
            @include('alerts.alert-danger')

            <div class="card-header card-header justify-content-between align-content-between d-flex ">
                <h2 class="text-light">Edit ticket</h2>
                <span class="float-end ">
                    <a class="btn btn-primary d-flex justify-content-center align-content-center m-2"
                        href="{{ route('tickets.index') }}">Tickets</a>
                </span>
            </div>
            <div class="card">
                <div class="card-body">
                    {!! Form::model($ticket, ['route' => ['tickets.update', $ticket->id], 'method' => 'PATCH']) !!}
                    @can('edit-ticket')
                        <div class="form-group">
                            <strong>Title:</strong>
                            {!! Form::text('title', null, [
                                'placeholder' => 'Title',
                                'class' => 'form-control',
                                'minlength' => '3',
                                'maxlength' => '150',
                            ]) !!}
                        </div>
                    @endcan
                    @cannot('edit-ticket')
                        <h5 class="">{{ $ticket->title }}</h5>
                        {!! Form::hidden('title', null) !!}
                    @endcannot
                    <label for="important_id">{{ __('Important:') }}</label>
                    <select class="form-select" name="important_id">
                        @foreach ($important as $status_s)
                            <option value="{{ $status_s->id }}" @if ($status_s->id == old('important_id', $ticket->important_id)) selected @endif>
                                {{ $status_s->title }}</option>
                        @endforeach
                    </select>
                    <label for="status_id">{{ __('Status:') }}</label>
                    <select class="form-select" name="status_id">
                        @foreach ($status as $status_s)
                            <option value="{{ $status_s->id }}" @if ($status_s->id == old('status_id', $ticket->status_id)) selected @endif>
                                {{ $status_s->title }}</option>
                        @endforeach
                    </select>
                    @can('edit-ticket')
                        <div class="form-group">
                            <strong>Message:</strong>
                            {!! Form::textarea('message_json', null, ['placeholder' => 'Message', 'class' => 'form-control']) !!}
                        </div>
                    @endcan
                    @cannot('edit-ticket')
                        {!! Form::hidden('message_json', null) !!}
                    @endcannot
                    <button type="submit" class="btn btn-primary float-end mt-3">Submit</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
