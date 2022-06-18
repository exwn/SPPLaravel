<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $periode = Periode::orderBy('id', 'ASC')->paginate(100);
        return view('periode.index', compact('periode'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('periode.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_periode = new Periode;
        $new_periode->name = $request->get('name');
        $new_periode->tanggal_mulai = $request->get('tanggal_mulai');
        $new_periode->tanggal_akhir = $request->get('tanggal_akhir');

        $new_periode->save();
        return redirect()->route('periode.index')->with('success', 'Periode successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function show(Periode $periode)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function edit(Periode $periode)
    {
        return view('periode.form', ['periode' => $periode]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update_periode = Periode::findOrFail($id);
        $update_periode->name = $request->get('name');
        $update_periode->tanggal_mulai = $request->get('tanggal_mulai');
        $update_periode->tanggal_akhir = $request->get('tanggal_akhir');
        $update_periode->save();
        return redirect()->route('periode.index')->with('toast_success', 'Periode successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Periode $periode)
    {
        //
    }
}
