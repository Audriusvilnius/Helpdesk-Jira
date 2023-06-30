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
            <div class="card-header">Create ticket
                <span class="float-right">
                    <a class="btn btn-primary float-end" href="{{ route('tickets.index') }}">Tickets</a>
                </span>
            </div>
            <div class="card-body">
                {!! Form::open(array('route' => 'tickets.store', 'method'=>'POST')) !!}
                <div class="form-group">
                    <strong>Title:</strong>
                    {!! Form::text('title', null, array('placeholder' => 'Title','class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    <strong>Massege:</strong>
                    {!! Form::textarea('message_json', null, array('placeholder' => 'Massege','class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    <strong>Important:</strong>
                    {!! Form::select('important_id', $important,[], array('class' => 'form-control','multiple')) !!}
                </div>
                <button type="submit" class="btn btn-primary float-end mt-3">Submit</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
