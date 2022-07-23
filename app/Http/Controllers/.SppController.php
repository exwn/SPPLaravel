<?php

namespace App\Http\Controllers;

use App\Models\Pelajar;
use App\Models\Spp;

use Illuminate\Http\Request;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pelajar = Pelajar::all();
        return view('spp.index', ['pelajar' => $pelajar]);

        // $spp = Spp::orderBy('id', 'DESC')->paginate();
        // return view('spp.index', compact('spp'))->with('i', ($request->input('page', 1) - 1) * 5);
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
        $new_spp = new Spp;
        $new_spp->name = $request->get('name');
        $new_spp->jumlah = $request->get('jumlah');
        $new_spp->save();
        return redirect()->route('spp.index')->with('toast_success', 'Spp successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function show(Spp $spp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function edit(Spp $spp)
    {
        $jumlah = Spp::pluck('jumlah')->all();
        return view('spp.form', [
            'spp' => $spp, 'jumlah' => $jumlah
        ]);



        return view('spp.form', [
            'spp' => $spp
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update_spp = Spp::findOrFail($id);
        $update_spp->name = $request->get('name');
        $update_spp->jumlah = $request->get('jumlah');
        $update_spp->save();
        return redirect()->route('spp.index')->with('toast_success', 'Spp successfully update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $spp_destroy = Spp::findOrFail($id);
        $spp_destroy->delete();
        return redirect()->route('spp.index')->with('toast_success', 'Spp successfully delete');
    }
}
