@extends('layouts.app')

@section('title', 'Transformasi Data')

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
                        <th scope="col" rowspan="2" width="5">No</th>
                        <th scope="col" rowspan="2">Alternatif</th>
                        <th scope="col" colspan="{{ $preference->sub_criterias->count() }}" class="text-center">Kriteria</th>
                    </tr>
                    <tr>
                        @foreach ($preference->sub_criterias as $key => $item)
                            <th scope="col">{{ 'C'.($key+1) }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($preferences as $key => $item)
                        <tr>
                            <td scope="row">{{ $key+1 }}</td>
                            <td scope="row">{{ $item->candidate->name }}</td>
                            @foreach ($item->sub_criterias as $value)
                                <td scope="row">{{ $value->weight }}</td>
                            @endforeach
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
