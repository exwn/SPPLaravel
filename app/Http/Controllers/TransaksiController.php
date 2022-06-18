<?php

namespace App\Http\Controllers;

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
        $transaksi = Transaksi::orderBy('id', 'DESC')->paginate(5);
        return view('transaksi.index', compact('transaksi'))->with('i', ($request->input('page', 1) - 1) * 5);
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
        // $new_transaksi->name = $request->get('name');
        $new_transaksi->jumlah = $request->get('jumlah');
        $new_transaksi->save();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi succesfully created');
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
        // $jumlah = Transaksi::pluck('jumlah')->all();
        // return view('transaksi.form', ['transaksi' => $transaksi, 'jumlah' => $jumlah]);
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
