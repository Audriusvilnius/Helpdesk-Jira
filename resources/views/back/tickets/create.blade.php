@extends('layouts.app')
@section('content')
<div class="container pt-5 pb-5 my-5">
    <div class="justify-content-center">

        @include('alerts.alert-success')
        @include('alerts.alert-danger')

        <div class="card-header card-header justify-content-between align-content-between d-flex ">
            <h2 class="text-light">Create ticket</h2>
            @can('role-create')
            <span class="float-end ">
                <a class="btn btn-primary d-flex justify-content-center align-content-center m-2 " href="{{ route('tickets.index') }}">Tickets</a>
            </span>
            @endcan
        </div>
        <div class="card">
            <div class="card-body">
                {!! Form::open(array('route' => 'tickets.store', 'method'=>'POST')) !!}
                <div class="form-group">
                    <strong>Title:</strong>
                    {!! Form::text('title', null, array('placeholder' => 'Title','class' => 'form-control','minlength'=>'3', 'maxlength'=>'50')) !!}
                </div>
                <div class="form-group">
                    <strong>Important:</strong>
                    {!! Form::select('important_id', $important,[], array('class' => 'form-control important-conteiner','multiple')) !!}
                </div>
                <div class="form-group">
                    <strong>Massege:</strong>
                    {!! Form::textarea('message_json', null, array('placeholder' => 'Massege','class' => 'form-control')) !!}
                </div>
                <button type="submit" class="btn btn-primary float-end mt-3">Create</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
