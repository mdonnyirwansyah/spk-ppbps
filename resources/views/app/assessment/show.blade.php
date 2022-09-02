@extends('layouts.app')

@section('title', 'Penilaian')

@push('javascript')
@include('app.assessment.actions')
<script>
    $(document).ready( function() {
        $('#assessments-table').DataTable();
        $('#matriks-table').DataTable();
        $('#preferences-table').DataTable();
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
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="assessments-tab" data-toggle="tab" href="#assessments" role="tab" aria-controls="assessments" aria-selected="true">Penilaian</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="matriks-tab" data-toggle="tab" href="#matriks" role="tab" aria-controls="matriks" aria-selected="false">Matriks</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="preferences-tab" data-toggle="tab" href="#preferences" role="tab" aria-controls="preferences" aria-selected="false">Preferensi</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            @include('app.assessment.partials.assessments')
            @include('app.assessment.partials.matriks')
            @include('app.assessment.partials.preferences')
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
