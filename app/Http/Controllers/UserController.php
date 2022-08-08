<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Role;
use App\Models\Spp;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

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
        $users = User::whereIn('role_id', [1, 2])->orderBy('id', 'DESC')->paginate(10);
        return view('users.index', ['users' => $users, 'role' => $role, 'kelas' => $kelas, 'jurusan' => $jurusan]);

        // var_dump($model->name);
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
        $new_user = new User;

        $new_user->name = $request->get('name');
        $new_user->email = $request->get('email');
        $new_user->password = Hash::make($request->get('password'));
        $new_user->role_id = $request->get('role');
        $new_user->no_telp = $request->get('no_telp');

        $new_user->save();
        return redirect()->route('user.index')->with('toast_success', 'User successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        return response()->json(
            $user
        );
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

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        // $user->password = \Hash::make($request->get('password'));
        $user->no_telp = $request->get('no_telp');
        $user->role_id = $request->get('role');

        $user->save();
        return redirect()->route('user.index')->with('toast_success', 'User succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        User::find($user)->delete();
        return redirect()->route('user.index')
            ->with('toast_success', 'User deleted successfully');
    }
}
