@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="pagetitle">
            <h1>Vitamin</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('vitamin.index') }}">Data Vitamin</a></li>
                    <li class="breadcrumb-item active">Data Transaksi Vitamin</li>
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
                        <h5 class="card-title">Data Transaksi Vitamin</h5>
                        <div class="row mb-3 mt-2">
                            <div class="col-md-12 col-sm-12 col-lg-12 justify-content-end">
                                <a href="#">
                                    <button type="button" class="btn btn-primary btn-sm fw-bold" data-bs-toggle="modal"
                                        data-bs-target="#masuk"><i class="bi bi-shield-plus"></i> Tambah Stok Masuk</button>
                                </a>
                                <a href="#">
                                    <button type="button" class="btn btn-success btn-sm fw-bold" data-bs-toggle="modal"
                                        data-bs-target="#keluar"><i class="bi bi-shield-minus"></i> Tambah Stok
                                        Keluar</button>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <h6 class="fw-bold text-secondary">Data Transaksi Masuk</h6>
                                <table class="table table-striped" id="datatables">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Vitamin</th>
                                            <th>Tanggal</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vitaminMasuk as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->vitamin->nama_vitamin }}</td>
                                                <td>{{ $item->formatted_tanggal_masuk }}</td>
                                                <td>{{ $item->jumlah_masuk }}</td>
                                                <td>
                                                    <button onclick="deleteMasuk({{ $item->id }})"
                                                        class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash3" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Hapus"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-6">
                                <h6 class="fw-bold text-secondary">Data Transaksi Keluar</h6>
                                <table class="table table-striped" id="datatablesKeluar">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Vitamin</th>
                                            <th>Tanggal</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vitaminKeluar as $vitaminKeluar)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $vitaminKeluar->vitamin->nama_vitamin }}</td>
                                                <td>{{ $vitaminKeluar->formatted_tanggal_keluar }}</td>
                                                <td>{{ $vitaminKeluar->jumlah_keluar }}</td>
                                                <td>
                                                    <a href="#"
                                                        onclick="deleteVitaminKeluar({{ $vitaminKeluar->id }})">
                                                        <button type="button" class="btn btn-danger btn-sm"><i
                                                                class="bi bi-trash3" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Hapus"></i></button>
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

            </div>
        </div>
    </section>

    @include('admin.vitamin-transaksi.masuk')
    @include('admin.vitamin-transaksi.keluar')
@endsection

@section('customJs')
    <script>
        function deleteMasuk(id) {
            console.log(id);
            var url = '{{ route('vitamin-transaksi.delete-masuk', 'ID') }}';
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
                            window.location.href = "{{ route('vitamin-transaksi.index') }}";
                        } else {

                        }
                    }
                });
            }
        }

        function deleteVitaminKeluar(id) {
            var url = '{{ route('vitamin-transaksi.delete-keluar', 'ID') }}';
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
                            window.location.href = "{{ route('vitamin-transaksi.index') }}";
                        } else {

                        }
                    }
                });
            }
        }

        $(document).ready(function() {
            function displayError(input, errorMessage) {
                input.addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errorMessage);
            }

            function removeError(input) {
                input.removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
            }

            function checkExistingData(input, type) {
                let url = '{{ route('check-stock-vitamin') }}';
                let vitaminId = $('select[name=vitamin_id]').val(); // Mengambil nilai ID vitamin dari select
                let jumlahKeluar = $("input[name=jumlah_keluar]").val(); // Mengambil nilai jumlah keluar dari input
                let token = $('input[name="_token"]').val(); // Mengambil token CSRF

                console.log(vitaminId);

                let formData = new FormData();
                formData.append('_token', token);
                formData.append('id', vitaminId); // Menggunakan nama yang sesuai dengan kontroler
                formData.append('jumlah_keluar', jumlahKeluar);

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    processData: false, // Tidak memproses data FormData secara otomatis
                    contentType: false, // Tidak menambahkan header konten
                    success: function(data) {
                        if (data.exists) {
                            removeError(input);
                        } else {
                            displayError(input, data.message);
                        }
                    },
                    error: function() {
                        console.log('Error occurred while checking existing data.');
                    }
                });
            }

            $('#jumlah_keluar').on('input', function() {
                removeError($(this));
                var type = $(this).attr('id');
                checkExistingData($(this), type);
            });

            $('#keluarForm').submit(function(event) {
                event.preventDefault();
                let formData = $(this).serialize();
                $("button[type='submit']").prop('disabled', true);

                let spinnerHtml =
                    '<div class="spinner-border text-light" role="status"><span class="visually-hidden">Loading...</span></div>';
                $("button[type='submit']").html(spinnerHtml);

                $.ajax({
                    url: '{{ route('vitamin-transaksi.store-keluar') }}',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $("button[type='submit']").prop('disabled', false);
                        $("button[type='submit']").html('Tambahkan');

                        if (data['status'] == true) {
                            $('.invalid-feedback').removeClass('invalid-feedback').html('');
                            $("input[type='text'], select, input[type='number']").removeClass(
                                'is-invalid');
                            window.location.href = '{{ route('vitamin-transaksi.index') }}';
                        } else {
                            $('.invalid-feedback').removeClass('invalid-feedback').html('');
                            $("input[type='text'], select, input[type='number']").removeClass(
                                'is-invalid');

                            $.each(data.errors, function(field, errorMessage) {
                                $("#" + field).addClass('is-invalid').siblings('p')
                                    .addClass('invalid-feedback').html(errorMessage[0]);
                            });
                        }
                    },
                    error: function() {
                        console.log('terjadi kesalahan');
                    }
                });
            });
        });
    </script>
@endsection
