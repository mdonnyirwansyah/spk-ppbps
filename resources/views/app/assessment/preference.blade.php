@extends('layouts.app')

@section('title', 'Preferensi')

@push('javascript')
@include('app.assessment.actions')
<script>
    $(document).ready( function() {
        $('#preference-table').DataTable();
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
              <a class="nav-link" href="{{ route('assessment.assessment', $recruitment) }}" aria-selected="false">Penilaian</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('assessment.weight', $recruitment) }}" aria-selected="false">Bobot</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-selected="true">Preferensi</a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade show active">
                <table id="preference-table" class="table table-bordered table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th rowspan="2" style="vertical-align: middle;">Rank.</th>
                            <th rowspan="2" style="vertical-align: middle;">Nama</th>
                            <th colspan="4" style="text-align: center;">Kriteria</th>
                            <th rowspan="2" style="vertical-align: middle;">Skor</th>
                            <th rowspan="2" style="vertical-align: middle;">Status</th>
                            <th rowspan="2" style="vertical-align: middle;">Aksi</th>
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
                                <td>{{$index+1}}</td>
                                <td>{{$result['name']}}</td>
                                @foreach ($result['criteria'] as $key => $criteria)
                                    <td>
                                        {{$criteria['result']}}
                                    </td>
                                @endforeach
                                <td>
                                    {{$result['score']}}
                                </td>
                                <form action="{{ route('candidate.update-status', $result['slug']) }}" id="update-status-{{ $result['id'] }}" enctype="multipart/form-data">
                                    @method('PUT')
                                    <td>
                                        <select class="form-control" style="width: 100%" name="status">
                                            <option selected disabled>Pilih</option>
                                            <option value="Lulus" {{ ($result['status'] == 'Lulus' ? 'selected' : '') }}>Lulus</option>
                                            <option value="Tidak Lulus" {{ ($result['status'] == 'Tidak Lulus' ? 'selected' : '') }}>Tidak Lulus</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button type="submit" id="btn" data-toggle="tooltip" data-placement="top" title="Simpan" onClick="updateStatus({{ $result['id'] }})" class="btn btn-icon">
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