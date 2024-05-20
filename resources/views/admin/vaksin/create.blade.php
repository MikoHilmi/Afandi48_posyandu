<div class="modal fade" id="vaksinCreate" tabindex="-2">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="" enctype="multipart/form-data" id="vaksinForm" name="vaksinForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Tambah Data Vaksin</h5>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="nama_vaksin" class="col-sm-3 col-form-label text-secondary fw-semibold">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" name="nama_vaksin" id="nama_vaksin" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <label for="deskripsi"
                            class="col-sm-3 col-form-label text-secondary fw-semibold">Deskripsi</label>
                        <div class="col-sm-9">
                            <input type="text" name="deskripsi" id="deskripsi" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary fw-bold"
                        data-bs-dismiss="modal">Batal</button>
                    <button type="submit" value="Simpan" class="btn btn-sm btn-primary fw-bold">Tambahkan</button>
                </div>
            </form>
        </div>
    </div>
</div>