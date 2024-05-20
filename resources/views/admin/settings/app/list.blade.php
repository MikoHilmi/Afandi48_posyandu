@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="pagetitle">
            <h1>Pengaturan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Pengaturan</li>
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
                        <h5 class="card-title">Pengaturan Aplikasi</h5>
                        <form action="{{ route('settings.update') }}" method="POST">
                            @csrf
                            <div class="tab-pane" id="tabs-home-1">
                                <table class="table">
                                    <tr>
                                        <th width="150px">Title</th>
                                        <th width="20px">:</th>
                                        <th>
                                            <input type="text" class="form-control" name="title" id="title"
                                                value="{{ $data->title }}">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th width="150px">Logo</th>
                                        <th width="20px">:</th>
                                        <th>
                                            <img src="{{ asset('uploads/aplikasi' . $data->logo) }}" height="100"
                                                alt="logo">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th width="150px">Logo Update</th>
                                        <th width="20px">:</th>
                                        <th>
                                            <input type="hidden" id="image_id" name="image_id" value="">
                                            <input name="logo" id="image" type="file" class="form-control" />
                                        </th>
                                    </tr>
                                    <tr>
                                        <th width="150px">Footer</th>
                                        <th width="20px">:</th>
                                        <th>
                                            <input type="text" class="form-control" name="foter" id="foter"
                                                value="{{ $data->foter }}">
                                        </th>
                                    </tr>
                                </table>
                                <button class="btn btn-primary mt-3 w-100">Simpan Perubahan</button>
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
        $(document).ready(function() {
            // Initialize file input change event for either favicon or logo
            $('#image').on('change', function() {
                uploadImage(this.files[0]);
            });

            function uploadImage(file) {
                var formData = new FormData();
                formData.append('image', file);

                $.ajax({
                    url: "{{ route('temp-images.create') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $("#image_id").val(response['image_id']);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
        });
    </script>
@endsection
