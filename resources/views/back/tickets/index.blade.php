@extends('layouts.app')
@section('content')
    <div class="container pt-5 pb-5 my-5">
        <div class="justify-content-center">

            @include('alerts.alert-success')
            @include('alerts.alert-danger')

            <div class="card-header card-header justify-content-between align-content-between d-flex ">
                <h2 class="text-light">Tickets list</h2>
                @can('ticket-create')
                    <span class=" d-flex">
                        <a class="btn btn-warning d-flex justify-content-center align-content-center m-2"
                            href="{{ route('home') }}">Home</a>
                        <a class="btn btn-primary d-flex justify-content-center align-content-center m-2"
                            href="{{ route('tickets.create') }}">New ticket</a>

                    </span>
                @endcan
            </div>
            <div class="card-body">
                @foreach ($data as $key => $ticket)
                    <div class="col-md-12 col-xl-12 mb-2">
                        <div class="card shadow-0 border rounded-3">
                            <div class="card-body">
                                <div class="row">
                                    <div
                                        class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0 justify-content-evenly align-content-between">
                                        {{-- <div class="col-md-6 col-lg-6 col-xl-6"> --}}
                                        <h6> {{ '# ' . $ticket->id }}
                                            <span class="fs-6 d-flex float-end text-black-50">
                                                {{ $ticket->created_at->format('Y-m-d H:i') }}
                                            </span>
                                        </h6>
                                        <p>{{ $ticket->user_name }}</p>
                                        <span class="fs-6 d-flex text-black-50">
                                            {{ $ticket->ticketsImportant->title }}
                                        </span>
                                        <span class="fs-6 d-flex float-end text-black-50">
                                            {{ $ticket->status_id }}
                                        </span>
                                        {{-- </div> --}}
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="d-flex flex-row align-items-center">
                                            <h5 class="length_title">{{ $ticket->title }}</h5>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <span>{{ $ticket->attach }}</span>
                                            <small class="fs-6 m-1">Update:
                                                {{ $ticket->updated_at->format('Y-m-d H:i') }}
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                        <div class="d-flex">
                                            <a class="btn btn-success btn-sm m-1 "style="display:inline;width:60px;"
                                                href="{{ route('tickets.show', $ticket->id) }}">Show</a>
                                            @can('ticket-edit')
                                                <a class="btn btn-primary btn-sm m-1" style="display:inline;width:60px;"
                                                    href="{{ route('tickets.edit', $ticket->id) }}">Edit</a>
                                            @endcan
                                            @can('ticket-delete')
                                                {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['tickets.destroy', $ticket->id],
                                                    'style' => 'display:inline;width:60px;',
                                                ]) !!}
                                                {!! Form::submit('Delete', [
                                                    'class' => 'btn btn-danger btn-sm m-1',
                                                    'style' => 'display:inline;width:60px;',
                                                ]) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{ $data->appends($_GET)->links() }}
            </div>
        </div>
    </div>
@endsection
