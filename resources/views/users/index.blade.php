@extends('users.user_layouts.app')

@section('page_title', 'Auto Mechanics')
@section('home', 'active')
@section('transparent-header', 'header-transparent')

@section('hero')

<section id="hero" class="d-flex flex-column justify-content-end align-items-center">
  <div id="heroCarousel" data-bs-interval="5000" class="container carousel carousel-fade" data-bs-ride="carousel">

    <!-- Slide 1 -->
    <div class="carousel-item active">
      <div class="carousel-container">
        <h2 class="animate__animated animate__fadeInDown">Welcome to <span>Auto Mechanics</span></h2>
        <p class="animate__animated fanimate__adeInUp">Your Trusted Roadside Assistance Partner!
At Emergency Mechanic, we understand that vehicle breakdowns can happen at the most inconvenient times. That's why we're here to offer swift and reliable roadside assistance to get you back on the road in no time.</p>
        <a href="{{ route('freelancers') }}" class="btn-get-started animate__animated animate__fadeInUp scrollto">Get
          Started</a>
      </div>
    </div>

    <!-- Slide 2 -->
    <div class="carousel-item">
      <div class="carousel-container">
        <h2 class="animate__animated animate__fadeInDown">24/7 Assistance Anywhere, Anytime</h2>
        <p class="animate__animated animate__fadeInUp">Breakdowns don't wait for convenient hours, and neither do we. Emergency Mechanic is at your service 24 hours a day, 7 days a week. Whether it's the crack of dawn or the dead of night, our team is always ready to respond swiftly to your call for assistance, providing you with peace of mind on every journey.</p>
        <a href="{{ route('freelancers') }}" class="btn-get-started animate__animated animate__fadeInUp scrollto">Get
          Started</a>
      </div>
    </div>

    <!-- Slide 3 -->
    <div class="carousel-item">
      <div class="carousel-container">
        <h2 class="animate__animated animate__fadeInDown">Join the Emergency Mechanic Community</h2>
        <p class="animate__animated animate__fadeInUp">Become a part of the Emergency Mechanic community and experience a new level of convenience and reliability in roadside assistance. Sign up for our newsletter to receive exclusive offers, maintenance tips, and updates on the latest in automotive care. Trust Emergency Mechanic to be your go-to partner in times of need, because when it comes to your vehicle, we've got your back!</p>
        <a href="{{ route('freelancers') }}" class="btn-get-started animate__animated animate__fadeInUp scrollto">Get
          Started</a>
      </div>
    </div>

    <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
      <span class="carousel-control-prev-icon bx bx-chevron-left" aria-hidden="true"></span>
    </a>

    <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
      <span class="carousel-control-next-icon bx bx-chevron-right" aria-hidden="true"></span>
    </a>

  </div>

  <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
    viewBox="0 24 150 28 " preserveAspectRatio="none">
    <defs>
      <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
    </defs>
    <g class="wave1">
      <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
    </g>
    <g class="wave2">
      <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
    </g>
    <g class="wave3">
      <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
    </g>
  </svg>

</section>

@endsection

@section('content')

<!-- ======= Workshop Section ======= -->
<section id="testimonials" class="testimonials">
  <div class="container">
    <div class="section-title" data-aos="zoom-out">
      <h2>Popuplar Shop</h2>
      <div class="row">
        <div class="col-lg-6">
          <p>Look! for our Popular shop</p>
        </div>
        <div class="col-lg-6 text-end mt-lg-0 mt-4">
          <a href="#" class="btn btn-secondary">See All</a>
        </div>
      </div>
    </div>

    <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
      <div class="swiper-wrapper">

        <div class="swiper-slide">
          <div class="card mb-3 shadow" style="max-width: 640px;">
            <div class="row g-0">
              <div class="col-md-7">
                <div class="image-container">
                  <img src="assets/img/Services/pic1.jpg" class="img-fluid rounded-start"
                    style="object-fit: cover; height: 52vh;">
                  <figcaption>
                    <a href="#" class="btn btn-primary fw-bold align-items-center"><i
                        class="bi bi-arrow-right me-2"></i>View Shop</a>
                  </figcaption>
                </div>
              </div>
              <div class="col-md-5">
                <div class="card-body" style="background:#0f0e17;height: 52vh;">
                  <a href="#">
                    <h5 class="card-title" style="color:#fffffe;"><strong>AUTOBOT OFFROAD</strong></h5>
                    <span style="color:#a7a9be;">Pasonsanca, Zamboanga City</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Workhop item -->
      </div>
      <div class="swiper-pagination"></div>
    </div>

  </div>
