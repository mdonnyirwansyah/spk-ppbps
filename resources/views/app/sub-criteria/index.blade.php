@extends('layouts.app')

@section('title', 'Sub Kriteria')

@push('javascript')
@include('app.sub-criteria.actions')

<script>
    $(document).ready( function() {
        $('#recruitment').change(function (e) {
            e.preventDefault();
            var recruitment = e.target.value;

            $.ajax({
                url: "{{ route('sub-criteria.get-criteria') }}",
                type:"POST",
                data: {
                    recruitment: recruitment
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function (response) {
                    $('#criteria').empty();
                    $("#criteria").append('<option>Pilih Kriteria</option>');
                    $.each(response.criterias, function(index, criteria) {
                        $('#criteria').append('<option value="'+criteria.id+'">'+criteria.name+'</option>');
                    })
                }
            });
        });

        $('#criteria').change(function (e) {
            criteria.draw();
            e.preventDefault();
        });

        var criteria = $('#subcriteria-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('sub-criteria.get-data') }}",
                type: "POST",
                data: function (d) {
                    d.criteria = $('#criteria').val();
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    width: 50,
                    orderable: false,
                    searchable: false
                },
                {data: 'name', name: 'name'},
                {data: 'rating', name: 'rating'},
                {data: 'weight', name: 'weight'},
                {
                    data: 'action',
                    name: 'action',
                    width: 75,
                    orderable: false,
                    searchable: false
                }
            ],
            order: [
                [ 3, 'asc' ]
            ]
        });
    });
</script>
@endpush

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Sub Kriteria</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active">
        <a href="{{ route('dashboard') }}">Dashboard</a>
      </div>
      <div class="breadcrumb-item">Sub Kriteria</div>
    </div>
  </div>
  <div class="section-body">
    <div class="card">
      <div class="card-body">
        <div class="col-12">
            <div class="section-header-button d-flex flex-column">
              <form class="form-inline" action="{{ route('sub-criteria.create') }}" method="post">
                  @csrf
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <button class="btn btn-primary" type="submit">Tambah</button>
                      </div>
                      <select class="custom-select filter @error('recruitment') is-invalid @enderror" name="recruitment" id="recruitment">
                          <option value="" selected>Pilih Rekrutmen</option>
                          @foreach ($recruitment as $item)
                          <option value="{{ $item->id }}" >{{ $item->title }}</option>
                          @endforeach
                      </select>
                      @error('recruitment')
                          <span class="invalid-feedback" role="alert">
                              <small>{{ $message }}</small>
                          </span>
                      @enderror
                      <select class="custom-select @error('recruitment') is-invalid @enderror" name="criteria" id="criteria">
                          <option value="" selected>Pilih Kriteria</option>
                      </select>
                      @error('criteria')
                          <span class="invalid-feedback" role="alert">
                              <small>{{ $message }}</small>
                          </span>
                      @enderror
                  </div>
              </form>
            </div>
          <hr>
          <table id="subcriteria-table" class="table table-bordered table-striped dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Rating</th>
                      <th>Bobot</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
