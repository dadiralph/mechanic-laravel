@extends('users.user_layouts.app')

@section('page_title', 'Auto Mechanics | Workshops')
@section('workshop', 'active')

@section('content')

<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs "
    style="height:45vh; background-image: url(../../assets/img/Services/pic1.jpg); object-fit:cover; ">
    <div class="container position-relative ">
        <div class="justify-content-center position-absolute mt-5 border p-lg-3 p-y-3 shadow rounded w-50"
            style="top:50%;left:50%;transform:translate(-50%, 0%);">
            <h2 class="fs-2 fw-bold text-white mt-4 text-center">Look for Shop nearest from you!</h2>
            <ol class=" justify-content-center mt-4">
                <li class=" fw-bold"><a href="../">Home</a></li>
                <li class=" fw-bold text-white">Workhop Look-Up</li>
            </ol>
        </div>
    </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Nearby Shop ======= -->
<section id="recent-blog-posts" class="recent-blog-posts">

    <div class="container my-5">
        <div class="section-title" data-aos="zoom-out">
            <h2>Look Up</h2>
            <p>Locate your current location</p>
        </div>
        <!-- <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.708412701253!2d122.06994007444473!3d6.925416393074364!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3250419120b41fdf%3A0x8288d56b352b007d!2sKikoMonster%20Creative%20Studio!5e0!3m2!1sen!2sph!4v1688971699907!5m2!1sen!2sph"
            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe> -->
        <div id="map"></div>
    </div>

    <div class="container" data-aos="fade-up">
        <div class="section-title" data-aos="zoom-out">
            <h2>Nearby Shop</h2>
            <p>Nearest shop in your location</p>
        </div>
        <div class="row" id="shops">
        </div>
    </div>

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
                    const { latitude, longitude } = position.coords;
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
                    success: function (response) {
                        console.log(response)
                        const shops = response.shops
                        const container = document.querySelector('#shops');
                        for (let i = 0; i < shops.length; i++) {
                            const shop = shops[i]
                            if (shop['latitude'] != null) {
                                new mapboxgl.Marker({ color: 'red' })
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
                    error: function (xhr) {
                        console.log(xhr)
                    }
                });
            }
        }

    </script>


    @endsection