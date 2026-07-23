<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'report_name',
        'report_type',
        'from_date',
        'to_date',
        'filters',
        'file_path',
        'description',
        'created_by',
    ];

    protected $casts = [
        'from_date' => 'date',
        'to_date' => 'date',
        'filters' => 'array',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /*
    |--------------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeType($query, $type)
    {
        if ($type) {
            $query->where('report_type', $type);
        }

        return $query;
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            $query->where('report_name', 'like', "%{$search}%");
        }

        return $query;
    }

    public function scopeDateRange($query, $from = null, $to = null)
    {
        if ($from) {
            $query->whereDate('from_date', '>=', $from);
        }

        if ($to) {
            $query->whereDate('to_date', '<=', $to);
        }

        return $query;
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getDurationAttribute()
    {
        if (!$this->from_date || !$this->to_date) {
            return 0;
        }

        return $this->from_date->diffInDays($this->to_date) + 1;
    }

    public function getFileAvailableAttribute()
    {
        return !empty($this->file_path);
    }

    public function getBadgeColorAttribute()
    {
        return match ($this->report_type) {
            'Attendance' => 'green',
            'Leave' => 'yellow',
            'Payroll' => 'blue',
            'Performance' => 'purple',
            'Employee' => 'indigo',
            default => 'gray',
        };
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    public static function reportTypes()
    {
        return [
            'Attendance',
            'Leave',
            'Payroll',
            'Performance',
            'Employee',
        ];
    }
}