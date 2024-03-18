<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('page_title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('adminassets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('adminassets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('adminassets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('adminassets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('adminassets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('adminassets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('adminassets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('adminassets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('adminassets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('adminassets/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: May 30 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  {{-- cdnjs link for jquery --}}
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  {{-- toastr notifications cdn --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  	<!-- selectize js cdn -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
  <link href="https://api.mapbox.com/mapbox-gl-js/v3.1.2/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v3.1.2/mapbox-gl.js"></script>
    <style>
        #map {
            width: 100%;
            aspect-ratio: 16 / 7;
        }
    </style>
</head>

<body>

  <!-- ======= Header ======= -->
  @include('shop.shop_layouts.header')
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  @include('shop.shop_layouts.sidebar')
  <!-- End Sidebar-->

  <main id="main" class="main">

    @yield('content')

  </main><!-- End #main -->

  {{-- Footer --}}
  @include('shop.shop_layouts.footer')
  {{-- End Footer --}}

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('adminassets/vendor/apexcharts/apexcharts.min.js') }} "></script>
  <script src="{{ asset('adminassets/vendor/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
  <script src="{{ asset('adminassets/vendor/chart.js/chart.umd.js') }} "></script>
  <script src="{{ asset('adminassets/vendor/echarts/echarts.min.js') }} "></script>
  <script src="{{ asset('adminassets/vendor/quill/quill.min.js') }} "></script>
  <script src="{{ asset('adminassets/vendor/simple-datatables/simple-datatables.js') }} "></script>
  <script src="{{ asset('adminassets/vendor/tinymce/tinymce.min.js') }} "></script>
  <script src="{{ asset('adminassets/vendor/php-email-form/validate.js') }} "></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('adminassets/js/main.js') }}"></script>


  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script>
    $(document).ready(function() {

      var pusher = new Pusher('6da4bce044b823839e00', {
        cluster: 'ap2'
      });

      var channel = pusher.subscribe('my-channel');
      channel.bind('my-event', function(data) {
        if(data.client_id) {
          let pending = parseInt($('#' + data.client_id).find('.pending').html());
          if(pending) {
            $('#' + data.client_id).find('.pending').html(pending + 1);
          } else {
            $('#' + data.client_id).html('<a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-bell"></i><span class="badge bg-primary badge-number pending">1</span></a>');
          }
        }

        // Fetch and update notification content dynamically
        updateNotificationDropdownContent();
      });

      function updateNotificationDropdownContent() {
          // Make an AJAX request to fetch the latest notifications from the server
          $.ajax({
              url: '/mechanic/fetch-appointmentnotifications', // Replace with your actual route
              method: 'GET',
              success: function (data) {
                  // Assuming data is an array of notification items
                  var notificationsHtml = '';
                  data.forEach(function (notification) {
                      var date = new Date(notification.created_at);
                      var formattedTime = date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                      
                      notificationsHtml += '<a href="">';
                      notificationsHtml += '<li class="notification-item">';
                      notificationsHtml += '<i class="bi bi-exclamation-circle text-warning"></i>';
                      notificationsHtml += '<div>';
                      notificationsHtml += '<h4>' + notification.message + '</h4>';
                      notificationsHtml += '<p>Pending Appointment Waiting for Approval</p>';
                      notificationsHtml += '<p>' + formattedTime + '</p>';
                      notificationsHtml += '</div>';
                      notificationsHtml += '</li>';
                      notificationsHtml += '</a>';
                  });

                  // Update the notification dropdown content
                  $('.notification-content').html(notificationsHtml);
              },
              error: function (error) {
                  console.log('Error fetching notifications: ', error);
              }
          });
      }

    })
  </script>

  @yield('mechanic-view-modal-script')

  {{-- toastr notifications cdn --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- selectize js cdn -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js" integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>
    $('#services').selectize({ 
        create: false,
        maxItems: null,
        placeholder: 'Select services...',
        plugins: ['remove_button'],
     })
  </script>

  @yield('toastr_script')

</body>

</html>