<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jurusan = Jurusan::orderBy('id', 'ASC')->get();
        return view('jurusan.index', compact('jurusan'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jurusan.form');
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
            'name' => 'required|unique:jurusan|max:255'
        ]);

        $new_jurusan = new jurusan;

        $new_jurusan->name = $request->get('name');
        $new_jurusan->save();
        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Jurusan $jurusan)
    {
        return view('jurusan.form', [
            'jurusan' => $jurusan
        ]);
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
        $request->validate([
            'name' => 'required|unique:jurusan|max:255'
        ]);

        $update_jurusan = Jurusan::findOrFail($id);
        $update_jurusan->name = $request->get('name');
        $update_jurusan->save();
        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jurusan_destroy = Jurusan::findOrFail($id);
        $jurusan_destroy->delete();
        return redirect()->route('jurusan.index')->with('success', 'Jurusan successfully delete');
    }
}
