@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="pagetitle">
            <a href="{{ route('balita.index') }}">
                <button class="btn btn-dark btn-sm fw-bold"><i class="bi bi-arrow-left-short"></i> Kembali</button>
            </a>
        </div>
    </section>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body table-responsive">
                        <h5 class="card-title">Edit Data Balita</h5>
                        <form method="POST" action="" id="balitaForm" name="balitaForm">
                            @method('POST')
                            @csrf
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label for="nama_ortu" class="col-form-label">Nama Orang Tua</label>
                                    <input type="text" class="form-control" id="nama_ortu" name="nama_ortu"
                                        value="{{ $namaOrtu }}" readonly>
                                </div>
                                <div class="col-sm-6">
                                    <label for="nama_balita" class="col-form-label">Nama Balita</label>
                                    <input type="text" name="nama_balita" id="nama_balita" class="form-control"
                                        placeholder="Masukkan nama lengkap balita" required
                                        value="{{ $balita->nama_balita }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label for="tanggal_lahir_balita" class="col-form-label">Tanggal Lahir
                                        Balita</label>
                                    <input type="date" name="tanggal_lahir_balita" id="tanggal_lahir_balita"
                                        class="form-control" required value="{{ $balita->tanggal_lahir_balita }}">
                                </div>
                                <div class="col-sm-4">
                                    <label for="tempat_lahir" class="col-form-label">Tempat Lahir
                                        Balita</label>
                                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control"
                                        placeholder="Tempat lahir" required value="{{ $balita->tempat_lahir }}">
                                </div>
                                <div class="col-sm-4">
                                    <label for="jenis_kelamin_balita" class="col-form-label">Jenis Kelamin
                                        Balita</label>
                                    <select name="jenis_kelamin_balita" id="jenis_kelamin_balita" class="form-select"
                                        aria-label="Default select example" required>
                                        <option value="" disabled>Pilih jenis kelamin</option>
                                        <option {{ $balita->jenis_kelamin_balita == 'laki-laki' ? 'selected' : '' }}
                                            value="Laki-laki">Laki - laki</option>
                                        <option {{ $balita->jenis_kelamin_balita == 'perempuan' ? 'selected' : '' }}
                                            value="Perempuan">Perempuan</option>
                                    </select>
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
            $('#balitaForm').submit(function(event) {
                event.preventDefault();

                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                var updateUrl = '{{ route('balita.update', ['balita' => $balita->id]) }}';

                $.ajax({
                    type: 'put',
                    url: updateUrl,
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        window.location.href = '{{ route('balita.index') }}';
                    },
                    error: function(error) {}
                });
            });
        });
    </script>
@endsection
