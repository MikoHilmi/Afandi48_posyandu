<div class="modal fade" id="vitaminEdit" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="put" enctype="multipart/form-data" id="vitaminEditForm">
                @csrf
                @method('put') <!-- Menambahkan method PUT untuk update -->
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Edit Data Vitamin</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="row mb-3">
                        <label for="nama_vitamin" class="col-sm-3 col-form-label text-secondary fw-semibold">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" name="nama_vitamin" id="nama_vitamin" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <label for="deskripsi" class="col-sm-3 col-form-label text-secondary fw-semibold">Deskripsi</label>
                        <div class="col-sm-9">
                            <input type="text" name="deskripsi" id="deskripsi" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary fw-bold" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-primary fw-bold">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>