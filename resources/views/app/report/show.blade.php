@extends('layouts.app')

@section('title', 'Laporan')

@push('javascript')
<script>
    $(document).ready( function() {
        $('#report-table').DataTable();
        $('#btn-export').on('click', function() {
            $('#btn-export').addClass('d-none')
            $('#btn-pdf').removeClass('d-none');
            $('#btn-excel').removeClass('d-none')
        });
        $('#btn-pdf').on('click', function() {
            $('#btn-export').removeClass('d-none')
            $('#btn-pdf').addClass('d-none');
            $('#btn-excel').addClass('d-none')
        });
        $('#btn-excel').on('click', function() {
            $('#btn-export').removeClass('d-none')
            $('#btn-pdf').addClass('d-none');
            $('#btn-excel').addClass('d-none')
        });
    });
</script>
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('report.index') }}" class="btn btn-icon">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <h1>Laporan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('report.index') }}">Filter Laporan</a>
            </div>
            <div class="breadcrumb-item">Laporan</div>
        </div>
    </div>
  <div class="section-body">
    <div class="card">
      <div class="card-body">
        <div class="col-12">
            <div class="d-flex flex-column flex-md-row justify-content-between">
                <h2 style="font-size: 18px; color: #34395e">{{ $recruitment->title }}</h2>
                <div class="d-flex justify-content-end">
                    <button id="btn-export" class="btn btn-primary">Cetak</button>
                    <a id="btn-pdf" href="{{ route('report.export.pdf', $recruitment) }}" target="_blank" class="btn btn-danger d-none mr-3">PDF</a>
                    <a id="btn-excel" href="{{ route('report.export.excel', $recruitment) }}" target="_blank" class="btn btn-success d-none">Excel</a>
                </div>
            </div>
            <hr>
            <table id="report-table" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th rowspan="2" style="vertical-align: middle;">Rank.</th>
                        <th rowspan="2" style="vertical-align: middle;">Nama</th>
                        <th colspan="{{ $recruitment->criterias->count() }}" style="text-align: center;">Kriteria</th>
                        <th rowspan="2" style="vertical-align: middle;">Skor</th>
                        <th rowspan="2" style="vertical-align: middle;">Status</th>
                    </tr>
                    <tr>
                        @foreach ($recruitment->criterias as $criteria)
                            <th>{{ $criteria->name }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sawResults as $index => $result)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $result['name'] }}</td>
                            @foreach ($result['criteria'] as $key => $criteria)
                                <td>
                                    {{ $criteria['result'] }}
                                </td>
                            @endforeach
                            <td>
                                {{ $result['score'] }}
                            </td>
                            <td><span class="badge {{ ($result['status'] == 'Lulus' ? 'badge-success' : 'badge-danger') }}">{{ $result['status'] }}</span></td>
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
