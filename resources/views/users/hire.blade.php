@extends('users.user_layouts.app')

@section('page_title', 'Auto Mechanics | Hire Mechanic')

@section('content')

<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs " style="height:45vh; background-image: url(../../assets/img/Services/pic1.jpg); object-fit:cover; ">
    <div class="container position-relative ">

        <div class="justify-content-center position-absolute mt-5 border p-lg-3 p-y-3 shadow rounded w-50" style="top:50%;left:50%;transform:translate(-50%, 0%);">
            <h2 class="fs-2 fw-bold text-white mt-4 text-center">Please fill up your form below</h2>
            <ol class=" justify-content-center mt-4">
                <li class=" fw-bold"><a href="../../index.html">Home</a></li>
                <li class=" fw-bold text-white">Hire Mechanic</li>
            </ol>
        </div>

    </div>
</section><!-- End Breadcrumbs -->

<!-- Booking Form -->
<section class="booking">
    <div class="container my-5">
        <div class="container">

            <div class="row">
                <div class="col-lg-4 border-5 border-top border-bottom p-4 bg-light mb-lg-0 mb-4 ">
                    <h2 class="fs-3 fw-bold text-center text-lg-start my-4">Mechanic Information</h2>
                    <div class="square-image">
                        <img src="{{$mechanic['profile']}}" class="img-fluid rounded" alt="">
                    </div>
                    <div class="my-3">
                        <h3 class="fs-4 fw-bold text-center">{{ $mechanic['name']['first_name'] }} {{
                            $mechanic['name']['middle_name'] }} {{ $mechanic['name']['last_name'] }} {{
                            $mechanic['name']['suffix'] }}</h3>
                    </div>

                    <div class="align-items-center d-lg-flex mb-2 d-block">
                        <div class="d-block d-lg-flex align-items-center mb-lg-0 mb-2">
                            <i class="bx bx-time-five fw-bold fs-5 fw-light me-0 me-lg-2"></i>
                            <span class="me-2 mt-2 mt-lg-0">Time Available:</span>
                        </div>
                        <span class="px-lg-0 px-4">
                            7:00 A.M.
                            -
                            9:00 P.M.
                        </span>
                    </div>
                    {{--
                    <div class="align-items-center d-lg-flex mb-2 d-block">
                        <div class="d-block d-lg-flex align-items-center mb-lg-0 mb-2">
                            <i class="bx bxs-star fw-bold fs-5 me-0 me-lg-2"></i>
                            <span class="me-2 mt-2 mt-lg-0">Ratings:</span>
                        </div>
                        <span class="px-lg-0 px-4">(1.5<i class="bx bxs-star fw-bold "></i>)</span>
                        <!-- <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="bx bx-star text-primary mr-1"></small>
                                        <small class="bx bx-star text-primary mr-1"></small>
                                        <small class="bx bx-star text-primary mr-1"></small>
                                        <small class="bx bx-star text-primary mr-1"></small>
                                        <small class="bx bx-star text-primary mr-1"></small>
                                        <small>(99)</small>
                                    </div> -->
                    </div>
                    --}}
                </div>
                <div class="col-lg-8">
                    <form action="{{ route('hire.mechanic', $mechanic['id']) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="bg-light">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row my-4">
                                        <div class="col-2">
                                            <a href="login.html"><i class="bi bi-arrow-left me-2"></i>Back</a>
                                        </div>
                                        <div class="col-md-5">
                                            <h2 class="fs-3 fw-bold mb-0 text-lg-start text-center">Appointment Form
                                            </h2>
                                        </div>
                                        <div class="col-md-5">
                                            <h2 class="fs-3 fw-bold mb-0 text-lg-start text-center">{{
                                                $currentDateTime->format('Y-m-d h:i A') }}</h2>
                                        </div>
                                    </div>


                                    <form>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">

                                                <div class="form-outline">

                                                    <label class="form-label" for="appointment_type">Appointment
                                                        Type</label>
                                                    <select class="form-select" name="appointment_type" id="appointment_type" aria-label="Default select example">
                                                        <option value="Home Service">Home Service</option>
                                                        <option value="Emergency Service">Emergency Service</option>
                                                    </select>
                                                    @foreach($errors->all() as $error)
                                                    <small id="errormsg" class="form-text text-danger text-muted">{{
                                                        $error }}</small>
                                                    @endforeach

                                                </div>


                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-outline">
                                                    <label class="form-label" for="date_start">Date</label>
                                                    <input type="date" name="date_start" id="date_start" value="{{ now()->format('Y-m-d') }}" min="{{ now()->format('Y-m-d') }}" class="form-control">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-outline">
                                                            <label class="form-label" for="start_time">Start
                                                                Time</label>
                                                            <select class="form-select" id="start_time" name="start_time" aria-label="Default select example" required>
                                                                <option value="">Select Start Time</option>
                                                                <?php
                                                                $defaultStartTime = new DateTime('07:00');
                                                                $defaultEndTime = new DateTime('19:00');
                                                                $startTime = isset($mechanic->start_time) ? new DateTime($mechanic->start_time) : $defaultStartTime;
                                                                $endTime = isset($mechanic->end_time) ? new DateTime($mechanic->end_time) : $defaultEndTime;
                                                                $interval = new DateInterval('PT1H');
                                                                while ($startTime <= $endTime) {
                                                                    echo '<option value="' . $startTime->format('H:i') . '">' . $startTime->format('g:i A') . '</option>';
                                                                    $startTime->add($interval);
                                                                }
                                                                ?>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-outline">
                                                            <label class="form-label" for="end_time">End Time</label>
                                                            <select class="form-select" id="end_time" name="end_time" aria-label="Default select example" disabled required>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <div class="form-outline">
                                                    <label class="form-label" for="no_vehicle">Number of Vehicle</label>
                                                    <input type="number" id="no_vehicle" class="form-control" step="1" min="1" value="1">
                                                </div>
                                            </div>



                                        </div>

                                        <div class="">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">

                                                    <div class="form-outline">

                                                        <label class="form-label" for="form3Example2">Make</label>
                                                        <input type="text" name="make" id="make" class="form-control" placeholder="e.x Honda" required>

                                                    </div>


                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-outline">

                                                        <label class="form-label" for="form3Example2">Model</label>
                                                        <input type="text" name="model" id="model" class="form-control" placeholder="e.x Civic" required>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-outline">
                                                        <label class="form-label" for="services">Services</label>
                                                        <select class="" name="services[]" id="services" aria-label="Default select example" multiple required>
                                                            <option value=""></option>
                                                            @if(count($servicesList) > 0)
                                                            @foreach($servicesList as $service)
                                                            <option value="{{ $service }}">{{ $service }}</option>
                                                            @endforeach
                                                            @else
                                                            <option value="Oil Change">Oil Change</option>
                                                            <option value="Brake Inspection">Brake Inspection</option>
                                                            <option value="Engine Tune-up">Engine Tune-up</option>
                                                            <option value="Tire Rotation">Tire Rotation</option>
                                                            <option value="Transmission Fluid Flush">Transmission Fluid Flush</option>
                                                            <option value="Wheel Alignment">Wheel Alignment</option>
                                                            <option value="Air Conditioning Service">Air Conditioning Service</option>
                                                            <option value="Battery Replacement">Battery Replacement</option>
                                                            <option value="Suspension System Repair">Suspension System Repair</option>
                                                            <option value="Exhaust System Inspection">Exhaust System Inspection</option>
                                                            <option value="Radiator Flush">Radiator Flush</option>
                                                            <option value="Spark Plug Replacement">Spark Plug Replacement</option>
                                                            <option value="Fuel System Cleaning">Fuel System Cleaning</option>
                                                            <option value="Ignition System Repair">Ignition System Repair</option>
                                                            <option value="Power Steering Fluid Flush">Power Steering Fluid Flush</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-outline mb-3">
                                                <label class="form-label" for="note">Notes</label>
                                                <textarea name="note" id="note" cols="2" rows="5" class="w-100 form-control"></textarea>
                                            </div>

                                            <div class="form-outline mb-2">
                                                <label class="form-label" for="problem_image">Problem Image</label>
                                                <input type="file" id="problem_image" class="form-control" name="problem_image" required>

                                            </div>
                                        </div>

                                        <div class="d-lg-flex d-block align-items-center justify-content-center my-4">
                                            <a class="btn fs-5 fw-bold btn-light  w-100 me-2 mb-lg-0 mb-3">Cancel</a>
                                            <button type="submit" class="btn fs-5 fw-bold btn-block  w-100 " style="background:#ff8906; border:none;color:#fffffe;">Submit
                                                Request</button>
                                        </div>

                                    </form>


                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- JavaScript code to dynamically update end time options based on selected start time --}}
