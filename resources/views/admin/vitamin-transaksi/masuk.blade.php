<div class="modal fade" id="masuk" tabindex="-2">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('vitamin-transaksi.store-masuk') }}" enctype="multipart/form-data"
                name="masukForm" id="masukForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Tambah Vitamin Masuk</h5>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="vitamin" class="col-sm-2 col-form-label text-secondary fw-semibold">Nama</label>
                        <div class="col-sm-10">
                            <select name="vitamin" id="vitamin" class="form-control" required>
                                <option value="">Pilih Nama Vitamin</option>
                                @foreach ($vitamins as $vitamin)
                                    <option value="{{ $vitamin->id }}">{{ $vitamin->nama_vitamin }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tanggal_masuk"
                            class="col-sm-2 col-form-label text-secondary fw-semibold">Tanggal</label>
                        <div class="col-sm-10">
                            <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <label for="jumlah_masuk"
                            class="col-sm-2 col-form-label text-secondary fw-semibold">Jumlah</label>
                        <div class="col-sm-10">
                            <input type="text" name="jumlah_masuk" id="jumlah_masuk" class="form-control"
                                placeholder="Masukkan jumlah vitamin masuk" required>
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
