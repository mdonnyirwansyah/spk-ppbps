@extends('layouts.app')

@section('title', 'Edit Sub Kriteria')

@push('javascript')
@if ($message = Session::get('error'))
  <script>
      swal('Pemberitahuan', '{{ $message }}');
  </script>
@endif
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('sub-criteria.index') }}" class="btn btn-icon">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <h1>Edit Sub Kriteria</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('sub-criteria.index') }}">Sub Kriteria</a>
            </div>
            <div class="breadcrumb-item">Edit Sub Kriteria</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('sub-criteria.update', $subCriteria) }}" enctype="multipart/form-data">
                            @method('PUT')
                            @include('app.sub-criteria.partials.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
