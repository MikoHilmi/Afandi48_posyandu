<section id="hero" class="d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                <h1>Selamat Datang Di {{ $title->title }}</h1>
                <div class="mt-4">
                    <a href="{{ route('balita.show') }}" class="btn btn-primary">Cari Balita</a>
                    {{-- <a href="javascript:void(0);" onclick="createUrutan()" class="btn btn-danger">Ambil Antrian</a> --}}
                    <a href="javascript:void(0);" onclick="tes()" class="btn btn-danger">Ambil Antrian</a>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img">
                <img src="{{ asset('frontend/assets/img/banner.png') }}" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</section>

<div class="modal modal-lg fade" id="showBalita" tabindex="-2">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Form antrian</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('countAntrian') }}" id="antrianForm" name="antrianForm">
                    @method('POST')
                    @csrf
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <input type="text" name="nama_ibu" id="nama_ibu" class="form-control"
                                placeholder="Masukkan nama Ibu" required>
                        </div>
                    </div>
                    <div id="container">
                        <div class="row mb-2">
                            <div class="col-sm-10">
                                <input type="text" name="nama_balita[]" class="form-control"
                                    placeholder="Masukkan nama balita" required>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-primary addRemoveButton">
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary fw-bold">Ambil</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@section('customJs')
    <script>
        $(document).ready(function() {
            $("#container").on("click", ".addRemoveButton", function() {
                let row = $(this).closest('.row');

                if ($(this).text().trim() === 'Add') {
                    let newRow = row.clone();
                    newRow.find('input[type="text"]').val('');
                    row.after(newRow);
                    $(this).html('Remove').removeClass('btn-primary').addClass(
                        'btn-danger');
                } else {
                    row.remove();
                }
            });
        });

        function tes() {
            $('#showBalita').modal('show');
        }

        function createUrutan() {
            let csrfToken = $('meta[name="csrf-token"]').attr('content');
            Swal.fire({
                title: 'Masukkan Nama Ibu',
                input: 'text',
                inputPlaceholder: 'Masukkan nama ibu',
                showCancelButton: true,
                confirmButtonText: 'Ambil Antrian',
                cancelButtonText: 'Batal',
                showLoaderOnConfirm: true,
                preConfirm: (namaIbu) => {
                    return fetch('{{ route('countAntrian') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({
                                nama_ibu: namaIbu
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(response.statusText)
                            }
                            return response.json();
                        })
                        .then(data => {
                            Swal.fire({
                                title: 'Berhasil mengambil antrian!',
                                html: `Nomor Urut : <b>${data.antrian.nomor_urut}</b><br>Nama Ibu : <b>${data.antrian.nama_ibu}</b>`,
                                icon: 'success'
                            });
                        })
                        .catch(error => {
                            Swal.showValidationMessage(
                                `Request failed: ${error}`
                            );
                        });
                },
                allowOutsideClick: () => !Swal.isLoading()
            });
        }
    </script>
@endsection
