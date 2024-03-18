@extends('users.user_layouts.app')

@section('page_title', 'Auto Mechanics | Workshops')
@section('workshop', 'active')

@section('content')

<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs " style="height:45vh; background-image: url(../../assets/img/Services/pic1.jpg); object-fit:cover; ">
    <div class="container position-relative ">
        <div class="justify-content-center position-absolute mt-5 border p-lg-3 p-y-3 shadow rounded w-50" style="top:50%;left:50%;transform:translate(-50%, 0%);">
            <ol class=" justify-content-center mt-4">
                <li class=" fw-bold"><a href="../">Home</a></li>
            </ol>
        </div>
    </div>
</section><!-- End Breadcrumbs -->

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
                        <span>Freelancer</span>
                        </br>
                        <span>
                            @for ($i = 1; $i <= 5; $i++) @if(isset($mechanic['ratings'])) @if ($i <=$mechanic['ratings']) <i class="bx bxs-star" style="color: #ff8906;"></i>
                                @else
                                <i class="bx bxs-star" style="color: #ddd;"></i>
                                @endif
                                @else
                                <i class="bx bxs-star" style="color: #ddd;"></i>
                                @endif
                                @endfor
                        </span>
                        </br>
                        <div class="mt-2 mb-3">
                            @foreach($mechanic['services'] as $service)
                            <span>{{$service}}</span>
                            </br>
                            @endforeach
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-4">
                            <a href="{{ route('hire', ['id' => $mechanic['id']]) }}" class="btn btn-primary me-2 px-5" style="background:#ff8906;color:#fffffe; border:none;">Hire</a>
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

<!-- ======= Nearby Shop ======= -->
<section id="recent-blog-posts" class="recent-blog-posts">
    <div class="container" data-aos="fade-up">
        <div class="section-title" data-aos="zoom-out">
            <h2>Nearby Shop</h2>
            <p>Nearest shop in your location</p>
        </div>
        <div id="map" hidden></div>
        <div class="row" id="shops">
        </div>
    </div>
</section>

<script>
    // Function to calculate distance between two sets of coordinates
    function calculateDistance(lat1, lon1, lat2, lon2) {
        return calculateHaversineDistance(lat1, lon1, lat2, lon2).toFixed(1);
    }

    // Function to calculate distance using Haversine formula
    function calculateHaversineDistance(lat1, lon1, lat2, lon2) {
        const R = 6371; // Radius of the Earth in kilometers
        const dLat = deg2rad(lat2 - lat1);
        const dLon = deg2rad(lon2 - lon1);
        const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * Math.sin(dLon / 2) * Math.sin(dLon / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        const distance = R * c; // Distance in kilometers
        return distance;
    }

    function deg2rad(deg) {
        return deg * (Math.PI / 180);
    }

    mapboxgl.accessToken = 'pk.eyJ1Ijoibmp0YW4xNDIiLCJhIjoiY2w4d2pnZmZ6MG82dzN3cXZyb2FtOW1xZyJ9.G7-OEK4yKaaGEDjeYckmgA';
    if (!mapboxgl.supported()) {
        alert('Your browser does not support Mapbox GL');
    } else {
        const map = new mapboxgl.Map({
            container: 'map',
            // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
            style: 'mapbox://styles/mapbox/streets-v12',
            center: [-74.5, 40],
            zoom: 13
        });

        navigator.geolocation.getCurrentPosition(
            position => {
                const {
                    latitude,
                    longitude
                } = position.coords;
                // Center the map on the user's location
                map.setCenter([longitude, latitude]);
                // Add a marker for the user's current location
                new mapboxgl.Marker()
                    .setLngLat([longitude, latitude])
                    .addTo(map);
                getShops(longitude, latitude);
            },
            error => {
                console.error('Error getting user location:', error.message);
            }
        );

        function getShops(latitude, longitude) {
            $.ajax({
                url: 'shops',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response)
                    const shops = response.shops
                    const container = document.querySelector('#shops');
                    for (let i = 0; i < shops.length; i++) {
                        const shop = shops[i]
                        const search = "{{$search}}"
                        let found = false;

                        Object.values(shop).forEach((field) => {
                            if (Array.isArray(field)) {
                                // If the field is an array, search within its elements
                                field.forEach((element) => {
                                    if (element.toString().toLowerCase().includes(search.toLowerCase())) {
                                        found = true;
                                    }
                                });
                            } else {
                                // If the field is not an array, directly search within it
                                if (field.toString().toLowerCase().includes(search.toLowerCase())) {
                                    found = true;
                                }
                            }
                        });

                        // If search is found in any field or its nested arrays, do something
                        if (!found) {
                            continue
                        }
                        if (shop['latitude'] != null) {
                            new mapboxgl.Marker({
                                    color: 'red'
                                })
                                .setLngLat([shop['longitude'], shop['latitude']])
                                .setPopup(new mapboxgl.Popup().setHTML('<h3>' + shop['shop_name'] + '</h3>'))
                                .addTo(map);

                            const shopElement = document.createElement('div');
                            shopElement.className = 'col-lg-4';
                            shopElement.innerHTML = `
                                <div class="post-box">
                                    <div class="post-img"><img src="${shop['cover_photo']}" class="img-fluid w-100" alt="" style="height: 40vh; object-fit:cover;"></div>
                                    <span class="post-date">${calculateDistance(latitude, longitude, shop['latitude'], shop['longitude'])/1000} kilometers away</span>
                                    <h3 class="post-title">${shop['shop_name']}</h3>
                                    <a href="Hire-Mechanic/${shop['id']}"><span>Make Appointment</span><i class="bi bi-arrow-right"></i></a>
                                    <a href="chats/${shop['id']}"><span>Message</span><i class="bi bi-arrow-right"></i></a>
                                </div>
                            `;
                            container.appendChild(shopElement);
                        }
                    }
                },
                error: function(xhr) {
                    console.log(xhr)
                }
            });
        }
    }
</script>


@endsection