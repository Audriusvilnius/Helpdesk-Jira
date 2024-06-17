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
                <div class="card-header">Status
                    @can('status-create')
                        <span class="float-right">
                            <a class="btn btn-primary float-end" href="{{ route('status.create') }}">New Status</a>
                        </span>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th width="280px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $status)
                                <tr>
                                    <td>{{ $status->id }}</td>
                                    <td>{{ $status->title }}</td>
                                    <td>
                                        <a class="btn btn-success" href="{{ route('status.show', $status->id) }}">Show</a>
                                        @can('status-edit')
                                            <a class="btn btn-primary" href="{{ route('status.edit', $status->id) }}">Edit</a>
                                        @endcan
                                        @can('status-delete')
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['status.destroy', $status->id], 'style' => 'display:inline']) !!}
                                            {{-- {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!} --}}
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
