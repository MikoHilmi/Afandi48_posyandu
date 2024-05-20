<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Posyandu | Ganggang Panjang</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="" rel="icon">
    <link href="" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Dosis:300,400,500,,600,700,700i|Lato:300,300i,400,400i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->

    <link href="{{ asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('frontend/assets/css/style.css') }}" rel="stylesheet">

    <style>
        .card {
            margin-bottom: 30px;
            border: none;
            border-radius: 5px;
            box-shadow: 0px 0 30px rgba(1, 41, 112, 0.1);
        }
    </style>

</head>

<body>

    <!-- ======= Header ======= -->
    @include('frontend.layouts.nav')

    <main id="main">
        <section class="breadcrumbs">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card mb-4">
                            <div class="card-body table-responsive text-secondary">
                                <h5 class="card-title">Data Balita</h5>
                                <h6>{{ $balita->nama_balita }}</h6>
                                <h6>{{ $balita->jenis_kelamin_balita }}</h6>
                                <h6>{{ $balita->formatted_tanggal_lahir }} / {{ $balita->usia }}</h6>
                                <h6>{{ $balita->nomor_telepon }}</h6>
                                <h6>{{ $balita->alamat }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card mb-4">
                            <div class="card-body table-responsive">
                                <h5 class="card-title">Record Pertumbuhan Balita</h5>
                                <div class="row mb-3 mt-2">
                                    <div class="col-md-12 col-sm-12 col-lg-12 justify-content-end">
                                        <a href="{{ route('export-imunisasi', ['id_balita' => $balita->id]) }}"
                                            target="_blank">
                                            <button type="button" class="btn btn-success btn-sm fw-bold"><i
                                                    class="bi bi-printer"></i> Export .xlsx</button>
                                        </a>
                                    </div>
                                </div>

                                <table class="table display table-striped" id="datatables">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tgl Imunisasi</th>
                                            <th>Berat Badan</th>
                                            <th>Tinggi Badan</th>
                                            <th>Catatan</th>
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
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    @include('admin.imunisasi.kurva')
                </div>
            </div>
        </section>

        <script src="{{ $chartBeratBadan->cdn() }}"></script>
        {{ $chartBeratBadan->script() }}

        <script src="{{ $chartTinggiBadan->cdn() }}"></script>
        {{ $chartTinggiBadan->script() }}

    </main>

    <footer id="footer">
        <div class="container py-4">
            <div class="copyright">
                &copy; Copyright <strong><span>Posyandu</span></strong>. All Rights Reserved
            </div>
        </div>
    </footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('frontend/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>

</body>

</html>
