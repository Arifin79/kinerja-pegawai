<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    // Menentukan nama tabel yang terkait dengan model
    protected $table = 'sekolah';

    // Menggunakan HasFactory trait untuk mempermudah pembuatan data dummy
    use HasFactory;

    // Menentukan kolom-kolom yang dapat diisi oleh mass assignment
    protected $fillable = [
        'namasekolah',
        'alamat',
        'latitude',
        'longitude',
    ];
}
