@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="pagetitle">
            <h1>Data Pertumbuhan Balita</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('balita.index') }}">Balita</a></li>
                    <li class="breadcrumb-item active">Data Pertumbuhan</li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="section">
        @include('admin.message')
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body table-responsive text-secondary">
                        <h5 class="card-title">Data Balita</h5>
                        <h6>{{ $balita->nama_balita }}</h6>
                        <h6>{{ $balita->jenis_kelamin_balita }}</h6>
                        <h6>{{ $balita->formatted_tanggal_lahir }} / {{ $balita->usia }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body table-responsive">
                        <h5 class="card-title">Record Pertumbuhan Balita</h5>
                        <div class="row mb-3 mt-2">
                            <div class="col-md-12 col-sm-12 col-lg-12 justify-content-end">
                                <a href="{{ route('imunisasi.create', ['id' => $balita->id]) }}">
                                    <button type="button" class="btn btn-primary btn-sm fw-bold">
                                        <i class="bi bi-file-earmark-plus"></i> Tambah Data Pertumbuhan
                                    </button>
                                </a>
                                <a href="{{ route('export-imunisasi', ['id_balita' => $balita->id]) }}" target="_blank">
                                    <button type="button" class="btn btn-success btn-sm fw-bold ms-2"><i
                                            class="bi bi-printer"></i> Export .xlsx</button>
                                </a>

                            </div>
                        </div>

                        <!-- Default Table -->
                        <table class="table display table-striped" id="datatables">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    {{-- <th>Nama</th> --}}
                                    <th>Tgl Imunisasi</th>
                                    <th>Berat Badan</th>
                                    <th>Tinggi Badan</th>
                                    <th>Catatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($imunisasi as $index => $data)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $data->formatted_tanggal_imunisasi }}</td>
                                        <td>{{ $data->berat_badan }} Kg</td>
                                        <td>{{ $data->tinggi_badan }} Cm</td>
                                        <td>{{ $data->catatan }}</td>
                                        <td>
                                            <a href="{{ route('imunisasi.edit', ['id' => $data->id]) }}">
                                                <button type="button" class="btn btn-primary btn-sm"><i
                                                        class="bi bi-pencil" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Edit"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
        </div>
        @include('admin.imunisasi.kurva')
    </section>

    <script src="{{ $chartBeratBadan->cdn() }}"></script>
    {{ $chartBeratBadan->script() }}

    <script src="{{ $chartTinggiBadan->cdn() }}"></script>
    {{ $chartTinggiBadan->script() }}
@endsection

@section('customJs')
    <script></script>
@endsection
