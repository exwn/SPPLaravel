<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Pelajar;
use App\Models\Spp;
use App\Models\Transaksi;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $spp = Spp::all();
        $user = User::where('role_id', 3)->get();
        $transaksi = Transaksi::orderBy('id', 'DESC')->paginate(100);
        return view('transaksi.admin.index', ['transaksi' => $transaksi, 'spp' => $spp, 'user' => $user])->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function pelajarIndex(Request $request)
    {
        $user = Auth::user();
        $transaksi = Transaksi::where('users_id', Auth::user()->id)->get();
        $kelas = Spp::where('id', Auth::user()->kelas_id)->get();
        $jurusan = Jurusan::where('id', Auth::user()->jurusan_id)->get('name');
        return view('transaksi.pelajar.index', [
            'transaksi' => $transaksi,
            'user' => $user,
            'kelas' => $kelas,
            'jurusan' => $jurusan
        ])->with('i', ($request->input('page', 1) - 1) * 5);
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
        $new_transaksi->users_id = $request->get('nama');
        $new_transaksi->spp_id = $request->get('kelas');
        $new_transaksi->bulan = $request->get('bulan');
        $new_transaksi->jumlah_dibayarkan = $request->get('jumlah_dibayarkan');
        $new_transaksi->tunggakan = $request->get('tagihanNumber') - $request->get('jumlah_dibayarkan');
        $user = User::all();
        if ($request->hasfile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = date('YmdHi') . $file->hashName();
            $file->move(public_path('bukti_pembayaran', $user), $filename);
            $new_transaksi->bukti_pembayaran = $filename;
        };
        $new_transaksi->save();
        return redirect()->route('transaksi.index')->with('toast_success', 'Transaksi succesfully created');
        // return dd($request->all());
    }
    public function pelajarStore(Request $request)
    {
        $new_transaksi = new Transaksi;
        $new_transaksi->users_id = $request->get('nama');
        $new_transaksi->spp_id = $request->get('kelas');
        $new_transaksi->bulan = $request->get('bulan');
        $new_transaksi->jumlah_dibayarkan = $request->get('jumlah_dibayarkan');
        $new_transaksi->tunggakan = $request->get('tagihanNumber') - $request->get('jumlah_dibayarkan');
        $user = User::all();
        if ($request->hasfile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = date('YmdHi') . $file->hashName();
            $file->move(public_path('bukti_pembayaran', $user), $filename);
            $new_transaksi->bukti_pembayaran = $filename;
        };
        $new_transaksi->save();
        return redirect()->route('transaksi.pelajar.index')->with('toast_success', 'Transaksi succesfully created');
        // return dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        return response()->json(
            $transaksi
        );
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

    public function print_pdf()
    {
        $spp = Spp::all();
        $user = User::where('role_id', 3)->get();
        $transaksi = Transaksi::all();
        $pdf = PDF::loadview('transaksi.admin.print_pdf', ['transaksi' => $transaksi, 'spp' => $spp, 'user' => $user])->setPaper('a4', 'landscape');
        return $pdf->download('laporan-transaksi.pdf');
        // return $pdf->stream();

        // $pdf = App::make('dompdf.wrapper');
        // $pdf->loadHTML('<h1>Test</h1>');
        // return $pdf->stream();
    }
    public function pelajar_pdf()
    {
        $user = Auth::user();
        // $spp = Spp::where('id', Auth::user()->kelas_id)->get();
        // $user = User::where('role_id', 3)->get();
        $transaksi = Transaksi::where('users_id', Auth::user()->id)->get();
        $pdf = PDF::loadview('transaksi.admin.print_pdf', ['transaksi' => $transaksi, 'user' => $user])->setPaper('a4', 'landscape');
        return $pdf->download('laporan-transaksi.pdf');
    }
}
