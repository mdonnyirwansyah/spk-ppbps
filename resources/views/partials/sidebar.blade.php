<aside id="sidebar-wrapper">
  <div class="sidebar-brand">
    <a href="">{{ config('app.name') }}</a>
  </div>
  <div class="sidebar-brand sidebar-brand-sm">
    <a href="#">{{ strtoupper(substr(config('app.name'), 0, 2)) }}</a>
  </div>
  <nav>
    <ul class="sidebar-menu">
        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-chart-pie"></i>
            <span>Dashboard</span>
          </a>
        </li>

        <li class="dropdown {{ request()->routeIs('recruitment.*') || request()->routeIs('criteria.*') || request()->routeIs('sub-criteria.*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                <i class="fas fa-database"></i>
                <span>Data Master</span>
            </a>
            <ul class="dropdown-menu">
              <li class="dropdown {{ request()->routeIs('recruitment.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('recruitment.index') }}">Tema Rekrutmen</a>
              </li>
              <li class="dropdown {{ request()->routeIs('criteria.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('criteria.index') }}">Kriteria</a>
              </li>
              <li class="dropdown {{ request()->routeIs('sub-criteria.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('sub-criteria.index') }}">Sub-Kriteria</a>
              </li>
            </ul>
        </li>

        <li class="{{ request()->routeIs('candidate.*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('candidate.index') }}">
            <i class="fas fa-users"></i>
            <span>Kandidat</span>
          </a>
        </li>

        <li class="{{ request()->routeIs('assessment.*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('assessment.index') }}">
            <i class="fas fa-sort-amount-down-alt"></i>
            <span>Penilaian</span>
          </a>
        </li>

        <li class="{{ request()->routeIs('report.*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('report.index') }}">
            <i class="fas fa-print"></i>
            <span>Laporan</span>
          </a>
        </li>

        <li class="{{ request()->routeIs('account.profile-information') || request()->routeIs('account.update-password') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('account.profile-information') }}">
            <i class="fas fa-user-cog"></i>
            <span>Akun</span>
          </a>
        </li>
      </ul>
  </nav>
</aside>
