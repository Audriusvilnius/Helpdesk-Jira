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
                <div class="card-header">Users
                    <span class="float-right">
                        <a class="btn btn-primary float-end" href="{{ route('users.create') }}">New User</a>
                    </span>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th width="280px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if (!empty($user->getRoleNames()))
                                            @foreach ($user->getRoleNames() as $val)
                                                <label
                                                    class="badge rounded-pill bg-dark text-capitalize fs-6">{{ $val }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-success" href="{{ route('users.show', $user->id) }}">Show</a>
                                        @can('user-edit')
                                            <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>
                                        @endcan
                                        @can('user-delete')
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
                                            {{-- {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!} --}}
                                            {!! Form::close() !!}
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $data->render() }}
                </div>
            </div>
        </div>
    </div>
@endsection
