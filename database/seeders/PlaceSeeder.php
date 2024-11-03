<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Place;

class PlaceSeeder extends Seeder
{
    public function run()
    {
        Place::create([
            'name' => 'Nama Tempat', // Tambahkan nilai untuk kolom 'name'
            'latitude' => '-6.921900', // Contoh nilai latitude
            'longitude' => '107.606000', // Contoh nilai longitude
            'radius' => 100, // Contoh nilai radius
        ]);
    }
}
