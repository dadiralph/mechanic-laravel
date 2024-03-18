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
<script type="module">
    import { initializeApp } from 'https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js'

    // If you enabled Analytics in your project, add the Firebase SDK for Google Analytics
    import { getAnalytics } from 'https://www.gstatic.com/firebasejs/10.7.1/firebase-analytics.js'

    // Add Firebase products that you want to use
    import { getAuth, signInWithEmailAndPassword  } from 'https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js'
    import { getFirestore } from 'https://www.gstatic.com/firebasejs/10.7.1/firebase-firestore.js'

    const firebaseConfig = {
        apiKey: "AIzaSyAUnj0N-M99e-lF8mmruqAwfRvOmLzUvxE",
        authDomain: "mechanic-assistance-3b77d.firebaseapp.com",
        projectId: "mechanic-assistance-3b77d",
        storageBucket: "mechanic-assistance-3b77d.appspot.com",
        messagingSenderId: "564842703163",
        appId: "1:564842703163:web:f22a526830a1a0a5f3af1e"
    };
    const app = initializeApp(firebaseConfig);
    const auth = getAuth(app);

    const firebaseLogin = async (email, password) => {
        console.log("logging in")
        const result = await signInWithEmailAndPassword(auth, email, password);
        console.log(result)
        return result;
    }
    async function validateForm(event) {
        event.preventDefault(); // Prevent the default form submission
        let username = document.getElementById('form2Example1').value;
        let password = document.getElementById('form2Example2').value;
        const result = await firebaseLogin(username, password)
        const data = JSON.stringify(result);
        const submitData = {
            "displayName" : result.user.displayName,
            "email": result.user.email,
            "localId": result._tokenResponse.localId,
        }
        //appending submit data
        for (const key in submitData) {
            if (submitData.hasOwnProperty(key)) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = key;
                input.value = submitData[key];
                myForm.appendChild(input);
            }
        }

        myForm.submit();
    }

    // Get the form element by its ID
    const myForm = document.getElementById('loginForm');

    // Add the function as the onsubmit handler
    myForm.onsubmit = validateForm;

</script>
<script>


    // async function validateForm(event) {
    //     event.preventDefault(); // Prevent the default form submission
    //     let username = document.getElementById('form2Example1').value;
    //     let password = document.getElementById('form2Example2').value;
    //     console.log(username, password);
    //     firebaseLogin(username, password)
    // }

</script>

<body>


    <main id="main">

        <!-- Section: Design Block -->
        <section class="background-radial-gradient overflow-hidden">
            <div class="container px-lg-4 px-md-5 px-0 text-start my-5">
                <div class="row gx-lg-5 mb-5">
                    <div class="col-md-12 mb-5 mb-lg-0 position-relative bg-container">

                        <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                        <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

                        <div class="card bg-glass">
                            <div class="card-body px-4  px-md-5 bg-glass-body">
                                <div class="row my-4">
                                    <div class="col-3">
                                        <!-- Back to index -->
                                        <a href="{{ route('index')}}"><i class="bi bi-arrow-left me-2"></i>Back</a>
                                    </div>
                                    <div class="col-md-9">
                                        <!-- Back to index -->
                                        <h2 class="fs-3 fw-bold mb-0 text-center">Login To Your Account</h2>
                                    </div>
                                </div>
                                <form action="{{ route('login.post') }}" method="POST"
                                    id="loginForm">
                                    @csrf
                                    <div class=" mb-3">
                                        <div class="row g-0 d-flex align-items-center">
                                            <div class="col-lg-4 d-none d-lg-flex">
                                                <img src="../assets/img/login-image/login-pic.jpg" alt=""
                                                    class="img-fluid rounded-t-5 shadaw rounded-tr-lg-0 rounded-bl-lg-5 "
                                                    style="height: 60vh; object-fit:cover;" />
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="p-lg-5 p-0 py-3">
                                                    <div class="form-outline mb-4">
                                                        @if (!empty(session('success')))
                                                        <div class="alert alert-success" role="alert">
                                                            {{ session('success') }}
                                                        </div>
                                                        @endif
                                                        @if (!empty(session('error')))
                                                        <div class="alert alert-danger" role="alert">
                                                            {{ session('error') }}
                                                        </div>
                                                        @endif
                                                    </div>

                                                    <form>
                                                        <!-- Email input -->
                                                        <div class="form-outline mb-4">
                                                            <label class="form-label"
                                                                for="form2Example1">Email</label>
                                                            <input type="text" name="username" id="form2Example1"
                                                                class="form-control" />
                                                        </div>

                                                        <!-- Password input -->
                                                        <div class="form-outline mb-4">
                                                            <label class="form-label"
                                                                for="form2Example2">Password</label>
                                                            <input type="password" name="password" id="form2Example2"
                                                                class="form-control" />
                                                        </div>
                                                        <div class="form-outline mb-4">
                                                            @foreach($errors->all() as $error)
                                                            <small id="errormsg"
                                                                class="form-text text-danger text-muted">{{ $error
                                                                }}</small>
                                                            @endforeach
                                                        </div>

                                                        <div class="mb-4">
                                                            <div
                                                                class="d-lg-flex justify-content-between align-items-center d-block">
                                                                <!-- Checkbox -->
                                                                <div class="form-check">
                                                                    <label class="form-check-label"
                                                                        for="form2Example31"> Remember me </label>
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="" id="form2Example31" checked />
                                                                </div>
                                                                <a href="#!">Forgot password?</a>
                                                            </div>
                                                        </div>

                                                        <!-- Submit button -->
                                                        <button class="btn fw-bold fs-5 btn-block mb-4 w-100"
                                                            style="background:#ff8906; border:none;color:#fffffe;">Sign
                                                            in</button>
                                                    </form>

                                                    <div class="text-center">
                                                        <p>or sign up with:</p>
                                                        <a href="{{ route('signup.mechanic') }}"
                                                            class="btn border shadow btn-floating mx-1 mb-lg-0 mb-3"
                                                            style="background:#2e2f3e; color: #a7a9be;">
                                                            <span>Mechanics</span>
                                                        </a>

                                                        <a href="{{ route('signup.vehicle') }}"
                                                            class="btn border shadow btn-floating mx-1 mb-lg-0 mb-3"
                                                            style="background:#2e2f3e; color: #a7a9be;">
                                                            <span>Vehicle Owner</span>
                                                        </a>

                                                        <a href="{{ route('signup.shop') }}"
                                                            class="btn border shadow btn-floating mx-1 mb-lg-0 mb-3"
                                                            style="background:#2e2f3e; color: #a7a9be; ">
                                                            <span>Shop Owner</span>
                                                        </a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
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


</body>

</html>