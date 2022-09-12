@extends('layouts.app')

@section('title', 'Laporan')

@push('javascript')
<script>
    $(document).ready( function() {
        $('#report-table').DataTable();
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
            <div class="d-flex justify-content-between">
                <h2 style="font-size: 1.4em">{{ $recruitment->title }}</h2>
                <a href="{{ route('report.print', $recruitment) }}" target="_blank" class="btn btn-primary" type="submit">Cetak</a>
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
