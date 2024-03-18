@extends('shop.shop_layouts.app')

@section('page_title', 'Shop | Appointments Pending')
@section('dashboard', 'collapsed')
@section('appointment.show', 'show')
@section('pending.appointment.active', 'active')
@section('messages', 'collapsed')
@section('location', 'collapsed')


@section('content')

<div class="pagetitle">
  <h1>Appointments</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Pending Appointments</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">

    <!-- Recent Sales -->
    <div class="col-12">
      <div class="card recent-sales overflow-auto">

        <div class="card-body">
          <h5 class="card-title">My Appointments <span>| Pending</span></h5>

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
              @foreach ($pendingappointments as $pending)
              <tr>
                <td>{{ $pending['client']['name']['first_name'] }} {{ $pending['client']['name']['middle_name'] }} {{ $pending['client']['name']['last_name'] }} {{ $pending['client']['name']['suffix'] }}</td>
                <td>{{ $pending['client']['address']['province'] }}, {{ $pending['client']['address']['city'] }}, {{
                  $pending['client']['address']['barangay'] }}, {{ $pending['client']['address']['street'] }}
                  ({{ $pending['client']['address']['landmark'] }})
                </td>
                <td>{{$pending['appointment_type']}}</td>
                <td>{{ $pending['date_start'] }} ({{ \Carbon\Carbon::createFromFormat('H:i',
                  $pending['start_time'])->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i',
                  $pending['end_time'])->format('h:i A') }})</td>
                <td><span class="badge bg-warning">{{ $pending['status'] }}</span></td>
                <td>
                  <div class="d-flex flex-column">
                    <a class="approve-appointment" data-appointment-id="{{ $pending['id'] }}" data-toggle="modal"
                      data-target="#approveAppointmentModal">Accept</a>
                    <a class="view-appointment" data-appointment-id="{{ $pending['id'] }}" data-toggle="modal"
                      data-target="#appointmentDetailsModal">View</a>
                    <a class="reject-appointment" data-appointment-id="{{ $pending['id'] }}" data-toggle="modal"
                      data-target="#rejectAppointmentModal">Reject</a>
                  </div>
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

<!-- The Modal for comfirming of approving appointment -->
<div class="modal fade" id="approveAppointmentModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Approve Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to approve this appointment?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form id="approveForm" action="{{ route('appointment.approve') }}" method="POST">
          @csrf
          <input type="hidden" id="appointmentId" name="appointmentId" value="">
          <button type="submit" class="btn btn-primary">Approve</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- The Modal for comfirming of rejecting appointment -->
<div class="modal fade" id="rejectAppointmentModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Reject Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="rejectForm" action="{{ route('appointment.reject') }}" method="POST">
        @csrf
        <div class="modal-body">
          <p>Are you sure you want to Reject this appointment?</p>
          <div class="form-floating mb-3">
            <textarea class="form-control" name="reason" id="reason" required placeholder="Leave a reason here"
              id="floatingTextarea" style="height: 100px;"></textarea>
            <label for="floatingTextarea">Reason</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="hidden" id="appointmentId" name="appointmentId" value="">
          <button type="submit" class="btn btn-primary">Reject</button>
        </div>
      </form>
    </div>
  </div>
</div>


@endsection

@section('mechanic-view-modal-script')

{{-- script for Viewing appointment Modal --}}
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
        modal.find('[id="note"]').text(response.notes);
        modal.find('[id="problem_image"]').attr('src',response.problem_image);
        modal.find('[id="selected_services"]').text(response.services);

      },
      error: function (xhr) {
        // Handle error, e.g., show an error message to the user.
      }
    });
  });

</script>

{{-- Script for processing the approved appointment --}}
<script>
  // Script to manually show the approval modal
  $('.approve-appointment').on('click', function (event) {
    event.preventDefault(); // Prevent the default anchor behavior

    // Extract the appointment ID from data-attribute
    var appointmentId = $(this).data('appointment-id');

    // Update the hidden input in the form
    $('#approveForm #appointmentId').val(appointmentId);

    // Manually show the modal
    $('#approveAppointmentModal').modal('show');
  });
</script>

{{-- Script for processing the rejected appointment --}}
<script>
  // Script to manually show the approval modal
  $('.reject-appointment').on('click', function (event) {
    event.preventDefault(); // Prevent the default anchor behavior

    // Extract the appointment ID from data-attribute
    var appointmentId = $(this).data('appointment-id');

    // Update the hidden input in the form
    $('#rejectForm #appointmentId').val(appointmentId);

    // Manually show the modal
    $('#rejectAppointmentModal').modal('show');
  });
</script>

@endsection

@section('toastr_script')

@if (Session::has('success'))
<script>
  toastr.options = {
    'progressBar': true,
    "closeButton": true,
  }
  toastr.success("{{ Session::get('success') }}", 'Success!', { timeout: 12000 })
</script>

@endif

@endsection