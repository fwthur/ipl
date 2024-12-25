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
                    <h4 class="fw-bold">{{ __('List Wisata') }}</h4>
                </div>
                <div class="col-6 mt-2 text-end">
                    <a href="{{ route('wisata.create') }}" class="btn btn-primary">Tambah Wisata</a>
                </div>
            </div>

        </div>

        <div class="card-body">
            <table class="table table-hover table-striped table-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Wisata</th>
                        <th>Category</th>
                        <th>Deskripsi</th>
                        <th>Alamat</th>
                        <th>Telephone</th>
                        <th>Sosial Media</th>
                        <th>Longitude</th>
                        <th>Latitude</th>
                        <th>Harga</th>
                        <th>Jam Buka</th>
                        <th>Jam Tutup</th>
                        <th>Hari</th>
                        <th>Image</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($wisata as $w)
                        @php
                            $category = DB::table('wisatas')->join('categories', 'wisatas.category_id', '=', 'categories.id')
                                        ->where('wisatas.id', $w->id)
                                        ->select('categories.title')->get();
                            $hari = json_decode($w->hari, true);
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $w->name }}</td>
                            @foreach ($category as $c)
                                <td>{{ $c->title }}</td>
                            @endforeach
                            <td>{{ $w->description }}</td>
                            <td>{{ $w->alamat }}</td>
                            <td>{{ $w->no_telp }}</td>
                            <td>
                                <ul>
                                    <li>
                                        Facebook : {{ $w->facebook }}
                                    </li>
                                    <li>
                                        Instagram : {{ $w->instagram }}
                                    </li>
                                    <li>
                                        Twitter : {{ $w->twitter }}
                                    </li>
                                    <li>
                                        Youtube : {{ $w->youtube }}
                                    </li>
                                </ul>
                            </td>
                            <td>{{ $w->longitude }}</td>
                            <td>{{ $w->latitude }}</td>
                            <td>{{ $w->harga }}</td>
                            <td>{{ $w->jam_buka }}</td>
                            <td>{{ $w->jam_tutup }}</td>
                            <td>
                                <span class="badge bg-primary">{{ ($hari['senin'] == 'true') ? 'Senin' : '' }}</span>
                                <span class="badge bg-primary">{{ ($hari['selasa'] == 'true') ? 'Selasa' : '' }}</span>
                                <span class="badge bg-primary">{{ ($hari['rabu'] == 'true') ? 'Rabu' : '' }}</span>
                                <span class="badge bg-primary">{{ ($hari['kamis'] == 'true') ? 'Kamis' : '' }}</span>
                                <span class="badge bg-primary">{{ ($hari['jumat'] == 'true') ? 'Jumat' : '' }}</span>
                                <span class="badge bg-primary">{{ ($hari['sabtu'] == 'true') ? 'Sabtu' : '' }}</span>
                                <span class="badge bg-primary">{{ ($hari['minggu'] == 'true') ? 'Minggu' : '' }}</span>
                            </td>
                            <td>
                                <a href="{{ asset('images/'.$w->image) }}" target="_blank">
                                    <img src="{{ asset('images/'.$w->image) }}" alt="" class="img-fluid" style="width: 80px; height: 80px;">
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('wisata.show', $w->id) }}" class="badge bg-secondary text-dark text-decoration-none">Show</a>
                                <a href="{{ route('wisata.edit', $w->id) }}" class="badge bg-primary text-white text-decoration-none">Edit</a>
                                <a href="" class="badge bg-danger text-white text-decoration-none" onclick="event.preventDefault();document.getElementById('delete-{{ $w->id }}').submit();">Delete</a>
                                <form action="{{ route('wisata.destroy', $w->id) }}" id="delete-{{ $w->id }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                {{ $wisata->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
