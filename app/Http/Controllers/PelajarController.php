<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Pelajar;
use App\Models\Spp;
use Illuminate\Http\Request;

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
        $pelajar = Pelajar::orderBy('id', 'DESC')->paginate(100);
        return view('pelajar.index', compact('pelajar'), ['jurusan' => $jurusan], ['spp' => $spp])->with('i', ($request->input('page', 1) - 1) * 5);
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
        $new_pelajar = new Pelajar;
        $new_pelajar->name = $request->get('name');
        $new_pelajar->no_telp = $request->get('no_telp');
        $new_pelajar->jurusan_id = $request->get('jurusan');
        $new_pelajar->kelas_id = $request->get('kelas');
        $new_pelajar->save();
        return redirect()->route('pelajar.index')->with('toast_success', 'Pelajar succesfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pelajar  $pelajar
     * @return \Illuminate\Http\Response
     */
    public function show(pelajar $pelajar)
    {
        return response()->json(
            $pelajar
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pelajar  $pelajar
     * @return \Illuminate\Http\Response
     */
    public function edit(pelajar $pelajar)
    {
        $spp = Spp::all();
        $jurusan = Jurusan::all();
        return view('pelajar.form', ['pelajar' => $pelajar, 'spp' => $spp, 'jurusan' => $jurusan]);
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
        $pelajar = Pelajar::findOrFail($id);

        $pelajar->name = $request->get('name');
        $pelajar->no_telp = $request->get('no_telp');
        $pelajar->is_active = $request->get('is_active');
        $pelajar->jurusan_id = $request->get('jurusan');
        $pelajar->kelas_id = $request->get('kelas');

        $pelajar->save();
        return redirect()->route('pelajar.index')->with('toast_success', 'Pelajar succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($pelajar)
    {
        Pelajar::find($pelajar)->delete();
        return redirect()->route('pelajar.index')
            ->with('toast_success', 'Pelajar deleted successfully');
    }
}
