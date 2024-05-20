@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="pagetitle">
            <h1>Antrian</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Antrian</li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @include('admin.message')
                <div class="card">
                    <div class="card-body table-responsive">
                        <h5 class="card-title">Antrian</h5>
                        <div class="row mb-3 mt-2">
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <a href="javascript:void(0);" onclick="clearData()"
                                    class="btn btn-danger btn-sm fw-bold">Bersihkan
                                    Antrian</a>
                            </div>
                        </div>
                        <table class="table table-hover" id="datatables">
                            <thead>
                                <tr>
                                    <th>No Urut</th>
                                    <th>Nama Ibu</th>
                                    <th>Nama Balita</th>
                                    <th>Status</th>
                                    <th>Ubah Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($antrian as $item)
                                    <tr>
                                        <td>
                                            <button class="btn btn-primary">{{ $item->nomor_urut }}</button>
                                        </td>
                                        <td>{{ $item->nama_ibu }}</td>
                                        <td>{{ $item->nama_balita }}</td>
                                        <td>
                                            @if ($item->status == 1)
                                                <span class="badge bg-success">Selesai</span>
                                            @else
                                                <span class="badge bg-danger">Menunggu</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status == 0)
                                                <a href="{{ route('ubah.status', ['id' => $item->id]) }}"
                                                    class="btn btn-success btn-sm">Selesai</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        function clearData() {
            if (confirm("Anda yakin ingin membersihkan data antrian?")) {
                $.ajax({
                    url: '{{ route('antrian.clear') }}',
                    type: 'GET',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response["status"]) {
                            window.location.href = "{{ route('antrian.index') }}";
                        } else {
                            // Handle success message if needed
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        // Handle error message or display to the user
                    }
                });
            }
        }
    </script>
@endsection
