@extends('layouts.app')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header">
            <div class="row">
                <div class="col-6 mt-2">
                    <h4 class="fw-bold">{{ __('Detail Category') }}</h4>
                </div>
            </div>

        </div>

        <div class="card-body">
            <a href="{{ route('categories.index') }}" class="btn btn-primary mb-3">Back to list</a>

            <table class="table table-hover table-striped table-responsive">
                <tbody>
                    <tr>
                        <td>Id</td>
                        <td>{{ $category->id }}</td>
                    </tr>
                    <tr>
                        <td>Title</td>
                        <td>{{ $category->title }}</td>
                    </tr>
                </tbody>
            </table>
            <a href="{{ route('categories.index') }}" class="btn btn-primary">Back to list</a>
        </div>
    </div>
@endsection
