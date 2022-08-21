<?php

namespace App\Charts;

use App\Models\Jurusan;
use App\Models\Transaksi;
use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class TransaksiChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {

        $jurusan = Jurusan::get()->pluck('name')->toArray();

        $kelas10_perawat = User::where('kelas_id', 1)->Where('jurusan_id', 1)->count();
        $kelas10_farmasi = User::where('kelas_id', 1)->Where('jurusan_id', 2)->count();
        $kelas10_ots = User::where('kelas_id', 1)->Where('jurusan_id', 3)->count();
        $kelas10_tkj = User::where('kelas_id', 1)->Where('jurusan_id', 4)->count();

        $kelas11_perawat = User::where('kelas_id', 2)->Where('jurusan_id', 1)->count();
        $kelas11_farmasi = User::where('kelas_id', 2)->Where('jurusan_id', 2)->count();
        $kelas11_ots = User::where('kelas_id', 2)->Where('jurusan_id', 3)->count();
        $kelas11_tkj = User::where('kelas_id', 2)->Where('jurusan_id', 4)->count();

        $kelas12_perawat = User::where('kelas_id', 3)->Where('jurusan_id', 1)->count();
        $kelas12_farmasi = User::where('kelas_id', 3)->Where('jurusan_id', 2)->count();
        $kelas12_ots = User::where('kelas_id', 3)->Where('jurusan_id', 3)->count();
        $kelas12_tkj = User::where('kelas_id', 3)->Where('jurusan_id', 4)->count();

        return $this->chart->barChart()
            ->setTitle('Jumlah pelajar berdasarkan kelas dan jurusan.')
            // ->setSubtitle('Wins during season 2021.')
            ->addData('Kelas 10', [$kelas10_perawat, $kelas10_farmasi, $kelas10_ots, $kelas10_tkj])
            ->addData('Kelas 11', [$kelas11_perawat, $kelas11_farmasi, $kelas11_ots, $kelas11_tkj])
            ->addData('Kelas 12', [$kelas12_perawat, $kelas12_farmasi, $kelas12_ots, $kelas12_tkj])
            ->setXAxis($jurusan);
    }
}
