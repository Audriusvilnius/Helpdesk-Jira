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
                <div class="card-header">Important
                    @can('important-create')
                        <span class="float-right">
                            <a class="btn btn-primary float-end" href="{{ route('important.create') }}">New Important</a>
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
                            @foreach ($data as $key => $important)
                                <tr>
                                    <td>{{ $important->id }}</td>
                                    <td>{{ $important->title }}</td>
                                    <td>
                                        <a class="btn btn-success"
                                            href="{{ route('important.show', $important->id) }}">Show</a>
                                        @can('important-edit')
                                            <a class="btn btn-primary"
                                                href="{{ route('important.edit', $important->id) }}">Edit</a>
                                        @endcan
                                        @can('important-delete')
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['important.destroy', $important->id],
                                                'style' => 'display:inline',
                                            ]) !!}

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
