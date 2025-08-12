@extends('layouts.profile')

@section('title', 'Location')

@section('location', 'text-primary')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/leaflet.css') }}" />
@endpush

@section('modals')
    <div class="fixed top-0 left-0 bg-black/50 z-50 hidden" id="modal">
        <div class="flex w-screen h-screen items-center justify-center">
            <div class="p-8 bg-white rounded-lg w-1/2">
                <div class="text-xl mb-8 font-bold flex items-center justify-between">
                    <p></p>
                    <p class="text-black">Add Address</p>
                    <button type="button" class="text-gray hover:text-primary" onclick="toggleModal()">
                        <x-heroicon-o-x-circle class="w-8 h-8" />
                    </button>
                </div>
                <div class="flex justify-evenly mb-4 text-black">
                    <div class="text-center inline-flex flex-col items-center">
                        <button type="button" class="border border-primary rounded-full text-primary h-8 w-8 flex items-center justify-center mb-1 cursor-pointer" id="button-pinpoint-location" onclick="goToStep(1)">1</button>
                        <p class="text-xs">Pinpoint location</p>
                    </div>
                    <div class="text-center inline-flex flex-col items-center">
                        <button type="button" class="border border-primary rounded-full text-white bg-gray-light h-8 w-8 flex items-center justify-center mb-1 cursor-pointer" id="button-complete-address" onclick="goToStep(2)">2</button>
                        <p class="text-xs">Complete address detail</p>
                    </div>
                </div>
                <hr class="mb-4">
                <div class="" id="tab-pinpoint-location">
                    <p class="mb-4 text-lg font-bold text-black">Please Confirm this is your address?</p>
                    <div id="map" class="w-full h-64 rounded-lg mb-4"></div>
                    <div class="flex justify-evenly text-gray text-sm mb-4">
                        <p>Latitude: <span class="latitude">Loading...</span></p>
                        <p>Longitude: <span class="longitude">Loading...</span></p>
                    </div>
                    <x-button variant="primary" onclick="goToStep(2)" block>Confirm Location</x-button>
                </div>
                <form class="hidden" id="tab-complete-address-detail" action="{{ route('locations.store') }}" method="POST">
                    @csrf

                    <p class="mb-4 text-lg font-bold text-black">Please Confirm this is your address?</p>

                    <input type="hidden" name="latitude" class="latitude">
                    <input type="hidden" name="longitude" class="longitude">
                    <div class="mb-4">
                        <x-form.label for="address">Address</x-form.label>
                        <x-form.textarea name="address" id="address" placeholder="ex. New Kemanggisan Street No. 10 2F" rows="2" required></x-form.textarea>
                    </div>
                    <div class="flex gap-4 mb-4">
                        <div class="w-1/3">
                            <x-form.label for="city">City</x-form.label>
                            <x-form.input type="text" name="city" id="city" placeholder="ex. Jakarta" required/>
                        </div>
                        <div class="w-1/3">
                            <x-form.label for="country">Country</x-form.label>
                            <x-form.input type="text" name="country" id="country" placeholder="ex. Indonesia" required/>
                        </div>
                        <div class="w-1/3">
                            <x-form.label for="postal_code">Postal Code</x-form.label>
                            <x-form.input type="text" name="postal_code" id="postal_code" placeholder="ex. 12025" minlength="5" maxlength="5" pattern="[0-9]{5}" required/>
                        </div>
                    </div>

                    <div class="mb-8">
                        <x-form.label for="notes">Notes</x-form.label>
                        <x-form.input type="text" name="notes" id="notes" placeholder="ex. Black Gate, White Building" required/>
                    </div>
                    <x-button type="submit" variant="primary" block>Add New Address</x-button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <section>
        <div class="flex justify-end mb-4">
            <x-button variant="primary" onclick="toggleModal()">+ Add New Address</x-button>
        </div>

        <div class="flex flex-col gap-4 text-black">
            @if (Auth::user()->locations->count() > 0)
                @foreach (Auth::user()->locations as $key => $location)
                    @if ($key === 0)
                        <div class="p-4 bg-primary-light border border-primary rounded-lg">
                    @else
                        <div class="p-4 bg-white border border-gray-light rounded-lg hover:border-primary">
                    @endif
                            <p class="font-bold">{{ $location->user->username }}</p>
                            <p>{{ $location->city }}, {{ $location->country }}</p>
                            <p>{{ $location->notes }}, {{ $location->postal_code }}</p>
                            <form action="{{ route('locations.destroy', ['id' => $location->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="text-sm text-primary font-bold">Delete</button>
                            </form>
                        </div>
                @endforeach
            @else
                <p class="text-lg font-bold">You got no location registered yet.</p>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
<script src="{{ asset('js/leaflet.js') }}"></script>

