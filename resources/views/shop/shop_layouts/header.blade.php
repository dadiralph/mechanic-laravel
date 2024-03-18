<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="index.html" class="logo d-flex align-items-center">
      <img src="assets/img/logo.png" alt="">
      <span class="d-none d-lg-block">Shop Admin</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->



  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      {{-- Notification --}}
      {{--
      @foreach ($appointmentnotificationsrealtime as $notification)
      <li class="nav-item dropdown" id="{{ $notification->id }}">

        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-bell"></i>
          @if ($notification->unread)
          <span class="badge bg-primary badge-number pending">{{ $notification->unread }}</span>
          @endif
        </a>

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
          <li class="dropdown-header">
            @if ($notification->unread)
            You have {{ $notification->unread }} new notifications
            @endif
            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <div class="notification-content">
            @foreach ($appointmentnotifications as $notificationlink)
            <a href="{{ route('appointment.pending') }}">
              <li class="notification-item">
                <i class="bi bi-exclamation-circle text-warning"></i>
                <div>
                  <h4>{{ $notificationlink->message }}</h4>
                  <p>Pending Appointment Waiting for Approval</p>
                  <p>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $notificationlink->created_at)->format('h:i A')
                    }}
                  </p>
                </div>
              </li>
            </a>
            @endforeach
          </div>

          <li>
            <hr class="dropdown-divider">
          </li>
          <li class="dropdown-footer">
            <a href="#">Mark All Read</a>
          </li>

        </ul><!-- End Notification Dropdown Items -->

      </li>
      @endforeach
      --}}
      <!-- End Notification Nav -->

      {{-- Profile --}}
      <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="{{ auth()->user()->profileURL}}" width="34" height="34" alt="Profile" class="rounded-circle">
          <span class="d-none d-md-block dropdown-toggle ps-2">
            {{ ucwords(Auth::user()->displayName) }}
          </span>
        </a><!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6>
            {{ ucwords(Auth::user()->displayName) }}
            </h6>
            {{--
            @if(Auth::user() && Auth::user()->role == 'admin')
            <span>Administrator</span>
            @elseif(Auth::user() && Auth::user()->role == 'mechanic')
            <span>Mechanic</span>
            @endif
            --}}
            <span>Shop Admin</span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <!-- <li>
            <a class="dropdown-item " href="users-profile.html">
              <i class="bi bi-gear"></i>
              <span>Account Settings</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li> -->


          <li>
            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
              <i class="bi bi-box-arrow-right"></i>
              <span>Sign Out</span>
            </a>
          </li>



        </ul><!-- End Profile Dropdown Items -->
      </li>
      <!-- End Profile Nav -->
    </ul>
  </nav><!-- End Icons Navigation -->

</header>
<!-- End Header -->