@extends('layouts.app')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header">
            <div class="row">
                <div class="col-6 mt-2">
                    <h4 class="fw-bold">{{ __('Detail Wisata') }}</h4>
                </div>
            </div>

        </div>

        <div class="card-body">
            <a href="{{ route('wisata.index') }}" class="btn btn-primary mb-3">Back to list</a>

            <table class="table table-hover table-striped table-responsive">
                <tbody>
                    <tr>
                        <td>Id</td>
                        <td>{{ $wisata->id }}</td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>{{ $wisata->name }}</td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        @foreach ($category as $c)
                            <td>{{ $c->title }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>{{ $wisata->description }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>{{ $wisata->alamat }}</td>
                    </tr>
                    <tr>
                        <td>Telephone</td>
                        <td>{{ $wisata->no_telp }}</td>
                    </tr>
                    <tr>
                        <td>Sosial Media</td>
                        <td>
                            <ul>
                                <li>
                                    Facebook : {{ $wisata->facebook }}
                                </li>
                                <li>
                                    Instagram : {{ $wisata->instagram }}
                                </li>
                                <li>
                                    Twitter : {{ $wisata->twitter }}
                                </li>
                                <li>
                                    Youtube : {{ $wisata->youtube }}
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>Longitude</td>
                        <td>{{ $wisata->longitude }}</td>
                    </tr>
                    <tr>
                        <td>Latitude</td>
                        <td>{{ $wisata->latitude }}</td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td>{{ $wisata->harga }}</td>
                    </tr>
                    <tr>
                        <td>Jam Buka</td>
                        <td>{{ $wisata->jam_buka }}</td>
                    </tr>
                    <tr>
                        <td>Jam Tutup</td>
                        <td>{{ $wisata->jam_tutup }}</td>
                    </tr>
                    <tr>
                        <td>Hari</td>
                        <td>
                            <span class="badge bg-primary">{{ ($hari['senin'] == 'true') ? 'Senin' : '' }}</span>
                            <span class="badge bg-primary">{{ ($hari['selasa'] == 'true') ? 'Selasa' : '' }}</span>
                            <span class="badge bg-primary">{{ ($hari['rabu'] == 'true') ? 'Rabu' : '' }}</span>
                            <span class="badge bg-primary">{{ ($hari['kamis'] == 'true') ? 'Kamis' : '' }}</span>
                            <span class="badge bg-primary">{{ ($hari['jumat'] == 'true') ? 'Jumat' : '' }}</span>
                            <span class="badge bg-primary">{{ ($hari['sabtu'] == 'true') ? 'Sabtu' : '' }}</span>
                            <span class="badge bg-primary">{{ ($hari['minggu'] == 'true') ? 'Minggu' : '' }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Image</td>
                        <td>
                            <a href="{{ asset('images/'.$wisata->image) }}" target="_blank">
                                <img src="{{ asset('images/'.$wisata->image) }}" alt="" class="img-fluid" style="width: 80px; height: 80px;">
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <a href="{{ route('wisata.index') }}" class="btn btn-primary">Back to list</a>
        </div>
    </div>
@endsection
