@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="pagetitle">
            <a href="{{ route('imunisasi.index', ['id' => $id]) }}">
                {{-- <button class="btn btn-dark btn-sm fw-bold"><i class="bi bi-arrow-left-short"></i> Kembali</button> --}}
            </a>
        </div>
    </section>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body table-responsive">
                        <h5 class="card-title">Edit Data Imunisasi</h5>
                        <form method="POST" action="" id="imunisasiForm" name="imunisasiForm">
                            @csrf
                            <div class="row mb-3">
                                <label for="id_balita" class="form-label">Balita</label>
                                <div class="col-sm-12">
                                    <select class="form-select" id="id_balita" name="id_balita" required>
                                        <option value="{{ $id }}" selected>{{ $namaBalita }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tanggal_imunisasi" class="form-label">Tanggal Imunisasi</label>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control" id="tanggal_imunisasi"
                                        name="tanggal_imunisasi" value="{{ $imunisasi->tanggal_imunisasi }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="berat_badan" class="form-label">Berat Badan (kg)</label>
                                <div class="col-sm-12">
                                    <input type="number" step="0.01" class="form-control" id="berat_badan"
                                        name="berat_badan" value="{{ $imunisasi->berat_badan }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tinggi_badan" class="form-label">Tinggi Badan (cm)</label>
                                <div class="col-sm-12">
                                    <input type="number" step="0.01" class="form-control" id="tinggi_badan"
                                        name="tinggi_badan" value="{{ $imunisasi->tinggi_badan }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="catatan" class="form-label">Catatan</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="catatan" name="catatan" rows="3">{{ $imunisasi->catatan }}</textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm fw-bold">Simpan</button>
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
            $('#imunisasiForm').submit(function(event) {
                event.preventDefault();

                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var updateUrl = '{{ route('imunisasi.update', ['id' => $imunisasi->id]) }}';

                $.ajax({
                    type: 'POST',
                    url: updateUrl,
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        $('#imunisasiForm')[0].reset();

                        window.location.href =
                            '{{ route('imunisasi.index', ['id' => $balita->id]) }}';
                    },
                    error: function(error) {
                        alert('Terjadi kesalahan saat menyimpan data imunisasi.');
                    }
                });
            });
        });
    </script>
@endsection
