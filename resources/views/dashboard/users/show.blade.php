@extends('layouts.app')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header">
            <div class="row">
                <div class="col-6 mt-2">
                    <h4 class="fw-bold">{{ __('Detail Users') }}</h4>
                </div>
            </div>

        </div>

        <div class="card-body">
            <a href="{{ route('users.index') }}" class="btn btn-primary mb-3">Back to list</a>

            <table class="table table-hover table-striped table-responsive">
                <tbody>
                    <tr>
                        <td>Id</td>
                        <td>{{ $user->id }}</td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td>Roles</td>
                        <td>{{ $user->roles }}</td>
                    </tr>
                </tbody>
            </table>
            <a href="{{ route('users.index') }}" class="btn btn-primary">Back to list</a>
        </div>
    </div>
@endsection
