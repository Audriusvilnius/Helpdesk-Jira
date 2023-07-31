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
                            <a class="text-decoration-none text-black container-btn bg-outline float-start"
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
            </div>
            <div class="card-body h-100">
                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-4 row-cols-xxl-4 g-4">
                    <div class="col">
                        <div class="card bg-dark-subtle h-100">
                            <div class="card-header ">TO DO</div>
                            @foreach ($data as $key => $open)
                                @if ($open->share_status_id == 1)
                                    <div class="card m-2 board-card">
                                        <div class="card-body shadow">
                                            <div class=" justify-content-between align-content-center d-flex">
                                                <h2 class="card-text me-3 fst-italic fw-light">#
                                                    {{ $open->share_ticket_id }}.
                                                </h2>
                                                <div class="d-flex">
                                                    <a class=" text-decoration-none"
                                                        href="{{ route('tickets.edit', $open->share_ticket_id) }}">
                                                        <div class=" fst-italic p-2 board-pill border border-1 shadow"
                                                            style="background-color:{{ $open->shareImportant->important_bc }}; color:{{ $open->shareImportant->important_tc }};">
                                                            @if ($open->upload_User_File()->count())
                                                                <i class="board-att fs-5 bi bi-paperclip">
                                                                    <sup class="me-3">
                                                                        +{{ $open->upload_User_File()->count() }}
                                                                    </sup>
                                                                </i>
                                                            @endif
                                                            @if ($open->share_Users()->count() > 1)
                                                                <i class="fs-5 bi bi-person-circle">
                                                                    <sup class="me-1">
                                                                        +{{ $open->share_Users()->count() - 1 }}
                                                                    </sup>
                                                                </i>
                                                            @endif
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <small class="fst-italic"><b>{{ $open->ovner->name }}</b></small>
                                            {{-- <img src="..." class="card-img-top" alt="..."> --}}
                                            <a class=" text-decoration-none text-black"
                                                href="{{ route('tickets.show', $open->share_ticket_id) }}">
                                                <h6 class="mt-3 fw-light">{{ $open->shareTicket->title }}</h6>
                                                <p class="length_message fw-lighter">{{ $open->shareTicket->request }}</p>
                                                @can('ticket-edit')
                                                    <a class="text-decoration-none text-black-50 float-end"
                                                        href="{{ route('tickets.edit', $open->shareTicket->id) }}"><i
                                                            class="bi bi-pencil-square"></i></a>
                                                @endcan
                                                <div class="py-1 d-flex flex-row text-black-50 board-date">
                                                    {{ $open->shareTicket->created_at->format('Y-m-d, H:m') }}
                                                </div>
                                            </a>
                                        </div>
                                        @can('delete-btn')
                                            <div class="card-footer">
                                                <div class="border-sm-start-none">
                                                    <div class=" row justify-content-evenly align-content-cente m-1">
                                                        {!! Form::open([
                                                            'method' => 'DELETE',
                                                            'route' => ['tickets.destroy', $open->shareTicket->id],
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
                        <div class="card bg-dark-subtle h-100">
                            <div class="card-header">IN PROGRESS</div>
                            @foreach ($data as $open)
                                @if ($open->share_status_id == 2)
                                    <div class="card m-2 board-card">
                                        <div class="card-body shadow">
                                            <div class=" justify-content-between align-content-center d-flex">
                                                <h2 class="card-text me-3 fst-italic fw-light">#
                                                    {{ $open->share_ticket_id }}.
                                                </h2>
                                                <div class="d-flex">
                                                    <a class=" text-decoration-none"
                                                        href="{{ route('tickets.edit', $open->share_ticket_id) }}">
                                                        <div class=" fst-italic p-2 board-pill border border-1 shadow"
                                                            style="background-color:{{ $open->shareImportant->important_bc }}; color:{{ $open->shareImportant->important_tc }};">
                                                            @if ($open->upload_User_File()->count())
                                                                <i class="board-att fs-5 bi bi-paperclip">
                                                                    <sup class="me-3">
                                                                        +{{ $open->upload_User_File()->count() }}
                                                                    </sup>
                                                                </i>
                                                            @endif
                                                            @if ($open->share_Users()->count() > 1)
                                                                <i class="fs-5 bi bi-person-circle">
                                                                    <sup class="me-1">
                                                                        +{{ $open->share_Users()->count() - 1 }}
                                                                    </sup>
                                                                </i>
                                                            @endif
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <small class="fst-italic"><b>{{ $open->ovner->name }}</b></small>
                                            {{-- <img src="..." class="card-img-top" alt="..."> --}}
                                            <a class=" text-decoration-none text-black"
                                                href="{{ route('tickets.show', $open->share_ticket_id) }}">
                                                <h6 class="mt-3 fw-light">{{ $open->shareTicket->title }}</h6>
                                                <p class="length_message fw-lighter">{{ $open->shareTicket->request }}</p>
                                                @can('ticket-edit')
                                                    <a class="text-decoration-none text-black-50 float-end"
                                                        href="{{ route('tickets.edit', $open->shareTicket->id) }}"><i
                                                            class="bi bi-pencil-square"></i></a>
                                                @endcan
                                                <div class="py-1 board-date d-flex flex-row text-black-50">
                                                    {{ $open->shareTicket->updated_at->format('Y-m-d, H:m') }}
                                                </div>
                                            </a>
                                        </div>
                                        @can('delete-btn')
                                            <div class="card-footer">
                                                <div class="border-sm-start-none">
                                                    <div class=" row justify-content-evenly align-content-cente m-1">
                                                        {!! Form::open([
                                                            'method' => 'DELETE',
                                                            'route' => ['tickets.destroy', $open->shareTicket->id],
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
                        <div class="card bg-dark-subtle h-100">
                            <div class="card-header">WAIT ANSWER</div>
                            @foreach ($data as $key => $open)
                                @if ($open->share_status_id == 3)
                                    <div class="card m-2 board-card">
                                        <div class="card-body shadow">
                                            <div class=" justify-content-between align-content-center d-flex">
                                                <h2 class="card-text me-3 fst-italic fw-light">#
                                                    {{ $open->share_ticket_id }}.
                                                </h2>
                                                <div class="d-flex">
                                                    <a class=" text-decoration-none"
                                                        href="{{ route('tickets.edit', $open->share_ticket_id) }}">
                                                        <div class=" fst-italic p-2 board-pill border border-1 shadow"
                                                            style="background-color:{{ $open->shareImportant->important_bc }}; color:{{ $open->shareImportant->important_tc }};">
                                                            @if ($open->upload_User_File()->count())
                                                                <i class="board-att fs-5 bi bi-paperclip">
                                                                    <sup class="me-3">
                                                                        +{{ $open->upload_User_File()->count() }}
                                                                    </sup>
                                                                </i>
                                                            @endif
                                                            @if ($open->share_Users()->count() > 1)
                                                                <i class="fs-5 bi bi-person-circle">
                                                                    <sup class="me-1">
                                                                        +{{ $open->share_Users()->count() - 1 }}
                                                                    </sup>
                                                                </i>
                                                            @endif
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <small class="fst-italic"><b>{{ $open->ovner->name }}</b></small>
                                            {{-- <img src="..." class="card-img-top" alt="..."> --}}
                                            <a class=" text-decoration-none text-black"
                                                href="{{ route('tickets.show', $open->share_ticket_id) }}">
                                                <h6 class="mt-3 fw-light">{{ $open->shareTicket->title }}</h6>
                                                <p class="length_message fw-lighter">{{ $open->shareTicket->request }}</p>
                                                @can('ticket-edit')
                                                    <a class="text-decoration-none text-black-50 float-end"
                                                        href="{{ route('tickets.edit', $open->shareTicket->id) }}"><i
                                                            class="bi bi-pencil-square"></i></a>
                                                @endcan
                                                <div class="py-1 board-date d-flex flex-row text-black-50">
                                                    {{ $open->shareTicket->updated_at->format('Y-m-d, H:m') }}
                                                </div>
                                            </a>
                                        </div>
                                        @can('delete-btn')
                                            <div class="card-footer">
                                                <div class="border-sm-start-none">
                                                    <div class=" row justify-content-evenly align-content-cente m-1">
                                                        {!! Form::open([
                                                            'method' => 'DELETE',
                                                            'route' => ['tickets.destroy', $open->shareTicket->id],
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
                        <div class="card bg-dark-subtle h-100">
                            <div class="card-header">DONE</div>
                            @foreach ($data as $key => $open)
                                @if ($open->share_status_id > 3)
                                    <div class="card m-2 board-card">
                                        <div class="card-body shadow">
                                            <div class=" justify-content-between align-content-center d-flex">
                                                <h2 class="card-text me-3 fst-italic fw-light">#
                                                    {{ $open->share_ticket_id }}.
                                                </h2>
                                                <div class="d-flex">
                                                    <a class=" text-decoration-none"
                                                        href="{{ route('tickets.edit', $open->share_ticket_id) }}">
                                                        <div class=" fst-italic p-2 board-pill border border-1 shadow"
                                                            style="background-color:{{ $open->shareImportant->important_bc }}; color:{{ $open->shareImportant->important_tc }};">
                                                            @if ($open->upload_User_File()->count())
                                                                <i class="board-att fs-5 bi bi-paperclip">
                                                                    <sup class="me-3">
                                                                        +{{ $open->upload_User_File()->count() }}
                                                                    </sup>
                                                                </i>
                                                            @endif
                                                            @if ($open->share_Users()->count() > 1)
                                                                <i class="fs-5 bi bi-person-circle">
                                                                    <sup class="me-1">
                                                                        +{{ $open->share_Users()->count() - 1 }}
                                                                    </sup>
                                                                </i>
                                                            @endif
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <small class="fst-italic"><b>{{ $open->ovner->name }}</b></small>
                                            {{-- <img src="..." class="card-img-top" alt="..."> --}}
                                            <a class=" text-decoration-none text-black"
                                                href="{{ route('tickets.show', $open->share_ticket_id) }}">
                                                <h6 class="mt-3 fw-light">{{ $open->shareTicket->title }}</h6>
                                                <p class="length_message fw-lighter">{{ $open->shareTicket->request }}</p>
                                                @can('ticket-edit')
                                                    <a class="text-decoration-none text-black-50 float-end"
                                                        href="{{ route('tickets.edit', $open->shareTicket->id) }}"><i
                                                            class="bi bi-pencil-square"></i></a>
                                                @endcan
                                                <div class="py-1 board-date d-flex flex-row text-black-50">
                                                    {{ $open->shareTicket->updated_at->format('Y-m-d, H:m') }}
                                                </div>
                                            </a>
                                        </div>
                                        @can('delete-btn')
                                            <div class="card-footer">
                                                <div class="border-sm-start-none">
                                                    <div class=" row justify-content-evenly align-content-cente m-1">
                                                        {!! Form::open([
                                                            'method' => 'DELETE',
                                                            'route' => ['tickets.destroy', $open->shareTicket->id],
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