<script>
    let map;
    let marker;
    let latitude = null;
    let longitude = null;

    // Default coordinates (Jakarta, Indonesia) - fallback if geolocation fails
    const defaultCoords = {
        lat: -6.2088,
        lng: 106.8456
    };

    // Initialize the map
    function initMap() {
        // Start with default coordinates
        const initialLat = latitude || defaultCoords.lat;
        const initialLng = longitude || defaultCoords.lng;

        map = L.map('map').setView([initialLat, initialLng], 15);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Add initial marker
        marker = L.marker([initialLat, initialLng], {
            draggable: true
        }).addTo(map);

        // Set initial coordinates
        latitude = initialLat;
        longitude = initialLng;
        updateCoordinateDisplay();

        // Update coordinates when marker is dragged
        marker.on('dragend', function(e) {
            const position = e.target.getLatLng();
            latitude = position.lat;
            longitude = position.lng;
            updateCoordinateDisplay();
        });

        // Add click event to place marker
        map.on('click', function(e) {
            latitude = e.latlng.lat;
            longitude = e.latlng.lng;
            marker.setLatLng([latitude, longitude]);
            updateCoordinateDisplay();
        });

        // Try to get user's current location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    // Success callback
                    latitude = position.coords.latitude;
                    longitude = position.coords.longitude;
                    map.setView([latitude, longitude], 15);
                    marker.setLatLng([latitude, longitude]);
                    updateCoordinateDisplay();
                },
                function(error) {
                    // Error callback
                    console.warn('Geolocation failed:', error.message);
                    console.log('Using default coordinates:', defaultCoords.lat, defaultCoords.lng);
                    // Coordinates are already set to default values
                },
                {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 60000
                }
            );
        } else {
            console.warn('Geolocation is not supported by this browser');
            console.log('Using default coordinates:', defaultCoords.lat, defaultCoords.lng);
        }
    }

    function updateCoordinateDisplay() {
        if (latitude !== null && longitude !== null) {
            document.querySelector('.latitude').textContent = latitude.toFixed(6);
            document.querySelector('.longitude').textContent = longitude.toFixed(6);
        } else {
            document.querySelector('.latitude').textContent = 'Loading...';
            document.querySelector('.longitude').textContent = 'Loading...';
        }
    }

    // Initialize map when page loads
    document.addEventListener('DOMContentLoaded', function() {
        initMap();
        updateCoordinateDisplay();
    });

    function goToStep(stepNumber) {
        if (stepNumber === 1) {
            // Show step 1, hide step 2
            document.getElementById('tab-pinpoint-location').classList.remove('hidden');
            document.getElementById('tab-complete-address-detail').classList.add('hidden');

            // Update step 1 button (active)
            document.querySelector('#button-pinpoint-location').innerHTML = '1';
            document.querySelector('#button-pinpoint-location').className = 'border border-primary rounded-full text-primary h-8 w-8 flex items-center justify-center mb-1 cursor-pointer';

            // Update step 2 button (inactive)
            document.querySelector('#button-complete-address').innerHTML = '2';
            document.querySelector('#button-complete-address').className = 'border border-primary rounded-full text-white bg-gray-light h-8 w-8 flex items-center justify-center mb-1 cursor-pointer';

            // Refresh map size when going back to step 1
            setTimeout(() => {
                if (map) {
                    map.invalidateSize();
                }
            }, 100);

        } else if (stepNumber === 2) {
            // Only allow going to step 2 if coordinates are valid
            if (latitude === null || longitude === null) {
                alert('Please confirm your location first before proceeding to step 2.');
                return;
            }

            // Update hidden inputs with current coordinates
            document.querySelector('input[name="latitude"]').value = latitude;
            document.querySelector('input[name="longitude"]').value = longitude;

            // Show step 2, hide step 1
            document.getElementById('tab-pinpoint-location').classList.add('hidden');
            document.getElementById('tab-complete-address-detail').classList.remove('hidden');

            // Update step 1 button (completed)
            document.querySelector('#button-pinpoint-location').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>';
            document.querySelector('#button-pinpoint-location').className = 'border border-primary bg-primary rounded-full text-white h-8 w-8 flex items-center justify-center mb-1 cursor-pointer';

            // Update step 2 button (active)
            document.querySelector('#button-complete-address').innerHTML = '2';
            document.querySelector('#button-complete-address').className = 'border border-primary rounded-full text-primary h-8 w-8 flex items-center justify-center mb-1 cursor-pointer';
        }
    }

    function toggleModal() {
        const modal = document.getElementById('modal');
        modal.classList.toggle('hidden');

        // Reset to first tab when opening modal
        if (!modal.classList.contains('hidden')) {
            goToStep(1);
        }
    }
</script>
@endpush
