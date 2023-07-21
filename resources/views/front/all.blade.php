@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="container">
            <div class="justify-content-center">
                @include('alerts.alert-success')
                @include('alerts.alert-danger')

                <div class="card-header card-header justify-content-between align-content-between d-flex my-3">
                    <h2 class="text-light">Board</h2>
                    @can('ticket-create')
                        <span class=" d-flex">
                            <a class="text-decoration-none text-black container-btn shadow bg-warning d-flex"
                                href="{{ route('home') }}">Home</a>
                            <a class="text-decoration-none text-black container-btn shadow bg-info d-flex"
                                href="{{ route('tickets.create') }}">New Ticket</a>
                        </span>
                    @endcan
                </div>
            </div>
            <div class="card h-100 p-3">
                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-4 row-cols-xxl-4 g-4">
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-header"> TO DO</div>
                            @foreach ($data as $key => $open)
                                @if ($open->status_id == 1)
                                    <div class="card m-1">
                                        <a class=" text-decoration-none text-black"
                                            href="{{ route('tickets.show', $open->id) }}">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="board-pill"
                                                        style="background-color:{{ $open->ticketsImportant->important_bc }};">
                                                        @if ($open->attach_json !== null)
                                                            <i class="bi bi-paperclip fs-4 board-att"
                                                                style="color:{{ $open->ticketsImportant->important_tc }};"></i>
                                                        @endif
                                                    </div>
                                                    <h6 class="card-text d-flex ms-3 me-3">{{ $open->id }}</h6>
                                                    {{-- <img src="..." class="card-img-top" alt="..."> --}}
                                                    <h6 class="card-text d-flex"> {{ $open->ticketsUser->name }}</h6>
                                                </div>
                                                <div class="fs-6 d-flex flex-row text-black-50">
                                                    Open: {{ $open->created_at->format('Y-m-d H:i') }}
                                                </div>
                                                <div class="fs-6 d-flex flex-row text-black-50 ">
                                                    Edit : {{ $open->updated_at->format('Y-m-d H:i') }}
                                                </div>
                                                <h6>{{ $open->title }}</h6>
                                                {{-- <p> {!! nl2br(e($open->title)) !!}</p> --}}
                                                {{-- <h6 class="length_title">{{ $open->title }}</h6> --}}
                                                {{-- <samp class="card-title">{{ $open->title }}</samp> --}}
                                                {{-- <p class="card-text">{{ $open->user_id }}</p> --}}
                                                <p class="length_message">{{ $open->request }}</p>
                                                @can('ticket-edit')
                                                    <a class="icon-edit text-decoration-none fs-2 text-black-50 float-end"
                                                        href="{{ route('tickets.edit', $open->id) }}"></a>
                                                @endcan
                                            </div>
                                        </a>
                                        @can('delete-btn')
                                            <div class="card-footer">
                                                <div class="border-sm-start-none">
                                                    <div class=" row justify-content-evenly align-content-cente m-1">
                                                        {!! Form::open([
                                                            'method' => 'DELETE',
                                                            'route' => ['tickets.destroy', $open->id],
                                                        ]) !!}
                                                        <div class="row justify-content-evenly align-content-cente">
                                                            {!! Form::submit('Delete', [
                                                                'class' => 'row col-12 btn btn-danger mt-1 btn-index ',
                                                            ]) !!}
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                        @endcan
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-header">IN PROGRESS</div>
                            @foreach ($data as $open)
                                @if ($open->status_id == 2)
                                    <div class="card m-1">
                                        <a class=" text-decoration-none text-black"
                                            href="{{ route('tickets.show', $open->id) }}">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="board-pill"
                                                        style="background-color:{{ $open->ticketsImportant->important_bc }};">
                                                        @if ($open->attach_json !== null)
                                                            <i class="bi bi-paperclip fs-4 board-att"
                                                                style="color:{{ $open->ticketsImportant->important_tc }};"></i>
                                                        @endif
                                                    </div>
                                                    <h6 class="card-text d-flex ms-3 me-3">{{ $open->id }}</h6>
                                                    {{-- <img src="..." class="card-img-top" alt="..."> --}}
                                                    <h6 class="card-text d-flex"> {{ $open->ticketsUser->name }}</h6>
                                                </div>
                                                <div class="fs-6 d-flex flex-row text-black-50">
                                                    Open: {{ $open->created_at->format('Y-m-d H:i') }}
                                                </div>
                                                <div class="fs-6 d-flex flex-row text-black-50 ">
                                                    Edit : {{ $open->updated_at->format('Y-m-d H:i') }}
                                                </div>
                                                <h6>{{ $open->title }}</h6>
                                                {{-- <p> {!! nl2br(e($open->title)) !!}</p> --}}
                                                {{-- <h6 class="length_title">{{ $open->title }}</h6> --}}
                                                {{-- <samp class="card-title">{{ $open->title }}</samp> --}}
                                                {{-- <p class="card-text">{{ $open->user_id }}</p> --}}
                                                <p class="length_message">{{ $open->request }}</p>
                                                @can('ticket-edit')
                                                    <a class="icon-edit text-decoration-none fs-2 text-black-50 float-end"
                                                        href="{{ route('tickets.edit', $open->id) }}"></a>
                                                @endcan
                                            </div>
                                        </a>
                                        @can('delete-btn')
                                            <div class="card-footer">
                                                <div class="border-sm-start-none">
                                                    <div class=" row justify-content-evenly align-content-cente m-1">
                                                        {!! Form::open([
                                                            'method' => 'DELETE',
                                                            'route' => ['tickets.destroy', $open->id],
                                                        ]) !!}
                                                        <div class="row justify-content-evenly align-content-cente">
                                                            {!! Form::submit('Delete', [
                                                                'class' => 'row col-12 btn btn-danger mt-1 btn-index ',
                                                            ]) !!}
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                        @endcan
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-header">WAIT ANSWER</div>
                            @foreach ($data as $key => $open)
                                @if ($open->status_id == 3)
                                    <div class="card m-1">
                                        <a class=" text-decoration-none text-black"
                                            href="{{ route('tickets.show', $open->id) }}">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="board-pill"
                                                        style="background-color:{{ $open->ticketsImportant->important_bc }};">
                                                        @if ($open->attach_json !== null)
                                                            <i class="bi bi-paperclip fs-4 board-att"
                                                                style="color:{{ $open->ticketsImportant->important_tc }};"></i>
                                                        @endif
                                                    </div>
                                                    <h6 class="card-text d-flex ms-3 me-3">{{ $open->id }}</h6>
                                                    {{-- <img src="..." class="card-img-top" alt="..."> --}}
                                                    <h6 class="card-text d-flex"> {{ $open->ticketsUser->name }}</h6>
                                                </div>
                                                <div class="fs-6 d-flex flex-row text-black-50">
                                                    Open: {{ $open->created_at->format('Y-m-d H:i') }}
                                                </div>
                                                <div class="fs-6 d-flex flex-row text-black-50 ">
                                                    Edit : {{ $open->updated_at->format('Y-m-d H:i') }}
                                                </div>
                                                <h6>{{ $open->title }}</h6>
                                                {{-- <p> {!! nl2br(e($open->title)) !!}</p> --}}
                                                {{-- <h6 class="length_title">{{ $open->title }}</h6> --}}
                                                {{-- <samp class="card-title">{{ $open->title }}</samp> --}}
                                                {{-- <p class="card-text">{{ $open->user_id }}</p> --}}
                                                <p class="length_message">{{ $open->request }}</p>
                                                @can('ticket-edit')
                                                    <a class="icon-edit text-decoration-none fs-2 text-black-50 float-end"
                                                        href="{{ route('tickets.edit', $open->id) }}"></a>
                                                @endcan
                                            </div>
                                        </a>
                                        @can('delete-btn')
                                            <div class="card-footer">
                                                <div class="border-sm-start-none">
                                                    <div class=" row justify-content-evenly align-content-cente m-1">
                                                        {!! Form::open([
                                                            'method' => 'DELETE',
                                                            'route' => ['tickets.destroy', $open->id],
                                                        ]) !!}
                                                        <div class="row justify-content-evenly align-content-cente">
                                                            {!! Form::submit('Delete', [
                                                                'class' => 'row col-12 btn btn-danger mt-1 btn-index ',
                                                            ]) !!}
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                        @endcan
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-header">DONE</div>
                            @foreach ($data as $key => $open)
                                @if ($open->status_id > 3)
                                    <div class="card m-1">
                                        <a class=" text-decoration-none text-black"
                                            href="{{ route('tickets.show', $open->id) }}">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="board-pill"
                                                        style="background-color:{{ $open->ticketsImportant->important_bc }};">
                                                        @if ($open->attach_json !== null)
                                                            <i class="bi bi-paperclip fs-4 board-att"
                                                                style="color:{{ $open->ticketsImportant->important_tc }};"></i>
                                                        @endif
                                                    </div>
                                                    <h6 class="card-text d-flex ms-3 me-3">{{ $open->id }}</h6>
                                                    {{-- <img src="..." class="card-img-top" alt="..."> --}}
                                                    <h6 class="card-text d-flex"> {{ $open->ticketsUser->name }}</h6>
                                                </div>
                                                <div class="fs-6 d-flex flex-row text-black-50">
                                                    Open: {{ $open->created_at->format('Y-m-d H:i') }}
                                                </div>
                                                <div class="fs-6 d-flex flex-row text-black-50 ">
                                                    Edit : {{ $open->updated_at->format('Y-m-d H:i') }}
                                                </div>
                                                <h6>{{ $open->title }}</h6>
                                                {{-- <p> {!! nl2br(e($open->title)) !!}</p> --}}
                                                {{-- <h6 class="length_title">{{ $open->title }}</h6> --}}
                                                {{-- <samp class="card-title">{{ $open->title }}</samp> --}}
                                                {{-- <p class="card-text">{{ $open->user_id }}</p> --}}
                                                <p class="length_message">{{ $open->request }}</p>
                                                @can('ticket-edit')
                                                    <a class="icon-edit text-decoration-none fs-2 text-black-50 float-end"
                                                        href="{{ route('tickets.edit', $open->id) }}"></a>
                                                @endcan
                                            </div>
                                        </a>
                                        @can('delete-btn')
                                            <div class="card-footer">
                                                <div class="border-sm-start-none">
                                                    <div class=" row justify-content-evenly align-content-cente m-1">
                                                        {!! Form::open([
                                                            'method' => 'DELETE',
                                                            'route' => ['tickets.destroy', $open->id],
                                                        ]) !!}
                                                        <div class="row justify-content-evenly align-content-cente">
                                                            {!! Form::submit('Delete', [
                                                                'class' => 'row col-12 btn btn-danger mt-1 btn-index ',
                                                            ]) !!}
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                        @endcan
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
