@extends('layouts.app')

@section('title', 'Penilaian')

@push('javascript')
@include('app.assessment.actions')
<script>
    $(document).ready( function() {
        $('#assessments-table').DataTable();
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
        <h1>{{ $recruitment->title }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('assessment.index') }}">Penilaian</a>
            </div>
            <div class="breadcrumb-item">{{ $recruitment->title }}</div>
        </div>
    </div>
  <div class="section-body">
    <div class="card">
      <div class="card-body">
        <div class="col-12">
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" aria-selected="true">Penilaian</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('assessment.weight', $recruitment) }}" aria-selected="false">Bobot</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('assessment.preference', $recruitment) }}" aria-selected="false">Preferensi</a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade show active">
                <table id="assessments-table" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th rowspan="2" style="vertical-align: middle;">No</th>
                            <th rowspan="2" style="vertical-align: middle;">Nama</th>
                            <th colspan="{{ $recruitment->criterias->count() }}" style="text-align: center;">Kriteria</th>
                            <th rowspan="2" style="vertical-align: middle;">Aksi</th>
                        </tr>
                        <tr>
                            @foreach ($recruitment->criterias as $criteria)
                                <th>{{ $criteria->name }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($recruitment->candidates as $index => $candidate)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $candidate->name }}</td>
                            <form action="{{ route('assessment.store') }}" id="update-assessment-{{ $candidate->id }}">
                                <input type="hidden" name="recruitment" value="{{ $recruitment->id }}"/>
                                <input type="hidden" name="candidate" value="{{ $candidate->id }}"/>
                                @foreach ($recruitment->criterias as $criteria)
                                    <td>
                                        <input type="hidden" name="criterias[]" value="{{ $criteria->id }}"/>
                                        <select class="form-control" style="width: 100%" name="sub_criterias[]">
                                            <option selected disabled>Pilih</option>
                                            @foreach ($criteria->sub_criterias as $sub_criteria)
                                                <option value="{{ $sub_criteria->weight }}"
                                                    @foreach ($candidate->assessments as $assessment)
                                                        {{ ($criteria->id == $assessment->criteria_id &&
                                                        $sub_criteria->weight == $assessment->weight) ? 'selected' : '' }}
                                                    @endforeach>
                                                    {{ $sub_criteria->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                @endforeach
                                <td>
                                    <button type="submit" id="btn" data-toggle="tooltip" data-placement="top" title="Simpan" onClick="updateAssessment({{ $candidate->id }})" class="btn btn-icon">
                                        <i class="fas fa-save text-primary"></i>
                                    </button>
                                </td>
                            </form>
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
