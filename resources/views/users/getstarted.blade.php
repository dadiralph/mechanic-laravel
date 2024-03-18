@extends('users.user_layouts.app')

@section('page_title', 'Auto Mechanics | Get Started')

@section('content')
    
        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs"
            class="breadcrumbs "
            style="height:45vh; background-image: url(../assets/img/Services/pic1.jpg); object-fit:cover; ">
            <div class="container position-relative ">

                <div class="justify-content-center position-absolute mt-5 border p-lg-3 p-y-3 shadow rounded w-50"style="top:50%;left:50%;transform:translate(-50%, 0%);">
                    <h2 class="fs-2 fw-bold text-white mt-4 text-center">Let's Get Started</h2>
                    <ol class=" justify-content-center mt-4">
                        <li class=" fw-bold"><a href="../../index.html">Home</a></li>
                        <li class=" fw-bold"><a href="../../client/pages/freelancer.html">Filter</a></li>
                    </ol>
                </div>
            </div>
        </section><!-- End Breadcrumbs -->

        <!-- Filter -->
        <section class="team">
            <div class="container">
                <div class="section-title" data-aos="zoom-out">
                    <h2>Top Mechanics</h2>
                    <div class="row">
                      <div class="col-lg-12">
                        <p>Our Skilled Mechanics</p>
                      </div>
                      
                    </div>
                </div>

                <!-- Appointment Form -->
                <div class="row my-5">
                    <div class="col-lg-4">
                        <div class="card shadow">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="fs-5 fw-bold text-center">Appointment Form</h3>
                                </div>
                            </div>
                            <!-- form Start here -->
                            <form action="">
                                <div class="card-body" style="height: 60vh; overflow-y: scroll;">

                                        <div class="form-outline mb-3 ">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <label class="form-label" for="form3Example2"class="mt-3">Location:</label>
                                                <button class="btn border border-2 mb-2" type="submit">Show Location</button>
                                            </div>                                        
                                            <input type="text" name="" id=""class="form-control p-2 ">
                                        </div>


                                        <div class="form-outline mb-3">
                                            <label class="form-label" for="form3Example2">Vehicle Type:</label>
                                            <select class="form-select" aria-label="Default select example">
                                                <option value=""></option>
                                                <option value="1">Motorcycle</option>
                                                <option value="2">Car</option>
                                            </select>
                                        </div>

                                        <div class="form-outline mb-3">
                                            <label class="form-label" for="form3Example2">Service:</label>
                                            <select class="form-select" aria-label="Default select example">
                                                <option value=""></option>
                                                <option value="1">Motorcycle</option>
                                                <option value="2">Car</option>
                                            </select>
                                        </div>

                                        <div class="form-outline mb-3">
                                            <label class="form-label" for="form3Example2">Make:</label>
                                            <select class="form-select" aria-label="Default select example">
                                                <option value=""></option>
                                                <option value="1">Motorcycle</option>
                                                <option value="2">Car</option>
                                            </select>
                                        </div>

                                        <div class="form-outline mb-3">
                                            <label class="form-label" for="form3Example2">Model:</label>
                                            <select class="form-select" aria-label="Default select example">
                                                <option value=""></option>
                                                <option value="1">Motorcycle</option>
                                                <option value="2">Car</option>
                                            </select>
                                        </div>

                                        <div class="form-outline mb-3">
                                            <label class="form-label" for="form3Example2">Notes:</label>
                                            <textarea name="" id="" cols="2" rows="5" class="w-100 form-control"></textarea>
                                        </div>
                                
                                </div>

                                <!-- Submit Button -->
                                <div class="card-footer">

                                    <button class="btn btn-light align-items-center d-flex"type="button"data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        <span>Particular Help</span><i class="bx bxs-help-circle fs-5 "></i>
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card">
                                                    <p class="p-3">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quos delectus, voluptates perferendis modi quaerat facere magni. Iusto totam debitis perspiciatis dolores corrupti cum ullam quisquam, provident error aliquam mollitia labore!</p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Got it</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                
                                    <div class="my-3 text-center">
                                        <button type="submit" class="btn fw-bold btn-block  w-100"style="background:#ff8906; border:none;color:#fffffe;">Submit Request</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Geological Map -->
                    <div class="col-lg-8 mt-lg-0 mt-5">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.708412701253!2d122.06994007444473!3d6.925416393074364!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3250419120b41fdf%3A0x8288d56b352b007d!2sKikoMonster%20Creative%20Studio!5e0!3m2!1sen!2sph!4v1688971699907!5m2!1sen!2sph" 
                            width="100%" 
                            height="450" 
                            style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                            class="border-top border-3">
                        </iframe>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">

                                <!-- Filtering TAB -->
                                <div class="my-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h3 class="fs-5 fw-bold">Filter By Mechanics</h3>
                                        <div class="menu-data">
                                            <button class="btn btn-light"type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded fs-5 fw-bold"></i>
                                            </button>

                                            <!-- Filter Dropdown -->
                                            <div class="dropdown">
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                  <li><a class="dropdown-item text-center  fw-bold" href="#">Filter By:</a></li>
                                                  <li><hr class="dropdown-divider"></li>
                                                  <li><a class="dropdown-item" href="#">Mechanics</a></li>
                                                  <li><a class="dropdown-item" href="#">Shops</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                    
                                </div>
                                                                                   
                            </div>
                            <div class="card-body">
                                <div class="my-5">
                                    <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                          <button class="nav-link active btn-light"id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#nearest" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Nearest</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                          <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Top Rated</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                          <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Cost Efficient</button>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Tab Content -->
                                <div class="tab-content" id="pills-tabContent">

                                    <!-- Nearest Item -->
                                    <div class="tab-pane fade show active" id="nearest" role="tabpanel" aria-labelledby="pills-home-tab">
                                        <div class="row row-cols-1 row-cols-md-3 g-4">

                                            <!-- Filter item -->
                                            <div class="col">
                                                <div class="member" data-aos="fade-up">
                                                    <div class="member-img">
                                                    <img src="../assets/img/mechanics/bac.jpg" class="img-fluid w-100" alt="">
                                                    <div class="social">
                                                        <a href=""><i class="bi bi-twitter"></i></a>
                                                        <a href=""><i class="bi bi-facebook"></i></a>
                                                        <a href=""><i class="bi bi-instagram"></i></a>
                                                        <a href=""><i class="bi bi-linkedin"></i></a>
                                                    </div>
                                                    </div>
                                                    <div class="member-info">
                                                    <h4>Walter White</h4>
                                                    <span>Chief Mechanics</span>
                                                    <span>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star-half"style="color:#ff8906;"></i>
                                                        <small>(1.3k)</small>
                                                    </span>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center mb-4">
                                                    <button class="btn btn-primary me-2 px-5"style="background:#ff8906;color:#fffffe; border:none;">Hire</button>
                                                    <a href="#"class="btn btn-secondary">View Details</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Filter Item -->
                                            <div class="col">
                                              <div class="member" data-aos="fade-up">
                                                    <div class="member-img">
                                                    <img src="../assets/img/mechanics/bac.jpg" class="img-fluid w-100" alt="">
                                                    <div class="social">
                                                        <a href=""><i class="bi bi-twitter"></i></a>
                                                        <a href=""><i class="bi bi-facebook"></i></a>
                                                        <a href=""><i class="bi bi-instagram"></i></a>
                                                        <a href=""><i class="bi bi-linkedin"></i></a>
                                                    </div>
                                                    </div>
                                                    <div class="member-info">
                                                    <h4>Walter White</h4>
                                                    <span>Chief Mechanics</span>
                                                    <span>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star-half"style="color:#ff8906;"></i>
                                                        <small>(1.3k)</small>
                                                    </span>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center mb-4">
                                                    <button class="btn btn-primary me-2 px-5"style="background:#ff8906;color:#fffffe; border:none;">Hire</button>
                                                    <a href="#"class="btn btn-secondary">View Details</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Filter Item -->
                                            <div class="col">
                                                <div class="member" data-aos="fade-up">
                                                    <div class="member-img">
                                                    <img src="../assets/img/mechanics/bac.jpg" class="img-fluid w-100" alt="">
                                                    <div class="social">
                                                        <a href=""><i class="bi bi-twitter"></i></a>
                                                        <a href=""><i class="bi bi-facebook"></i></a>
                                                        <a href=""><i class="bi bi-instagram"></i></a>
                                                        <a href=""><i class="bi bi-linkedin"></i></a>
                                                    </div>
                                                    </div>
                                                    <div class="member-info">
                                                    <h4>Walter White</h4>
                                                    <span>Chief Mechanics</span>
                                                    <span>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star-half"style="color:#ff8906;"></i>
                                                        <small>(1.3k)</small>
                                                    </span>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center mb-4">
                                                    <button class="btn btn-primary me-2 px-5"style="background:#ff8906;color:#fffffe; border:none;">Hire</button>
                                                    <a href="#"class="btn btn-secondary">View Details</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Filter Item -->
                                            <div class="col">
                                                <div class="member" data-aos="fade-up">
                                                    <div class="member-img">
                                                    <img src="../assets/img/mechanics/bac.jpg" class="img-fluid w-100" alt="">
                                                    <div class="social">
                                                        <a href=""><i class="bi bi-twitter"></i></a>
                                                        <a href=""><i class="bi bi-facebook"></i></a>
                                                        <a href=""><i class="bi bi-instagram"></i></a>
                                                        <a href=""><i class="bi bi-linkedin"></i></a>
                                                    </div>
                                                    </div>
                                                    <div class="member-info">
                                                    <h4>Walter White</h4>
                                                    <span>Chief Mechanics</span>
                                                    <span>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star-half"style="color:#ff8906;"></i>
                                                        <small>(1.3k)</small>
                                                    </span>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center mb-4">
                                                    <button class="btn btn-primary me-2 px-5"style="background:#ff8906;color:#fffffe; border:none;">Hire</button>
                                                    <a href="#"class="btn btn-secondary">View Details</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Filter Item -->
                                            <div class="col">
                                                <div class="member" data-aos="fade-up">
                                                    <div class="member-img">
                                                    <img src="../assets/img/mechanics/bac.jpg" class="img-fluid w-100" alt="">
                                                    <div class="social">
                                                        <a href=""><i class="bi bi-twitter"></i></a>
                                                        <a href=""><i class="bi bi-facebook"></i></a>
                                                        <a href=""><i class="bi bi-instagram"></i></a>
                                                        <a href=""><i class="bi bi-linkedin"></i></a>
                                                    </div>
                                                    </div>
                                                    <div class="member-info">
                                                    <h4>Walter White</h4>
                                                    <span>Chief Mechanics</span>
                                                    <span>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star-half"style="color:#ff8906;"></i>
                                                        <small>(1.3k)</small>
                                                    </span>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center mb-4">
                                                    <button class="btn btn-primary me-2 px-5"style="background:#ff8906;color:#fffffe; border:none;">Hire</button>
                                                    <a href="#"class="btn btn-secondary">View Details</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Filter Item -->
                                            <div class="col">
                                                <div class="member" data-aos="fade-up">
                                                    <div class="member-img">
                                                    <img src="../assets/img/mechanics/bac.jpg" class="img-fluid w-100" alt="">
                                                    <div class="social">
                                                        <a href=""><i class="bi bi-twitter"></i></a>
                                                        <a href=""><i class="bi bi-facebook"></i></a>
                                                        <a href=""><i class="bi bi-instagram"></i></a>
                                                        <a href=""><i class="bi bi-linkedin"></i></a>
                                                    </div>
                                                    </div>
                                                    <div class="member-info">
                                                    <h4>Walter White</h4>
                                                    <span>Chief Mechanics</span>
                                                    <span>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star-half"style="color:#ff8906;"></i>
                                                        <small>(1.3k)</small>
                                                    </span>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center mb-4">
                                                    <button class="btn btn-primary me-2 px-5"style="background:#ff8906;color:#fffffe; border:none;">Hire</button>
                                                    <a href="#"class="btn btn-secondary">View Details</a>
                                                    </div>
                                                </div>

                                            
                                            </div>
                                            
                                          </div>
                                          <div class="my-4">
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination  justify-content-center">
                                                  <li class="page-item">
                                                    <a class="page-link" href="#" aria-label="Previous">
                                                      <span aria-hidden="true">&laquo;</span>
                                                    </a>
                                                  </li>
                                                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                  <li class="page-item">
                                                    <a class="page-link" href="#" aria-label="Next">
                                                      <span aria-hidden="true">&raquo;</span>
                                                    </a>
                                                  </li>
                                                </ul>
                                              </nav>
                                        </div>
                                    </div>

                                    <!-- Top Rated Item -->
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                        <div class="row row-cols-1 row-cols-md-3 g-4">

                                            <!-- Filter item -->
                                            <div class="col">
                                                <div class="member" data-aos="fade-up">
                                                    <div class="member-img">
                                                    <img src="../assets/img/mechanics/bac.jpg" class="img-fluid w-100" alt="">
                                                    <div class="social">
                                                        <a href=""><i class="bi bi-twitter"></i></a>
                                                        <a href=""><i class="bi bi-facebook"></i></a>
                                                        <a href=""><i class="bi bi-instagram"></i></a>
                                                        <a href=""><i class="bi bi-linkedin"></i></a>
                                                    </div>
                                                    </div>
                                                    <div class="member-info">
                                                    <h4>Walter White</h4>
                                                    <span>Chief Mechanics</span>
                                                    <span>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star-half"style="color:#ff8906;"></i>
                                                        <small>(1.3k)</small>
                                                    </span>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center mb-4">
                                                    <button class="btn btn-primary me-2 px-5"style="background:#ff8906;color:#fffffe; border:none;">Hire</button>
                                                    <a href="#"class="btn btn-secondary">View Details</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Filter Item -->
                                            <div class="col">
                                              <div class="member" data-aos="fade-up">
                                                    <div class="member-img">
                                                    <img src="../assets/img/mechanics/bac.jpg" class="img-fluid w-100" alt="">
                                                    <div class="social">
                                                        <a href=""><i class="bi bi-twitter"></i></a>
                                                        <a href=""><i class="bi bi-facebook"></i></a>
                                                        <a href=""><i class="bi bi-instagram"></i></a>
                                                        <a href=""><i class="bi bi-linkedin"></i></a>
                                                    </div>
                                                    </div>
                                                    <div class="member-info">
                                                    <h4>Walter White</h4>
                                                    <span>Chief Mechanics</span>
                                                    <span>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star-half"style="color:#ff8906;"></i>
                                                        <small>(1.3k)</small>
                                                    </span>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center mb-4">
                                                    <button class="btn btn-primary me-2 px-5"style="background:#ff8906;color:#fffffe; border:none;">Hire</button>
                                                    <a href="#"class="btn btn-secondary">View Details</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Filter Item -->
                                            <div class="col">
                                                <div class="member" data-aos="fade-up">
                                                    <div class="member-img">
                                                    <img src="../assets/img/mechanics/bac.jpg" class="img-fluid w-100" alt="">
                                                    <div class="social">
                                                        <a href=""><i class="bi bi-twitter"></i></a>
                                                        <a href=""><i class="bi bi-facebook"></i></a>
                                                        <a href=""><i class="bi bi-instagram"></i></a>
                                                        <a href=""><i class="bi bi-linkedin"></i></a>
                                                    </div>
                                                    </div>
                                                    <div class="member-info">
                                                    <h4>Walter White</h4>
                                                    <span>Chief Mechanics</span>
                                                    <span>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star-half"style="color:#ff8906;"></i>
                                                        <small>(1.3k)</small>
                                                    </span>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center mb-4">
                                                    <button class="btn btn-primary me-2 px-5"style="background:#ff8906;color:#fffffe; border:none;">Hire</button>
                                                    <a href="#"class="btn btn-secondary">View Details</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Filter Item -->
                                            <div class="col">
                                                <div class="member" data-aos="fade-up">
                                                    <div class="member-img">
                                                    <img src="../assets/img/mechanics/bac.jpg" class="img-fluid w-100" alt="">
                                                    <div class="social">
                                                        <a href=""><i class="bi bi-twitter"></i></a>
                                                        <a href=""><i class="bi bi-facebook"></i></a>
                                                        <a href=""><i class="bi bi-instagram"></i></a>
                                                        <a href=""><i class="bi bi-linkedin"></i></a>
                                                    </div>
                                                    </div>
                                                    <div class="member-info">
                                                    <h4>Walter White</h4>
                                                    <span>Chief Mechanics</span>
                                                    <span>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star-half"style="color:#ff8906;"></i>
                                                        <small>(1.3k)</small>
                                                    </span>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center mb-4">
                                                    <button class="btn btn-primary me-2 px-5"style="background:#ff8906;color:#fffffe; border:none;">Hire</button>
                                                    <a href="#"class="btn btn-secondary">View Details</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Filter Item -->
                                            <div class="col">
                                                <div class="member" data-aos="fade-up">
                                                    <div class="member-img">
                                                    <img src="../assets/img/mechanics/bac.jpg" class="img-fluid w-100" alt="">
                                                    <div class="social">
                                                        <a href=""><i class="bi bi-twitter"></i></a>
                                                        <a href=""><i class="bi bi-facebook"></i></a>
                                                        <a href=""><i class="bi bi-instagram"></i></a>
                                                        <a href=""><i class="bi bi-linkedin"></i></a>
                                                    </div>
                                                    </div>
                                                    <div class="member-info">
                                                    <h4>Walter White</h4>
                                                    <span>Chief Mechanics</span>
                                                    <span>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star-half"style="color:#ff8906;"></i>
                                                        <small>(1.3k)</small>
                                                    </span>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center mb-4">
                                                    <button class="btn btn-primary me-2 px-5"style="background:#ff8906;color:#fffffe; border:none;">Hire</button>
                                                    <a href="#"class="btn btn-secondary">View Details</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Filter Item -->
                                            <div class="col">
                                                <div class="member" data-aos="fade-up">
                                                    <div class="member-img">
                                                    <img src="../assets/img/mechanics/bac.jpg" class="img-fluid w-100" alt="">
                                                    <div class="social">
                                                        <a href=""><i class="bi bi-twitter"></i></a>
                                                        <a href=""><i class="bi bi-facebook"></i></a>
                                                        <a href=""><i class="bi bi-instagram"></i></a>
                                                        <a href=""><i class="bi bi-linkedin"></i></a>
                                                    </div>
                                                    </div>
                                                    <div class="member-info">
                                                    <h4>Walter White</h4>
                                                    <span>Chief Mechanics</span>
                                                    <span>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star-half"style="color:#ff8906;"></i>
                                                        <small>(1.3k)</small>
                                                    </span>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center mb-4">
                                                    <button class="btn btn-primary me-2 px-5"style="background:#ff8906;color:#fffffe; border:none;">Hire</button>
                                                    <a href="#"class="btn btn-secondary">View Details</a>
                                                    </div>
                                                </div>

                                            
                                            </div>
                                            
                                          </div>
                                          <div class="my-4">
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination  justify-content-center">
                                                  <li class="page-item">
                                                    <a class="page-link" href="#" aria-label="Previous">
                                                      <span aria-hidden="true">&laquo;</span>
                                                    </a>
                                                  </li>
                                                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                  <li class="page-item">
                                                    <a class="page-link" href="#" aria-label="Next">
                                                      <span aria-hidden="true">&raquo;</span>
                                                    </a>
                                                  </li>
                                                </ul>
                                              </nav>
                                        </div>
                                    </div>

                                    <!-- Cost Efficient Item -->
                                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                        <div class="row row-cols-1 row-cols-md-3 g-4">

                                            <!-- Filter item -->
                                            <div class="col">
                                                <div class="member" data-aos="fade-up">
                                                    <div class="member-img">
                                                    <img src="../assets/img/mechanics/bac.jpg" class="img-fluid w-100" alt="">
                                                    <div class="social">
                                                        <a href=""><i class="bi bi-twitter"></i></a>
                                                        <a href=""><i class="bi bi-facebook"></i></a>
                                                        <a href=""><i class="bi bi-instagram"></i></a>
                                                        <a href=""><i class="bi bi-linkedin"></i></a>
                                                    </div>
                                                    </div>
                                                    <div class="member-info">
                                                    <h4>Walter White</h4>
                                                    <span>Chief Mechanics</span>
                                                    <span>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star-half"style="color:#ff8906;"></i>
                                                        <small>(1.3k)</small>
                                                    </span>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center mb-4">
                                                    <button class="btn btn-primary me-2 px-5"style="background:#ff8906;color:#fffffe; border:none;">Hire</button>
                                                    <a href="#"class="btn btn-secondary">View Details</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Filter Item -->
                                            <div class="col">
                                              <div class="member" data-aos="fade-up">
                                                    <div class="member-img">
                                                    <img src="../assets/img/mechanics/bac.jpg" class="img-fluid w-100" alt="">
                                                    <div class="social">
                                                        <a href=""><i class="bi bi-twitter"></i></a>
                                                        <a href=""><i class="bi bi-facebook"></i></a>
                                                        <a href=""><i class="bi bi-instagram"></i></a>
                                                        <a href=""><i class="bi bi-linkedin"></i></a>
                                                    </div>
                                                    </div>
                                                    <div class="member-info">
                                                    <h4>Walter White</h4>
                                                    <span>Chief Mechanics</span>
                                                    <span>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star-half"style="color:#ff8906;"></i>
                                                        <small>(1.3k)</small>
                                                    </span>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center mb-4">
                                                    <button class="btn btn-primary me-2 px-5"style="background:#ff8906;color:#fffffe; border:none;">Hire</button>
                                                    <a href="#"class="btn btn-secondary">View Details</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Filter Item -->
                                            <div class="col">
                                                <div class="member" data-aos="fade-up">
                                                    <div class="member-img">
                                                    <img src="../assets/img/mechanics/bac.jpg" class="img-fluid w-100" alt="">
                                                    <div class="social">
                                                        <a href=""><i class="bi bi-twitter"></i></a>
                                                        <a href=""><i class="bi bi-facebook"></i></a>
                                                        <a href=""><i class="bi bi-instagram"></i></a>
                                                        <a href=""><i class="bi bi-linkedin"></i></a>
                                                    </div>
                                                    </div>
                                                    <div class="member-info">
                                                    <h4>Walter White</h4>
                                                    <span>Chief Mechanics</span>
                                                    <span>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star-half"style="color:#ff8906;"></i>
                                                        <small>(1.3k)</small>
                                                    </span>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center mb-4">
                                                    <button class="btn btn-primary me-2 px-5"style="background:#ff8906;color:#fffffe; border:none;">Hire</button>
                                                    <a href="#"class="btn btn-secondary">View Details</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Filter Item -->
                                            <div class="col">
                                                <div class="member" data-aos="fade-up">
                                                    <div class="member-img">
                                                    <img src="../assets/img/mechanics/bac.jpg" class="img-fluid w-100" alt="">
                                                    <div class="social">
                                                        <a href=""><i class="bi bi-twitter"></i></a>
                                                        <a href=""><i class="bi bi-facebook"></i></a>
                                                        <a href=""><i class="bi bi-instagram"></i></a>
                                                        <a href=""><i class="bi bi-linkedin"></i></a>
                                                    </div>
                                                    </div>
                                                    <div class="member-info">
                                                    <h4>Walter White</h4>
                                                    <span>Chief Mechanics</span>
                                                    <span>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star-half"style="color:#ff8906;"></i>
                                                        <small>(1.3k)</small>
                                                    </span>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center mb-4">
                                                    <button class="btn btn-primary me-2 px-5"style="background:#ff8906;color:#fffffe; border:none;">Hire</button>
                                                    <a href="#"class="btn btn-secondary">View Details</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Filter Item -->
                                            <div class="col">
                                                <div class="member" data-aos="fade-up">
                                                    <div class="member-img">
                                                    <img src="../assets/img/mechanics/bac.jpg" class="img-fluid w-100" alt="">
                                                    <div class="social">
                                                        <a href=""><i class="bi bi-twitter"></i></a>
                                                        <a href=""><i class="bi bi-facebook"></i></a>
                                                        <a href=""><i class="bi bi-instagram"></i></a>
                                                        <a href=""><i class="bi bi-linkedin"></i></a>
                                                    </div>
                                                    </div>
                                                    <div class="member-info">
                                                    <h4>Walter White</h4>
                                                    <span>Chief Mechanics</span>
                                                    <span>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star-half"style="color:#ff8906;"></i>
                                                        <small>(1.3k)</small>
                                                    </span>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center mb-4">
                                                    <button class="btn btn-primary me-2 px-5"style="background:#ff8906;color:#fffffe; border:none;">Hire</button>
                                                    <a href="#"class="btn btn-secondary">View Details</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Filter Item -->
                                            <div class="col">
                                                <div class="member" data-aos="fade-up">
                                                    <div class="member-img">
                                                    <img src="../assets/img/mechanics/bac.jpg" class="img-fluid w-100" alt="">
                                                    <div class="social">
                                                        <a href=""><i class="bi bi-twitter"></i></a>
                                                        <a href=""><i class="bi bi-facebook"></i></a>
                                                        <a href=""><i class="bi bi-instagram"></i></a>
                                                        <a href=""><i class="bi bi-linkedin"></i></a>
                                                    </div>
                                                    </div>
                                                    <div class="member-info">
                                                    <h4>Walter White</h4>
                                                    <span>Chief Mechanics</span>
                                                    <span>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star"style="color:#ff8906;"></i>
                                                        <i class="bx bxs-star-half"style="color:#ff8906;"></i>
                                                        <small>(1.3k)</small>
                                                    </span>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center mb-4">
                                                    <button class="btn btn-primary me-2 px-5"style="background:#ff8906;color:#fffffe; border:none;">Hire</button>
                                                    <a href="#"class="btn btn-secondary">View Details</a>
                                                    </div>
                                                </div>

                                            
                                            </div>
                                            
                                          </div>
                                          <div class="my-4">
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination  justify-content-center">
                                                  <li class="page-item">
                                                    <a class="page-link" href="#" aria-label="Previous">
                                                      <span aria-hidden="true">&laquo;</span>
                                                    </a>
                                                  </li>
                                                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                  <li class="page-item">
                                                    <a class="page-link" href="#" aria-label="Next">
                                                      <span aria-hidden="true">&raquo;</span>
                                                    </a>
                                                  </li>
                                                </ul>
                                              </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                
            </div>
        </section>

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