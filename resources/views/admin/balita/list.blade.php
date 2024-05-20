@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="pagetitle">
            <h1>Balita</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Balita</li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @include('admin.message')
                <div class="card">
                    <div class="card-body table-responsive">
                        <h5 class="card-title">Daftar Balita Desa Ganggang Panjang</h5>
                        <div class="row mb-2 mt-2">
                            <div class="col-md-5">
                                <a href="{{ route('balita.create') }}">
                                    <button type="button" class="btn btn-primary btn-sm fw-bold"><i
                                            class="bi bi-file-earmark-plus"></i> Tambah Data Balita</button>
                                </a>
                                <a href="balita/export_excel" target="_blank">
                                    <button type="button" class="btn btn-success btn-sm fw-bold ms-2"><i
                                            class="bi bi-printer"></i> Export .xlsx</button>
                                </a>
                            </div>
                        </div>

                        <!-- Default Table -->
                        <table class="table table-striped" id="datatables">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Balita</th>
                                    <th>Tgl Lahir</th>
                                    <th>Usia</th>
                                    <th>Jns Kelamin</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($balitas as $balita)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            @if ($balita->jenis_kelamin_balita === 'perempuan')
                                                <span
                                                    class="badge rounded-pill bg-danger text-white">{{ $balita->nama_balita }}</span>
                                            @elseif ($balita->jenis_kelamin_balita === 'laki-laki')
                                                <span
                                                    class="badge rounded-pill bg-primary text-white">{{ $balita->nama_balita }}</span>
                                            @else
                                                <span
                                                    class="badge rounded-pill bg-secondary text-white">{{ $balita->nama_balita }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $balita->formatted_tanggal_lahir }}</td>
                                        <td>{{ $balita->usia }}</td>
                                        <td>{{ $balita->jenis_kelamin_balita }}</td>
                                        <td>
                                            <a href="{{ route('balita.edit', $balita->id) }}">
                                                <button type="button" class="btn btn-primary btn-sm"><i
                                                        class="bi bi-pencil" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Edit"></i></button>
                                            </a>
                                            <a href="{{ route('imunisasi.index', ['id' => $balita->id]) }}">
                                                <button type="button" class="btn btn-success btn-sm"><i
                                                        class="bi bi-graph-up-arrow" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Imunisasi"></i></button>
                                            </a>
                                            <a href="#" onclick="deleteBalita({{ $balita->id }})">
                                                <button type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash3"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Hapus"></i></button>
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
    </section>
@endsection

@section('customJs')
    <script>
        function deleteBalita(id) {
            var url = '{{ route('balita.delete', 'ID') }}';
            var newUrl = url.replace('ID', id);
            if (confirm("Yakin hapus data ini ?")) {
                $.ajax({
                    url: newUrl,
                    type: 'delete',
                    data: {},
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response["status"]) {
                            window.location.href = "{{ route('balita.index') }}";
                        } else {

                        }
                    }
                });
            }
        }
    </script>
@endsection
