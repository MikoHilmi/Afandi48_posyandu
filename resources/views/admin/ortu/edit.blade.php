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
                        <h5 class="card-title">Edit Data Orang Tua</h5>

                        <form method="put" action="" id="ortuForm" name="ortuForm">
                            @csrf
                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <label for="nik_ayah" class="col-form-label">NIK Ayah</label>
                                    <input type="text" name="nik_ayah" id="nik_ayah" class="form-control" placeholder=""
                                        required value="{{ $ortu->nik_ayah }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-6">
                                    <label for="nama_ayah" class="col-form-label">Nama Ayah</label>
                                    <input type="text" name="nama_ayah" id="nama_ayah" class="form-control"
                                        placeholder="Masukkan nama lengkap ayah" required value="{{ $ortu->nama_ayah }}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="tanggal_lahir_ayah" class="col-form-label">Tanggal Lahir
                                        Ayah</label>
                                    <input type="date" name="tanggal_lahir_ayah" id="tanggal_lahir_ayah"
                                        class="form-control" placeholder="" required
                                        value="{{ $ortu->tanggal_lahir_ayah }}">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <label for="nik_ibu" class="col-form-label">NIK Ibu</label>
                                    <input type="text" name="nik_ibu" id="nik_ibu" class="form-control" placeholder=""
                                        required value="{{ $ortu->nik_ibu }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-6">
                                    <label for="nama_ibu" class="col-form-label">Nama Ibu</label>
                                    <input type="text" name="nama_ibu" id="nama_ibu" class="form-control"
                                        placeholder="Masukkan nama lengkap ibu" required value="{{ $ortu->nama_ibu }}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="tanggal_lahir_ibu" class="col-form-label">Tanggal Lahir Ibu</label>
                                    <input type="date" name="tanggal_lahir_ibu" id="tanggal_lahir_ibu"
                                        class="form-control" placeholder="" required value="{{ $ortu->tanggal_lahir_ibu }}">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4">
                                    <label for="phone" class="col-form-label">No. Telepon</label>
                                    <input type="text" name="phone" id="phone" class="form-control"
                                        placeholder="Masukkan nomor telepon aktif" required value="{{ $ortu->phone }}">
                                </div>
                                <div class="col-sm-8">
                                    <label for="alamat" class="col-form-label">Alamat</label>
                                    <textarea type="text" name="alamat" id="alamat" class="form-control" placeholder="Masukkan alamat sesuai ktp"
                                        style="height: 150px;" required>{{ $ortu->alamat }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-sm fw-bold">Simpan</button>
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
            $('#ortuForm').submit(function(event) {
                event.preventDefault();

                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var updateUrl = '{{ route('orang-tua.update', ['id' => $ortu->id]) }}';

                $.ajax({
                    type: 'put',
                    url: updateUrl,
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        window.location.href = '{{ route('orang-tua.index') }}';
                    },
                    error: function(error) {
                        alert('Terjadi kesalahan saat menyimpan data Orang Tua.');
                    }
                });
            });
        });
    </script>
@endsection
