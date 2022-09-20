@extends('layouts.app')

@section('title', 'Tambah Kandidat')

@push('javascript')
    <script>
        function printErrorMsg (msg) {
            $.each( msg, function ( key, value ) {
                $('#'+key).addClass('is-invalid');
                $('.'+key+'_err').text(value);
                $('#'+key).change(function () {
                    $('#'+key).removeClass('is-invalid');
                    $('#'+key).addClass('is-valid');
                });
            });
        }

        $('#collapse-import').on('click', function() {
            $('#btn-excel').removeClass('d-none');
        });

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
                        $('#form-import').trigger("reset");
                        toastr.success(response.success, 'Pemberitahuan,');
                        $('#btn-import').attr('disabled', false);
                    } else {
                        printErrorMsg(response.error);
                        $('#btn-import').attr('disabled', false);
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
                <div class="d-none card">
                    <div class="card-body d-flex justify-content-end">
                        <button id="collapse-import" class="btn btn-primary" data-toggle="collapse" data-target="#import" aria-expanded="false" aria-controls="import">
                            Import
                        </button>
                        <a id="btn-excel" href="{{ route('candidate.export') }}" target="_blank" class="btn btn-success d-none ml-3">File Import</a>
                    </div>
                    <div class="card-body collapse" id="import">
                        <form id="form-import" method="POST" action="{{ route('candidate.import') }}" enctype="multipart/form-data" autocomplete="off">
                            <input type="hidden" name="recruitment" value="{{ $recruitment->id }}">
                            <div class="form-group row">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                              <div class="col-sm-12 col-md-7">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button id="btn-import" class="btn btn-primary" type="submit">Import</button>
                                    </div>
                                    <input id="file" type="file" class="form-control" name="file" />
                                    <small class="invalid-feedback file_err"></small>
                                </div>
                              </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('candidate.store') }}" enctype="multipart/form-data" autocomplete="off">
                            @include('app.candidate.partials.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
