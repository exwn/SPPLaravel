<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use Illuminate\Http\Request;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        $spp = Spp::orderBy('id', 'ASC')->get();
        return view('spp.index', compact('spp'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('spp.form');
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
            'tahun_ajaran' => 'required',
            'kelas' => 'required',
            'total_tagihan' => 'required',
        ]);

        $new_spp = new Spp;
        $new_spp->tahun_ajaran = $request->get('tahun_ajaran');
        $new_spp->kelas = $request->get('kelas');
        $new_spp->total_tagihan = $request->get('total_tagihan');

        $new_spp->save();
        return redirect()->route('spp.index')->with('success', 'SPP berhasil ditambahkan');
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
    public function edit(spp $spp)
    {
        return view('spp.form', ['spp' => $spp]);
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
        $spp = Spp::findOrFail($id);

        $request->validate([
            'tahun_ajaran' => 'required',
            'kelas' => 'required',
            'total_tagihan' => 'required',
        ]);

        $spp->tahun_ajaran = $request->get('tahun_ajaran');
        $spp->kelas = $request->get('kelas');
        $spp->total_tagihan = $request->get('total_tagihan');
        $spp->save();
        return redirect()->route('spp.index')->with('success', 'SPP berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $spp_destroy = Spp::findOrFail($id);
        $spp_destroy->delete();
        return redirect()->route('spp.index')->with('success', 'SPP berhasil dihapus');
    }
}
