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
                <div class="card-header">Edit permission
                    <span class="float-right">
                        <a class="btn btn-primary float-end" href="{{ route('permissions.index') }}">Permissions</a>
                    </span>
                </div>
                <div class="card-body">
                    {!! Form::model($permission, ['route' => ['permissions.update', $permission->id], 'method' => 'PATCH']) !!}
                    <div class="form-group">
                        <strong>Name:</strong>
                        {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                    </div>
                    {{-- <button type="submit" class="btn btn-primary float-end mt-3">Submit</button> --}}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
