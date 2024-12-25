@extends('layouts.main')

@section('content')
    {{-- Pembayaran --}}
    <section id="pembayaran">
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-md-9 mt-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold">Pilih metode pembayaran</h5>
                            <p>Gunakan salah satu metode pembayaran di bawah ini dengan cara transfer ke no rekening yang dipilih.</p>
                            <form action="" id="formMetode" name="formMetode">
                                <div class="row">
                                    <div class="col-md-3 mt-3">
                                        <input type="radio" class="btn-check" name="metode_pembayaran" id="option1" autocomplete="on" value="BCA Virtual Account">
                                        <label class="btn btn-outline-success" for="option1">
                                            BCA Virtual Account <br> <br>
                                            08373737
                                        </label>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <input type="radio" class="btn-check" name="metode_pembayaran" id="option2" autocomplete="on" value="BCA Virtual Account">
                                        <label class="btn btn-outline-success" for="option2">
                                            BCA Virtual Account <br> <br>
                                            08373737
                                        </label>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <input type="radio" class="btn-check" name="metode_pembayaran" id="option3" autocomplete="on" value="BCA Virtual Account">
                                        <label class="btn btn-outline-success" for="option3">
                                            BCA Virtual Account <br> <br>
                                            08373737
                                        </label>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <input type="radio" class="btn-check" name="metode_pembayaran" id="option4" autocomplete="on" value="BCA Virtual Account">
                                        <label class="btn btn-outline-success" for="option4">
                                            BCA Virtual Account <br> <br>
                                            08373737
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mt-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <form action="{{ route('konfirmasi.pembayaran', $transaction->uuid) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <h5 class="fw-bold mb-4">Metode Pembayaran</h5>

                                <div class="mb-3">
                                    <p class="text-grey">Wisata</p>
                                    @foreach ($wisata as $w)
                                        <p class="fw-bold">{{ $w->name }}</p>
                                    @endforeach
                                </div>
                                <div class="mb-3 border-bottom">
                                    <p class="text-grey">Tanggal</p>
                                    <p class="fw-bold">{{ date('d M y', strtotime($transaction->tanggal)) }}</p>
                                </div>
                                <div class="mt-3 mb-3 border-bottom">
                                    <div class="row">
                                        <div class="col-6 my-auto">
                                            <p class="text-grey">Jumlah Tiket</p>
                                            <p class="fw-bold">{{ $transaction->jumlah_tiket }}</p>
                                        </div>
                                        <div class="col-6 mt-auto">
                                            <p class="fw-bold">Rp {{ $transaction->jumlah_pembayaran }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 mt-3">
                                    <p class="fw-bold">Metode Pembayaran</p>
                                    <p class="text-grey" id="metpem">Select Metode Pembayaran</p>
                                </div>
                                <div class="mb-3 mt-3">
                                    <p class="fw-bold">Bukti Pembayaran</p>
                                    <input type="file" class="form-control" name="image">
                                </div>
                                <div class="mt-4">
                                    <input type="hidden" name="metode_pembayaran" id="metode" value>
                                    <button type="submit" class="btn btn-primary" style="width: 100%">Konfirmasi Pembayaran</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Pembayaran --}}

    <script>
        document.formMetode.onclick = function() {
            var radio = document.formMetode.metode_pembayaran.value;
            metpem.innerHTML = radio;
            metode.value = radio;
        }
    </script>
@endsection
