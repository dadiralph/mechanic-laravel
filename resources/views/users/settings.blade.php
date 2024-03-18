@extends('users.user_layouts.app')

@section('page_title', 'Auto Mechanics')


@section('hero')

<section id="hero" class="d-flex flex-column justify-content-end align-items-center">

</section>

@endsection

@section('content')
<section id="testimonials" class="testimonials">
  <div class="container mt-5">
    <div class="container">
      <h2>Change Name</h2>
      <form action="{{ route('client.name.change') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-10">
            <div class="row">
              <div class="col-md-4 mb-3">
                <div class="form-outline">
                  <label class="form-label" for="first_name">First
                    name</label>
                  <input value="{{$user['name']['first_name']}}" type="text" name="first_name" id="first_name"
                    class="form-control" required />
                  @error('first_name')
                  <small id="emailHelp2" class="form-text text-danger">{{
                    $message }}</small>
                  @enderror
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <div class="form-outline">

                  <label class="form-label" for="middle_name">Middle
                    name</label>
                  <input value="{{$user['name']['middle_name']}}" type="text" name="middle_name" id="middle_name"
                    class="form-control" />
                  @error('middle_name')
                  <small id="emailHelp2" class="form-text text-danger">{{
                    $message }}</small>
                  @enderror

                </div>
              </div>
              <div class="col-md-4 mb-3">
                <div class="form-outline">

                  <label class="form-label" for="last_name">Last name</label>
                  <input value="{{$user['name']['last_name']}}" type="text" name="last_name" id="last_name"
                    class="form-control" required />
                  @error('last_name')
                  <small id="emailHelp2" class="form-text text-danger">{{
                    $message }}</small>
                  @enderror

                </div>
              </div>
            </div>
          </div>
          <div class="col-md-2 mb-3">
            <div class="form-outline">
              <label class="form-label" for="suffix">Suffix</label>
              <select class="form-select" id="suffixSelect" name="suffix" aria-label="Default select example">
                <option value=""></option>
                <option value="Jr.">Jr.</option>
                <option value="Sr.">Sr.</option>
              </select>
            </div>
          </div>
        </div>
        <button type="submit" class="btn fs-5 fw-bold btn-block mb-4 w-100"
          style="background:#ff8906; border:none;color:#fffffe;">Change</button>
      </form>
    </div>

    <!-- Location -->
    <div class="container mt-5">
      <h2>Change Location</h2>
      <form action="{{ route('client.location.change') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-4">
            <div class="form-outline mb-3">
              <label class="form-label" for="province">Province</label>
              <select class="form-select" name="province" id="province" aria-label="Default select example">
                <option selected value="Zamboanga Del Sur">Zamboanga Del Sur
                </option>
              </select>
            </div>

          </div>
          <div class="col-md-4">
            <div class="form-outline mb-3">
              <label class="form-label" for="city">City</label>
              <select class="form-select" name="city" id="city" aria-label="Default select example">
                <option selected value="Zamboanga City">Zamboanga City</option>
              </select>
            </div>

          </div>
          <div class="col-md-4">
            <div class="form-outline mb-3">
              <label class="form-label" for="barangay">Barangay</label>
              <select class="" name="barangay" id="barangay" aria-label="Default select example" required>
                <option selected value="">Select a Barangay</option>
                @foreach ($barangay as $showbarangay)
                <option value="{{ ucwords(strtolower($showbarangay->brgyDesc)) }}">
                  {{ ucwords(strtolower($showbarangay->brgyDesc)) }}</option>
                @endforeach

              </select>
              @error('barangay')
              <small id="emailHelp2" class="form-text text-danger">{{ $message
                }}</small>
              @enderror
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-md-4">
            <div class="form-outline mb-3">
              <label class="form-label" for="street">Street</label>
              <input type="text" name="street" id="street" class="form-control" required />
              @error('street')
              <small id="emailHelp2" class="form-text text-danger">{{ $message
                }}</small>
              @enderror
            </div>

          </div>
          <div class="col-md-4">
            <div class="form-outline mb-3">
              <label class="form-label" for="landmark">Landmark</label>
              <input type="text" name="landmark" id="landmark" class="form-control" />
              @error('landmark')
              <small id="emailHelp2" class="form-text text-danger">{{ $message
                }}</small>
              @enderror
            </div>

          </div>
          <div class="col-md-4">
            <div class="form-outline mb-3">
              <label class="form-label" for="contact_number">Phone Number</label>
              <input type="text" name="contact_number" id="contact_number" class="form-control" required />
              @error('contact_number')
              <small id="emailHelp2" class="form-text text-danger">{{ $message
                }}</small>
              @enderror
            </div>
          </div>
        </div>
        <button type="submit" class="btn fs-5 fw-bold btn-block mb-4 w-100"
          style="background:#ff8906; border:none;color:#fffffe;">Change</button>
      </form>
    </div>

    <!-- Profile -->
    <div class="container mt-5">
      <h2>Change Profile Image</h2>
      <form action="{{ route('client.profile.change') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-md-6">
          <div class="form-outline mb-3">
            <label class="form-label" for="profile">Profile Image</label>
            <input type="file" name="profile" id="profile" accept=".jpg, .jpeg, .png" class="form-control" required />
            @error('profile')
            <small id="emailHelp2" class="form-text text-danger">{{ $message
              }}</small>
            @enderror
          </div>
        </div>
        <button type="submit" class="btn fs-5 fw-bold btn-block mb-4 w-100"
          style="background:#ff8906; border:none;color:#fffffe;">Change</button>
      </form>
    </div>
  </div>
</section><!-- End Testimonials Section -->
<script>
  // Set the value of the select element to "Jr."
  let suffix = "{{$user['name']['suffix']}}"
  document.getElementById("suffixSelect").value = suffix;

  let province = "{{$user['address']['province']}}";
  let city = "{{$user['address']['city']}}";
  let landmark = "{{$user['address']['landmark']}}";
  let barangay = "{{$user['address']['barangay']}}";
  let street = "{{$user['address']['street']}}";
  let contact_number = "{{$user['contact_number']}}";


  document.getElementById("province").value = province;
  document.getElementById("city").value = city;
  document.getElementById("landmark").value = landmark;
  document.getElementById("barangay").value = barangay;
  document.getElementById("street").value = street;
  document.getElementById("contact_number").value = contact_number;


</script>
@endsection