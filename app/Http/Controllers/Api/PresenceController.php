<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Presence;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    public function index () {
        $history = Presence::where("user_id", auth()->guard("api")->user()->id)->get();
        
        return response()->json([
            'success' => true,
            'data'    => $history
        ], 200);
    }
}
