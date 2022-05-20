<aside id="sidebar-wrapper">
  <div class="sidebar-brand">
    <a href="">{{ config('app.name') }}</a>
  </div>
  <div class="sidebar-brand sidebar-brand-sm">
    <a href="#">{{ strtoupper(substr(config('app.name'), 0, 2)) }}</a>
  </div>
  <ul class="sidebar-menu">
    <li class="{{ request()->is('/') ? 'active' : '' }}">
      <a class="nav-link" href="{{ url('/') }}">
        <i class="fas fa-chart-pie"></i> <span>Dashboard</span>
      </a>
    </li>
  </ul>
</aside>
