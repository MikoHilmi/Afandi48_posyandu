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
            <footer id="footer">
                <div class="container">
                    <div class="footer-newsletter">
                        <h2>Cari Nama Balita</h2>
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <form action="" method="get">
                                    <input type="text" name="keyword" value="{{ Request::get('keyword') }}"><input
                                        type="submit" value="Cari Balita">
                                </form>
                            </div>
                        </div>
                        <div class="card mt-4">
                            <div class="card-body table-responsive">
                                <!-- Default Table -->
                                <table class="table" id="datatables">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Balita</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Usia</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Lihat Imunisasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($balita as $balita)
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
                                                </td>
                                                <td>
                                                    <a href="{{ route('imunisasi.show', ['id' => $balita->id]) }}">
                                                        <button type="button" class="btn btn-success btn-sm"><i
                                                                class="bi bi-graph-up-arrow" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Imunisasi"></i></button>
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
            </footer>
        </section>
    </main>

    <!-- ======= Footer ======= -->
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
