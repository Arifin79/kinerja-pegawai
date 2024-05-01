<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'Task';
    use HasFactory;

    protected $fillable = ['name', 'title', 'date', 'image'];
}
