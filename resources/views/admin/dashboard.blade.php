@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="pagetitle">
            <h1>Dashboard</h1>

        </div>
    </section>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Balita <span>| Laki - laki / Perempuan</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $male }} / {{ $female }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Jumlah Kader</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $kader }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Rata - rata Pertumbuhan Balita</h5>
                                <div id="chart">
                                    {!! $rataRata->container() !!}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Stok Vaksin</h5>
                        <div id="chart">
                            {!! $stokVaksin->container() !!}
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Stok Vitamin</h5>
                        <div id="chart">
                            {!! $stokVitamin->container() !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('customJs')
    <script src="{{ $rataRata->cdn() }}"></script>
    {{ $rataRata->script() }}
    <script src="{{ $stokVaksin->cdn() }}"></script>
    {{ $stokVaksin->script() }}
    <script src="{{ $stokVitamin->cdn() }}"></script>
    {{ $stokVitamin->script() }}
@endsection
