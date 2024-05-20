@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="pagetitle">
            <a href="{{ route('kegiatan.index') }}">
                <button class="btn btn-dark btn-sm fw-bold"><i class="bi bi-arrow-left-short"></i> Kembali</button>
            </a>
        </div>
    </section>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body table-responsive">
                        <h5 class="card-title">Tambah Data Kegiatan</h5>

                        <form method="POST" action="" id="kegiatanForm" name="kegiatanForm">
                            @csrf
                            <div class="row mb-3">
                                <label for="judul_kegiatan" class="col-sm-2 col-form-label">Judul Kegiatan</label>
                                <div class="col-sm-10">
                                    <input type="text" name="judul_kegiatan" id="judul_kegiatan" class="form-control"
                                        placeholder="Masukkan judul kegiatan" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tempat" class="col-sm-2 col-form-label">Tempat</label>
                                <div class="col-sm-4">
                                    <input type="text" name="tempat" id="tempat" class="form-control"
                                        placeholder="Masukkan tempat kegiatan" required>
                                </div>
                                <label for="waktu" class="col-sm-2 col-form-label">Waktu</label>
                                <div class="col-sm-4">
                                    <input type="date" name="waktu" id="waktu" class="form-control"
                                        placeholder="Masukkan waktu kegiatan" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="image" class="col-sm-2 col-form-label">Poster</label>
                                <div class="col-sm-10">
                                    <input type="hidden" id="image_id" name="image_id" value="">
                                    <div id="image" class="dropzone dz-clickable">
                                        <div class="dz-message needsclick">
                                            <br>Drop files here or click to upload.<br><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-10">
                                    <textarea type="text" name="deskripsi" id="deskripsi" class="form-control" placeholder="Masukkan deskripsi kegiatan"
                                        style="height: 150px;" required></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-10">
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
        $('#kegiatanForm').submit(function(event) {
            event.preventDefault();
            var element = $(this);
            $("button[type=submit]").prop('disable', true);
            $.ajax({
                url: '{{ route('kegiatan.store') }}',
                type: 'POST',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response) {
                    $("button[type=submit]").prop('disable', false);
                    if (response["status"] == true) {
                        window.location.href = "{{ route('kegiatan.index') }}";
                    } else {}
                },
                error: function(jqXHR, exception) {
                    // console.log('Something went wrong');
                }
            });
        });

        Dropzone.autoDiscover = false;
        const dropzone = $("#image").dropzone({
            init: function() {
                this.on('addedfile', function(file) {
                    if (this.files.length > 1) {
                        this.removeFile(this.files[0]);
                    }
                });
            },
            url: "{{ route('temp-images.create') }}",
            maxFiles: 1,
            paramName: 'image',
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(file, response) {
                $("#image_id").val(response.image_id);
                // console.log(response)
            }
        });
    </script>
@endsection
