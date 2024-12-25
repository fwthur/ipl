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
                                @if($transaction->status_pembayaran == 'pending' && $transaction->metode_pembayaran != NULL)
                                    <a href="approve-{{ $transaction->id }}" class="badge bg-primary text-white text-decoration-none" data-bs-toggle="modal" data-bs-target="#approve-{{ $transaction->id }}">Edit</a>
                                @endif
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

    @foreach ($transactions as $transaction)
        <!-- Modal -->
        <div class="modal fade" id="approve-{{ $transaction->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Approve Pembayaran</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <a href="{{ asset('images/'.$transaction->image) }}" target="_blank">
                                <img src="{{ asset('images/'.$transaction->image) }}" alt="" class="img-fluid" style="width: 100%; height: 620px;">
                            </a>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="approve" value="approved" name="status_pembayaran">
                                <label class="form-check-label" for="approve">Status Pembayaran (Approve)</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endsection
