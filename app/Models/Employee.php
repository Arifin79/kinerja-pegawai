<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function tasks()
    {
        return $this->hasMany(Task::class, 'employee_id');
    }
}
