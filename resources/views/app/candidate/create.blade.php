@extends('layouts.app')

@section('title', 'Tambah Kandidat')

@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('candidate.index') }}" class="btn btn-icon">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <h1>Tambah Kandidat</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('candidate.index') }}">Kandidat</a>
            </div>
            <div class="breadcrumb-item">Tambah Kandidat</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('candidate.store') }}" enctype="multipart/form-data">
                            @include('app.candidate.partials.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
