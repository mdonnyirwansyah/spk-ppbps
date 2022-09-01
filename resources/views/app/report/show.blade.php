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
        <h1>{{ $recruitment->title }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('report.index') }}">Laporan</a>
            </div>
            <div class="breadcrumb-item">{{ $recruitment->title }}</div>
        </div>
    </div>
  <div class="section-body">
    <div class="card">
      <div class="card-body">
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Cetak</button>
            <hr>
            <table id="report-table" class="table table-bordered table-striped dt-responsive nowrap">
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Nama</th>
                        @foreach ($recruitment->criterias as $criteria)
                            <th>{{ $criteria->name }}</th>
                        @endforeach
                        <th>Skor</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($recruitment->candidates as $index => $candidate)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $candidate->name }}</td>
                        @foreach ($recruitment->criterias as $criteria)
                            <td>
                                @foreach ($criteria->sub_criterias as $sub_criteria)
                                    @foreach ($candidate->assessments as $assessment)
                                        {{ ($criteria->id == $assessment->criteria_id &&
                                        $sub_criteria->weight == $assessment->weight) ? $sub_criteria->name : '' }}
                                    @endforeach
                                @endforeach
                            </td>
                        @endforeach
                        <td></td>
                        <td></td>
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
