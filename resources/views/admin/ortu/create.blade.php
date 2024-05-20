@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="pagetitle">
            <a href="{{ route('orang-tua.index') }}">
                <button class="btn btn-dark btn-sm fw-bold"><i class="bi bi-arrow-left-short"></i> Kembali</button>
            </a>
        </div>
    </section>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body table-responsive">
                        <h5 class="card-title">Tambah Data Orang Tua</h5>

                        <form method="POST" action="" id="ortuForm" name="ortuForm">
                            @method('POST')
                            @csrf
                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <label for="nik_ayah" class="col-form-label">NIK Ayah</label>
                                    <input type="text" name="nik_ayah" id="nik_ayah" class="form-control" placeholder=""
                                        minlength="16" maxlength="16">
                                    <p class="invalid-feedback"></p>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <label for="nama_ayah" class="col-form-label">Nama Ayah</label>
                                    <input type="text" name="nama_ayah" id="nama_ayah" class="form-control"
                                        placeholder="Masukkan nama lengkap ayah">
                                    <p class="invalid-feedback"></p>
                                </div>
                                <div class="col-sm-6">
                                    <label for="tanggal_lahir_ayah" class="col-form-label">Tanggal Lahir
                                        Ayah</label>
                                    <input type="date" name="tanggal_lahir_ayah" id="tanggal_lahir_ayah"
                                        class="form-control" placeholder="">
                                    <p class="invalid-feedback"></p>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <label for="nik_ibu" class="col-form-label">NIK Ibu</label>
                                    <input type="text" name="nik_ibu" id="nik_ibu" class="form-control" placeholder=""
                                        minlength="16" maxlength="16">
                                    <p class="invalid-feedback"></p>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <label for="nama_ibu" class="col-form-label">Nama Ibu</label>
                                    <input type="text" name="nama_ibu" id="nama_ibu" class="form-control"
                                        placeholder="Masukkan nama lengkap ibu">
                                    <p class="invalid-feedback"></p>
                                </div>
                                <div class="col-sm-6">
                                    <label for="tanggal_lahir_ibu" class="col-form-label">Tanggal Lahir Ibu</label>
                                    <input type="date" name="tanggal_lahir_ibu" id="tanggal_lahir_ibu"
                                        class="form-control" placeholder="">
                                    <p class="invalid-feedback"></p>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4">
                                    <label for="phone" class="col-form-label">No. Telepon</label>
                                    <input type="text" name="phone" id="phone" class="form-control"
                                        placeholder="Masukkan nomor telepon aktif">
                                    <p class="invalid-feedback"></p>
                                </div>
                                <div class="col-sm-8">
                                    <label for="alamat" class="col-form-label">Alamat</label>
                                    <textarea type="text" name="alamat" id="alamat" class="form-control" placeholder="Masukkan alamat sesuai ktp"
                                        style="height: 150px;"></textarea>
                                    <p class="invalid-feedback"></p>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-sm fw-bold">Tambahkan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        $(document).ready(function() {
            function displayError(input, errorMessage) {
                input.addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errorMessage);
            }

            function removeError(input) {
                input.removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
            }

            function checkExistingData(input, type) {
                var value = input.val();
                var url = '{{ route('check-existing-data') }}';

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        value: value,
                        type: type
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.exists) {
                            displayError(input, data.message);
                        } else {
                            removeError(input);
                        }
                    },
                    error: function() {
                        console.log('Error occurred while checking existing data.');
                    }
                });
            }

            $('#nik_ayah, #nama_ayah, #nik_ibu, #nama_ibu').on('input', function() {
                removeError($(this));
                var type = $(this).attr('id');
                checkExistingData($(this), type);
            });

            $('#ortuForm').submit(function(event) {
                event.preventDefault();
                let formData = $(this).serialize();
                $("button[type='submit']").prop('disabled', true);

                let spinnerHtml =
                    '<div class="spinner-border text-light" role="status"><span class="visually-hidden">Loading...</span></div>';
                $("button[type='submit']").html(spinnerHtml);

                $.ajax({
                    url: '{{ route('orang-tua.store') }}',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $("button[type='submit']").prop('disabled', false);
                        $("button[type='submit']").html('Tambahkan');

                        if (data['success'] == true) {
                            $('.invalid-feedback').removeClass('invalid-feedback').html('');
                            $("input[type='text'], select, input[type='number']").removeClass(
                                'is-invalid');
                            window.location.href = '{{ route('orang-tua.index') }}';
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
