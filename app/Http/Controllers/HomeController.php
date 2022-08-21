<?php

namespace App\Http\Controllers;

use App\Charts\TransaksiChart;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(TransaksiChart $chart)
    {
        // $jurusan = Jurusan::get('name');
        $lunas = Transaksi::where('status', 1)->count();
        $total_uang = Transaksi::sum('jumlah_dibayarkan');
        $transaksi = Transaksi::count();
        $pelajar = User::where('role_id', 3)->count();
        return view('dashboard', [
            'chart' => $chart->build(),
            'pelajar' => $pelajar,
            'transaksi' => $transaksi,
            'total_uang' => $total_uang,
            'lunas' => $lunas,
            // 'jurusan' => $jurusan
        ]);
    }
}
