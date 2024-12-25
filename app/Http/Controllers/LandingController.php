<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wisata;
use Illuminate\Pagination\Paginator;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;

class LandingController extends Controller
{
    public function boot()
    {
        Paginator::useBootstrap();
    }

    public function index()
    {
        $category = Category::all();
        $wisata = Wisata::paginate(9);
        return view('landing', compact('wisata', 'category'));
    }

    public function augmented($uuid)
    {
        $wisata = Wisata::where('uuid', $uuid)->firstOrFail();
        return view('wisata.ar', compact('wisata'));
    }

    public function wisata()
    {
        $category = Category::all();
        $wisata = Wisata::paginate(9);
        return view('wisata.wisata', compact('wisata', 'category'));
    }

    public function search(Request $request)
    {
        $wisata = Wisata::filterByRequest($request)->paginate(9);
        $category = Category::all();
        return view('wisata.wisata', compact('wisata', 'category'));
    }

    public function detail($uuid)
    {
        $wisata = Wisata::where('uuid', $uuid)->firstOrFail();
        $hari = json_decode($wisata->hari, true);
        $min = 10;
        $max = 300;

        $kode = rand($min, $max);
        return view('wisata.detail', compact('kode', 'wisata', 'hari'));
    }

    public function simpan_pembayaran(Request $request)
    {
        $input = $request->all();
        $input['uuid'] = Uuid::uuid4();
        $input['pembeli_id'] = Auth::user()->id;

        $transaction = Transaction::create($input);
        $transaction->save();

        return redirect()->route('pembayaran.wisata', $transaction->uuid)->with('success', 'Silahkan untuk konfirmasi pembayaran!');
    }

    public function konfirmasi_pembayaran(Request $request, $uuid)
    {
        $transaction = Transaction::where('uuid', $uuid)->firstOrFail();
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg,svg,gif|max:4000',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $input = $request->all();
        $input['image'] = $imageName;
        $transaction->update($input);

        return redirect()->route('home')->with('success', 'Terimakasih telah konfirmasi pembayaran!');
    }

    public function pembayaran($uuid)
    {
        $transaction = Transaction::where('uuid', $uuid)->firstOrFail();
        $wisata = Wisata::where('id', $transaction->wisata_id)->get();
        return view('wisata.pembayaran', compact('transaction', 'wisata'));
    }
}
