@extends('layouts.app')
<title>@yield('title', 'Location')</title>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real-Time Location Tracking</title>

    <!-- Leaflet CSS & JavaScript -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <!-- CSS tambahan untuk styling -->
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

    <!-- Peta -->
    <div id="map"></div>

    <script>
        // Inisialisasi peta dengan posisi default
        const map = L.map('map').setView([-6.337, 108.320], 12);

        // Layer jalan standar (OpenStreetMap)
        const streetLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Lokasi pusat dan radius
        const centerLatLng = [-6.40801, 108.28146]; // Ganti dengan lokasi pusat yang diinginkan
        const radiusInMeters = 500; // Radius dalam meter

        // Tambahkan marker pusat dan lingkaran radius pada lokasi pusat
        const centerMarker = L.marker(centerLatLng).addTo(map)
            .bindPopup("Lokasi Pusat").openPopup();
        const radiusCircle = L.circle(centerLatLng, {
            color: 'blue',
            fillColor: '#3399ff',
            fillOpacity: 0.3,
            radius: radiusInMeters
        }).addTo(map);

        // Variabel untuk menyimpan marker dan radius pengguna secara dinamis
        let userMarker, userCircle;

        // Fungsi untuk menghitung jarak antara dua koordinat
        function calculateDistance(lat1, lon1, lat2, lon2) {
            const R = 6371e3; // Radius bumi dalam meter
            const φ1 = lat1 * Math.PI / 180;
            const φ2 = lat2 * Math.PI / 180;
            const Δφ = (lat2 - lat1) * Math.PI / 180;
            const Δλ = (lon2 - lon1) * Math.PI / 180;

            const a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
                      Math.cos(φ1) * Math.cos(φ2) *
                      Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

            return R * c; // Jarak dalam meter
        }

        // Fungsi untuk menemukan lokasi pengguna
        function findUserLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(position => {
                    const userLat = position.coords.latitude;
                    const userLng = position.coords.longitude;

                    // Jika marker pengguna sudah ada, hapus untuk memperbarui posisinya
                    if (userMarker) {
                        map.removeLayer(userMarker);
                        map.removeLayer(userCircle);
                    }

                    // Tambahkan marker baru di lokasi pengguna
                    userMarker = L.marker([userLat, userLng]).addTo(map)
                        .bindPopup("<b>Lokasi Anda Saat Ini</b>").openPopup();

                    // Tambahkan lingkaran radius di sekitar lokasi pengguna
                    userCircle = L.circle([userLat, userLng], {
                        color: 'red',
                        fillColor: '#f03',
                        fillOpacity: 0.2,
                        radius: 50 // Radius sekitar pengguna dalam meter
                    }).addTo(map);

                    // Zoom dan pindah peta ke lokasi pengguna
                    map.setView([userLat, userLng], 16);

                    // Hitung jarak pengguna ke lokasi pusat
                    const distance = calculateDistance(userLat, userLng, centerLatLng[0], centerLatLng[1]);
                    
                    // Cek apakah pengguna berada dalam radius pusat
                    if (distance <= radiusInMeters) {
                        alert("Anda berada dalam radius yang ditentukan!");
                    } else {
                        alert("Anda berada di luar radius.");
                    }
                }, error => {
                    console.error(error);
                    alert("Tidak dapat mengakses lokasi Anda.");
                }, { enableHighAccuracy: true, timeout: 5000, maximumAge: 0 });
            } else {
                alert("Geolocation tidak didukung oleh browser Anda.");
            }
        }

        // Jalankan pencarian lokasi pengguna
        findUserLocation();
    </script>
@endsection
</body>
</html>
