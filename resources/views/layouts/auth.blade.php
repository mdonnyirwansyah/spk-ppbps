@extends('layouts.skeleton')

@section('body')
      <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 p-4">
        <header class="login-brand">
          <img src="{{ asset('assets/img/bps-kota-pekanbaru.png') }}" alt="Logo BPS Kota Pekanbaru" width="250px">
        </header>
        <main>
            @yield('content')
        </main>
        <footer class="simple-footer">
          Copyright &copy; {{ config('app.name') }} {{ date('Y') }}
        </footer>
      </div>
@endsection
