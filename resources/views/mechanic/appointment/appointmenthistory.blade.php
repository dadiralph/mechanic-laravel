@extends('mechanic.mechanic_layouts.app')

@section('page_title', 'Auto Mechanics | Appointments History')
@section('dashboard', 'collapsed')
@section('appointment.show', 'show')
@section('history.appointment.active', 'active')
@section('settings', 'collapsed')


@section('content')
    
<div class="pagetitle">
    <h1>Appointments</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item active">Appointments History</li>
      </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
      
      <!-- Recent Sales -->
      <div class="col-12">
        <div class="card recent-sales overflow-auto">

            <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
            </div>

            <div class="card-body">
                <h5 class="card-title">Appointments <span>| Today</span></h5>

                <table class="table table-borderless datatable">
                <thead>
                    <tr>
                    <th scope="col">Customer</th>
                    <th scope="col">Address (province, city, brgy, street (landmark))</th>
                    <th scope="col">Appointment Type</th>
                    <th scope="col">Date & Time</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                    <tr>
                    <td>
                    {{ $appointment['client']['name']['first_name'] }} {{ $appointment['client']['name']['middle_name']}} 
            {{$appointment['client']['name']['last_name'] }} {{ $appointment['client']['name']['suffix'] }}
        </td>
                <td>{{ $appointment['client']['address']['province'] }}, {{ $appointment['client']['address']['city']
                  }}, {{
        $appointment['client']['address']['barangay'] }}, {{ $appointment['client']['address']['street'] }}
                  ({{ $appointment['client']['address']['landmark'] }})
                </td>
                <td>{{$appointment['appointment_type']}}</td>
                <td>{{ $appointment['date_start'] }} ({{ \Carbon\Carbon::createFromFormat(
        'H:i',
        $appointment['start_time']
    )->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat(
        'H:i',
        $appointment['end_time']
    )->format('h:i A') }})</td>
                <td><span class="badge bg-warning">{{ $appointment['status'] }}</span></td>
                        <td>
                        <a class="view-appointment" data-appointment-id="{{ $appointment['id'] }}">View</a>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>

            </div>

        </div>
      </div><!-- End Recent Sales -->

    </div>
</section>

<!-- The Modal for viewing the pending appointment -->
<div class="modal fade" id="appointmentDetailsModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Appointment Details</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
        <!-- Customer Information -->
        <h5>Customer Information</h5>
        <p><strong>Name:</strong> <span id="fullname">

        </span></p>
        <p><strong>Address:</strong> <span id="address"></span></p>

        <!-- Appointment Information -->
        <h5>Appointment Information</h5>
        <p><strong>Date:</strong> <span id="date_start"></span></p>
        <p><strong>Time:</strong> <span id="time"></span></p>
        <p><strong>Appointment Type:</strong> <span id="appointmenttype"></span></p>

        <!-- Vehicle Information -->
        <h5>Vehicle Information</h5>
        <p><strong>Make:</strong> <span id="make"></span></p>
        <p><strong>Model:</strong> <span id="model"></span></p>

        <!-- Additional Notes and Images -->
        <h5>Additional Notes</h5>
        <p id="note"></p>

        <h5>Problem Image</h5>
        <!-- Display problem images here -->
        <img src="" alt="Problem Image" id="problem_image">

        <!-- Selected Services -->
        <h5>Selected Services</h5>
        <p id="selected_services"></p>

      </div>

      <!-- Modal Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<script>
  // Script to handle edit button click
  $('.view-appointment').on('click', function () {
    var appointmentId = $(this).data('appointment-id');
    var modal = $('#appointmentDetailsModal');
    modal.modal('show');

    // Fetch lot type data by ID using AJAX and populate the modal fields
    $.ajax({
      url: '/mechanic/view-appointment/' + appointmentId,
      type: 'GET',
      dataType: 'json',
      success: function (response) {
        // Populate modal fields with fetched data
        modal.find('[id="fullname"]').text(response.client_name);
        modal.find('[id="address"]').text(response.client_address);
        modal.find('[id="date_start"]').text(response.date_start);
        modal.find('[id="time"]').text(response.time);
        modal.find('[id="appointmenttype"]').text(response.appointment_type);
        modal.find('[id="make"]').text(response.make);
        modal.find('[id="model"]').text(response.model);
        modal.find('[id="notes"]').text(response.services);
        modal.find('[id="problem_image"]').attr('src',response.problem_image);
        modal.find('[id="selected_services"]').text(response.services);

      },
      error: function (xhr) {
        // Handle error, e.g., show an error message to the user.
      }
    });
  });

</script>


@endsection