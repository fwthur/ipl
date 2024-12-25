@extends('layouts.main')

@section('content')
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
                                $wisata_filter = DB::table('wisatas')->join('categories', 'wisatas.category_id', '=', 'categories.id')
                                                ->where('categories.id', $c->id)
                                                ->get();
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
