@extends('users.user_layouts.app')

@section('page_title', 'Auto Mechanics | Appointments')

@section('content')

<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs "
    style="height:45vh; background-image: url(../../assets/img/Services/pic1.jpg); object-fit:cover; ">
    <div class="container position-relative ">

        <div class="justify-content-center position-absolute mt-5 border p-lg-3 p-y-3 shadow rounded w-50"
            style="top:50%;left:50%;transform:translate(-50%, 0%);">
            <h2 class="fs-2 fw-bold text-white mt-4 text-center">Please fill up your form below</h2>
            <ol class=" justify-content-center mt-4">
                <li class=" fw-bold"><a href="../../index.html">Home</a></li>
                <li class=" fw-bold text-white">Hire Mechanic</li>
            </ol>
        </div>

    </div>
</section><!-- End Breadcrumbs -->

<!-- Appointment Status -->
<section class="appointment-status">
    <div class="container my-5">
        <div class="section-title" data-aos="zoom-out">
            <h2>Appointment</h2>
            <p>Appointmemt Status</p>
        </div>
        <div role="tabpanel">
            <div class="row">
                <div class="col-md-3">
                    <!-- List group -->
                    <div class="list-group" id="myList" role="tablist">
                        <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#recent"
                            role="tab">Recent Activity</a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#pending"
                            role="tab">Pending Appointment</a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#completed"
                            role="tab">Completed Appointment</a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#all"
                            role="tab">All Appointment</a>
                    </div>
                </div>

                <div class="col-md-9 border p-3 rounded my-lg-0 my-4">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="recent" role="tabpanel">
                            <!-- Cart Start -->
                            <div class="">
                                <div class="row ">
                                    <div class="col-lg-12 table-responsive mb-5">
                                        <table class="table table-borderless table-hover text-center mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                    <th>Appointmemt Type</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="align-middle">
                                                @foreach ($appointments as $appointment)
                                                <tr>
                                                    <td class="align-middle">{{ $appointment['date_start'] }}</td>
                                                    <td class="align-middle">{{ $appointment['start_time'] }}</td>
                                                    <td class="align-middle">{{ $appointment['end_time'] }}</td>
                                                    <td class="align-middle">{{ $appointment['appointment_type'] }}</td>
                                                    <td class="align-middle">{{ $appointment['status'] }}</td>
                                                    <td class="align-middle">
                                                        <button
                                                            class="btn btn-sm btn-success fs-5 fw-bold view-appointment"
                                                            data-appointment-id="{{ $appointment['id'] }}"><i
                                                                class="bx bx-show-alt"></i></button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Cart End -->
                        </div>
                        <div class="tab-pane" id="pending" role="tabpanel">
                            <div class="">
                                <div class="row ">
                                    <div class="col-lg-12 table-responsive mb-5">
                                        <table class="table table-borderless table-hover text-center mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                    <th>Appointmemt Type</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="align-middle">
                                                @foreach ($pendingappointments as $appointment)
                                                <tr>
                                                    <td class="align-middle">{{ $appointment['date_start'] }}</td>
                                                    <td class="align-middle">{{ $appointment['start_time'] }}</td>
                                                    <td class="align-middle">{{ $appointment['end_time'] }}</td>
                                                    <td class="align-middle">{{ $appointment['appointment_type'] }}</td>
                                                    <td class="align-middle">{{ $appointment['status'] }}</td>
                                                    <td class="align-middle">
                                                        <button
                                                            class="btn btn-sm btn-success fs-5 fw-bold view-appointment"
                                                            data-appointment-id="{{ $appointment['id'] }}"><i
                                                                class="bx bx-show-alt"></i></button>
                                                        <a href="#" class="btn btn-sm btn-primary fs-5 fw-bold"><i
                                                                class="bx bxs-edit-alt"></i></a>
                                                        <button
                                                            class="btn btn-sm btn-danger fs-5 fw-bold cancel-appointment"
                                                            data-appointment-id="{{ $appointment['id'] }}"><i
                                                                class="bx bx-x"></i></button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="completed" role="tabpanel">
                            <div class="">
                                <div class="row ">
                                    <div class="col-lg-12 table-responsive mb-5">
                                        <table class="table table-borderless table-hover text-center mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                    <th>Appointmemt Type</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="align-middle">
                                                @foreach ($completedappointments as $appointment)
                                                <tr>
                                                    <td class="align-middle">{{ $appointment['date_start'] }}</td>
                                                    <td class="align-middle">{{ $appointment['start_time'] }}</td>
                                                    <td class="align-middle">{{ $appointment['end_time'] }}</td>
                                                    <td class="align-middle">{{ $appointment['appointment_type'] }}</td>
                                                    <td class="align-middle">{{ $appointment['status'] }}</td>
                                                    <td class="align-middle">
                                                        @if($appointment['status'] == "Pending completed")
                                                        <button
                                                            class="btn btn-sm btn-success fw-bold complete-appointment"
                                                            data-appointment-id="{{ $appointment['id'] }}">
                                                            Confirm and Review
                                                        </button>
                                                        @else
                                                        <button
                                                            class="btn btn-sm btn-success fs-5 fw-bold view-appointment"
                                                            data-appointment-id="{{ $appointment['id'] }}"><i
                                                                class="bx bx-show-alt"></i></button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="history" role="tabpanel">
                            <div class="">
                                <div class="row ">
                                    <div class="col-lg-12 table-responsive mb-5">
                                        <table class="table table-borderless table-hover text-center mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                    <th>Appointmemt Type</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="align-middle">
                                                @foreach ($appointments as $appointment)
                                                <tr>
                                                    <td class="align-middle">{{ $appointment['date_start'] }}</td>
                                                    <td class="align-middle">{{ $appointment['start_time'] }}</td>
                                                    <td class="align-middle">{{ $appointment['end_time'] }}</td>
                                                    <td class="align-middle">{{ $appointment['appointment_type'] }}</td>
                                                    <td class="align-middle">{{ $appointment['status'] }}</td>
                                                    <td class="align-middle">
                                                        <button
                                                            class="btn btn-sm btn-success fs-5 fw-bold view-appointment"
                                                            data-appointment-id="{{ $appointment['id'] }}"><i
                                                                class="bx bx-show-alt"></i></button>

                                                        <a href="#" class="btn btn-sm btn-primary fs-5 fw-bold"><i
                                                                class="bx bxs-edit-alt"></i></a>

                                                        <button
                                                            class="btn btn-sm btn-danger fs-5 fw-bold cancel-appointment"
                                                            data-appointment-id="{{ $appointment['id'] }}"><i
                                                                class="bx bx-x"></i></button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="all" role="tabpanel">
                            <div class="">
                                <div class="row ">
                                    <div class="col-lg-12 table-responsive mb-5">
                                        <table class="table table-borderless table-hover text-center mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                    <th>Appointmemt Type</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="align-middle">
                                                @foreach ($allappointments as $appointment)
                                                <tr>
                                                    <td class="align-middle">{{ $appointment['date_start'] }}</td>
                                                    <td class="align-middle">{{ $appointment['start_time'] }}</td>
                                                    <td class="align-middle">{{ $appointment['end_time'] }}</td>
                                                    <td class="align-middle">{{ $appointment['appointment_type'] }}</td>
                                                    <td class="align-middle">{{ $appointment['status'] }}</td>
                                                    <td class="align-middle">

                                                        <button
                                                            class="btn btn-sm btn-success fs-5 fw-bold view-appointment"
                                                            data-appointment-id="{{ $appointment['id'] }}"><i
                                                                class="bx bx-show-alt"></i></button>

                                                        <a href="#" class="btn btn-sm btn-primary fs-5 fw-bold"><i
                                                                class="bx bxs-edit-alt"></i></a>

                                                        <button
                                                            class="btn btn-sm btn-danger fs-5 fw-bold cancel-appointment"
                                                            data-appointment-id="{{ $appointment['id'] }}"><i
                                                                class="bx bx-x"></i></button>

                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="cancelAppointmentModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i
                        class="bx bxs-error me-2 text-danger"></i>Warning!!</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span class="fs-5 fw-bold">Are you sure you want to cancel this appointment?</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <form id="cancelForm" action="{{ route('appointment.cancel') }}" method="POST">
                    @csrf
                    <input type="hidden" id="appointmentId" name="appointmentId" value="">
                    <button type="submit" class="btn btn-primary">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewAppointment" tabindex="-1" aria-labelledby="viewAppointment" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Appointment Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="profile ">
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header profile-overview">
                                    <h5 class="card-title fs-5 fw-bold text-start">Appointment Information</h5>
                                </div>
                                <div class="card-body pt-3">

                                    <!-- appointment details -->
                                    <div class="profile-overview text-start">

                                        <div class="row">
                                            <div class="col-md-5 label">Date:</div>
                                            <div class="col-md-7"><span id="date_start"></span></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-5 label">Time:</div>
                                            <div class="col-md-7"><span id="time"></span></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-5 label">Appointment Type:</div>
                                            <div class="col-md-7"><span id="appointment_type">Home Service</span></div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header profile-overview">
                                    <h5 class="card-title fs-5 fw-bold text-start">Vehicle Information</h5>
                                </div>
                                <div class="card-body pt-3">

                                    <!-- appointment details -->
                                    <div class="profile-overview text-start">

                                        <div class="row">
                                            <div class="col-md-5 label">Make:</div>
                                            <div class="col-md-7"><span id="make"></span></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-5 label">Model:</div>
                                            <div class="col-md-7"><span id="model"></span></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-5 label">Additional Notes:</div>
                                            <div class="col-md-7"><span id="notes"></span></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-5 label">Problem Image:</div>
                                            <div class="col-md-7">
                                                <div class="row row-cols-1 row-cols-md-2 g-4">
                                                    <div class="col">
                                                        <div class="card" id="image_container">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-5 label">Selected Services:</div>
                                            <div class="col-md-7">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Service</th>
                                                            <th scope="col">Price</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody id="service_table_body">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="completeAppointmentModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Complete Job</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="completeForm" action="{{ route('appointment.confirmcomplete') }}" method="POST">
        @csrf
        <div class="modal-body">
          <p>Review:</p>
          <!-- Star Rating Selector -->
          <div class="form-group">
            <label for="starRating">Star Rating:</label>
            <select class="form-control" name="starRating" id="starRating" required>
              <option value="1">1 star</option>
              <option value="2">2 stars</option>
              <option value="3">3 stars</option>
              <option value="4">4 stars</option>
              <option value="5" selected>5 stars</option>
            </select>
          </div>
          <!-- Review Textarea -->
          <div class="form-floating mb-3">
            <textarea class="form-control" name="message" id="message" required placeholder="Leave a review here" style="height: 100px;"></textarea>
            <label for="message">Review</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="hidden" id="completeappointmentId" name="appointmentId" value="">
          <button type="submit" class="btn btn-primary">Complete</button>
        </div>
      </form>
    </div>
  </div>
