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
                    <h4 class="fw-bold">{{ __('List Category') }}</h4>
                </div>
                <div class="col-6 mt-2 text-end">
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">Tambah Category</a>
                </div>
            </div>

        </div>

        <div class="card-body">
            <table class="table table-hover table-striped table-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->title }}</td>
                            <td>
                                <a href="{{ route('categories.show', $category->id) }}" class="badge bg-secondary text-dark text-decoration-none">Show</a>
                                <a href="{{ route('categories.edit', $category->id) }}" class="badge bg-primary text-white text-decoration-none">Edit</a>
                                <a href="" class="badge bg-danger text-white text-decoration-none" onclick="event.preventDefault();document.getElementById('delete-{{ $category->id }}').submit();">Delete</a>
                                <form action="{{ route('categories.destroy', $category->id) }}" id="delete-{{ $category->id }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                {{ $categories->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
