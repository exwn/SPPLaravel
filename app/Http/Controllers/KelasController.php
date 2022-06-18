<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Periode;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kelas = Kelas::orderBy('id', 'DESC')->paginate(100);
        return view('kelas.index', compact('kelas'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $periode = Periode::all();
        // return view('kelas.form', ['periode' => $periode]);
        return view('kelas.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $new_kelas = new Kelas;

        $new_kelas->name = $request->get('name');
        // $new_kelas->periode_id = $request->get('periode');

        $new_kelas->save();
        return redirect()->route('kelas.index')->with('toast_success', 'Kelas successfully created');
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
    public function edit(Kelas $kelas)
    {
        // $periode = Periode::all();
        // return view('kelas.form', [
        //     'periode' => $periode, 'kelas' => $kelas
        // ]);
        return view('kelas.form', [
            'kelas' => $kelas
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
        $update_kelas = Kelas::findOrFail($id);
        $update_kelas->name = $request->get('name');
        // $update_kelas->periode_id = $request->get('periode');

        $update_kelas->save();
        return redirect()->route('kelas.index')->with('toast_success', 'Kelas successfully update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas_destroy = Kelas::findOrFail($id);
        $kelas_destroy->delete();
        return redirect()->route('kelas.index')->with('toast_success', 'Kelas successfully delete');
    }
}
