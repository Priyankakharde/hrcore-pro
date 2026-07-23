<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'employee_id',
        'name',
        'email',
        'phone',
        'department',
        'designation',
        'salary',
        'joining_date',
        'status',
    ];

    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }
}

