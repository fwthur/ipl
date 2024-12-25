@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card border-0 shadow-sm">
        <div class="card-header">
            <div class="row">
                <div class="col-6 mt-2">
                    <h4 class="fw-bold">{{ __('List Users') }}</h4>
                </div>
                <div class="col-6 mt-2 text-end">
                    <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah User</a>
                </div>
            </div>

        </div>

        <div class="card-body">
            <table class="table table-hover table-striped table-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->roles }}</td>
                            <td>
                                <a href="{{ route('users.show', $user->id) }}" class="badge bg-secondary text-dark text-decoration-none">Show</a>
                                <a href="{{ route('users.edit', $user->id) }}" class="badge bg-primary text-white text-decoration-none">Edit</a>
                                <a href="" class="badge bg-danger text-white text-decoration-none" onclick="event.preventDefault();document.getElementById('delete-{{ $user->id }}').submit();">Delete</a>
                                <form action="{{ route('users.destroy', $user->id) }}" id="delete-{{ $user->id }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                {{ $users->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
