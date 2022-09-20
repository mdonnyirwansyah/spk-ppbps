@extends('layouts.app')

@section('title', 'Edit Tema Rekrutmen')

@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('recruitment.index') }}" class="btn btn-icon">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <h1>Edit Tema Rekrutmen</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('recruitment.index') }}">Tema Rekrutmen</a>
            </div>
            <div class="breadcrumb-item">Edit Tema Rekrutmen</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('recruitment.update', $recruitment) }}" enctype="multipart/form-data" autocomplete="off">
                            @method('PUT')
                            @include('app.recruitment.partials.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
