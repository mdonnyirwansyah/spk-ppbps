@extends('layouts.app')

@section('title', 'Tambah Kandidat')

@push('javascript')
    <script>
        $('#form-import').unbind().bind('submit', function (e) {
            e.preventDefault();
            $('#btn-import').attr('disabled', true);
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if(response.success) {
                        toastr.success(response.success, 'Pemberitahuan,');
                        $('#btn').attr('disabled', false);
                    } else {
                        swal('Pemberitahuan', response.error);
                        $('#btn').attr('disabled', false);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
                }
            });
        });
    </script>
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('candidate.index') }}" class="btn btn-icon">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <h1>Tambah Kandidat</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('candidate.index') }}">Kandidat</a>
            </div>
            <div class="breadcrumb-item">Tambah Kandidat</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-end">
                        <button class="btn btn-success" data-toggle="collapse" data-target="#import-excel" aria-expanded="false" aria-controls="import-excel">
                            Import Excel
                        </button>
                    </div>
                    <div class="card-body collapse" id="import-excel">
                        <form id="form-import" method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                              <div class="col-sm-12 col-md-7">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button id="btn-import" class="btn btn-primary" type="submit">Import</button>
                                    </div>
                                    <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" />
                                    @error('file')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                              </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('candidate.store') }}" enctype="multipart/form-data">
                            @include('app.candidate.partials.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
