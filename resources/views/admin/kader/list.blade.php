@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="pagetitle">
            <h1>Kader Posyandu</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Data Kader Posyandu</li>
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
                        <h5 class="card-title">Data Kader Posyandu</h5>
                        <div class="row mb-3 mt-2">
                            <div class="col-md-5">
                                <a href="{{ route('kader.create') }}">
                                    <button type="button" class="btn btn-primary btn-sm fw-bold"><i
                                            class="bi bi-file-earmark-plus"></i> Tambah Data Kader</button>
                                </a>
                                {{-- <a href="" target="_blank">
                                    <button type="button" class="btn btn-success btn-sm fw-bold ms-2"><i
                                            class="bi bi-printer"></i> Export .xlsx</button>
                                </a> --}}
                            </div>
                        </div>
                        <!-- Default Table -->
                        <table class="table table-striped" id="datatables">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kader</th>
                                    <th>Nomor Telepom</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kaders as $kader)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kader->nama_kader }}</td>
                                        <td>{{ $kader->nomor_telepon }}</td>
                                        <td>{{ $kader->alamat }}</td>
                                        <td>
                                            <a href="{{ route('kader.edit', $kader->id) }}">
                                                <button type="button" class="btn btn-primary btn-sm"><i
                                                        class="bi bi-pencil" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Edit"></i></button>
                                            </a>
                                            <a href="#" onclick="deleteKader({{ $kader->id }})">
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
        function deleteKader(id) {
            var url = '{{ route('kader.delete', 'ID') }}';
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
                            window.location.href = "{{ route('kader.index') }}";
                        } else {

                        }
                    }
                });
            }
        }
    </script>
@endsection
