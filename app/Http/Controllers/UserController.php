<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
            $users = User::paginate(10);
            return view('dashboard.users.index', compact('users'));
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
            return view('dashboard.users.create');
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
            $input['password'] = Hash::make($request->password);
            $user = User::create($input);
            $user->save();
            return redirect()->route('users.index')->with('success', 'Users Berhasil di tambahkan!');
        }
        else{
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if(Auth::user()->roles == 'admin')
        {
            return view('dashboard.users.show', compact('user'));
        }
        else{
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Auth::user()->roles == 'admin')
        {
            return view('dashboard.users.edit', compact('user'));
        }
        else{
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if(Auth::user()->roles == 'admin')
        {
            $input = $request->all();
            $input['password'] = Hash::make($request->password);
            $user->update($input);
            return redirect()->route('users.index')->with('success', 'Users Berhasil di ubah!');
        }
        else{
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(Auth::user()->roles == 'admin')
        {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'Users Berhasil di hapus!');
        }
        else{
            abort(403);
        }
    }
}
