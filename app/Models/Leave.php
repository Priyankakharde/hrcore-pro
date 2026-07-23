<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = [
        'employee_name',
        'employee_id',
        'department',
        'leave_type',
        'start_date',
        'end_date',
        'total_days',
        'status',
        'priority',
        'reason',
        'admin_note',
        'remaining_leave',
        'applied_date',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'applied_date' => 'date',
    ];
}