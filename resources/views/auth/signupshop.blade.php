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
</head>

<body>


    <main id="main">

        <!-- Section: Design Block -->
        <!-- SHOP OWNER FORMS CARDS -->
        <div class="card bg-glass">
            <div class="card-body px-4  px-md-5 bg-glass-body">
                <div class="row my-4">
                    <div class="col-4">
                        <a href="{{ route('login') }}"><i class="bi bi-arrow-left me-2"></i>Back</a>
                    </div>
                    <div class="col-md-8">
                        <h2 class="fs-3 fw-bold mb-0 text-start">Sign-up As Shop Owner</h2>
                    </div>
                </div>
            <form accept="{{ route('shop.create') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                    <div class="mechanics-form">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="form-outline">
                                    <label class="form-label" for="form3Example1">First name</label>
                                    <input type="text" id="form3Example1" name="first_name" class="form-control" />
                                    @error('first_name')
                                    <small id="emailHelp2" class="form-text text-danger">{{
                                        $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <div class="form-outline">

                                    <label class="form-label" for="middle_name">Middle name</label>
                                    <input type="text" id="middle_name" name="middle_name" class="form-control" />
                                    @error('middle_name')
                                    <small id="emailHelp2" class="form-text text-danger">{{
                                        $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-outline">

                                    <label class="form-label" for="last_name">Last name</label>
                                    <input type="text" id="last_name" name="last_name" class="form-control" />
                                    @error('last_name')
                                    <small id="emailHelp2" class="form-text text-danger">{{
                                        $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <div class="form-outline">

                                    <label class="form-label" for="suffix">Suffix</label>
                                    <select class="form-select" id="suffix" name="suffix"
                                        aria-label="Default select example">
                                        <option selected></option>
                                        <option value="1">Jr.</option>
                                        <option value="2">Sr.</option>
                                        <option value="3">None</option>
                                    </select>
                                    @error('suffix')
                                    <small id="emailHelp2" class="form-text text-danger">{{
                                        $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-outline mb-3">
                                    <label class="form-label" for="shop_name">Shop Name</label>
                                    <input type="text" id="shop_name" name="shop_name" class="form-control" />
                                    @error('shop_name')
                                    <small id="emailHelp2" class="form-text text-danger">{{
                                        $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-outline mb-3">
                                    <label class="form-label" for="description">Description</label>
                                    <textarea type="contact_number" id="description" name="description"
                                        class="form-control"> </textarea>
                                        @error('description')
                                    <small id="emailHelp2" class="form-text text-danger">{{
                                        $message }}</small>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-outline mb-3">
                                    <label class="form-label" for="province">Province</label>
                                    <select class="form-select" id="province" name='province'
                                        aria-label="Default select example">
                                        <option selected value="Zamboanga Del Sur">Zamboanga Del Sur
                                        </option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-outline mb-3">
                                    <label class="form-label" for="city">City</label>
                                    <select class="form-select" name='city' id="city"
                                        aria-label="Default select example">
                                        <option selected value="Zamboanga City">Zamboanga City</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-outline mb-3">
                                    <label class="form-label" for="barangay">Barangay</label>
                                    <select class="" name="barangay" id="barangay" aria-label="Default select example"
                                        required>
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
                                    <input type="text" id="street" name='street' class="form-control" />
                                    @error('street')
                                    <small id="emailHelp2" class="form-text text-danger">{{ $message
                                        }}</small>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-outline mb-3">
                                    <label class="form-label" for="landmark">Landmark</label>
                                    <input type="text" id="landmark" name='landmark' class="form-control" />
                                    @error('landmark')
                                    <small id="emailHelp2" class="form-text text-danger">{{ $message
                                        }}</small>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-outline mb-3">
                                    <label class="form-label" for="contact_number">Phone Number</label>
                                    <input type="text" id="contact_number" name='contact_number' class="form-control" />
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
                                    <label class="form-label" for="shop_logo">Shop Logo</label>
                                    <input type="file" name="shop_logo" id="shop_logo" accept=".jpg, .jpeg, .png"
                                        class="form-control" required />
                                    @error('shop_logo')
                                    <small id="emailHelp2" class="form-text text-danger">{{ $message
                                        }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-outline mb-3">
                                    <label class="form-label" for="cover_photo">Cover Photo</label>
                                    <input type="file" name="cover_photo" id="cover_photo" accept=".jpg, .jpeg, .png"
                                        class="form-control" required />
                                    @error('cover_photo')
                                    <small id="emailHelp2" class="form-text text-danger">{{ $message
                                        }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-outline mb-3">
                                    <label class="form-label" for="email">Email Address</label>
                                    <input type="email" id="email" name="email" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-outline mb-3">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" id="password" name="password" class="form-control" />
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-outline mb-3">
                                    <label class="form-label" for="confirm_password">Confirm Password</label>
                                    <input type="password" id="confirm_password" name="confirm_password"
                                        class="form-control" />
                                </div>

                            </div>
                        </div>


                        <div class="form-check d-flex mb-3">
                            <input class="form-check-input me-2" type="checkbox" value="" id="form2Example33" checked />
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
        <!-- SHOP OWNER FORMS CARDS END-->
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


</body>

</html>