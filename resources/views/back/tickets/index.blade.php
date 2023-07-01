@extends('layouts.app')
@section('content')
<div class="container pt-5 pb-5 my-5">
    <div class="justify-content-center">

        @include('alerts.alert-success')
        @include('alerts.alert-danger')

        <div class="card-header card-header justify-content-between align-content-between d-flex ">
            <h2 class="text-light">Tickets list</h2>
            @can('role-create')
            <span class="float-end ">
                <a class="btn btn-primary d-flex justify-content-center align-content-center m-2" href="{{ route('tickets.create') }}">New ticket</a>
            </span>
            @endcan
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>!</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>User open</th>
                        <th>Attach</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->ticketsImportant->title }}</td>
                        <td>{{ $ticket->title }}</td>
                        <td>{{ $ticket->status_id }}</td>
                        <td>{{ $ticket->user_id }}</td>
                        <td>{{ $ticket->attach }}</td>
                        <td>{{ $ticket->created_at }}</td>
                        <td>{{ $ticket->updated_at }}</td>
                        <td>
                            <a class="btn btn-success" href="{{ route('tickets.show',$ticket->id) }}">Show</a>
                            @can('ticket-edit')
                            <a class="btn btn-primary" href="{{ route('tickets.edit',$ticket->id) }}">Edit</a>
                            @endcan
                            @can('ticket-delete')
                            {!! Form::open(['method' => 'DELETE','route' => ['tickets.destroy', $ticket->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $data->appends($_GET)->links() }}
        </div>
    </div>
</div>
@endsection
