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
        $transaksi = Transaksi::orderBy('id', 'DESC')->get();
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
        $request->validate([
            // 'name' => 'required',
            'jumlah_dibayarkan' => 'required',
            'bukti_pembayaran' => 'required|mimes:jpg,png,jpeg|max:2048',
        ]);

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
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan');
    }
    public function pelajarStore(Request $request)
    {
        $request->validate([
            'jumlah_dibayarkan' => 'required',
            'bukti_pembayaran' => 'required|mimes:jpg,png,jpeg|max:2048',
        ]);

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
        return redirect()->route('transaksi.pelajar.index')->with('success', 'Terimakasih telah membayar SPP');
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
        $request->validate([
            'lunas' => 'required',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status = $request->get('lunas');
        $transaksi->keterangan = $request->get('keterangan');
        $transaksi->save();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui');
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
            ->with('success', 'Transaksi berhasil dihapus');
    }

    public function print_pdf()
    {
        $spp = Spp::all();
        $user = User::where('role_id', 3)->get();
        $transaksi = Transaksi::all();
        $pdf = PDF::loadview('transaksi.admin.print_pdf', ['transaksi' => $transaksi, 'spp' => $spp, 'user' => $user])->setPaper('a4', 'landscape');
        return $pdf->download('laporan-transaksi.pdf');
    }
    public function pelajar_pdf()
    {
        $user = Auth::user();
        $transaksi = Transaksi::where('users_id', Auth::user()->id)->get();
        $pdf = PDF::loadview('transaksi.admin.print_pdf', ['transaksi' => $transaksi, 'user' => $user])->setPaper('a4', 'landscape');
        return $pdf->download('laporan-transaksi.pdf');
    }
}
