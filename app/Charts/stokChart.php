<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use ArielMejiaDev\LarapexCharts\PieChart;
use Illuminate\Support\Facades\DB;
use App\Models\Vaksin;
use App\Models\Vitamin;

class stokChart
{
    protected $stokVaksin, $stokVitamin;

    public function __construct(LarapexChart $stokVaksin, LarapexChart $stokVitamin)
    {
        $this->stokVaksin = $stokVaksin;
        $this->stokVitamin = $stokVitamin;
    }

    public function stokVaksin(): LarapexChart
    {
        $vaksins = Vaksin::get();
        $chart = new PieChart();
        $data = [];
        $labels = [];

        foreach ($vaksins as $vaksin) {
            $totalMasuk = $vaksin->masuk->sum('jumlah_masuk');
            $totalKeluar = $vaksin->keluar->sum('jumlah_keluar');
            $stokVaksin = $totalMasuk - $totalKeluar;
            $data[] = $stokVaksin;
            $labels[] = $vaksin->nama_vaksin;
        }
        $chart->addData($data)
        ->setLabels($labels)
        ->setType('donut');

        return $chart;
    }

    public function stokVitamin(): LarapexChart
    {
        $vitamins = Vitamin::get();
        $chart = new PieChart();
        $data = [];
        $labels = [];

        foreach ($vitamins as $vitamin) {
            $totalMasuk = $vitamin->masuk->sum('jumlah_masuk');
            $totalKeluar = $vitamin->keluar->sum('jumlah_keluar');
            $stokVitamin = $totalMasuk - $totalKeluar;
            $data[] = $stokVitamin;
            $labels[] = $vitamin->nama_vitamin;
        }
        $chart->addData($data)
        ->setLabels($labels)
        ->setType('donut');

        return $chart;
    }
}
