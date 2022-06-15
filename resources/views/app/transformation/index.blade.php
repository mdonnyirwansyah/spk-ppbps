@extends('layouts.app')

@section('title', 'Transformasi Data')

@push('javascript')

<script>
    $(document).ready( function() {
        $('.filter').change(function (e) {
            transformation.draw();
            e.preventDefault();
        });

        var transformation = $('#transformation-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('transformation.get-data') }}",
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
                {data: 'candidate', name: 'candidate'}
            ],
            order: [
                [ 1, 'asc' ]
            ]
        });
    });
</script>
@endpush

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Transformasi Data</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active">
        <a href="{{ route('dashboard') }}">Dashboard</a>
      </div>
      <div class="breadcrumb-item">Transformasi Data</div>
    </div>
  </div>
  <div class="section-body">
    <div class="card">
      <div class="card-body">
        <div class="col-12">
          <div class="section-header-button d-flex flex-column">
            <form class="form-inline" action="#" method="post">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button class="btn btn-primary" type="submit">Transformasi Data</button>
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
            <table id="transformation-table" class="table table-bordered table-striped dt-responsive nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kandidat</th>
                    </tr>
                </thead>
            </table>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
