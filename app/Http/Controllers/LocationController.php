<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function checkProximity(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        // Ambil lokasi yang sudah diatur (contohnya lokasi pertama)
        $location = Location::first();

        if (!$location) {
            return response()->json(['error' => 'Location not found'], 404);
        }

        $distance = $this->calculateDistance($latitude, $longitude, $location->latitude, $location->longitude);

        if ($distance <= $location->radius) {
            return response()->json(['status' => 'within_radius', 'distance' => $distance]);
        } else {
            return response()->json(['status' => 'outside_radius', 'distance' => $distance]);
        }
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        // Menggunakan rumus Haversine untuk menghitung jarak antara dua titik latitude dan longitude
        $earthRadius = 6371000; // Meter

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }

    public function index()
    {
        // Logika untuk menampilkan daftar lokasi
        return view('location.index');
    }

    


}
