@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="pagetitle">
            <h1>Orang Tua</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Data Orang Tua</li>
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
                        <h5 class="card-title">Data orang Tua</h5>
                        <div class="row mb-3 mt-2">
                            <div class="col-md-5">
                                <a href="{{ route('orang-tua.create') }}">
                                    <button type="button" class="btn btn-primary btn-sm fw-bold"><i
                                            class="bi bi-file-earmark-plus"></i> Tambah Data Orang Tua</button>
                                </a>
                            </div>
                        </div>
                        <!-- Default Table -->
                        <table class="table table-striped" id="datatables">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Ayah</th>
                                    <th>Ibu</th>
                                    <th>No Hp</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['ortu'] as $ortu)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <ul>
                                                <li>{{ $ortu->nama_ayah }}</li>
                                                <li>{{ $ortu->nik_ayah }}</li>
                                                <li>{{ $ortu->usiaAyah() }}</li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <li>{{ $ortu->nama_ibu }}</li>
                                                <li>{{ $ortu->nik_ibu }}</li>
                                                <li>{{ $ortu->usiaIbu() }}</li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <li>{{ $ortu->phone }}</li>
                                            </ul>
                                        </td>
                                        <td style="height: auto; white-space: normal;">
                                            <ul>
                                                <li>{{ $ortu->alamat }}</li>
                                            </ul>
                                        </td>
                                        <td>
                                            <a href="{{ route('orang-tua.edit', $ortu->id) }}">
                                                <button type="button" class="btn btn-primary btn-sm"><i
                                                        class="bi bi-pencil" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Edit"></i></button>
                                            </a>
                                            <a href="javascript:void(0)" onclick="showBalita({{ $ortu->id }})">
                                                <button type="button" class="btn btn-success btn-sm"><i class="bi bi-eye"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Show Balita"></i></button>
                                            </a>
                                            <a href="javascript:void(0)" onclick="deleteOrtu({{ $ortu->id }})">
                                                <button type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash"
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

    <div class="modal fade" id="showBalita" tabindex="-2">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Data Balita</h5>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Balita</th>
                                <th>Tgl Lahir</th>
                                <th>Usia</th>
                                <th>Jenis Kelamin</th>
                            </tr>
                        </thead>
                        <tbody class="spinners" id="detail_gr"></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary fw-bold" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customJs')
    <script>
        function deleteOrtu(id) {
            var url = '{{ route('orang-tua.delete', 'ID') }}';
            var newUrl = url.replace('ID', id);
            if (confirm("Data yang dihapus tidak dapat dikembalikan, Yakin hapus data ini ?")) {
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
                            window.location.href = "{{ route('orang-tua.index') }}";
                        } else {

                        }
                    }
                });
            }
        }

        function showBalita(id) {
            $('#showBalita').modal('show');
            const getBalitaUrl = "{{ route('get-balita.show', ['id' => ':id']) }}";

            $.ajax({
                type: 'get',
                data: {},
                url: getBalitaUrl.replace(':id', id),
                beforeSend: function() {
                    $('.spinners').prop('disabled', true);
                    $("#detail_gr").html('');
                    var spinnerHtml = `
                        <tr>
                        <td colspan="5" class="text-center">
                        <div class="spinner-border text-primary mt-2" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        </td>
                        </tr>
                    `;
                    $("#detail_gr").append(spinnerHtml);
                },
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        var balitaData = response.data;
                        var tableRows = '';
                        balitaData.forEach(function(balita, index) {
                            tableRows += '<tr>';
                            tableRows += '<td>' + (index + 1) + '</td>';
                            tableRows += '<td>' + balita.nama_balita +
                                '</td>';
                            tableRows += '<td>' + balita.tanggal_lahir_balita +
                                '</td>';
                            tableRows += '<td>' + balita.usia +
                                '</td>';
                            tableRows += '<td>' + balita.jenis_kelamin_balita +
                                '</td>';
                            tableRows += '</tr>';
                        });
                        $('#detail_gr').html(tableRows);
                    } else {
                        // Handle jika tidak berhasil mendapatkan data
                        console.log('Gagal mendapatkan data balita.');
                    }
                }
            })
        }
    </script>
@endsection
