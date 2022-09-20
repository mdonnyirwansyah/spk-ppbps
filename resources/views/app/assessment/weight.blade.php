@extends('layouts.app')

@section('title', 'Bobot')

@push('javascript')
<script>
    $(document).ready( function() {
        $('#weight-table').DataTable();
    });
</script>
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('assessment.index') }}" class="btn btn-icon">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <h1>Bobot</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('assessment.index') }}">Filter Penilaian</a>
            </div>
            <div class="breadcrumb-item">Bobot</div>
        </div>
    </div>
  <div class="section-body">
    <div class="card">
      <div class="card-body">
        <div class="col-12">
          <h2 style="font-size: 18px; color: #34395e">{{ $recruitment->title }}</h2>
          <hr>
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('assessment.assessment', $recruitment) }}" aria-selected="false">Penilaian</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-selected="true">Bobot</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('assessment.preference', $recruitment) }}" aria-selected="false">Preferensi</a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade show active">
                <table id="weight-table" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th rowspan="2" style="vertical-align: middle;">No</th>
                            <th rowspan="2" style="vertical-align: middle;">Nama</th>
                            <th colspan="{{ $recruitment->criterias->count() }}" style="text-align: center;">Kriteria</th>
                        </tr>
                        <tr>
                            @foreach ($recruitment->criterias as $criteria)
                                <th>{{ $criteria->name }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($candidates as $index => $candidate)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $candidate->name }}</td>
                            @foreach ($recruitment->criterias as $criteria)
                                <td>
                                    @foreach ($criteria->sub_criterias as $sub_criteria)
                                        @foreach ($candidate->assessments as $assessment)
                                            {{ ($criteria->id == $assessment->criteria_id &&
                                            $sub_criteria->weight == $assessment->weight) ? $assessment->weight : '' }}
                                        @endforeach
                                    @endforeach
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
