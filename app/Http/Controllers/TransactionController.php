<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Ramsey\Uuid\Uuid;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }

    public function index()
    {
        if(Auth::user()->roles == 'admin')
        {
            $transactions = Transaction::paginate(10);
            return view('dashboard.transactions.index', compact('transactions'));
        }
        else{
            $transactions = Transaction::where('pembeli_id', Auth::user()->id)->paginate(10);
            return view('dashboard.transactions.history', compact('transactions'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $transaction = Transaction::where('uuid', $uuid)->firstOrFail();
        return view('dashboard.transactions.tiket', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        if(Auth::user()->roles == 'admin')
        {
            $input = $request->all();
            $input['author_id'] = Auth::user()->id;
            $transaction->update($input);
            return redirect()->route('transactions.index')->with('success', 'Transaction Berhasil di ubah!');
        }
        else{
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
