<div class="modal fade" id="userCreate" tabindex="-2">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="" enctype="multipart/form-data" id="userForm" name="userForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Tambah Data User</h5>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="name" class="col-sm-3 col-form-label text-secondary fw-semibold">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email"
                            class="col-sm-3 col-form-label text-secondary fw-semibold">Email</label>
                        <div class="col-sm-9">
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <label for="password"
                            class="col-sm-3 col-form-label text-secondary fw-semibold">Password</label>
                        <div class="col-sm-9">
                            <input type="text" name="password" id="password" class="form-control" minlength="8" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary fw-bold"
                        data-bs-dismiss="modal">Batal</button>
                    <button type="submit" value="Simpan" class="btn btn-sm btn-primary fw-bold">Buat</button>
                </div>
            </form>
        </div>
    </div>
</div>