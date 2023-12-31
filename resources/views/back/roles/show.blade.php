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
            <div class="card-header">Role
                @can('role-create')
                <span class="float-right">
                    <a class="btn btn-primary float-end" href="{{ route('roles.index') }}">Back</a>
                </span>
                @endcan
            </div>
            <div class="card-body">
                <div class="lead">
                    <strong>Name:</strong>
                    {{ $role->name }}
                </div>
                <div class="lead">
                    <strong>Permissions:</strong>
                    @if(!empty($rolePermissions))
                    @foreach($rolePermissions as $permission)
                    <label class="badge badge-success">{{ $permission->name }}</label>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
