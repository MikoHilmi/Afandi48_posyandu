<div class="modal fade" id="keluar" tabindex="-2">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="" enctype="multipart/form-data" name="keluarForm" id="keluarForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Tambah Vaksin Keluar</h5>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="vaksin" class="col-sm-2 col-form-label text-secondary fw-semibold">Nama</label>
                        <div class="col-sm-10">
                            <select name="vaksin_id" id="vaksin_id" class="form-control" required>
                                <option value="">Pilih Nama Vaksin</option>
                                @foreach ($vaksins as $vaksin)
                                    <option value="{{ $vaksin->id }}">{{ $vaksin->nama_vaksin }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tanggal_keluar"
                            class="col-sm-2 col-form-label text-secondary fw-semibold">Tanggal</label>
                        <div class="col-sm-10">
                            <input type="date" name="tanggal_keluar" id="tanggal_keluar" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="row">
                        <label for="jumlah_keluar"
                            class="col-sm-2 col-form-label text-secondary fw-semibold">Jumlah</label>
                        <div class="col-sm-10">
                            <input type="text" name="jumlah_keluar" id="jumlah_keluar" class="form-control"
                                placeholder="Masukkan jumlah vaksin keluar" required>
                            <p class="invalid-feedback"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary fw-bold"
                        data-bs-dismiss="modal">Batal</button>
                    <button type="submit" value="Simpan" class="btn btn-sm btn-primary fw-bold">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
