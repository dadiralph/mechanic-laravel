@extends('users.user_layouts.app')
@section('content')
<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs " style="height:45vh; background-image: url(../../assets/img/Services/pic1.jpg); object-fit:cover; ">
    <div class="container position-relative ">

        <div class="justify-content-center position-absolute mt-5 border p-lg-3 p-y-3 shadow rounded w-50" style="top:50%;left:50%;transform:translate(-50%, 0%);">
            <h2 class="fs-2 fw-bold text-white mt-4 text-center">Choose your freelancers here!</h2>
            <ol class=" justify-content-center mt-4">
                <li class=" fw-bold"><a href="../">Home</a></li>
                <li class=" fw-bold text-white">Freelancers</li>
            </ol>
        </div>

    </div>
</section><!-- End Breadcrumbs -->

<section class="team">
    <!-- filterazation Start -->
    <div class="container-fluid my-5">
        <div class="row px-xl-5">
            <!-- Filter Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- FILTERING USING OFFCANVAS  -->
                <div class="container">

                    <!-- Content for larger screens -->
                    <!-- ITEM 1 FILTERING -->
                    <!-- <div class="d-none d-lg-block">

                        <h5 class=" text-uppercase  mb-3"><span class="fs-5 fw-bold">Filter</span></h5>
                        <div class="bg-light shadow rounded p-3">
                            <form>
                                <div
                                    class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                    <input type="checkbox" class="custom-control-input" checked id="price-all">
                                    <label class="custom-control-label" for="price-all">All to be filtered</label>

                                </div>
                            </form>
                        </div>
                        ITEM 1 FILTERING END
                    </div> -->

                    <!-- Button for smaller screens -->
                    <div class="bg-light py-4 shadow rounded d-lg-none d-block">
                        <button class="btn btn-light d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">

                            <span class="navbar-toggler-icon ">

                                <i class="bx bx-menu-alt-right fs-bold fs-2"></i>
                                <button class="btn btn-sm btn-light d-lg-none d-inline-block"><i class="bx bx-grid-alt fs-bold fs-5"></i></button>
                                <form class="form d-lg-none d-flex ">
                                    <button>
                                        <svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="search">
                                            <path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9" stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </button>
                                    <input class="input" placeholder="Search any keywords" required="" type="text" class="w-100">
                                    <button class="reset" type="reset">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </form>
                            </span>
                        </button>
                    </div>

                    <!-- Offcanvas -->
                    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Filter Mechanics</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <!-- <div class="offcanvas-body ">

                            <h5 class="text-uppercase my-4"><span class="fs-5 fw-bold">Filter</span></h5>
                            <div class="bg-light">
                                <form>
                                    <div
                                        class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                        <input type="checkbox" class="custom-control-input" checked id="price-all">
                                        <label class="custom-control-label" for="price-all">All to be filtered</label>

                                    </div>

                                </form>

                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
            <!-- filter Sidebar End -->
            <!-- filter Mechanics Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="d-lg-flex d-none align-items-center justify-content-between">
                                        <button class="btn btn-sm btn-light bg-light shadow rounded"><i class="bx bx-grid-alt fs-bold fs-5"></i></button>
                                        <form class="form ">
                                            <button>
                                                <svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="search">
                                                    <path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9" stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </button>
                                            <input class="input" placeholder="Search any keywords" required="" type="text" class="w-100">
                                            <button class="reset" type="reset">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex my-4 justify-content-lg-end justify-content-center ">
                                        <div class="me-2 bg-light shadow rounded">
                                            <div class="dropdown">
                                                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Sort by:
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li><a class="dropdown-item" href="#">Latest</a></li>
                                                    <li><a class="dropdown-item" href="#">Popularity</a></li>
                                                    <li><a class="dropdown-item" href="#">Best Rating</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="me-2 bg-light shadow rounded">
                                            <div class="dropdown">
                                                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Show as:
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li><a class="dropdown-item" href="#">Available</a></li>
                                                    <li><a class="dropdown-item" href="#">Unavailable</a></li>
                                                    <li><a class="dropdown-item" href="#">On Duty</a></li>
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1 d-flex w-100 gap-5 flex-wrap">
                        @foreach ($freelancers as $freelancer)
                        <div class="member" data-aos="fade-up">
                            <div class="member-img">
                                <img src="{{ $freelancer['profile'] }}" class="img-fluid w-100" alt="{{ $freelancer['name']['first_name'] }} {{ $freelancer['name']['middle_name'] }} {{ $freelancer['name']['last_name'] }} {{ $freelancer['name']['suffix'] }}">
                                <div class="social">
                                    {{--
                                    <a href="{{ $freelancer['twitter_link'] }}"><i class="bi bi-twitter"></i></a>
                                    <a href="{{ $freelancer['facebook_link'] }}"><i class="bi bi-facebook"></i></a>
                                    <a href="{{ $freelancer['instagram_link'] }}"><i class="bi bi-instagram"></i></a>
                                    <a href="{{ $freelancer['linkedin_link'] }}"><i class="bi bi-linkedin"></i></a>
                                    --}}
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>{{ $freelancer['name']['first_name'] }} {{ $freelancer['name']['middle_name'] }} {{
                                    $freelancer['name']['last_name'] }} {{ $freelancer['name']['suffix'] }}</h4>
                                <span>Freelancer</span>
                                <span>
                                    @for ($i = 1; $i <= 5; $i++) @if(isset($freelancer['ratings'])) @if ($i <=$freelancer['ratings']) <i class="bx bxs-star" style="color: #ff8906;"></i>
                                        @else
                                        <i class="bx bxs-star" style="color: #ddd;"></i>
                                        @endif
                                        @else
                                        <i class="bx bxs-star" style="color: #ddd;"></i>
                                        @endif
                                        @endfor
                                </span>
                                <span>
                                    @foreach($freelancer['services'] as $service)
                                        <span>{{$service}}</span>
                                    @endforeach
                                </span>
                                {{--
                                <span>
                                    @for ($i = 1; $i <= 5; $i++) @if ($i <=$freelancer['rating']) <i class="bx bxs-star"
                                        style="color: #ff8906;"></i>
                                        @else
                                        <i class="bx bxs-star" style="color: #ddd;"></i>
                                        @endif
                                        @endfor
                                        <small>({{ $freelancer['reviews'] }})</small>
                                </span>
                                --}}
                            </div>
                            <div class="d-flex flex-column gap-4 align-items-center justify-content-center mb-4">
                                <a href="{{ route('hire', ['id' => $freelancer['id']]) }}">

                                    <button class="btn btn-primary me-2 px-5" style="background: #ff8906; color: #fffffe; border: none;">Make
                                        Appointment</button>
                                </a>
                                <a href="{{ route('chats_id', ['id' => $freelancer['id']]) }}">
                                    <button class="btn btn-primary me-2 px-5" style="background: #ff8906; color: #fffffe; border: none;">Chat</button>
                                </a>
                                <!-- <a href="#" class="btn btn-secondary">View Details</a> -->
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <!-- <div class="col-12">
                                <nav>
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item disabled"><a class="page-link" href="#">Previous</span></a></li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                    </ul>
                                </nav>
                            </div> -->
                </div>
            </div>
            <!-- filter mechanics End -->
        </div>
    </div>
    <!-- Filterazation End -->
</section>



@endsection