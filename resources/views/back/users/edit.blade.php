@extends('layouts.app')
@section('content')
    <div class="container pt-5 pb-5 my-5">
        <div class="justify-content-center">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Opps!</strong> Something went wrong, please check below errors.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-header">Create user
                    <span class="float-right">
                        <a class="btn btn-primary float-end" href="{{ route('users.index') }}">Users</a>
                    </span>
                </div>
                <div class="card-body">
                    {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PATCH']) !!}
                    <div class="form-group">
                        <strong>Name:</strong>
                        {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <strong>Email:</strong>
                        {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <strong>Password:</strong>
                        {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <strong>Confirm Password:</strong>
                        {!! Form::password('password_confirmation', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <strong>Role:</strong>
                        {!! Form::select('roles[]', $roles, $userRole, ['class' => 'form-control', 'multiple']) !!}
                    </div>
                    {{-- <button type="submit" class="btn btn-primary float-end mt-3">Submit</button> --}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
