@extends('mechanic.mechanic_layouts.app')

@section('page_title', 'Auto Mechanics | Appointments')
@section('dashboard', 'collapsed')
@section('appointment.show', 'show')
@section('appointment.active', 'active')
@section('settings', 'collapsed')


@section('content')
    
<div class="pagetitle">
    <h1>Appointments</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item ">Appointments</li>
        <li class="breadcrumb-item active">Edit Appointment</li>
      </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
      
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Clients Details</h5>
              <div class="row">
                  <div class="col-6">
                      <label for="inputNanme4" class="form-label">Full Name</label>
                      <input type="text" class="form-control" value="{{ $editappointment->client->first_name }} {{ $editappointment->client->middle_name }} {{ $editappointment->client->last_name }} {{ $editappointment->client->suffix }}" id="inputNanme4" readonly>
                  </div>
                  <div class="col-6">
                      <label for="inputNanme4" class="form-label"><Address></Address></label>
                      <input type="text" class="form-control" value="{{ $editappointment->client->province }}, {{ $editappointment->client->city }}, {{ $editappointment->client->barangay }}, {{ $editappointment->client->street }}, {{ $editappointment->client->landmark }}" id="inputNanme4" readonly>
                  </div>
              </div>

              <h5 class="card-title">Appointsment Details</h5>

              <!-- Vertical Form -->
              <form class="row g-3">
                  <div class="col-md-6">
                      <div class="row">
                          <div class="col-4">
                              <label for="inputNanme4" class="form-label">Appointment Type</label>
                              <input type="text" class="form-control" value="{{ $editappointment->appointment_type }}" id="inputNanme4" readonly>
                            </div>
                            <div class="col-4">
                              <label for="date_start" class="form-label">Date Start</label>
                              <input type="date" class="form-control" name="date_start" value="{{ $editappointment->date_start }}" id="date_start" >
                            </div>
                            <div class="col-4">
                              <label for="inputEmail4" class="form-label">Date End</label>
                              <input type="date" class="form-control" id="inputEmail4" disabled>
                            </div>
                      </div>
                  </div>
                  <div class="col-6">
                      <div class="row">
                          <div class="col-4">
                              <label for="inputEmail4" class="form-label">Start Time</label>
                              <select class="form-select" id="start_time" name="start_time" aria-label="Default select example" required>
                                  <option value="">Select Start Time</option>
                                  <?php
                                    $startTime = new DateTime($editappointment->mechanic->start_time);
                                    $endTime = new DateTime($editappointment->mechanic->end_time);

                                    // Set the interval between time options (assuming 1 hour interval)
                                    $interval = new DateInterval('PT1H');

                                    // Get the selected start time
                                    $selectedStartTime = new DateTime($editappointment->start_time);

                                    // Loop through the time range and generate options
                                    while ($startTime <= $endTime) {
                                        $formattedTime = $startTime->format('H:i');
                                        $selectedAttribute = ($selectedStartTime == $startTime) ? 'selected' : '';

                                        echo '<option value="' . $formattedTime . '" ' . $selectedAttribute . '>' . $startTime->format('g:i A') . '</option>';

                                        $startTime->add($interval);
                                    }
                                  ?>
                              </select>
                          </div>
                          <div class="col-4">
                              <label for="end_time" class="form-label">End Time</label>
                              <select class="form-select" id="end_time" name="end_time" aria-label="Default select example" required>
                                  <option value="">Select End Time</option>
                                  <?php
                                    $startTime = new DateTime($editappointment->mechanic->start_time);
                                    $endTime = new DateTime($editappointment->mechanic->end_time);

                                    // Set the interval between time options (assuming 1 hour interval)
                                    $interval = new DateInterval('PT1H');

                                    // Get the selected start time
                                    $selectedStartTime = new DateTime($editappointment->end_time);

                                    // Loop through the time range and generate options
                                    while ($startTime <= $endTime) {
                                        $formattedTime = $startTime->format('H:i');
                                        $selectedAttribute = ($selectedStartTime == $startTime) ? 'selected' : '';

                                        echo '<option value="' . $formattedTime . '" ' . $selectedAttribute . '>' . $startTime->format('g:i A') . '</option>';

                                        $startTime->add($interval);
                                    }
                                  ?>
                              </select>
                          </div>
                          <div class="col-4">
                              <label for="inputEmail4" class="form-label">Number of Vehicle</label>
                              <input type="number" min="1" class="form-control" value="{{ count($appointmentvehicle)}}" id="inputEmail4" >
                          </div>
                      </div>
                  </div>
                  <div class="form-control">
                    @foreach ($appointmentvehicle as $appointmentvehicles)
                      <div class="row">
                          <div class="col-4">
                              <div class="row">
                                  <div class="col-6">
                                      <label for="make" class="form-label">Make</label>
                                      <input type="text" class="form-control" name="make" id="make" value="{{ $appointmentvehicles->make }}">
                                  </div>
                                  <div class="col-6">
                                      <label for="model" class="form-label">Model</label>
                                      <input type="text" class="form-control" name="model" id="model" value="{{ $appointmentvehicles->model }}">
                                  </div>
                              </div>
                          </div>
                          <div class="col-8">
                              <label for="inputPassword4" class="form-label">Services</label>
                              <div class="row">
                                <div class="col-md-9">
                                  <select class="" name="services[]" id="services" aria-label="Default select example" multiple required>
                                      <option value=""></option>
                                      @foreach ($mechanicServices as $services)
                                          <option value="{{ $services->id }}" 
                                                  {{ in_array($services->id, $appointmentvehicle->pluck('service_id')->toArray()) ? 'selected' : '' }}>
                                              {{ $services->service_name }} (&#8369; {{ $services->labor_fee }})
                                          </option>
                                      @endforeach
                                                                    
                                  </select>
                                </div>
                                <div class="col-md-3">
                                  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addServiceModal">Add Service</button>
                                </div>
                              </div>
                          </div>
                          <div class="col-4 mt-2">
                              <div>
                                  <label for="inputPassword4" class="form-label">Notes</label>
                                  <textarea name="" id="" class="form-control" cols="30" rows="5"></textarea>
                              </div>
                          </div>
                          <div class="col-4">
                              <label for="inputPassword4" class="form-label">Problem Images</label>
                              <div class="form-control" style="text-align-last: center;">
                                  <img src="{{ asset('images/problem_images/' . $appointmentvehicles->problem_images) }}" alt="" style="border-radius: 5px;width: 163px;">
                              </div>
                          </div>
                          <div class="col-4">
                            {{-- <label for="inputPassword4" class="form-label">Summary</label>
                            <div class="form-control">
                                <img src="assets/img/news-1.jpg" alt="" style="border-radius: 5px;width: 163px;">
                            </div> --}}
                          </div>
                      </div>
                    @endforeach
                  </div>
                  <div class="text-center">
                      <a href="{{ route('appointment') }}" class="btn btn-secondary">Back</a>
                      <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
              </form><!-- Vertical Form -->

            </div>
          </div>
  
        </div>

    </div>
</section>

<!-- Add Service Modal -->
<div class="modal fade" id="addServiceModal" tabindex="-1" role="dialog" aria-labelledby="addServiceModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addServiceModalLabel">Add Service</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="addServiceForm">
        @csrf
        <div class="modal-body">

            <div class="form-group">
              <label for="laborName">Labor Name:</label>
              <input type="text" class="form-control" id="laborName" required>
            </div>
            <div class="form-group">
              <label for="laborFee">Labor Fee:</label>
              <input type="text" class="form-control" id="laborFee" required>
            </div>
            
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
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
  $('.view-appointment').on('click', function() {
      var appointmentId = $(this).data('appointment-id');
      var modal = $('#appointmentDetailsModal');
      
      // Fetch lot type data by ID using AJAX and populate the modal fields
      $.ajax({
          url: '/mechanic/view-appointment/' + appointmentId,
          type: 'GET',
          dataType: 'json',
          success: function(response) {
              // Populate modal fields with fetched data
              modal.find('[id="fullname"]').text(response.client_name);
              modal.find('[id="address"]').text(response.client_address);
              modal.find('[id="date_start"]').text(response.date_start);
              modal.find('[id="time"]').text(response.time);
              modal.find('[id="appointmenttype"]').text(response.appointment_type);
              modal.find('[id="make"]').text(response.make);
              modal.find('[id="model"]').text(response.model);

              modal.modal('show');
          },
          error: function(xhr) {
              // Handle error, e.g., show an error message to the user.
          }
      });
  });

</script>

{{-- Script for processing the approved appointment --}}
<script>
  // Script to manually show the approval modal
  $('.add-service').on('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior

    // Update the hidden input in the form
    $('#approveForm #appointmentId').val(appointmentId);

    // Manually show the modal
    $('#approveAppointmentModal').modal('show');
  });
</script>

{{-- Script for processing the rejected appointment --}}
<script>
  // Script to manually show the approval modal
  $('.reject-appointment').on('click', function(event) {
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
                'progressBar' : true,
                "closeButton" : true,
            }
            toastr.success("{{ Session::get('success') }}", 'Success!', {timeout:12000})
        </script>

    @endif
    
@endsection