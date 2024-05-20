<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('admin-assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('admin-assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('admin-assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('admin-assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('admin-assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('admin-assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('admin-assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('admin-assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('admin-assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet">

</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <span class="text-center d-lg-block">POSYANDU DESA GANGGANG PANJANG</span>
                </a>
              </div><!-- End Logo -->

              @include('admin.message')
              
              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4 fw-bold">Login</h5>
                    <p class="text-center small">Selamat datang, Masukkan Email dan Password untuk mengakses admin panel</p>
                  </div>

                  <form action="{{ route('admin.authenticate') }}" class="row g-3" method="post">
                    @csrf
                    <div class="col-12">
                      <label for="email" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <input type="email" value="{{ old('email') }}" name="email" id="email" class="form-control @error('email') is-invalid @enderror">
                        {{-- <div class="invalid-feedback">Please enter your username.</div> --}}
                        @error('email')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                      {{-- <div class="invalid-feedback">Please enter your password!</div> --}}
                        @error('password')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100 fw-bold" type="submit">Login</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Buat akun baru, hubungi <a href="#" class="fw-bold">Pengurus</a> Posyandu</p>
                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  {{-- <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a> --}}

  <!-- Vendor JS Files -->
  <script src="{{ asset('admin-assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('admin-assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('admin-assets/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('admin-assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('admin-assets/vendor/quill/quill.min.js') }}"></script>
  <script src="{{ asset('admin-assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('admin-assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('admin-assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('admin-assets/js/main.js') }}"></script>

</body>

</html>