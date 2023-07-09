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
                        <a class="text-decoration-none text-black container-btn shadow bg-warning d-flex"
                            href="{{ route('tickets.index') }}">Back</a>
                        <a class="text-decoration-none text-black container-btn shadow bg-info d-flex"
                            href="{{ route('tickets.create') }}">New Ticket</a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="container">
            {{-- <div class="col-md-6 img-fluid opacity-25 position-fixed">
                <img src="{{ asset('/assets/images/undraw_remotely_2j6y.svg') }}" alt="Image" class="img-fluid">
            </div> --}}
            <div class="row">
                <div class="col-md-4 contents ">
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
                                @cannot('edit-ticket')
                                    {!! Form::hidden('title', null) !!}
                                </div>
                            @endcannot
                            <div class="col-md-12 col-lg-12col-xl-12 ">
                                <label class=" text-white-50" for="important_id">{{ __('Important:') }}</label>
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
                            <button type="submit" class="btn btn-success float-end mt-3">Edit</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                                {!! Form::model($ticket, ['route' => ['ticket-share', $ticket->id], 'method' => 'post']) !!}
                                {!! Form::hidden('ticket_id', $ticket->id) !!}
                                <div class="col-md-12 col-lg-12col-xl-12 ">
                                    <label class=" text-white-50" for="user_id">{{ __('User:') }}</label>
                                    <select class="form-select" name="user_id">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                @if ($user->id == old('id', $ticket->user_id)) selected @endif>
                                                {{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success float-end mt-3"><i
                                        class="bi bi-person-plus fs-3"></i></button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                                {!! Form::model($ticket, [
                                    'route' => ['ticket-file', $ticket->id],
                                    'method' => 'post',
                                    'enctype' => 'multipart/form-data',
                                ]) !!}
                                {!! Form::hidden('ticket_id', $ticket->id) !!}
                                <label class=" text-white-50" for="file">{{ __('File:') }}</label>
                                {!! Form::file('file', null, [
                                    'class' => 'form-control, text-white ',
                                    'type' => 'file',
                                ]) !!}

                                <button type="submit" class="btn btn-success float-end mt-3"><i
                                        class="bi bi-upload fs-3"></i></button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                                <label class=" text-white-50" for="important_id">
                                    {{ __('Share to User:') }}</label>
                            </div>
                            @foreach ($share as $share_user)
                                <div class=" text-white fs-4 ">
                                    <a href="#">
                                        <i class="bi bi-person-x-fill text-white fs-4 me-3"></i>
                                    </a>
                                    <a class=" text-white me-3" href="mailto:  {{ $share_user->shareUser->email }}">
                                        <i class="bi bi-envelope-at "></a></i>
                                    {{ $share_user->shareUser->name }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-4 contents ">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                                <label class=" text-white-50" for="important_id"><i class="bi bi-paperclip"></i>
                                    {{ __('Share file:') }}</label>
                                <br>
                                @if ($files)
                                    @foreach ($files as $id => $file)
                                        <div class=" text-white fs-6">
                                            <a href=""><i class="bi bi-trash3 fs-6 me-4 text-white"></i></a>
                                            <a class="text-decoration-none text-white m-1 me-3"
                                                href="{{ route('downloads-file', $file['file']) }}"><strong><i
                                                        class="bi bi-paperclip fs-6 me-4">{{ $file['name'] }}</i></strong></a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
