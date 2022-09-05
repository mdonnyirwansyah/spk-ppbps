@extends('layouts.app')

@section('title', 'Laporan')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Laporan</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active">
        <a href="{{ route('dashboard') }}">Dashboard</a>
      </div>
      <div class="breadcrumb-item">Laporan</div>
    </div>
  </div>
  <div class="section-body">
    <div class="card">
      <div class="card-body">
        <div class="col-12">
          <div class="section-header-button d-flex flex-column">
            <form class="form-inline" method="POST" action="{{ route('report.filter') }}">
                @csrf
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button class="btn btn-primary" type="submit">Pilih</button>
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
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
