@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="pagetitle">
            <h1>Vitamin</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('vitamin-transaksi.index') }}">Data Transaksi Vitamin</a>
                    </li>
                    <li class="breadcrumb-item active">Data Vitamin</li>
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
                        <h5 class="card-title">Data Vitamin</h5>
                        <div class="row mb-3 mt-2">
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <button type="button" class="btn btn-sm btn-primary fw-bold" data-bs-toggle="modal"
                                    data-bs-target="#vitaminCreate"><i class="bi bi-file-earmark-plus"></i> Tambah Data
                                    Vitamin</button>
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
                                    <th>Nama Vitamin</th>
                                    <th>Stok</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vitamins as $vitamins)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $vitamins->nama_vitamin }}</td>
                                        <td>
                                            @if ($vitamins->stok <= 0)
                                                <div class="alert alert-danger" role="alert">
                                                    Stok {{ $vitamins->nama_vitamin }} habis!
                                                </div>
                                            @else
                                                {{ $vitamins->stok }}
                                            @endif
                                        </td>
                                        <td>{{ $vitamins->deskripsi }}</td>
                                        <td>
                                            <button type="button" value="{{ $vitamins->id }}"
                                                class="btn btn-primary btn-sm vitaminEdit" data-bs-toggle="modal"
                                                data-bs-target="#vitaminEdit"><i class="bi bi-pencil"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Edit"></i></button>
                                            <a href="#" onclick="deleteVitamin({{ $vitamins->id }})">
                                                <button type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash3"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Hapus"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

                        @include('admin.vitamin.edit')
                        @include('admin.vitamin.create')

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        function deleteVitamin(id) {
            var url = '{{ route('vitamin.delete', 'ID') }}';
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
                            window.location.href = "{{ route('vitamin.index') }}";
                        } else {

                        }
                    }
                });
            }
        }

        $(document).ready(function() {
            $('#vitaminForm').submit(function(event) {
                event.preventDefault();

                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: '{{ route('vitamin.store') }}',
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        $('#vitaminForm')[0].reset();

                        window.location.href = '{{ route('vitamin.index') }}';
                    },
                    error: function(error) {
                        alert('Terjadi kesalahan saat menyimpan data vitamin.');
                    }
                });
            });

            $(document).on('click', '.vitaminEdit', function() {
                var id = $(this).val();
                $('#vitaminEdit').modal('show');

                $.ajax({
                    url: 'vitamin/' + id,
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            $('#id').val(response.data.id);
                            $('#nama_vitamin').val(response.data.nama_vitamin);
                            $('#deskripsi').val(response.data.deskripsi);
                        }
                    }
                });
            });

            $('#vitaminEditForm').submit(function(event) {
                event.preventDefault();

                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var id = $('#id').val();
                var formData = {
                    '_token': csrfToken,
                    'id': id,
                    'nama_vitamin': $('#nama_vitamin').val(),
                    'deskripsi': $('#deskripsi').val()
                };

                $.ajax({
                    type: 'PUT',
                    url: 'vitamin/' + id,
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#vitaminEdit').modal('hide');

                            window.location.href = '{{ route('vitamin.index') }}';
                        } else {
                            alert('Gagal mengupdate data vitamin.');
                        }
                    },
                    error: function() {
                        alert('Terjadi kesalahan saat mengupdate data vitamin.');
                    }
                });
            });
        });
    </script>
@endsection
