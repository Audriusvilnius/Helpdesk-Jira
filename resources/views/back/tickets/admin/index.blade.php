@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="container">
            <div class="justify-content-center">
                @include('alerts.alert-success')
                @include('alerts.alert-danger')

                <div class="card-header card-header justify-content-between align-content-between d-flex my-3">
                    <h2 class="text-light">Tickets list</h2>
                    @can('ticket-create')
                        <span class=" d-flex">
                            <a class="text-decoration-none text-white container-btn bg-dark float-start"
                                href="{{ url()->previous() }}">
                                <span>Back</span>
                            </a>
                            <a class="text-decoration-none text-black container-btn shadow bg-warning d-flex"
                                href="{{ route('home') }}">Home</a>
                            <a class="text-decoration-none text-black container-btn shadow bg-info d-flex"
                                href="{{ route('tickets.create') }}">New Ticket</a>
                        </span>
                    @endcan
                </div>
                {{-- <div class="card bg-dark-subtle h-100"> --}}
                <div class="card-body">
                    @foreach ($data as $key => $ticket)
                        <div class="col-md-12 col-xl-12 mb-2">
                            <div class="card shadow-0 border rounded-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-2 col-xl-2">
                                            <div class="text-center row justify-content-center p-3">
                                                <div
                                                    class="conteiner-status m-1 text-white rounded-pill bg-black opacity-75">
                                                    @if ($ticket->attach !== null)
                                                        <i class="bi bi-paperclip fs-4  me-2"></i>
                                                    @endif
                                                    <span class="fs-5">
                                                        {{ $ticket->id }}
                                                    </span>
                                                </div>
                                                <div class="fs-6 rounded-pill conteiner-status m-1"
                                                    style=" color:{{ $ticket->ticketsImportant->important_tc }}
                                                background-color:{{ $ticket->ticketsImportant->important_bc }}
                                                ">
                                                    {{ $ticket->ticketsImportant->title }}
                                                </div>
                                                <div class="fs-6 rounded-pill conteiner-status m-1"
                                                    style=" color:{{ $ticket->ticketsStatus->status_tc }}
                                                background-color:{{ $ticket->ticketsStatus->status_bc }}
                                                ">
                                                    {{ $ticket->ticketsStatus->title }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-8 col-xl-8 border-sm-start-none border-start">
                                            <div class="col-md-12 col-lg-12 col-xl-12">
                                                <div class="fs-6 rounded-1 bg-dark-subtle ps-3 pe-3">
                                                    {{ $ticket->ticketsUser->name }}
                                                </div>
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
                                        <div class="col-md-6 col-lg-2 col-xl-2 border-sm-start-none border-start">
                                            <div class=" row justify-content-evenly align-content-cente m-1">
                                                <a class="btn btn-success text-decoration-none text-white btn-index m-1"
                                                    href="{{ route('tickets.show', $ticket->id) }}">Conversation</a>
                                                @can('ticket-edit')
                                                    <a class=" btn btn-primary text-decoration-none text-white btn-index m-1"
                                                        href="{{ route('tickets.edit', $ticket->id) }}">Desk</a>
                                                @endcan
                                                @can('delete-btn')
                                                    {!! Form::open([
                                                        'method' => 'DELETE',
                                                        'route' => ['tickets.destroy', $ticket->id],
                                                    ]) !!}
                                                    <div class="row justify-content-evenly align-content-cente">
                                                        {!! Form::submit('Delete', [
                                                            'class' => 'row col-12 btn btn-danger mt-1 btn-index ',
                                                        ]) !!}
                                                    </div>
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
    </div>
    {{-- </div> --}}
@endsection
