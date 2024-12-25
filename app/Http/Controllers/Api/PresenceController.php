<?php

namespace App\Http\Controllers\Api;

use App\Models\Presence;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PresenceController extends Controller
{
    public function index() {
        $attendances = Attendance::all()->sortByDesc('data.is_end')->sortByDesc('data.is_start');
        
        return response()->json([
            'success' => true,
            'data'    => $attendances
        ], 200);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date_format:H:i:s',
            'batas_start_time' => 'required|date_format:H:i:s|after_or_equal:start_time',
            'end_time' => 'required|date_format:H:i:s|after:batas_start_time',
            'batas_end_time' => 'required|date_format:H:i:s|after:end_time',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }
    
        try {
            $attendance = Attendance::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'start_time' => $request->input('start_time'),
                'batas_start_time' => $request->input('batas_start_time'),
                'end_time' => $request->input('end_time'),
                'batas_end_time' => $request->input('batas_end_time'),
            ]);
    
            return response()->json([
                'success' => true,
                'message' => 'Data absensi berhasil ditambahkan',
                'data' => $attendance,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}