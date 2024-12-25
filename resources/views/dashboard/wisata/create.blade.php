@extends('layouts.app')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header">
            <div class="row">
                <div class="col-6 mt-2">
                    <h4 class="fw-bold">{{ __('Tambah Wisata') }}</h4>
                </div>
            </div>

        </div>

        <div class="card-body">
            <form action="{{ route('wisata.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label text-md-end">{{ __('Nama Wisata') }}</label>

                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label text-md-end">{{ __('Category') }}</label>

                    <select class="form-select" aria-label="Default select example" name="category_id">
                        <option>Select Category</option>
                        @foreach ($category as $id => $c)
                            <option value="{{ $c->id }}" {{ old('category_id', $c->id) == $id ? 'selected' : '' }}>{{ $c->title }}</option>
                        @endforeach
                    </select>

                    @error('category_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label text-md-end">{{ __('Description') }}</label>

                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus></textarea>

                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label text-md-end">{{ __('Alamat') }}</label>

                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" rows="3" name="alamat" value="{{ old('alamat') }}" required autocomplete="alamat" autofocus></textarea>

                    @error('alamat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="no_telp" class="form-label text-md-end">{{ __('Telephone') }}</label>

                    <input id="no_telp" type="text" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ old('no_telp') }}">

                    @error('no_telp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="facebook" class="form-label text-md-end">{{ __('Facebook') }}</label>

                    <input id="facebook" type="text" class="form-control @error('facebook') is-invalid @enderror" name="facebook" value="{{ old('facebook') }}">

                    @error('facebook')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="instagram" class="form-label text-md-end">{{ __('Instagram') }}</label>

                    <input id="instagram" type="text" class="form-control @error('instagram') is-invalid @enderror" name="instagram" value="{{ old('instagram') }}">

                    @error('instagram')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="twitter" class="form-label text-md-end">{{ __('Twitter') }}</label>

                    <input id="twitter" type="text" class="form-control @error('twitter') is-invalid @enderror" name="twitter" value="{{ old('twitter') }}">

                    @error('twitter')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="youtube" class="form-label text-md-end">{{ __('Youtube') }}</label>

                    <input id="youtube" type="text" class="form-control @error('youtube') is-invalid @enderror" name="youtube" value="{{ old('youtube') }}">

                    @error('youtube')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="longitude" class="form-label text-md-end">{{ __('Longitude') }}</label>

                    <input id="longitude" type="text" class="form-control @error('longitude') is-invalid @enderror" name="longitude" value="{{ old('longitude') }}">

                    @error('longitude')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="latitude" class="form-label text-md-end">{{ __('Latitude') }}</label>

                    <input id="latitude" type="text" class="form-control @error('latitude') is-invalid @enderror" name="latitude" value="{{ old('latitude') }}">

                    @error('latitude')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label text-md-end">{{ __('Harga') }}</label>

                    <input id="harga" type="text" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ old('harga') }}" required autocomplete="harga" autofocus>

                    @error('harga')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="jam_buka" class="form-label text-md-end">{{ __('Jam Buka') }}</label>

                    <input id="jam_buka" type="time" class="form-control @error('jam_buka') is-invalid @enderror" name="jam_buka" value="{{ old('jam_buka') }}" required autocomplete="jam_buka" autofocus>

                    @error('jam_buka')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="jam_tutup" class="form-label text-md-end">{{ __('Jam Tutup') }}</label>

                    <input id="jam_tutup" type="time" class="form-control @error('jam_tutup') is-invalid @enderror" name="jam_tutup" value="{{ old('jam_tutup') }}" required autocomplete="jam_tutup" autofocus>

                    @error('jam_tutup')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label text-md-end">{{ __('Image') }}</label>

                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" required autocomplete="image" autofocus>

                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="hari" class="form-label text-md-end">{{ __('Hari') }}</label>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" id="senin" name="senin">
                        <label class="form-check-label" for="senin">
                          Senin
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" id="selasa" name="selasa">
                        <label class="form-check-label" for="selasa">
                          Selasa
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" id="rabu" name="rabu">
                        <label class="form-check-label" for="rabu">
                          Rabu
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" id="kamis" name="kamis">
                        <label class="form-check-label" for="kamis">
                          Kamis
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" id="jumat" name="jumat">
                        <label class="form-check-label" for="jumat">
                          Jumat
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" id="sabtu" name="sabtu">
                        <label class="form-check-label" for="sabtu">
                          Sabtu
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" id="minggu" name="minggu">
                        <label class="form-check-label" for="minggu">
                          Minggu
                        </label>
                    </div>

                    @error('hari')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-0 mt-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