</div>


@endsection

@section('user-view-modal-script')

{{-- script for Viewing appointment Modal --}}
<script>
    $('.complete-appointment').on('click', function (event) {
    event.preventDefault(); // Prevent the default anchor behavior

    // Extract the appointment ID from data-attribute
    var appointmentId = $(this).data('appointment-id');

    // Update the hidden input in the form
    $('#completeForm #completeappointmentId').val(appointmentId);

    // Manually show the modal
    $('#completeAppointmentModal').modal('show');
  });
    // Script to handle edit button click
    $('.view-appointment').on('click', function () {
        var appointmentId = $(this).data('appointment-id');
        var modal = $('#viewAppointment');

        // Fetch lot type data by ID using AJAX and populate the modal fields
        $.ajax({
            url: 'view-appointment/' + appointmentId,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                // Populate modal fields with fetched data
                modal.find('[id="date_start"]').text(response.date_start);
                modal.find('[id="time"]').text(response.time);
                modal.find('[id="appointmenttype"]').text(response.appointment_type);
                modal.find('[id="make"]').text(response.make);
                modal.find('[id="model"]').text(response.model);

                // Display the image
                if (response.problem_images) {
                    var imageUrl = response.problem_images;
                    var imageElement = '<img src="images/problem_images/' + imageUrl + '" class="img-fluid" alt="Appointment Image">';
                    modal.find('[id="image_container"]').html(imageElement);
                } else {
                    // Handle case when no image is available
                    modal.find('[id="image_container"]').html('<p>No image available</p>');
                }

                // Display mechanic service data
                var serviceTableBody = modal.find('[id="service_table_body"]');
                serviceTableBody.empty(); // Clear existing rows

                response.mechanic_services.forEach(function (service) {
                    var row = '<tr><td id="service_name">' + service.service_name + '</td><td id="service_fee">' + service.labor_fee + '</td></tr>';
                    serviceTableBody.append(row);
                });

                modal.modal('show');
            },
            error: function (xhr) {
                // Handle error, e.g., show an error message to the user.
            }
        });
    });

</script>

{{-- Script for processing the rejected appointment --}}
<script>
    // Script to manually show the approval modal
    $('.cancel-appointment').on('click', function (event) {
        event.preventDefault(); // Prevent the default anchor behavior

        // Extract the appointment ID from data-attribute
        var appointmentId = $(this).data('appointment-id');

        // Update the hidden input in the form
        $('#cancelForm #appointmentId').val(appointmentId);

        // Manually show the modal
        $('#cancelAppointmentModal').modal('show');
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

@if (Session::has('error'))
<script>
    toastr.options = {
        'progressBar': true,
        "closeButton": true,
    }
    toastr.error("{{ Session::get('error') }}", 'Error!', { timeout: 12000 })
</script>

@endif

@endsection