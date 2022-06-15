@extends('layouts.app')

@section('title', 'Penilaian Kandidat')

@push('javascript')
<script>
    function printErrorMsg (msg) {
        $.each( msg, function ( key, value ) {
            $('#'+key.replace(/[^\w\s]|_/g,"")).addClass('is-invalid');
            $('.'+key.replace(/[^\w\s]|_/g,"")+'_err').text(value);
            $('#'+key.replace(/[^\w\s]|_/g,"")).change(function () {
                $('#'+key.replace(/[^\w\s]|_/g,"")).removeClass('is-invalid');
                $('#'+key.replace(/[^\w\s]|_/g,"")).addClass('is-valid');
            });
        });
    }

    $(document).ready( function() {
        $('#form-action').submit(function (e) {
            e.preventDefault();
            $('#btn').attr('disabled', true);
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
                        toastr.success(response.success, 'Selamat,');

                        async function redirect() {
                        let promise = new Promise(function(resolve, reject) {
                            setTimeout(function() { resolve('{{ route("candidate.index") }}'); }, 3000);
                        });
                        window.location.href = await promise;
                        }

                        redirect();
                    } else if(response.warning) {
                        toastr.warning(response.warning, 'Peringatan,');
                        $('#btn').attr('disabled', false);
                    } else if(response.failed) {
                        toastr.error(response.failed, 'Gagal,');
                        $('#btn').attr('disabled', false);
                    } else {
                        printErrorMsg(response.error);
                        $('#btn').attr('disabled', false);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
                }
            });
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
        <h1>Penilaian Kandidat</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('candidate.index') }}">Kandidat</a>
            </div>
            <div class="breadcrumb-item">Penilaian Kandidat</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('preference.store') }}" id="form-action" enctype="multipart/form-data">
                            <input type="hidden" name="candidate_id" id="candidate_id" @isset($candidate) value="{{ $candidate->id }}" @endisset/>

                            <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="recruitment">Tema Rekrutmen</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="text" class="form-control" name="recruitment" id="recruitment" @isset($candidate) value="{{ $candidate->recruitment->title }}" @endisset readonly/>
                              </div>
                            </div>

                            <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="candidate">Kandidat</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="text" class="form-control" name="candidate" id="candidate" @isset($candidate) value="{{ $candidate->name }}" @endisset readonly/>
                                  <small class="invalid-feedback name_err"></small>
                              </div>
                            </div>

                            @foreach ($criteria as $key => $item)
                            <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="{{ 'subcriterias'.$key }}">{{ $item->name }}</label>
                              <div class="col-sm-12 col-md-7">
                                <select class="form-control select2" style="width: 100%" name="sub_criterias[]" id="{{ 'subcriterias'.$key }}">
                                    @isset($candidate->preferences())
                                    <option value="">Pilih Sub Kriteria</option>
                                    @endisset
                                    @foreach ($item->sub_criterias as $sub_criteria)
                                    <option value="{{ $sub_criteria->id }}">{{ $sub_criteria->name }}</option>
                                    @endforeach
                                </select>
                                <small class="invalid-feedback {{ 'subcriterias'.$key.'_err' }}"></small>
                              </div>
                            </div>
                            @endforeach

                            <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                              <div class="col-sm-12 col-md-7">
                                <button class="btn btn-primary" id="btn">
                                    Simpan Perubahan
                                </button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
