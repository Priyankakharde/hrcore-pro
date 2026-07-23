<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [

        'project_name',
        'project_code',
        'client_name',
        'project_manager',
        'team_members',

        'start_date',
        'deadline',
        'completed_date',

        'budget',
        'spent_amount',

        'priority',
        'status',

        'progress',

        'department',
        'technology',
        'project_type',

        'total_tasks',
        'completed_tasks',
        'team_size',

        'description',
        'attachment',
    ];
}