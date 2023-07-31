@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="container">
            <div class="justify-content-center">

                @include('alerts.alert-success')
                @include('alerts.alert-danger')

                <div class="card-header card-header justify-content-between align-content-between d-flex ">
                    <h2 class="text-light">Create ticket</h2>
                    @can('role-create')
                        <a class="text-decoration-none text-black container-btn shadow bg-warning d-flex mb-4 float-end"
                            href="{{ route('home') }}">
                            <span>Home</span>
                        </a>
                    @endcan
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-9 col-xl-9">
                                {!! Form::open(['route' => 'tickets.store', 'method' => 'POST']) !!}
                                <div class="form-group">
                                    <strong>Title:</strong>
                                    {!! Form::text('title', null, [
                                        'placeholder' => 'Title',
                                        'class' => 'form-control mb-3',
                                        'minlength' => '3',
                                        'maxlength' => '150',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-3 col-xl-3">
                                <label for="important_id"><b>{{ __('Important:') }}</b></label>
                                <select class="form-select mb-3" name="important_id">
                                    <option value="3">{{ __('Medium') }}</option>
                                    @foreach ($important as $status)
                                        <option value="{{ $status->id }}"
                                            @if ($status->id == old('important_id')) selected @endif>
                                            <b>{{ $status->title }}</b>
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <strong>Massege:</strong>
                            {!! Form::textarea('message_json', null, [
                                'placeholder' => 'Leave message here',
                                'class' => 'form-control mb-3',
                            ]) !!}
                        </div>
                        <button type="submit" class="btn btn-success float-end mt-3">Create</button>
                        {!! Form::close() !!}
                        <a class="text-decoration-none text-black container-btn bg-outline mt-3 float-start"
                            href="{{ url()->previous() }}">
                            <span>Back</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
