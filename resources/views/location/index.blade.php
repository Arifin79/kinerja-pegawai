@extends('layouts.app')
<title>@yield('title', 'Location')</title>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Location</title>

    <!-- Leaflet CSS & JavaScript -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <!-- CSS tambahan untuk styling yang lebih rapi -->
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
        }

        #map {
           position: relative;
           width: 100%;
           height: 500px;
        }

        .location-button {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 1000;
            padding: 10px 15px;
            font-size: 14px;
            cursor: pointer;
        }
    </style>
</head>
@section('content')
<body>
    <!-- Tombol untuk menemukan lokasi pengguna -->
    <button class="location-button" onclick="findUserLocation()">Lokasi Saya</button>

    <!-- Peta dan Tombol Lokasi -->
    <div id="map" style="height: 500px;"></div>
    <button id="locationButton" class="btn btn-primary">Lokasi Saya</button>

    {{-- <!-- Peta -->
    <div id="map"></div> --}}

    <script>
        // Inisialisasi peta dengan posisi default
        const map = L.map('map').setView([-6.337, 108.320], 12);

        // Layer jalan standar (OpenStreetMap)
        const streetLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Layer Satelit (ESRI)
        const satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            maxZoom: 19,
            attribution: 'Tiles © Esri &mdash; Source: Esri, i-cubed, USDA, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
        });

        // Layer kontrol untuk beralih antara peta jalan dan satelit
        const baseLayers = {
            "Peta Jalan": streetLayer,
            "Peta Satelit": satelliteLayer,
        };
        L.control.layers(baseLayers).addTo(map);

        // Fungsi untuk menambahkan marker pada lokasi tertentu
        function addMarker(lat, lng, popupText) {
            const marker = L.marker([lat, lng]).addTo(map)
                .bindPopup(popupText).openPopup();
            map.setView([lat, lng], 14);
            return marker;
        }

        // Fungsi untuk mencari lokasi pengguna
        function findUserLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(position => {
                    const userLat = position.coords.latitude;
                    const userLng = position.coords.longitude;
                
                    // Tambahkan marker lokasi pengguna
                    addMarker(userLat, userLng, "<b>Lokasi Anda Saat Ini</b>");
                }, () => {
                    alert("Tidak dapat mengakses lokasi Anda.");
                });
            } else {
                alert("Geolocation tidak didukung oleh browser Anda.");
            }
        }
        // Jalankan pencarian lokasi pengguna saat halaman dimuat
        window.onload = findUserLocation;
    </script>
@endsection
</body>
</html>
