<!DOCTYPE html>
<html lang="en">

<body>
    <table class="table">
        <tr>
            <td style="font-size:30px">
                <b>REKAPITULASI PERTUMBUHAN BALITA</b>
            </td>
        </tr>
    </table>
    <br>
    <table style="border: 1px">
        <thead>
            <tr>
                <th rowspan="2" style="text-align: center;"><b>NO</b>
                </th>
                <th rowspan="2" style="text-align: center;"><b>NAMA
                        ANAK</b>
                </th>
                <th rowspan="2" style="text-align: center;">
                    <b>TGL LAHIR</b>
                </th>
                <th rowspan="2" style="text-align: center;">
                    <b>USIA (bln)</b>
                </th>
                <th colspan="2" style="text-align: center;"><b>NAMA</b>
                </th>
                <th colspan="12" style="text-align: center;"><b>HASIL
                        PENIMBANGAN</b></th>
                <th rowspan="2" style="text-align: center;">
                    <b>KETERANGAN</b>
                </th>
            </tr>
            <tr>
                <th style="text-align: center;"><b>AYAH</b>
                </th>
                <th style="text-align: center;"><b>IBU</b>
                </th>
                <th style="text-align: center;">
                    <b>JANUARI</b>
                </th>
                <th style="text-align: center;">
                    <b>FEBRUARI</b>
                </th>
                <th style="text-align: center;">
                    <b>MARET</b>
                </th>
                <th style="text-align: center;">
                    <b>APRIL</b>
                </th>
                <th style="text-align: center;">
                    <b>MEI</b>
                </th>
                <th style="text-align: center;">
                    <b>JUNI</b>
                </th>
                <th style="text-align: center;">
                    <b>JULI</b>
                </th>
                <th style="text-align: center;">
                    <b>AGUSTUS</b>
                </th>
                <th style="text-align: center;">
                    <b>SEPTEMBER</b>
                </th>
                <th style="text-align: center;">
                    <b>OKTOBER</b>
                </th>
                <th style="text-align: center;">
                    <b>NOVEMBER</b>
                </th>
                <th style="text-align: center;">
                    <b>DESEMBER</b>
                </th>
            </tr>
            <tr>
                <th colspan="2" style="text-align: center;">1</th>
                <th style="text-align: center;">2</th>
                <th style="text-align: center;">3</th>
                <th style="text-align: center;">4</th>
                <th style="text-align: center;">5</th>
                <th style="text-align: center;">6</th>
                <th style="text-align: center;">7</th>
                <th style="text-align: center;">8</th>
                <th style="text-align: center;">9</th>
                <th style="text-align: center;">10</th>
                <th style="text-align: center;">11</th>
                <th style="text-align: center;">12</th>
                <th style="text-align: center;">13</th>
                <th style="text-align: center;">14</th>
                <th style="text-align: center;">15</th>
                <th style="text-align: center;">16</th>
                <th style="text-align: center;">17</th>
                <th style="text-align: center;">18</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td rowspan="2" style="text-align: center;">{{ $loop->iteration }}</td>
                    <td rowspan="2" style="text-align: center;">{{ $item->nama_balita }}</td>
                    <td rowspan="2" style="text-align: center;">{{ $item->tanggal_lahir_balita }}</td>
                    <td rowspan="2" style="text-align: center;">{{ $item->getUsia() }}</td>
                    <td rowspan="2" style="text-align: center;">{{ $item->nama_ayah }}</td>
                    <td rowspan="2" style="text-align: center;">{{ $item->nama_ibu }}</td>
                    @for ($i = 1; $i <= 12; $i++)
                        <!-- Iterasi untuk setiap bulan -->
                        <td style="text-align: center;">
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
                    <td rowspan="2" style="text-align: center;">{{ $item->catatan_terakhir }}</td>
                </tr>
                <tr>
                    @for ($i = 1; $i <= 12; $i++)
                        <!-- Iterasi untuk setiap bulan -->
                        <td style="text-align: center;">
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
            @endforeach
        </tbody>
    </table>
    <br>
    <table>
        <tr>
            <td colspan="19" style="text-align: right;">
                Sidoarjo, ...... .............. 20
            </td>
        </tr>
    </table>
    <br>
    <br>
    <table>
        <tr>
            <th colspan="19" style="text-align: right;">
                .........................................
            </th>
        </tr>
    </table>

</body>

</html>
