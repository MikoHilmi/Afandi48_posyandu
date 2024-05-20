<table>
    <thead>
        <tr>
            <th>Nama Balita</th>
            <th>Tanggal Imunisasi</th>
            <th>Berat Badan</th>
            <th>Tinggi Badan</th>
            <th>Catatan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->nama_balita }}</td>
                <td>{{ $item->tanggal_imunisasi }}</td>
                <td>{{ $item->berat_badan }}</td>
                <td>{{ $item->tinggi_badan }}</td>
                <td>{{ $item->catatan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="card">
    <div class="card-body table-responsive">
        @for ($i = 0; $i < 5; $i++)
            @php
                $lowerAge = $i * 12;
                $upperAge = ($i + 1) * 12 - 1;
            @endphp
            <table class="table">
                <tr>
                    <td style="text-align: center; font-size:30px">
                        <b>REKAPITULASI PENIMBANGAN BAYI (UMUR {{ $lowerAge }} - {{ $upperAge }} BULAN)</b>
                    </td>
                </tr>
            </table>
            <br>
            <table border="1" class="table table-bordered">
                <thead>
                    <tr>
                        <th rowspan="3" style="text-align: center; vertical-align: middle;"><b>NO</b>
                        </th>
                        <th rowspan="3" style="text-align: center; vertical-align: middle;"><b>NAMA ANAK</b>
                        </th>
                        <th rowspan="3"
                            style="text-align: center; writing-mode: vertical-rl; transform: rotate(180deg); vertical-align: middle;">
                            <b>TGL LAHIR</b>
                        </th>
                        <th rowspan="3"
                            style="text-align: center; writing-mode: vertical-rl; transform: rotate(180deg); vertical-align: middle;">
                            <b>BB (gr)</b>
                        </th>
                        <th colspan="2" style="text-align: center; vertical-align: middle;"><b>NAMA</b></th>
                        <th colspan="2" style="text-align: center; vertical-align: middle;"><b>Pertama Kali
                                <br> Ditimbang</b></th>
                        <th colspan="12" style="text-align: center; vertical-align: middle;"><b>HASIL
                                PENIMBANGAN</b></th>
                        <th colspan="4" style="text-align: center; vertical-align: middle;"><b>PELAYANAN
                                <br> YANG DIBERIKAN</b></th>
                        <th colspan="11" style="text-align: center; vertical-align: middle;"><b>PEMBERIAN
                                IMUNISASI</b>
                        </th>
                        <th rowspan="3" style="text-align: center; vertical-align: middle;"><b>KETERANGAN</b>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;"><b>AYAH</b></th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;"><b>IBU</b></th>
                        <th rowspan="2"
                            style="text-align: center; writing-mode: vertical-rl; transform: rotate(180deg); vertical-align: middle;">
                            <b>Umur Anak (bln)</b>
                        </th>
                        <th rowspan="2"
                            style="text-align: center; writing-mode: vertical-rl; transform: rotate(180deg); vertical-align: middle;">
                            <b>BB (kg)</b>
                        </th>
                        <th rowspan="2"
                            style="text-align: center; writing-mode: vertical-rl; transform: rotate(180deg); vertical-align: middle;">
                            <b>JANUARI</b>
                        </th>
                        <th rowspan="2"
                            style="text-align: center; writing-mode: vertical-rl; transform: rotate(180deg); vertical-align: middle;">
                            <b>FEBRUARI</b>
                        </th>
                        <th rowspan="2"
                            style="text-align: center; writing-mode: vertical-rl; transform: rotate(180deg); vertical-align: middle;">
                            <b>MARET</b>
                        </th>
                        <th rowspan="2"
                            style="text-align: center; writing-mode: vertical-rl; transform: rotate(180deg); vertical-align: middle;">
                            <b>APRIL</b>
                        </th>
                        <th rowspan="2"
                            style="text-align: center; writing-mode: vertical-rl; transform: rotate(180deg); vertical-align: middle;">
                            <b>MEI</b>
                        </th>
                        <th rowspan="2"
                            style="text-align: center; writing-mode: vertical-rl; transform: rotate(180deg); vertical-align: middle;">
                            <b>JUNI</b>
                        </th>
                        <th rowspan="2"
                            style="text-align: center; writing-mode: vertical-rl; transform: rotate(180deg); vertical-align: middle;">
                            <b>JULI</b>
                        </th>
                        <th rowspan="2"
                            style="text-align: center; writing-mode: vertical-rl; transform: rotate(180deg); vertical-align: middle;">
                            <b>AGUSTUS</b>
                        </th>
                        <th rowspan="2"
                            style="text-align: center; writing-mode: vertical-rl; transform: rotate(180deg); vertical-align: middle;">
                            <b>SEPTEMBER</b>
                        </th>
                        <th rowspan="2"
                            style="text-align: center; writing-mode: vertical-rl; transform: rotate(180deg); vertical-align: middle;">
                            <b>OKTOBER</b>
                        </th>
                        <th rowspan="2"
                            style="text-align: center; writing-mode: vertical-rl; transform: rotate(180deg); vertical-align: middle;">
                            <b>NOVEMBER</b>
                        </th>
                        <th rowspan="2"
                            style="text-align: center; writing-mode: vertical-rl; transform: rotate(180deg); vertical-align: middle;">
                            <b>DESEMBER</b>
                        </th>
                        <th colspan="2" style="text-align: center; vertical-align: middle;">
                            <b>SIRUP <br> BESI</b>
                        </th>
                        <th colspan="2" style="text-align: center; vertical-align: middle;">
                            <b>VIT. A</b>
                        </th>
                        <th rowspan="2"
                            style="text-align: center; vertical-align: middle; writing-mode: vertical-rl; transform: rotate(180deg);">
                            <b>HB 0</b>
                        </th>
                        <th rowspan="2"
                            style="text-align: center; vertical-align: middle; writing-mode: vertical-rl; transform: rotate(180deg);">
                            <b>BCG</b>
                        </th>
                        <th colspan="3" style="text-align: center; vertical-align: middle;">
                            <b>DPT, HB, Hib</b>
                        </th>
                        <th colspan="4" style="text-align: center; vertical-align: middle; ">
                            <b>POLIO</b>
                        </th>
                        <th rowspan="2"
                            style="text-align: center; vertical-align: middle; writing-mode: vertical-rl; transform: rotate(180deg);">
                            <b>IPV</b>
                        </th>
                        <th rowspan="2"
                            style="text-align: center; vertical-align: middle; writing-mode: vertical-rl; transform: rotate(180deg);">
                            <b>MR</b>
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align: center; vertical-align: middle;">Fe 1 <br> BLN</th>
                        <th style="text-align: center; vertical-align: middle;">Fe 1 <br> BLN</th>
                        <th style="text-align: center; vertical-align: middle;">A1 <br> BLN</th>
                        <th style="text-align: center; vertical-align: middle;">A2 <br> BLN</th>
                        <th style="text-align: center; vertical-align: middle;">1</th>
                        <th style="text-align: center; vertical-align: middle;">2</th>
                        <th style="text-align: center; vertical-align: middle;">3</th>
                        <th style="text-align: center; vertical-align: middle;">1</th>
                        <th style="text-align: center; vertical-align: middle;">2</th>
                        <th style="text-align: center; vertical-align: middle;">3</th>
                        <th style="text-align: center; vertical-align: middle;">4</th>
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
                        <th style="text-align: center; vertical-align: middle;">19</th>
                        <th style="text-align: center; vertical-align: middle;">20</th>
                        <th style="text-align: center; vertical-align: middle;">21</th>
                        <th style="text-align: center; vertical-align: middle;">22</th>
                        <th style="text-align: center; vertical-align: middle;">23</th>
                        <th style="text-align: center; vertical-align: middle;">24</th>
                        <th style="text-align: center; vertical-align: middle;">25</th>
                        <th style="text-align: center; vertical-align: middle;">26</th>
                        <th style="text-align: center; vertical-align: middle;">27</th>
                        <th style="text-align: center; vertical-align: middle;">28</th>
                        <th style="text-align: center; vertical-align: middle;">29</th>
                        <th style="text-align: center; vertical-align: middle;">30</th>
                        <th style="text-align: center; vertical-align: middle;">31</th>
                        <th style="text-align: center; vertical-align: middle;">32</th>
                        <th style="text-align: center; vertical-align: middle;">33</th>
                        <th style="text-align: center; vertical-align: middle;">34</th>
                        <th style="text-align: center; vertical-align: middle;">35</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['rekapitulasi'] as $item)
                        @php
                            $usia_bulan = $item->usia_bulan;
                        @endphp
                        @if ($usia_bulan >= $lowerAge && $usia_bulan <= $upperAge)
                            <tr>
                                <td rowspan="2">{{ $loop->iteration }}</td>
                                <td rowspan="2">{{ $item->nama_balita }}</td>
                                <td rowspan="2">{{ $item->tanggal_lahir_balita }}</td>
                                <td rowspan="2"></td>
                                <td rowspan="2">{{ $item->nama_ayah }}</td>
                                <td rowspan="2">{{ $item->nama_ibu }}</td>
                                <td rowspan="2">{{ $item->getUsia() }}</td>
                                <td rowspan="2"></td>
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
                                                    echo $berat_badan[$key];
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
                                <td rowspan="2"></td>
                                <td rowspan="2"></td>
                                <td rowspan="2"></td>
                                <td rowspan="2"></td>
                                <td rowspan="2"></td>
                                <td rowspan="2"></td>
                                <td rowspan="2"></td>
                                <td rowspan="2"></td>
                                <td rowspan="2"></td>
                                <td rowspan="2"></td>
                                <td rowspan="2"></td>
                                <td rowspan="2"></td>
                                <td rowspan="2"></td>
                                <td rowspan="2"></td>
                                <td rowspan="2"></td>
                                <td rowspan="2"></td>
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
                                                    echo $tinggi_badan[$key];
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
                        @endif
                    @endforeach
                </tbody>
            </table>
        @endfor
    </div>
</div>
