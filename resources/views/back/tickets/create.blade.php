@extends('layouts.app')
@section('content')
<div class="container">
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
            <div class="card-header">Create ticket
                <span class="float-right">
                    <a class="btn btn-primary" href="{{ route('tickets.index') }}">Tickets</a>
                </span>
            </div>
            <div class="card-body">
                {!! Form::open(array('route' => 'tickets.store', 'method'=>'POST')) !!}
                <div class="form-group">
                    <strong>Title:</strong>
                    {!! Form::text('title', null, array('placeholder' => 'Title','class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    <strong>Body:</strong>
                    {!! Form::textarea('body', null, array('placeholder' => 'Body','class' => 'form-control')) !!}
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
