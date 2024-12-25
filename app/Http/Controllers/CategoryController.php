<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class CategoryController extends Controller
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
            $categories = Category::paginate(10);
            return view('dashboard.categories.index', compact('categories'));
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
            return view('dashboard.categories.create');
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
            $input = $request->all();
            $input['uuid'] = Uuid::uuid4();
            $category = Category::create($input);
            $category->save();
            return redirect()->route('categories.index')->with('success', 'Category Berhasil di tambahkan!');
        }
        else{
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        if(Auth::user()->roles == 'admin')
        {
            return view('dashboard.categories.show', compact('category'));
        }
        else{
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if(Auth::user()->roles == 'admin')
        {
            return view('dashboard.categories.edit', compact('category'));
        }
        else{
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if(Auth::user()->roles == 'admin')
        {
            $category->update($request->all());
            return redirect()->route('categories.index')->with('success', 'Category Berhasil di ubah!');
        }
        else{
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if(Auth::user()->roles == 'admin')
        {
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Category Berhasil di hapus!');
        }
        else{
            abort(403);
        }
    }
}