</section><!-- End Testimonials Section -->

<!-- ======= Team Section ======= -->
<section id="team" class="team">
  <div class="container mechanics">

    <div class="section-title" data-aos="zoom-out">
      <h2>Top Mechanics</h2>
      <div class="row">
        <div class="col-lg-6">
          <p>Our Skilled Mechanics</p>
        </div>
        <div class="col-lg-6 text-end">
          <a href="/freelancers" class="btn btn-secondary ">See All</a>
        </div>
      </div>
    </div>

    <!-- Swiper -->
    <div class="swiper portfolio-details-slider">
      <div class="swiper-wrapper">

        @foreach ($mechanics as $mechanic)
        <div class="swiper-slide">
          <div class="member" data-aos="fade-up">
            <div class="member-img">
              <img src="{{ $mechanic['profile'] }}" class="img-fluid" alt="">
              <!-- <div class="social">
                            <a href=""><i class="bi bi-twitter"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                          </div> -->
            </div>
            <div class="member-info">
              <h4>{{ $mechanic['name']['first_name'] }} {{ $mechanic['name']['middle_name'] }} {{
                $mechanic['name']['last_name'] }} {{ $mechanic['name']['suffix'] }}</h4>
            </div>
            <div class="d-flex align-items-center justify-content-center mb-4">
              <a href="{{ route('hire', ['id' => $mechanic['id']]) }}" class="btn btn-primary me-2 px-5"
                style="background:#ff8906;color:#fffffe; border:none;">Hire</a>
              <a href="{{ route('chats_id', ['id' => $mechanic['id']]) }}" class="btn btn-secondary">Message</a>
            </div>
          </div>
        </div><!-- End Workhop item -->
        @endforeach

      </div>
      <div class="swiper-pagination"></div>
    </div>

  </div>
</section><!-- End Team Section -->

<!-- ======= Values Section ======= -->
<section id="Services" class="values">
  <div class="container">

    <div class="section-title" data-aos="zoom-out">
      <h2>Services</h2>
      <p>What We Do Offer</p>
    </div>

    <div class="row">
      <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
        <div class="card" style="background-image: url(assets/img/Services/pic1.jpg);">
          <div class="card-body">
            <h5 class="card-title"><a href="">Mechanic Freelancers</a></h5>
            <p class="card-text">Our platform connects you with experienced freelance mechanics ready to provide top-notch service. Simply submit your request, and let our dedicated professionals get your vehicle back on the road.</p>
            <div class="read-more"><a href="#" class="btn btn-secondary text-white"><i class="bi bi-arrow-right"></i>
                Request Service</a></div>
          </div>
        </div>
      </div>
      <div class="col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="100">
        <div class="card" style="background-image: url(assets/img/Services/shop2.jpg);">
          <div class="card-body">
            <h5 class="card-title"><a href="#">Mechanic Shop</a></h5>
            <p class="card-text">Explore our network of reputable mechanic shops where expertise meets quality service. Browse through a variety of auto repair centers, each committed to delivering excellence in car and motor maintenance and repairs. Find the perfect shop for your needs and schedule your visit hassle-free.</p>
            <div class="read-more"><a href="#" class="btn btn-secondary text-white"><i class="bi bi-arrow-right"></i>
                View Shop</a></div>
          </div>
        </div>

      </div>
    </div>

  </div>
</section><!-- End Values Section -->

@endsection