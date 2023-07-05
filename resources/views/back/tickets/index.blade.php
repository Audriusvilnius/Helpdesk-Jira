@extends('layouts.app')
@section('content')
    <div class="container pt-5 pb-5 my-5">
        <div class="justify-content-center">
            @include('alerts.alert-success')
            @include('alerts.alert-danger')

            <div class="card-header card-header justify-content-between align-content-between d-flex my-3">
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
                                    <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0 ">
                                        <div class="col-md-8 col-lg-8 col-xl-8">
                                            <h6> {{ '# ' . $ticket->id }}
                                                <span class="fs-6 d-flex float-end">{{ $ticket->user_name }}</span>
                                            </h6>
                                        </div>
                                        <div class="text-center">
                                            <span class="fs-6 d-flex text-white bg-danger rounded-2">
                                                {{ $ticket->ticketsImportant->title }}
                                            </span>
                                            <div class="fs-6 d-flex flex-row text-black-50 ">
                                                {{ $ticket->ticketsStatus->title }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6 border-sm-start-none border-start">
                                        <div class="col-md-12 col-lg-12 col-xl-12 d-flex mb-1 justify-content-between">
                                            <div class="fs-6 d-flex flex-row text-black-50">
                                                Open: {{ $ticket->created_at->format('Y-m-d H:i') }}
                                            </div>
                                            <div class="fs-6 d-flex flex-row text-black-50 ">
                                                Edit : {{ $ticket->updated_at->format('Y-m-d H:i') }}
                                            </div>

                                        </div>
                                        <h5 class="length_title">{{ $ticket->title }}</h5>
                                        <div class="length_message">
                                            <p class="length_message">{{ $ticket->request }}</p>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <span>{{ $ticket->attach }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                        <div class=" d-flex justify-content-evenly">
                                            <a class="btn btn-success m-1"
                                                href="{{ route('tickets.show', $ticket->id) }}">Show</a>
                                            @can('ticket-edit')
                                                <a class="btn btn-primary m-1"
                                                    href="{{ route('tickets.edit', $ticket->id) }}">Edit</a>
                                            @endcan
                                            @can('ticket-delete')
                                                {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['tickets.destroy', $ticket->id],
                                                ]) !!}
                                                {!! Form::submit('Delete', [
                                                    'class' => 'btn btn-danger m-1',
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
