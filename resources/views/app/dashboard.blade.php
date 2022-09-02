@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Dashboard</h1>
  </div>

  <div class="row">
    <div class="col-md-4 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-icon shadow-primary bg-primary">
                <i class="fas fa-award"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Jumlah Rekrutmen</h4>
                </div>
                <div class="card-body">
                    {{ $totalRecruitment }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="summary">
                    <div class="summary-info">
                        <h4>Selamat Datang di Sistem Pendukung Keputusan Penerimaan Petugas BPS Kota Pekanbaru</h4>
                    </div>
                    <div class="summary-item">
                        <h6>Daftar Rekrutmen Terbaru</h6>
                        <ul class="list-unstyled list-unstyled-border">
                            @foreach ($recruitment as $item)
                                <li class="media ml-2">
                                    <div class="media-body">
                                        <div class="media-right">{{ $item->candidates->count() }} Kandidat</div>
                                        <div class="media-title">{{ $item->title }}</div>
                                        <div class="text-muted text-small"><div class="bullet"></div> {{ $item->created_at->diffForHumans() }}</div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</section>
@endsection
