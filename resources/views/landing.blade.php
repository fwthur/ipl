@extends('layouts.main')

@section('content')
    {{-- Jumbotron --}}
    <section id="hero">
        <div class="jumbotron bg-hero pt-5">
            <div class="container pt-5 mt-5 text-center text-white">
                <h2 class="display-4 fw-bold">Nikmati Berbagai Macam Jenis Wisata di Daerah Banyumas dengan Mudah </h2>

                <div class="card border-0 shadow-sm mt-5">
                    <div class="card-body">
                        <form action="{{ route('search') }}" method="GET">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mt-3 mb-3">
                                        <input class="form-control form-control-lg" type="text" placeholder="Nama Wisata" name="name" aria-label="search example">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="mt-3 mb-3">
                                        <select class="form-select form-select-lg" aria-label="Default select example" name="category_id">
                                            <option selected>Select Category</option>
                                            @foreach ($category as $c)
                                                <option value="{{ $c->id }}">{{ $c->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mt-3 mb-3">
                                        <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Jumbotron --}}

    {{-- Infopanel --}}
    <section id="infopanel">
        <div class="container mt-5 pt-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mx-auto my-auto">
                            <div class="card border-0 bg-transparent">
                                <div class="card-body text-center">
                                    <img src="{{ asset('img/icon/ic-build.svg') }}" alt="" class="img-fluid rounded-circle">
                                    <h2 class="fw-bold">1200+</h2>
                                    <p class="fw-bold">Tempat Wisata</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mx-auto my-auto">
                            <div class="card border-0 bg-transparent">
                                <div class="card-body text-center">
                                    <img src="{{ asset('img/icon/ic-build.svg') }}" alt="" class="img-fluid rounded-circle">
                                    <h2 class="fw-bold">1200+</h2>
                                    <p class="fw-bold">Tempat Wisata</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mx-auto my-auto">
                            <div class="card border-0 bg-transparent">
                                <div class="card-body text-center">
                                    <img src="{{ asset('img/icon/ic-build.svg') }}" alt="" class="img-fluid rounded-circle">
                                    <h2 class="fw-bold">1200+</h2>
                                    <p class="fw-bold">Tempat Wisata</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Infopanel --}}

    {{-- List Wisata --}}
    <section id="wisata">
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-md-3 mt-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold">Kategori Wisata</h5>
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <button class="nav-link active" id="v-pills-all-tab" data-bs-toggle="pill" data-bs-target="#v-pills-all" type="button" role="tab" aria-controls="v-pills-all" aria-selected="true">All</button>
                                @foreach ($category as $c)
                                    <button class="nav-link" id="v-pills-{{ $c->id }}-tab" data-bs-toggle="pill" data-bs-target="#v-pills-{{ $c->id }}" type="button" role="tab" aria-controls="v-pills-{{ $c->id }}" aria-selected="false">{{ $c->title }}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-all" role="tabpanel" aria-labelledby="v-pills-all-tab">
                            <div class="row">
                                @foreach ($wisata as $w)
                                    <div class="col-md-4 my-auto mt-3">
                                        <a href="{{ route('detail.wisata', $w->uuid) }}" class="text-decoration-none text-dark">
                                            <div class="card border-0 bg-transparent">
                                                <img src="{{ asset('images/'.$w->image) }}" alt="" class="img-fluid img-card-top rounded">
                                                <h3 class="fw-bold mt-3">{{ $w->name }}</h3>
                                                <p class="text-grey">{{ $w->alamat }}</p>
                                                <h4 class="fw-bold">Rp {{ $w->harga }}</h4>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @foreach ($category as $c)
                            @php
                                $wisata_filter = DB::table('categories')->join('wisatas', 'wisatas.category_id', '=', 'categories.id')
                                                ->where('categories.id', $c->id)
                                                ->paginate(9);
                            @endphp
                            <div class="tab-pane fade" id="v-pills-{{ $c->id }}" role="tabpanel" aria-labelledby="v-pills-{{ $c->id }}-tab">
                                <div class="row">
                                    @foreach ($wisata_filter as $w)
                                        <div class="col-md-4 my-auto mt-3">
                                            <a href="{{ route('detail.wisata', $w->uuid) }}" class="text-decoration-none text-dark">
                                                <div class="card border-0 bg-transparent">
                                                    <img src="{{ asset('images/'.$w->image) }}" alt="" class="img-fluid img-card-top rounded">
                                                    <h3 class="fw-bold mt-3">{{ $w->name }}</h3>
                                                    <p class="text-grey">{{ $w->alamat }}</p>
                                                    <h4 class="fw-bold">Rp {{ $w->harga }}</h4>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End List Wisata --}}
@endsection
