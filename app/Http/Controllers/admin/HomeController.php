<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Charts\KurvaPertumbuhanChart;
use App\Charts\stokChart;
use App\Models\Balita;
use App\Models\Kader;

class HomeController extends Controller
{
    protected $rataRata, $stokVaksin, $stokVitamin;

    public function __construct(KurvaPertumbuhanChart $rataRata, stokChart $stokVaksin, stokChart $stokVitamin)
    {
        $this->rataRata = $rataRata;
        $this->stokVaksin = $stokVaksin;
        $this->stokVitamin = $stokVitamin;
    }

    public function index()
    {
        $male = Balita::jenisKelamin('Laki-laki');
        $female = Balita::jenisKelamin('Perempuan');
        $kader = Kader::all()->count();
        $rataRata = $this->rataRata->rataRata();
        $stokVaksin = $this->stokVaksin->stokVaksin();
        $stokVitamin = $this->stokVitamin->stokVitamin();

        return view('admin.dashboard', compact('male', 'female', 'kader', 'rataRata', 'stokVaksin', 'stokVitamin'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
