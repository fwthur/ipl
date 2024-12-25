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
                    <h4 class="fw-bold">{{ __('Transaction Report') }}</h4>
                </div>
            </div>

        </div>

        <div class="card-body">
            <table class="table table-hover table-striped table-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No Ref</th>
                        <th>Wisata</th>
                        <th>Pembeli</th>
                        <th>Jumlah Tiket</th>
                        <th>Tanggal</th>
                        <th>Jumlah Pembayaran</th>
                        <th>Metode Pembayaran</th>
                        <th>Status Pembayaran</th>
                        <th>Author</th>
                        <th>Kode Unik</th>
                        <th>Image</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($transactions as $transaction)
                        @php
                            $wisata = DB::table('transactions')->join('wisatas', 'transactions.wisata_id', '=', 'wisatas.id')
                                        ->where('transactions.id', $transaction->id)
                                        ->select('wisatas.name')->get();
                            $pembeli = DB::table('transactions')->join('users', 'transactions.pembeli_id', '=', 'users.id')
                                        ->where('transactions.id', $transaction->id)
                                        ->select('users.name')->get();
                            $author = DB::table('transactions')->join('users', 'transactions.author_id', '=', 'users.id')
                                        ->where('transactions.id', $transaction->id)
                                        ->select('users.name')->get();
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $transaction->uuid }}</td>
                            @foreach ($wisata as $w)
                                <td>{{ $w->name }}</td>
                            @endforeach
                            @foreach ($pembeli as $p)
                                <td>{{ $p->name }}</td>
                            @endforeach
                            <td>{{ $transaction->jumlah_tiket }}</td>
                            <td>{{ $transaction->tanggal }}</td>
                            <td>{{ $transaction->jumlah_pembayaran }}</td>
                            @if ($transaction->metode_pembayaran == NULL)
                                <td>Belum konfirmasi pembayaran</td>
                            @else
                                <td>{{ $transaction->metode_pembayaran }}</td>
                            @endif
                            <td>{{ $transaction->status_pembayaran }}</td>
                            @if ($transaction->author_id == NULL)
                                <td>Belum konfirmasi pembayaran</td>
                            @else
                                @foreach ($author as $a)
                                    <td>{{ $a->name }}</td>
                                @endforeach
                            @endif
                            <td>{{ $transaction->kode_unik }}</td>
                            @if ($transaction->image == NULL)
                                <td>Belum konfirmasi pembayaran</td>
                            @else
                                <td>
                                    <a href="{{ asset('images/'.$transaction->image) }}" target="_blank">
                                        <img src="{{ asset('images/'.$transaction->image) }}" alt="" class="img-fluid" style="width: 80px; height: 80px;">
                                    </a>
                                </td>
                            @endif
                            <td>
                                @if($transaction->metode_pembayaran == NULL)
                                    <a href="" class="badge bg-danger text-white text-decoration-none" onclick="event.preventDefault();document.getElementById('delete-{{ $transaction->id }}').submit();">Delete</a>
                                    <form action="{{ route('transactions.destroy', $transaction->id) }}" id="delete-{{ $transaction->id }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                @endif
                                @if($transaction->status_pembayaran == 'approved')
                                    <a href="{{ route('transactions.show', $transaction->uuid) }}" class="badge bg-secondary text-dark text-decoration-none">Cetak Tiket</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                {{ $transactions->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