<script>
    document.getElementById('start_time').addEventListener('change', function() {
        var startTime = this.value;
        var endTimeSelect = document.getElementById('end_time');
        var endTimeOptions = endTimeSelect.options;

        // Clear existing options
        endTimeOptions.length = 0;

        // Separate the hour and AM/PM from the selected start time
        var startTimeArray = startTime.split(' ');
        var startHour = parseInt(startTimeArray[0]);
        var startAMPM = startTimeArray[1];

        // Convert PM hours to 24-hour format
        var adjustedStartHour = (startAMPM === 'PM' && startHour !== 12) ? startHour + 12 : startHour;

        // Calculate the index to start from based on the selected start time
        var startIndex = adjustedStartHour + 1;

        // Add new options for end time
        for (var i = startIndex; i <= 16; i++) {
            var displayHour = (i <= 12) ? i : i - 12;
            var displayAMPM = (i < 12 || i === 24) ? 'AM' : 'PM';
            var time24Format = (i < 10 ? '0' : '') + i + ':00';
            var time12Format = displayHour + ':00 ' + displayAMPM;
            var option = new Option(time12Format, time24Format);
            endTimeOptions.add(option);
        }


        // Enable the end time select
        endTimeSelect.disabled = false;
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
    toastr.success("{{ Session::get('success') }}", 'Success!', {
        timeout: 12000
    })
</script>

@endif

@endsection