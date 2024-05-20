@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="pagetitle">
            <h1>Vaksin</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('vaksin-transaksi.index') }}">Data Transaksi Vaksin</a></li>
                    <li class="breadcrumb-item active">Data Vaksin</li>
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
                        <h5 class="card-title">Data Vaksin</h5>
                        <div class="row mb-3 mt-2">
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <button type="button" class="btn btn-sm btn-primary fw-bold" data-bs-toggle="modal"
                                    data-bs-target="#vaksinCreate"><i class="bi bi-file-earmark-plus"></i> Tambah Data
                                    Vaksin</button>
                                {{-- <a href="vaksin/export_excel" target="_blank">
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
                                    <th>Nama Vaksin</th>
                                    <th>Stok</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vaksins as $vaksins)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $vaksins->nama_vaksin }}</td>
                                        <td>
                                            @if ($vaksins->stok <= 0)
                                                <div class="alert alert-danger" role="alert">
                                                    Stok {{ $vaksins->nama_vaksin }} habis!
                                                </div>
                                            @else
                                                {{ $vaksins->stok }}
                                            @endif
                                        </td>
                                        <td>{{ $vaksins->deskripsi }}</td>
                                        <td>
                                            <button type="button" value="{{ $vaksins->id }}"
                                                class="btn btn-primary btn-sm vaksinEdit" data-bs-toggle="modal"
                                                data-bs-target="#vaksinEdit"><i class="bi bi-pencil"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Edit"></i></button>
                                            <a href="#" onclick="deleteVaksin({{ $vaksins->id }})">
                                                <button type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash3"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Hapus"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

                        @include('admin.vaksin.edit')
                        @include('admin.vaksin.create')

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        function deleteVaksin(id) {
            var url = '{{ route('vaksin.delete', 'ID') }}';
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
                            window.location.href = "{{ route('vaksin.index') }}";
                        } else {

                        }
                    }
                });
            }
        }

        $(document).ready(function() {
            $('#vaksinForm').submit(function(event) {
                event.preventDefault();

                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: '{{ route('vaksin.store') }}',
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        $('#vaksinForm')[0].reset();

                        window.location.href = '{{ route('vaksin.index') }}';
                    },
                    error: function(error) {
                        alert('Terjadi kesalahan saat menyimpan data vaksin.');
                    }
                });
            });

            $(document).on('click', '.vaksinEdit', function() {
                var id = $(this).val();
                $('#vaksinEdit').modal('show');

                $.ajax({
                    url: 'vaksin/' + id,
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            $('#id').val(response.data.id);
                            $('#nama_vaksin').val(response.data.nama_vaksin);
                            $('#deskripsi').val(response.data.deskripsi);
                        }
                    }
                });
            });

            $('#vaksinEditForm').submit(function(event) {
                event.preventDefault();

                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var id = $('#id').val();
                var formData = {
                    '_token': csrfToken,
                    'id': id,
                    'nama_vaksin': $('#nama_vaksin').val(),
                    'deskripsi': $('#deskripsi').val()
                };

                $.ajax({
                    type: 'PUT',
                    url: 'vaksin/' + id,
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#vaksinEdit').modal('hide');

                            window.location.href = '{{ route('vaksin.index') }}';
                        } else {
                            alert('Gagal mengupdate data vaksin.');
                        }
                    },
                    error: function() {
                        alert('Terjadi kesalahan saat mengupdate data vaksin.');
                    }
                });
            });
        });
    </script>
@endsection
