<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Role;
use App\Models\Spp;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $role = Role::all();
        $kelas = Spp::all();
        $jurusan = Jurusan::all();
        $users = User::whereIn('role_id', [1, 2])->orderBy('id', 'ASC')->get();
        return view('users.index', ['users' => $users, 'role' => $role, 'kelas' => $kelas, 'jurusan' => $jurusan])->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::all();
        return view('users.form', ['role' => $role]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:users,name',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'no_telp' => 'unique:users',
            // 'role' => 'required|in:1,2,3'
        ]);

        $new_user = new User;
        $new_user->name = $request->get('name');
        $new_user->email = $request->get('email');
        $new_user->password = Hash::make($request->get('password'));
        $new_user->role_id = $request->get('role');
        $new_user->no_telp = $request->get('no_telp');

        $new_user->save();
        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $role = Role::all();
        return view('users.form', ['user' => $user, 'role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255|unique:users,name,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
            'no_telp' => 'unique:users,no_telp,' . $user->id,
            // 'role' => 'required|in:1,2,3'
        ]);

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if ($request->password != null) {
            $user->password = Hash::make($request->get('password'));
        } else {
            $user->password = $request->except('password');
        };
        $user->no_telp = $request->get('no_telp');
        $user->role_id = $request->get('role');

        $user->save();
        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_destroy = User::findOrFail($id);
        $user_destroy->delete();
        return redirect()->route('user.index')
            ->with('success', 'User berhasil dihapus');
    }
}
