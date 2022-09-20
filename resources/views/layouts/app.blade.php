@extends('layouts.skeleton')

@section('body')
<div class="main-wrapper">
  <header>
    <div class="navbar-bg"></div>
    <nav class="navbar navbar-expand-lg main-navbar">
        @include('partials.topnav')
    </nav>
  </header>

  <aside class="main-sidebar">
    @include('partials.sidebar')
  </aside>

  <!-- Main Content -->
  <main class="main-content">
    @yield('content')
  </main>

  <footer class="main-footer">
    @include('partials.footer')
  </footer>
</div>
@endsection
