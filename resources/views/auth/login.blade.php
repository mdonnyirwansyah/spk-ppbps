@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="text-dark" style="font-size: 16px">{{ __('Login') }}</h1>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('login') }}" autocomplete="off">
            @csrf
            <div class="form-group">
                <label for="email" class="control-label">{{ __('Email') }}</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $email ?? old('email') }}">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <small>{{ $message }}</small>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password" class="control-label">{{ __('Password') }}</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <small>{{ $message }}</small>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-lg btn-block btn-primary">{{ __('Login') }}</button>
        </form>
    </div>
</div>
@endsection
