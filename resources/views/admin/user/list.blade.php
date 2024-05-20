@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="pagetitle">
            <h1>Pengguna</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Data Pengguna</li>
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
                        <h5 class="card-title">Data Pengguna</h5>
                        <div class="row mb-3 mt-2">
                            <div class="col-md-5">
                                <button type="button" class="btn btn-sm btn-primary fw-bold" data-bs-toggle="modal"
                                    data-bs-target="#userCreate"><i class="bi bi-file-earmark-plus"></i> Tambah Data
                                    User</button>
                            </div>
                        </div>
                        <!-- Default Table -->
                        <table class="table table-striped" id="datatables">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>********</td>
                                        {{-- <td>{{ $user->password }}</td> --}}
                                        <td>
                                            {{-- <a href="{{ route('kader.edit', $kader->id) }}">
                                                <button type="button" class="btn btn-primary btn-sm"><i
                                                        class="bi bi-pencil" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Edit"></i></button>
                                            </a> --}}
                                            <a href="#" onclick="deleteUser({{ $user->id }})">
                                                <button type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash3"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Hapus"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                        {{-- @include('admin.vaksin.edit') --}}
                        @include('admin.user.create')
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        function deleteUser(id) {
            var url = '{{ route('user.delete', 'ID') }}';
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
                            window.location.href = "{{ route('user.index') }}";
                        } else {

                        }
                    }
                });
            }
        }

        $(document).ready(function() {
            $('#userForm').submit(function(event) {
                event.preventDefault();

                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: '{{ route('user.store') }}',
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        $('#userForm')[0].reset();

                        window.location.href = '{{ route('user.index') }}';
                    },
                    error: function(error) {
                        alert('Terjadi kesalahan saat menyimpan data Pengguna.');
                    }
                });
            });

            // $(document).on('click', '.vaksinEdit', function() {
            //     var id = $(this).val();
            //     $('#vaksinEdit').modal('show');

            //     $.ajax({
            //         url: 'vaksin/' + id,
            //         type: 'GET',
            //         success: function(response) {
            //             if (response.success) {
            //                 $('#id').val(response.data.id);
            //                 $('#nama_vaksin').val(response.data.nama_vaksin);
            //                 $('#deskripsi').val(response.data.deskripsi);
            //             }
            //         }
            //     });
            // });

            // $('#vaksinEditForm').submit(function(event) {
            //     event.preventDefault();

            //     var csrfToken = $('meta[name="csrf-token"]').attr('content');
            //     var id = $('#id').val();
            //     var formData = {
            //         '_token': csrfToken,
            //         'id': id,
            //         'nama_vaksin': $('#nama_vaksin').val(),
            //         'deskripsi': $('#deskripsi').val()
            //     };

            //     $.ajax({
            //         type: 'PUT',
            //         url: 'vaksin/' + id,
            //         data: formData,
            //         dataType: 'json',
            //         success: function(response) {
            //             if (response.success) {
            //                 $('#vaksinEdit').modal('hide');

            //                 window.location.href = '{{ route('vaksin.index') }}';
            //             } else {
            //                 alert('Gagal mengupdate data vaksin.');
            //             }
            //         },
            //         error: function() {
            //             alert('Terjadi kesalahan saat mengupdate data vaksin.');
            //         }
            //     });
            // });
        });
    </script>
@endsection
