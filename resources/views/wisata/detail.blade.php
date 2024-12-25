@extends('layouts.main')

@section('content')
    {{-- Detail --}}
    <section id="detail">
        <div class="container pt-5 mt-5">
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <img src="{{ asset('images/'. $wisata->image) }}" alt="" class="img-fluid rounded">
                            <a href="{{ route('ar', $wisata->uuid) }}" class="btn btn-primary mt-4" style="width: 100%" target="_blank">View Virtual Reality</a>
                        </div>
                        <div class="col-md-8 mt-3">
                            <h2 class="fw-bold">{{ $wisata->name }}</h2>
                            <h4 class="fw-bold mt-2">Rp {{ $wisata->harga }}</h4>
                            <ul class="mt-3 list-unstyled">
                                <li>
                                    <p class="alamat">{{ $wisata->alamat }}</p>
                                </li>
                                <li>
                                    <p class="jam">Jam Operasional : {{ $wisata->jam_buka }} s/d {{ $wisata->jam_tutup }}</p>
                                </li>
                                <li>
                                    <p class="no_telp">{{ $wisata->no_telp }}</p>
                                </li>
                            </ul>
                            <div class="hari">
                                <span class="badge bg-primary">{{ ($hari['senin'] == 'true') ? 'Senin' : '' }}</span>
                                <span class="badge bg-primary">{{ ($hari['selasa'] == 'true') ? 'Selasa' : '' }}</span>
                                <span class="badge bg-primary">{{ ($hari['rabu'] == 'true') ? 'Rabu' : '' }}</span>
                                <span class="badge bg-primary">{{ ($hari['kamis'] == 'true') ? 'Kamis' : '' }}</span>
                                <span class="badge bg-primary">{{ ($hari['jumat'] == 'true') ? 'Jumat' : '' }}</span>
                                <span class="badge bg-primary">{{ ($hari['sabtu'] == 'true') ? 'Sabtu' : '' }}</span>
                                <span class="badge bg-primary">{{ ($hari['minggu'] == 'true') ? 'Minggu' : '' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mt-3">
                        <div class="card-body">
                            <h4 class="fw-bold">Deskripsi</h4>
                            <p class="desc">{{ $wisata->description }}</p>
                        </div>
                    </div>

                    <div class="maps">
                        <div class="ratio ratio-16x9 mt-5">
                            <iframe class="rounded" src="https://maps.google.com/maps?q={{ $wisata->latitude }},{{ $wisata->longitude }}&hl=ind&z=14&amp;output=embed" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>

                </div>

                <div class="col-md-3">
                    <div class="card border-0 shadow sm-mt-3">
                        <div class="card-body">
                            <form action="{{ route('simpan.pembayaran', $wisata->uuid) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="jumlah_tiket" class="form-label text-md-end fw-bold">{{ __('Tiket') }}</label>

                                    <input id="jumlah_tiket" type="number" class="form-control text-center @error('jumlah_tiket') is-invalid @enderror" name="jumlah_tiket" value="{{ old('jumlah_tiket') }}" required autocomplete="jumlah_tiket" autofocus onkeyup="sum()">

                                    @error('jumlah_tiket')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label text-md-end fw-bold">{{ __('Tanggal') }}</label>

                                    <input id="tanggal" type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ old('tanggal') }}" required autocomplete="tanggal" autofocus>

                                    @error('tanggal')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 border-top">
                                    <div class="row mt-3">
                                        <div class="col-6 my-auto">
                                            <h6 class="fw-bold">Total</h6>
                                        </div>
                                        <div class="col-6 my-auto">
                                            <h5 class="fw-bold" id="total"></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 border-top">
                                    <div class="row mt-3">
                                        <div class="col-6 my-auto">
                                            <h6 class="fw-bold">Kode Unik</h6>
                                        </div>
                                        <div class="col-6 my-auto">
                                            <h5 class="fw-bold" id="kode"></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 border-top">
                                    <div class="row mt-3">
                                        <div class="col-6 my-auto">
                                            <h6 class="fw-bold">Subtotal</h6>
                                        </div>
                                        <div class="col-6 my-auto">
                                            <h5 class="fw-bold" id="subtotal"></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    @if(Auth::check())
                                        <input type="hidden" name="jumlah_pembayaran" value id="sub">
                                        <input type="hidden" name="kode_unik" value id="kode_unik">
                                        <input type="hidden" name="wisata_id" value="{{ $wisata->id }}">
                                        <button type="submit" class="btn btn-primary" style="width: 100%">Konfirmasi Pembayaran</button>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-primary" style="width: 100%">Masuk</a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Detail --}}


    <script>
        function sum()
        {
            var tiket = document.getElementById('jumlah_tiket').value;
            var kode = "<?php echo $kode ?>";
            var harga = "<?php echo $wisata->harga ?>";

            var total = parseInt(tiket) * parseInt(harga);
            var subtotal = total + parseInt(kode);
            if(!isNaN(total)){
                document.getElementById('total').innerHTML = "Rp " + total;
                document.getElementById('kode').innerHTML = kode;
                document.getElementById('kode_unik').value = kode;
                document.getElementById('subtotal').innerHTML = "Rp " + subtotal;
                document.getElementById('sub').value = subtotal;
            }
        }
    </script>
@endsection
