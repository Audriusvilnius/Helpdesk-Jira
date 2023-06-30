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
                @can('role-create')
                <span class="float-right">
                    <a class="btn btn-primary float-end" href="{{ route('status.index') }}">Back</a>
                </span>
                @endcan
            </div>
            <div class="card-body">
                <div class="lead">
                    <strong>Title:</strong>
                    {{ $status->title }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
