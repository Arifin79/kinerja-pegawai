<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index() {
        $location = Location::first();
        
        return response()->json([
            'success' => true,
            'data'    => $location
        ], 200);
    }
}
