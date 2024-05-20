<section id="team" class="team section-bg">
    <div class="container">

        <div class="section-title">
            <h2>Kegiatan</h2>
        </div>

        <div class="row">

            @foreach ($kegiatans as $kegiatan)
            <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                <div class="member">
                    <div class="member-img">
                        <img src="{{ asset('uploads/kegiatan' . $kegiatan->image) }}" class="img-fluid"
                            alt="">
                    </div>
                    <div class="member-info">
                        <h4 class="fs-3">{{ $kegiatan->judul_kegiatan }}</h4>
                        <span class="fw-semibold text-dark">Lokasi : {{ $kegiatan->tempat }}</span>
                        <span class="fw-semibold text-dark">Waktu : {{ $kegiatan->formatted_waktu }}</span>
                        <span class="text-dark">Deskripsi : {{ $kegiatan->deskripsi }}</span>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

    </div>
</section>