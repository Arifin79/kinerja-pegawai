<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assigment extends Model
{
    // Menentukan nama tabel yang terkait dengan model
    protected $table = 'Assigment';

    // Menggunakan HasFactory trait untuk mempermudah pembuatan data dummy
    use HasFactory;

    // Menentukan kolom-kolom yang dapat diisi oleh mass assignment
    protected $fillable = ['project_name', 'project_type', 'customer_name', 'customer_type', 'deadline', 'image'];
}
