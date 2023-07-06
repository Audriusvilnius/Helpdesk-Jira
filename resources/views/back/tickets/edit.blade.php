@extends('layouts.app')
@section('content')
    <div class="container pt-5 my-5 ">
        <div class="justify-content-center">

            @include('alerts.alert-success')
            @include('alerts.alert-danger')

            <div class="card-header card-header justify-content-between align-content-between d-flex ">
                <h4 class="up text-center">{{ '# ' . $ticket->id }}</h4>
                <h2 class="text-light ms-5 me-5 text-center">{!! nl2br(e($ticket->title)) !!}</h2>
                @can('ticket-edit')
                    <span class="float-end ">
                        <a class="btn btn-warning justify-content-center align-content-center m-2"
                            href="{{ route('tickets.index') }}">Back</a>
                        <a class="btn btn-primary  justify-content-center align-content-center m-2"
                            href="{{ route('tickets.index') }}">Tickets</a>
                    </span>
                @endcan
            </div>
        </div>
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('/assets/images/undraw_remotely_2j6y.svg') }}" alt="Image" class="img-fluid">
                    </div>
                    <div class="col-md-6 contents">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
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
                                    <div class="col-md-12 col-lg-12col-xl-12 ">
                                        <label class=" text-white-50" for="important_id">
                                            {{ __('Important:') }}</label>
                                        <select class="form-select" name="important_id">
                                            @foreach ($important as $status_s)
                                                <option value="{{ $status_s->id }}"
                                                    @if ($status_s->id == old('important_id', $ticket->important_id)) selected @endif>
                                                    {{ $status_s->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                        <label class=" text-white-50" for="status_id">{{ __('Status:') }}</label>
                                        <select class="form-select" name="status_id">
                                            @foreach ($status as $status_s)
                                                <option value="{{ $status_s->id }}"
                                                    @if ($status_s->id == old('status_id', $ticket->status_id)) selected @endif>
                                                    {{ $status_s->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @can('edit-ticket')
                                        <div class="form-group">
                                            <strong>Message:</strong>
                                            {!! Form::textarea('message_json', null, ['placeholder' => 'Message', 'class' => 'form-control']) !!}
                                        </div>
                                    @endcan
                                    @cannot('edit-ticket')
                                        {!! Form::hidden('message_json', null) !!}
                                    @endcannot
                                    <button type="submit" class="btn btn-success float-end mt-3">Submit</button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
