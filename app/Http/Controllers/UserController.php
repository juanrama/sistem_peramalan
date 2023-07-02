<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.data', [
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create', ['user' => User::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request -> validate([
            'name' => 'required',
            'username' => 'required|min:4|max:8|unique:users',
            'email' => 'required|email',
            'role' => 'required',
            'password' => 'required|min:6|max:8'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/database/user')->with('success', 'Post baru telah ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($username)
    {
        $user= User::where('username', $username) -> first();
        $roles = User::distinct('role')->pluck('role');
        return view('user.edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rule = [
            'name' => '',
            'email' => '',
            'role' => 'required',
        ];

        $validatedData = $request->validate($rule);

        User::where('id', $id) ->update($validatedData);
        return redirect('/database/user')->with('ubah', 'Data mahasiswa berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    $user = User::findOrFail($id);
    $user->delete();

    return redirect('/database/user')->with('hapus', 'Data mahasiswa berhasil dihapus');
    }
}
