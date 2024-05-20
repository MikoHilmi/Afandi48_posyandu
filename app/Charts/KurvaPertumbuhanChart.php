<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Imunisasi;
use Illuminate\Support\Facades\DB;

class KurvaPertumbuhanChart
{
    protected $chartWeight, $chartHeight, $rataRata;

    public function __construct(LarapexChart $chartWeight, LarapexChart $chartHeight, LarapexChart $rataRata)
    {
        $this->chartWeight = $chartWeight;
        $this->chartHeight = $chartHeight;
        $this->rataRata = $rataRata;
    }


    public function buildBeratBadanChart($idBalita): LarapexChart
    {
        $imunisasiData = Imunisasi::where('id_balita', $idBalita)->orderBy('tanggal_imunisasi')->get();

        $weights = $imunisasiData->pluck('berat_badan')->toArray();
        $dates = $imunisasiData->pluck('tanggal_imunisasi')->toArray();

        $months = array_map(function ($date) {
            return date('m', strtotime($date));
        }, $dates);


        return $this->chartWeight->areaChart()
            ->addData('Berat Badan', $weights)
            ->setXAxis($months)
            ->setHeight(300)
            ->setGrid()
            ->setColors(['#303F9F']);
    }

    public function buildTinggiBadanChart($idBalita): LarapexChart
    {
        $imunisasiData = Imunisasi::where('id_balita', $idBalita)->orderBy('tanggal_imunisasi')->get();

        $heights = $imunisasiData->pluck('tinggi_badan')->toArray();
        $dates = $imunisasiData->pluck('tanggal_imunisasi')->toArray();

        $months = array_map(function ($date) {
            return date('m', strtotime($date));
        }, $dates);


        return $this->chartHeight->areaChart()
            ->addData('Tinggi Badan', $heights)
            ->setXAxis($months)
            ->setHeight(300)
            ->setGrid()
            ->setColors(['#303F9F']);
    }

    public static function rataRata(): LarapexChart
    {
        $imunisasi = DB::table('imunisasis')
            ->selectRaw('DATE_FORMAT(tanggal_imunisasi, "%Y-%m") as bulan_tahun, AVG(berat_badan) as berat_badan, AVG(tinggi_badan) as tinggi_badan')
            ->groupBy('bulan_tahun')
            ->get();

        $heights = $imunisasi->pluck('tinggi_badan')->toArray();
        $weights = $imunisasi->pluck('berat_badan')->toArray();
        $monthsYears = $imunisasi->pluck('bulan_tahun')->toArray();

        $chart = new LarapexChart();

        $chart->setDataset([
            [
                'name' => 'Tinggi Badan',
                'data' => $heights,
            ],
            [
                'name' => 'Berat Badan',
                'data' => $weights,
            ],
        ]);

        $chart->setXAxis($monthsYears)
            ->setType('area')
            ->setHeight(350)
            ->setGrid();

        return $chart;
    }
}
