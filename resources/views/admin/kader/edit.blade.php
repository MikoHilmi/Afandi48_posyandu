@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="pagetitle">
            <a href="{{ route('kader.index') }}">
                <button class="btn btn-dark btn-sm fw-bold"><i class="bi bi-arrow-left-short"></i> Kembali</button>
            </a>
        </div>
    </section>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body table-responsive">
                        <h5 class="card-title">Tambah Data Kader Posyandu</h5>

                        <form method="put" action="" id="kaderForm" name="kaderForm">
                            @csrf
                            <div class="row mb-3">
                                <label for="nama_kader" class="col-sm-2 col-form-label">Nama Kader</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama_kader" id="nama_kader" class="form-control"
                                        placeholder="Masukkan nama lengkap kader" value="{{ $kader->nama_kader }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nomor_telepon" class="col-sm-2 col-form-label">No. Telepon</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nomor_telepon" id="nomor_telepon" class="form-control"
                                        placeholder="Masukkan nomor telepon aktif" value="{{ $kader->nomor_telepon }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea type="text" name="alamat" id="alamat" class="form-control" placeholder="Masukkan alamat sesuai ktp"
                                        style="height: 150px;">{{ $kader->alamat }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-10">
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
            $('#kaderForm').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    type: 'put',
                    url: '{{ route('kader.update', $kader->id) }}',
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        window.location.href = '{{ route('kader.index') }}';
                    },
                    error: function(error) {
                    }
                });
            });
        });
    </script>
@endsection
