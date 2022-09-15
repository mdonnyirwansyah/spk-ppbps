@extends('layouts.app')

@section('title', 'Kandidat')

@push('javascript')
@include('app.candidate.actions')

<script>
    $(document).ready( function() {
        $('.filter').change(function (e) {
            candidate.draw();
            e.preventDefault();
        });

        var candidate = $('#candidate-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('candidate.get-all') }}",
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
                {
                    data: 'action',
                    name: 'action',
                    width: 75,
                    orderable: false,
                    searchable: false
                }
            ],
            order: [
                [ 1, 'asc' ]
            ]
        });
    });
</script>

@if ($message = Session::get('success'))
  <script>
      toastr.success('{{ $message }}', 'Pemberitahuan,')
  </script>
@endif
@endpush

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Kandidat</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active">
        <a href="{{ route('dashboard') }}">Dashboard</a>
      </div>
      <div class="breadcrumb-item">Kandidat</div>
    </div>
  </div>
  <div class="section-body">
    <div class="card">
      <div class="card-body">
        <div class="col-12">
          <div class="section-header-button d-flex flex-column">
            <form class="form-inline" method="POST" action="{{ route('candidate.filter') }}">
                @csrf
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button class="btn btn-primary" type="submit">Tambah</button>
                    </div>
                    <select class="custom-select filter @error('recruitment') is-invalid @enderror" name="recruitment" id="recruitment">
                        <option selected disabled>Pilih Rekrutmen</option>
                        @foreach ($recruitments as $recruitment)
                        <option value="{{ $recruitment->id }}" >{{ $recruitment->title }}</option>
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
            <table id="candidate-table" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
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
