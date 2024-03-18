<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Auto Mechanics</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/registration.css') }}">

    {{-- cdnjs link for jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- selectize js cdn -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"
        integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>


    <main id="main">

        <!-- Section: Design Block -->
        <section class="background-radial-gradient overflow-hidden">
            <div class="container px-lg-4 px-md-5 px-0 text-start ">
                <div class="row gx-lg-5 mb-5">
                    <div class="col-md-12 mb-5 mb-lg-0 position-relative bg-container">

                        <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                        <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

                        <!-- uncomment if this is selected button for sign up -->
                        <!-- MECHANICS FORMS CARDS -->
                        <div class="card bg-glass">
                            <div class="card-body px-4  px-md-5 bg-glass-body">
                                <div class="row my-4">
                                    <div class="col-4">
                                        <a href="{{ route('login') }}"><i class="bi bi-arrow-left me-2"></i>Back</a>
                                    </div>
                                    <div class="col-md-8">
                                        <h2 class="fs-3 fw-bold mb-0 text-start">Sign-up As Vehicle Owner</h2>
                                    </div>
                                </div>


                                <form accept="{{ route('client.create') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mechanics-form">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-4 mb-3">
                                                        <div class="form-outline">

                                                            <label class="form-label" for="first_name">First
                                                                name</label>
                                                            <input type="text" name="first_name" id="first_name"
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
                                                            <input type="text" name="middle_name" id="middle_name"
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
                                                            <input type="text" name="last_name" id="last_name"
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
                                                    <select class="form-select" name="suffix"
                                                        aria-label="Default select example">
                                                        <option value=""></option>
                                                        <option value="Jr.">Jr.</option>
                                                        <option value="Sr.">Sr.</option>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-outline mb-3">
                                                    <label class="form-label" for="province">Province</label>
                                                    <select class="form-select" name="province" id="province"
                                                        aria-label="Default select example">
                                                        <option selected value="Zamboanga Del Sur">Zamboanga Del Sur
                                                        </option>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-outline mb-3">
                                                    <label class="form-label" for="city">City</label>
                                                    <select class="form-select" name="city" id="city"
                                                        aria-label="Default select example">
                                                        <option selected value="Zamboanga City">Zamboanga City</option>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-outline mb-3">
                                                    <label class="form-label" for="barangay">Barangay</label>
                                                    <select class="" name="barangay" id="barangay"
                                                        aria-label="Default select example" required>
                                                        <option selected value="">Select a Barangay</option>
                                                        @foreach ($barangay as $showbarangay)
                                                        <option
                                                            value="{{ ucwords(strtolower($showbarangay->brgyDesc)) }}">
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
                                                    <input type="text" name="street" id="street" class="form-control"
                                                        required />
                                                    @error('street')
                                                    <small id="emailHelp2" class="form-text text-danger">{{ $message
                                                        }}</small>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-outline mb-3">
                                                    <label class="form-label" for="landmark">Landmark</label>
                                                    <input type="text" name="landmark" id="landmark"
                                                        class="form-control" />
                                                    @error('landmark')
                                                    <small id="emailHelp2" class="form-text text-danger">{{ $message
                                                        }}</small>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-outline mb-3">
                                                    <label class="form-label" for="contact_number">Phone Number</label>
                                                    <input type="text" name="contact_number" id="contact_number"
                                                        class="form-control" required />
                                                    @error('contact_number')
                                                    <small id="emailHelp2" class="form-text text-danger">{{ $message
                                                        }}</small>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-outline mb-3">
                                                    <label class="form-label" for="valid_id">Valid Id</label>
                                                    <input type="file" name="valid_id" id="valid_id"
                                                        accept=".jpg, .jpeg, .png" class="form-control" required />
                                                    @error('valid_id')
                                                    <small id="emailHelp2" class="form-text text-danger">{{ $message
                                                        }}</small>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-outline mb-3">
                                                    <label class="form-label" for="profile">Profile Image</label>
                                                    <input type="file" name="profile" id="profile"
                                                        accept=".jpg, .jpeg, .png" class="form-control" required />
                                                    @error('profile')
                                                    <small id="emailHelp2" class="form-text text-danger">{{ $message
                                                        }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <div class="form-outline mb-3">
                                                            <label class="form-label" for="email">Email</label>
                                                            <input type="email" name="email" id="email"
                                                                class="form-control" required />
                                                            @error('email')
                                                            <small id="emailHelp2" class="form-text text-danger">{{
                                                                $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-outline mb-3">
                                                            <label class="form-label" for="sex">Sex</label>
                                                            <select class="form-select" name="sex" id="sex"
                                                                aria-label="Default select example" required>
                                                                <option selected value=""></option>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                                @error('sex')
                                                                <small id="emailHelp2" class="form-text text-danger">{{
                                                                    $message }}</small>
                                                                @enderror

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-outline mb-3">
                                                    <label class="form-label" for="username">Username</label>
                                                    <input type="text" name="username" id="username"
                                                        class="form-control" required />
                                                    @error('username')
                                                    <small id="emailHelp2" class="form-text text-danger">{{ $message
                                                        }}</small>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-outline mb-3">
                                                    <label class="form-label" for="password">Password</label>
                                                    <input type="password" name="password" id="password"
                                                        class="form-control" required />
                                                    @error('password')
                                                    <small id="emailHelp2" class="form-text text-danger">{{ $message
                                                        }}</small>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-outline mb-3">
                                                    <label class="form-label" for="confirm_password">Confirm
                                                        Password</label>
                                                    <input type="password" name="confirm_password" id="confirm_password"
                                                        class="form-control" required />
                                                    @error('confirm_password')
                                                    <small id="emailHelp2" class="form-text text-danger">{{ $message
                                                        }}</small>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>


                                        <div class="form-check d-flex mb-3">
                                            <input class="form-check-input me-2" type="checkbox" id="form2Example33"
                                                name="terms_and_conditions" checked />
                                            <label class="form-check-label" for="form2Example33">
                                                I agreed the terms and Conditions
                                            </label>
                                        </div>

                                        <button type="submit" class="btn fs-5 fw-bold btn-block mb-4 w-100"
                                            style="background:#ff8906; border:none;color:#fffffe;">Sign-up</button>

                                    </div>

                                </form>


                            </div>
                        </div>
                        <!-- MECHANICS FORMS CARDS END-->

                    </div>
                </div>
            </div>
        </section>
        <!-- Section: Design Block -->

    </main><!-- End #main -->


    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- selectize js cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
        integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('#barangay').selectize({ maxItems: 1, create: true })
    </script>


</body>

</html>