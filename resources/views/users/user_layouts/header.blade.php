<!-- ======= Header ======= -->
<script>
  function formatTimeAgo(timestampString) {
    const timestamp = new Date(timestampString);
    const now = new Date();
    const diff = Math.floor((now - timestamp) / 1000); // Convert milliseconds to seconds

    const minute = 60;
    const hour = minute * 60;
    const day = hour * 24;
    const month = day * 30;
    const year = day * 365;

    if (diff >= year) {
      const years = Math.floor(diff / year);
      return years + ' year' + (years > 1 ? 's' : '') + ' ago';
    } else if (diff >= month) {
      const months = Math.floor(diff / month);
      return months + ' month' + (months > 1 ? 's' : '') + ' ago';
    } else if (diff >= day) {
      const days = Math.floor(diff / day);
      return days + ' day' + (days > 1 ? 's' : '') + ' ago';
    } else if (diff >= hour) {
      const hours = Math.floor(diff / hour);
      return hours + ' hour' + (hours > 1 ? 's' : '') + ' ago';
    } else {
      const minutes = Math.floor(diff / minute);
      return minutes + ' minute' + (minutes > 1 ? 's' : '') + ' ago';
    }
  }
</script>
<header id="header" class="fixed-top d-flex align-items-center  @yield('transparent-header') ">
  <div class="container d-flex align-items-center justify-content-between">

    <div class="logo">
      <h1><a href="{{ route('index') }}" class="d-lg-flex d-none">Auto Mechanics</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
    </div>

    <nav id="navbar" class="navbar mx-lg-auto me-auto">
      <ul>
        <li><a class="nav-link scrollto @yield('home')" href="{{ route('index') }}">Home</a></li>
        <li><a class="nav-link scrollto @yield('workshop')" href="{{ route('workshop') }}">Workshop Look-Up</a></li>
        <li><a class="nav-link scrollto @yield('freelancers')" href="{{route('freelancers')}}">Freelancers</a></li>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

    <div class="d-flex align-items-center">

      <!--Search Button-->
      <button class="btn btn-secondary fw-bold me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop" title="Search" style="background:none;color:#fffffe;">
        <i class="bx bx-search"></i>
      </button>

      @if(auth()->user() != null)
      <!--Search Button-->
      <a href="{{ route('chats')}}" class="btn btn-secondary fw-bold me-2" title="Messenger" style="background:none;color:#fffffe;">

        <i class="bx bxl-messenger"></i>
      </a>

      <!-- Notification button -->
      <div class="dropdown">

        <button class="btn  btn-secondary px-2 fw-bold  my-2" title="Notifications" type="button" id="dropdownMenuNotif" data-bs-toggle="dropdown" aria-expanded="false" style="background:none;color:#fffffe;">

          <i class="bx bx-bell position-relative px-0 fs-5">
            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
              <span class="visually-hidden">New alerts</span>
            </span>
          </i>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuNotif">
            <!-- <li><a class="dropdown-item fw-bold text-lg-center text-start" href="#">You have 4 new notifications </a>
            </li> -->
            <li>
              <hr class="dropdown-divider">
            </li>
            @foreach (Auth::user()->notifications as $notification)
            @php
            $timestamp = $notification['timestamp']; // Assuming 'timestamp' is the field in your notification for the timestamp
            @endphp

            <li class="align-items-center d-flex px-lg-4 px-0">
              <i class="bx bx-alarm-exclamation fs-3"></i>
              <a class="dropdown-item fw-bold" href="#">
                Appointment Update
                <br>
                <span class="fw-normal">{{ htmlspecialchars($notification['message']) }}</span><br>
                <span class="fw-normal" id="timeAgo{{$loop->index}}"></span>
              </a>
            </li>

            <script>
              // Use Blade to inject PHP variables into JavaScript
              document.getElementById('timeAgo{{$loop->index}}').innerText = formatTimeAgo('{{$timestamp}}');
            </script>
            @endforeach
            <li>
              <hr class="dropdown-divider">
            </li>
            <!-- <li><a class="dropdown-item text-lg-center text-start" href="#">Show all notifications</a></li> -->
          </ul>
        </button>

      </div>


      <!-- button for Profile -->
      <div class="dropdown">
        <button class="btn dropdown-toggle fs-5 text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="border:none;">
          <img src="{{ auth()->user()->profileURL}}" alt="profile" width="34" height="34" class="rounded-circle ">
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
          <li><a class="dropdown-item fw-bold" href="#">
              <img src="{{ auth()->user()->profileURL}}" alt="" class="rounded-circle me-2" width="25" height="25">
              {{ ucwords(Auth::user()->displayName) }}
            </a>
            <span class="px-5 fw-semi-italic">{{ auth()->user()->email}}</span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <!-- <li>
            <a class="dropdown-item" href="account.html"><i class="bx bx-cog me-2"></i>Account Settings</a>
          </li> -->
          <li>
            <a class="dropdown-item" href="{{ route('settings.client') }}"><i class="bx bx-cog me-2"></i>Account settings</a>
          </li>
          <li>
            <a class="dropdown-item" href="{{ route('appointment.client') }}"><i class="bx bx-bookmarks me-2"></i>Appointment Status</a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="{{ route('logout')}}"><i class="bx bx-exit me-2"></i>Sign-out</a></li>
        </ul>
      </div>
      @else
      <a href="{{ route('login') }}" class="btn btn-secondary me-2 border-2" style="background:none;color:#fffffe;">Login</a>
      <!-- modal sign-up triggerd msg-->
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background:#ff8906;color:#fffffe;border:none;">Sign-up
      </button>

      <!-- Modal -->
      <div class="modal " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content" style="z-index: 100000;">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Sign-up Warning</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="text-center">
                <h2 class="fs-4 fw-bold my-4">Welcome!</h2>
                <h3 class="fs-5">Choose where you Sign-up with:</h3>
              </div>
              <div class="text-center my-5">

                <a href="{{ route('signup.mechanic') }}" class="btn border shadow btn-floating mx-1 mb-lg-0 mb-3" style="background:#2e2f3e; color: #a7a9be;">
                  <span>Mechanics</span>
                </a>

                <a href="{{ route('signup.vehicle') }}" class="btn border shadow btn-floating mx-1 mb-lg-0 mb-3" style="background:#2e2f3e; color: #a7a9be;">
                  <span>Vehicle Owner</span>
                </a>

                <a href="{{ route('signup.shop') }}" class="btn border shadow btn-floating mx-1 mb-lg-0 mb-3" style="background:#2e2f3e; color: #a7a9be; ">
                  <span>Shop Owner</span>
                </a>

              </div>

            </div>

          </div>
        </div>
      </div>
      @endif
    </div>


    <!-- offcanvas trigger Search Bar -->
    <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
      <div class="offcanvas-header" style="background:#0f0e17; color:#fffffe;">
        <h5 id="offcanvasTopLabel">Search any characters</h5>
        <button type="button" class="btn-close text-reset " data-bs-dismiss="offcanvas" aria-label="Close" style="background-color:#eee;"></button>
      </div>
      <div class="offcanvas-body" style="background:#0f0e17;">
        <div class="container">
          <form action="{{ route('search.post') }}" method="POST">
            @csrf
            <div class="d-flex flex-row">
            <input class="input bg-white" name="search" placeholder="Type your text" required type="text">
              <button type="submit">
                <svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="search">
                  <path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9" stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
              </button>
            </div>
            <button class="reset" type="reset">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- End Header -->