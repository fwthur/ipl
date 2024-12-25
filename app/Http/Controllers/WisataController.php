<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Ramsey\Uuid\Uuid;
use App\Models\Category;

class WisataController extends Controller
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
            $wisata = Wisata::paginate(10);
            return view('dashboard.wisata.index', compact('wisata'));
        }
        else{
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->roles == 'admin')
        {
            $category = Category::all();
            return view('dashboard.wisata.create', compact('category'));
        }
        else{
            abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->roles == 'admin')
        {
            $request->validate([
                'image' => 'required|image|mimes:png,jpg,jpeg,svg,gif|max:4000',
            ]);

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            $input = $request->all();
            $input['uuid'] = Uuid::uuid4();
            $input['image'] = $imageName;
            $hari = [
                'senin' => $request->senin,
                'selasa' => $request->selasa,
                'rabu' => $request->rabu,
                'kamis' => $request->kamis,
                'jumat' => $request->jumat,
                'sabtu' => $request->sabtu,
                'minggu' => $request->minggu,
            ];
            $input['hari'] = (collect($hari))->toJson();
            $wisata = Wisata::create($input);
            $wisata->save();
            return redirect()->route('wisata.index')->with('success', 'Wisata Berhasil di tambahkan!');
        }
        else{
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wisata  $wisata
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->roles == 'admin')
        {
            $wisata = Wisata::find($id);
            $category = Category::where('categories.id', $wisata->category_id)->get();
            $hari = json_decode($wisata->hari, true);
            return view('dashboard.wisata.show', compact('wisata', 'category', 'hari'));
        }
        else{
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wisata  $wisata
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->roles == 'admin')
        {
            $wisata = Wisata::find($id);
            $category = Category::all()->pluck('title', 'id');
            $hari = json_decode($wisata->hari, true);
            return view('dashboard.wisata.edit', compact('wisata', 'category', 'hari'));
        }
        else{
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wisata  $wisata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->roles == 'admin')
        {
            $wisata = Wisata::find($id);
            $input = $request->all();
            if ($imageName = $request->file('image')) {
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $input['image'] = $imageName;
            }else{
                unset($input['image']);
            }
            $hari = [
                'senin' => $request->senin,
                'selasa' => $request->selasa,
                'rabu' => $request->rabu,
                'kamis' => $request->kamis,
                'jumat' => $request->jumat,
                'sabtu' => $request->sabtu,
                'minggu' => $request->minggu,
            ];
            $input['hari'] = (collect($hari))->toJson();

            $wisata->update($input);
            return redirect()->route('wisata.index')->with('success', 'Wisata Berhasil di ubah!');
        }
        else{
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wisata  $wisata
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->roles == 'admin')
        {
            $wisata = Wisata::find($id);
            $wisata->delete();
            return redirect()->route('wisata.index')->with('success', 'Wisata Berhasil di hapus!');
        }
        else{
            abort(403);
        }
    }
}
