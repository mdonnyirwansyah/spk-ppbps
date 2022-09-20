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
                    <h2 style="font-size: 18px; color: #34395e">Jumlah Rekrutmen</h2>
                </div>
                <div class="card-body">
                    <p style="font-size: 16px">
                        <b>{{ $totalRecruitment }}</b>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="summary">
                    <div class="summary-info">
                        <h2 style="font-size: 18px; color: #34395e">
                            <b>Selamat Datang di Sistem Pendukung Keputusan Penerimaan Petugas BPS Kota Pekanbaru</b>
                        </h4>
                    </div>
                    <div class="summary-item">
                        <h3 style="font-size: 16px; color: #34395e">
                            <b>Daftar Rekrutmen Terbaru</b>
                        </h3>
                        <ul class="list-unstyled list-unstyled-border">
                            @foreach ($recruitment as $item)
                                <li class="media ml-2">
                                    <div class="media-body">
                                        <h4 class="media-title" style="font-size: 14px">{{ $item->title }}</h4>
                                        <p class="media-right text-muted" style="font-size: 12px">{{ $item->candidates->count() }} Kandidat</p>
                                        <p class="text-muted text-small">
                                            <span class="bullet"></span> {{ $item->created_at->diffForHumans() }}
                                        </p>
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
