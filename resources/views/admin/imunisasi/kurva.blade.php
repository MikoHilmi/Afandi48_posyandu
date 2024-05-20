<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Kurva Pertumbuhan Berat Badan</h5>
                <div id="chart">
                    {!! $chartBeratBadan->container() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Kurva Pertumbuhan Tinggi Badan</h5>
                <div id="chart">
                    {!! $chartTinggiBadan->container() !!}
                </div>
            </div>
        </div>
    </div>
</div>
