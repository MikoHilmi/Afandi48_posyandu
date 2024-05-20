@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="pagetitle">
            <h1>Kegiatan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Kegiatan</li>
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
                        <h5 class="card-title">Jadwal Kegiatan</h5>
                        <div class="row mb-2 mt-2">
                            <div class="col-md-5">
                                <a href="{{ route('kegiatan.create') }}">
                                    <button type="button" class="btn btn-primary btn-sm fw-bold"><i
                                            class="bi bi-file-earmark-plus"></i> Tambah Data Kegiatan</button>
                                </a>
                                <a href="jadwal/export_excel" target="_blank">
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
                                    <th>Nama Kegiatan</th>
                                    <th>Tempat</th>
                                    <th>Waktu</th>
                                    <th>Poster</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kegiatans as $kegiatan)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $kegiatan->judul_kegiatan }}</td>
                                        <td>{{ $kegiatan->tempat }}</td>
                                        <td>{{ $kegiatan->formatted_waktu }}</td>
                                        <td><img src="{{ asset('uploads/kegiatan' . $kegiatan->image) }}" width="100">
                                        </td>
                                        <td>{{ $kegiatan->deskripsi }}</td>
                                        <td>
                                            <a href="{{ route('kegiatan.edit', $kegiatan->id) }}">
                                                <button type="button" class="btn btn-primary btn-sm"><i
                                                        class="bi bi-pencil" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Edit"></i></button>
                                            </a>
                                            <a href="#" onclick="deleteKegiatan({{ $kegiatan->id }})">
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
        function deleteKegiatan(id) {
            var url = '{{ route('kegiatan.delete', 'ID') }}';
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
                            window.location.href = "{{ route('kegiatan.index') }}";
                        } else {

                        }
                    }
                });
            }
        }
    </script>
@endsection
