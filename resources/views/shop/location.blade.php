@extends('shop.shop_layouts.app')

@section('page_title', 'Auto Mechanics | Messages')
@section('appointment', 'collapsed')
@section('dashboard', 'collapsed')
@section('messages', 'collapsed')

@section('content')

<div class="pagetitle">
    <h1>Location</h1>
</div>

<section>
    <div id="map"></div>
    <div class="p-3 d-flex justify-content-center align-items-center">
        <button id="saveLocation" type="button" class="btn btn-primary">Save as Shop Location</button>
    </div>
</section>
<script>
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
        markers = []

        navigator.geolocation.getCurrentPosition(
            position => {
                const { latitude, longitude } = position.coords;
                // Center the map on the user's location
                map.setCenter([longitude, latitude]);
                // Add a marker for the user's current location
                const userMarker = new mapboxgl.Marker()
                    .setLngLat([longitude, latitude])
                    .addTo(map);
                markers.push(userMarker)
            },
            error => {
                console.error('Error getting user location:', error.message);
            }
        );
        map.on('click', (e) => {
            const { lng, lat } = e.lngLat;
            removeAllMarkers()
            // Add a marker at the clicked location
            const marker = new mapboxgl.Marker()
                .setLngLat([lng, lat])
                .addTo(map);
            markers.push(marker)

        });
        function removeAllMarkers() {
            markers.forEach(marker => marker.remove());
            // Clear the markers array
            markers.length = 0;
        }
        const saveButton = document.getElementById('saveLocation');
        saveButton.addEventListener('click', saveLocation);

        function saveLocation() {
            const firstMarkerLocation = markers[0]._lngLat
            // console.log(firstMarkerLocation._lngLat)
            const apiUrl = 'location/save/';
            var csrfToken = "{{ csrf_token() }}";
            const data = {
                _token: csrfToken,
                latitude: firstMarkerLocation.lat,
                longitude: firstMarkerLocation.lng
            };
            $.ajax({
                url: apiUrl,
                type: 'POST',
                data: data,
                success: function (response) {
                    console.log(response)
                    toastr.success('{{ Session::get('success') }}', 'Location saved', {
                        closeButton: true,
                        progressBar: true,
                        timeOut: 1000
                    });
                    // You can handle the success response here, e.g., update UI or show a success message
                },
                error: function (error) {
                    console.error('Error sending message:', error);
                    // You can handle the error response here, e.g., show an error message
                }
            });
        }
    }

</script>

@endsection

@section('toastr_script')

@if (Session::has('success'))
<script>
    toastr.options = {
        'progressBar': true,
        "closeButton": true,
    }
    toastr.success("{{ Session::get('success') }}", 'Success!', { timeout: 12000 })
</script>

@endif

@endsection