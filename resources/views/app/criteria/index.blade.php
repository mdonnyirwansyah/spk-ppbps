@extends('layouts.app')

@section('title', 'Kriteria')

@push('javascript')
@include('app.criteria.actions')

<script>
    $(document).ready( function() {
        $('.filter').change(function (e) {
            criteria.draw();
            e.preventDefault();
        });

        var criteria = $('#criteria-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('criteria.get-data') }}",
                type: "POST",
                data: function (d) {
                    d.recruitment = $('#recruitment').val();
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
                [ 2, 'asc' ]
            ]
        });
    });
</script>
@endpush

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Kriteria</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active">
        <a href="{{ route('dashboard') }}">Dashboard</a>
      </div>
      <div class="breadcrumb-item">Kriteria</div>
    </div>
  </div>
  <div class="section-body">
    <div class="card">
      <div class="card-body">
        <div class="col-12">
          <div class="section-header-button d-flex flex-column">
            <form class="form-inline" action="{{ route('criteria.create') }}" method="post">
                @csrf
                <div class="input-group mb-3">
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
                </div>
            </form>
          </div>
          <hr>
            <table id="criteria-table" class="table table-bordered table-striped dt-responsive nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
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
