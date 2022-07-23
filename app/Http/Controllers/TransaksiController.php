<?php

namespace App\Http\Controllers;

use App\Models\Pelajar;
use App\Models\Spp;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pelajar = Pelajar::all();
        $spp = Spp::all();
        $transaksi = Transaksi::orderBy('id', 'DESC')->paginate(10);
        return view('transaksi.index', compact('transaksi'), ['pelajar' => $pelajar, 'spp' => $spp])->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transaksi.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_transaksi = new Transaksi;
        $new_transaksi->pelajar_id = $request->get('nama');
        $new_transaksi->spp_id = $request->get('kelas');
        $new_transaksi->bulan = $request->get('bulan');
        $new_transaksi->jumlah_dibayarkan = $request->get('jumlah_dibayarkan');
        $new_transaksi->save();
        return redirect()->route('transaksi.index')->with('toast_success', 'Transaksi succesfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        return view('transaksi.form', ['transaksi' => $transaksi]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->jumlah = $request->get('jumlah');
        $transaksi->save();
        return redirect()->route('transaksi.index')->with('toast_success', 'Transaksi succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksi_destroy = Transaksi::findOrFail($id);
        $transaksi_destroy->delete();
        return redirect()->route('transaksi.index')
            ->with('toast_success', 'Transaksi deleted successfully');
    }
}
