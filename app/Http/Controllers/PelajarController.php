<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Spp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PelajarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $spp = Spp::all();
        $jurusan = Jurusan::all();
        $pelajar = User::where('role_id', 3)->orderBy('id', 'DESC')->get();
        return view('pelajar.index', ['pelajar' => $pelajar, 'jurusan' => $jurusan, 'spp' => $spp])->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $spp = Spp::all();
        $jurusan = Jurusan::all();
        return view('pelajar.form', ['jurusan' => $jurusan], ['spp' => $spp]);
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
        ]);

        $new_pelajar = new User;
        $new_pelajar->name = $request->get('name');
        $new_pelajar->email = $request->get('email');
        $new_pelajar->password = Hash::make($request->get('password'));
        $new_pelajar->no_telp = $request->get('no_telp');
        $new_pelajar->role_id = 3;
        $new_pelajar->kelas_id = $request->get('kelas');
        $new_pelajar->jurusan_id = $request->get('jurusan');
        $new_pelajar->save();
        return redirect()->route('pelajar.index')->with('success', 'Pelajar berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pelajar  $pelajar
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
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $spp = Spp::all();
        $jurusan = Jurusan::all();
        return view('pelajar.form', ['user' => $user, 'spp' => $spp, 'jurusan' => $jurusan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pelajar = User::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255|unique:users,name,' . $pelajar->id,
            'email' => 'required|email|unique:users,email,' . $pelajar->id,
            'password' => 'nullable|min:8',
            'no_telp' => 'unique:users,no_telp,' . $pelajar->id,
        ]);

        $pelajar->name = $request->get('name');
        $pelajar->email = $request->get('email');
        if ($request->password != null) {
            $pelajar->password = Hash::make($request->get('password'));
        } else {
            $pelajar->password = $request->except('password');
        };
        $pelajar->no_telp = $request->get('no_telp');
        $pelajar->kelas_id = $request->get('kelas');
        $pelajar->jurusan_id = $request->get('jurusan');
        $pelajar->is_active = $request->get('is_active');

        $pelajar->save();
        return redirect()->route('pelajar.index')->with('success', 'Pelajar berhasil diperbarui');
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
        return redirect()->route('pelajar.index')
            ->with('success', 'Pelajar berhasil dihapus');
    }
}
