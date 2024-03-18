  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link @yield('dashboard')" href="{{ route('mechanic') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link @yield('appointment')" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>My Appointments</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse @yield('appointment.show')" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('appointment.pending') }}" class="@yield('pending.appointment.active')">
              <i class="bi bi-circle"></i><span>Pending Appointments</span>
            </a>
          </li>
          <li>
            <a href="{{ route('appointment') }}" class="@yield('appointment.active')">
              <i class="bi bi-circle"></i><span>Appointments</span>
            </a>
          </li>
          <li>
            <a href="{{ route('appointment.history') }}" class="@yield('history.appointment.active')">
              <i class="bi bi-circle"></i><span>Appointments History</span>
            </a>
          </li>
        </ul>
      </li><!-- End Appointments Page Nav -->
      <li class="nav-item">
        <a class="nav-link @yield('messages')" href="{{ route('messages') }}">
          <i class="bi bi-grid"></i>
          <span>Messages</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link @yield('settings')" href="{{ route('mechanic.settings') }}">
          <i class="bi bi-grid"></i>
          <span>Settings</span>
        </a>
      </li>
    </ul>

   

  </aside>
  <!-- End Sidebar-->