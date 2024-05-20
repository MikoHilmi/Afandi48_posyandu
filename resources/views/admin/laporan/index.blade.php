@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="pagetitle">
            <h1>Laporan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Laporan</li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="row mb-2 mt-2">
                    <div class="col-md-5">
                        <a href="laporan/download" target="_blank">
                            <button type="button" class="btn btn-success fw-bold"><i class="bi bi-printer"></i>
                                Export .xlsx</button>
                        </a>
                        <a href="laporan/word" target="_blank">
                            <button type="button" class="btn btn-primary fw-bold"><i class="bi bi-printer"></i>
                                Export .doc</button>
                        </a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body table-responsive">
                        <table class="table">
                            <tr>
                                <td style="text-align: center; font-size:30px">
                                    <b>REKAPITULASI PERTUMBUHAN BALITA</b>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <table border="1" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;"><b>NO</b>
                                    </th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;"><b>NAMA
                                            ANAK</b>
                                    </th>
                                    <th rowspan="2"
                                        style="text-align: center; writing-mode: vertical-rl; transform: rotate(180deg); vertical-align: middle;">
                                        <b>TGL LAHIR</b>
                                    </th>
                                    <th rowspan="2"
                                        style="text-align: center; writing-mode: vertical-rl; transform: rotate(180deg); vertical-align: middle;">
                                        <b>USIA (bln)</b>
                                    </th>
                                    <th colspan="2" style="text-align: center; vertical-align: middle;"><b>NAMA</b>
                                    </th>
                                    <th colspan="12" style="text-align: center; vertical-align: middle;"><b>HASIL
                                            PENIMBANGAN</b></th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">
                                        <b>KETERANGAN</b>
                                    </th>
                                </tr>
                                <tr>
                                    <th style="text-align: center; vertical-align: middle;"><b>AYAH</b>
                                    </th>
                                    <th style="text-align: center; vertical-align: middle;"><b>IBU</b>
                                    </th>
                                    <th
                                        style="text-align: center; writing-mode: vertical-rl; transform: rotate(180deg); vertical-align: middle;">
                                        <b>JANUARI</b>
                                    </th>
                                    <th
                                        style="text-align: center; writing-mode: vertical-rl; transform: rotate(180deg); vertical-align: middle;">
                                        <b>FEBRUARI</b>
                                    </th>
                                    <th
                                        style="text-align: center; writing-mode: vertical-rl; transform: rotate(180deg); vertical-align: middle;">
                                        <b>MARET</b>
                                    </th>
                                    <th
                                        style="text-align: center; writing-mode: vertical-rl; transform: rotate(180deg); vertical-align: middle;">
                                        <b>APRIL</b>
                                    </th>
                                    <th
                                        style="text-align: center; writing-mode: vertical-rl; transform: rotate(180deg); vertical-align: middle;">
                                        <b>MEI</b>
                                    </th>
                                    <th
                                        style="text-align: center; writing-mode: vertical-rl; transform: rotate(180deg); vertical-align: middle;">
                                        <b>JUNI</b>
                                    </th>
                                    <th
                                        style="text-align: center; writing-mode: vertical-rl; transform: rotate(180deg); vertical-align: middle;">
                                        <b>JULI</b>
                                    </th>
                                    <th
                                        style="text-align: center; writing-mode: vertical-rl; transform: rotate(180deg); vertical-align: middle;">
                                        <b>AGUSTUS</b>
                                    </th>
                                    <th
                                        style="text-align: center; writing-mode: vertical-rl; transform: rotate(180deg); vertical-align: middle;">
                                        <b>SEPTEMBER</b>
                                    </th>
                                    <th
                                        style="text-align: center; writing-mode: vertical-rl; transform: rotate(180deg); vertical-align: middle;">
                                        <b>OKTOBER</b>
                                    </th>
                                    <th
                                        style="text-align: center; writing-mode: vertical-rl; transform: rotate(180deg); vertical-align: middle;">
                                        <b>NOVEMBER</b>
                                    </th>
                                    <th
                                        style="text-align: center; writing-mode: vertical-rl; transform: rotate(180deg); vertical-align: middle;">
                                        <b>DESEMBER</b>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="2" style="text-align: center; vertical-align: middle;">1</th>
                                    <th style="text-align: center; vertical-align: middle;">2</th>
                                    <th style="text-align: center; vertical-align: middle;">3</th>
                                    <th style="text-align: center; vertical-align: middle;">4</th>
                                    <th style="text-align: center; vertical-align: middle;">5</th>
                                    <th style="text-align: center; vertical-align: middle;">6</th>
                                    <th style="text-align: center; vertical-align: middle;">7</th>
                                    <th style="text-align: center; vertical-align: middle;">8</th>
                                    <th style="text-align: center; vertical-align: middle;">9</th>
                                    <th style="text-align: center; vertical-align: middle;">10</th>
                                    <th style="text-align: center; vertical-align: middle;">11</th>
                                    <th style="text-align: center; vertical-align: middle;">12</th>
                                    <th style="text-align: center; vertical-align: middle;">13</th>
                                    <th style="text-align: center; vertical-align: middle;">14</th>
                                    <th style="text-align: center; vertical-align: middle;">15</th>
                                    <th style="text-align: center; vertical-align: middle;">16</th>
                                    <th style="text-align: center; vertical-align: middle;">17</th>
                                    <th style="text-align: center; vertical-align: middle;">18</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['rekapitulasi'] as $item)
                                    <tr>
                                        <td rowspan="2">{{ $loop->iteration }}</td>
                                        <td rowspan="2">{{ $item->nama_balita }}</td>
                                        <td rowspan="2">{{ $item->tanggal_lahir_balita }}</td>
                                        <td rowspan="2">{{ $item->getUsia() }}</td>
                                        <td rowspan="2">{{ $item->nama_ayah }}</td>
                                        <td rowspan="2">{{ $item->nama_ibu }}</td>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <!-- Iterasi untuk setiap bulan -->
                                            <td>
                                                @php
                                                    $tanggal_imunisasi = explode(',', $item->tanggal_imunisasi);
                                                    $berat_badan = explode(',', $item->berat_badan);
                                                    $catatan = explode(',', $item->catatan);
                                                    $found = false;
                                                    // Iterasi melalui semua tanggal imunisasi
                                                    foreach ($tanggal_imunisasi as $key => $tanggal) {
                                                        // Periksa apakah bulan pada tanggal ini sesuai dengan bulan yang sedang diiterasi
                                                        if (date('n', strtotime($tanggal)) == $i) {
                                                            // Jika sesuai, tampilkan berat badan dan catatan
                                                            echo $berat_badan[$key] . ' Kg';
                                                            $found = true;
                                                            break;
                                                        }
                                                    }
                                                    // Jika tidak ada data imunisasi pada bulan ini, tampilkan pesan kosong
                                                    if (!$found) {
                                                        echo '';
                                                    }
                                                @endphp
                                            </td>
                                        @endfor
                                        <td rowspan="2">{{ $item->catatan_terakhir }}</td>
                                    </tr>
                                    <tr>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <!-- Iterasi untuk setiap bulan -->
                                            <td>
                                                @php
                                                    $tanggal_imunisasi = explode(',', $item->tanggal_imunisasi);
                                                    $tinggi_badan = explode(',', $item->tinggi_badan);
                                                    $catatan = explode(',', $item->catatan);
                                                    $found = false;
                                                    // Iterasi melalui semua tanggal imunisasi
                                                    foreach ($tanggal_imunisasi as $key => $tanggal) {
                                                        // Periksa apakah bulan pada tanggal ini sesuai dengan bulan yang sedang diiterasi
                                                        if (date('n', strtotime($tanggal)) == $i) {
                                                            // Jika sesuai, tampilkan berat badan dan catatan
                                                            echo $tinggi_badan[$key] . ' Cm';
                                                            $found = true;
                                                            break;
                                                        }
                                                    }
                                                    // Jika tidak ada data imunisasi pada bulan ini, tampilkan pesan kosong
                                                    if (!$found) {
                                                        echo '';
                                                    }
                                                @endphp
                                            </td>
                                        @endfor
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="19" style="text-align: right; vertical-align: middle; padding-top: 25px">
                                        Sidoarjo, ...... .............. 20
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        (
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        )
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script></script>
@endsection
