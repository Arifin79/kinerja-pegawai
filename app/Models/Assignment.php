<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Assignment extends Model
{
    use HasFactory;

    protected $fillable = ['project_name', 'project_type', 'customer_name', 'customer_type', 'deadline', 'employee_name', 'image'];
}

