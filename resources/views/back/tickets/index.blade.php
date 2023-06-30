@extends('layouts.app')
@section('content')
<div class="container pt-5 pb-5 my-5">
    <div class="justify-content-center">
        @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div>
        @endif
        <div class="card">
            <div class="card-header">Tickets
                @can('role-create')
                <span class="float-right">
                    <a class="btn btn-primary float-end" href="{{ route('tickets.create') }}">New ticket</a>
                </span>
                @endcan
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $ticket)
                        <tr>
                            <td>{{ $ticket->id }}</td>
                            <td>{{ $ticket->title }}</td>
                            <td>{{ $ticket->status }}</td>
                            <td>{{ $ticket->status }}</td>
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
</div>
@endsection
