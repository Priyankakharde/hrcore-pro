<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'attendance_date',
        'check_in',
        'check_out',
        'working_hours',
        'overtime_hours',
        'break_hours',
        'shift',
        'status',
        'location',
        'device',
        'ip_address',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'attendance_date' => 'date',
        'check_in' => 'datetime:H:i',
        'check_out' => 'datetime:H:i',
    ];

    /**
     * Employee Relationship
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Created By Relationship
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Search Scope
     */
    public function scopeSearch($query, $search)
    {
        if (!$search) {
            return $query;
        }

        return $query->whereHas('employee', function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%");
        });
    }

    /**
     * Status Filter
     */
    public function scopeStatus($query, $status)
    {
        if (!$status) {
            return $query;
        }

        return $query->where('status', $status);
    }

    /**
     * Date Filter
     */
    public function scopeDate($query, $date)
    {
        if (!$date) {
            return $query;
        }

        return $query->whereDate('attendance_date', $date);
    }

    /**
     * Status Badge Color
     */
    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            'Present' => 'success',
            'Absent' => 'danger',
            'Leave' => 'warning',
            'Half Day' => 'info',
            'Holiday' => 'secondary',
            default => 'dark',
        };
    }

    /**
     * Total Hours
     */
    public function getTotalHoursAttribute()
    {
        return number_format(
            $this->working_hours + $this->overtime_hours,
            2
        );
    }

    /**
     * Attendance Percentage
     */
    public static function attendancePercentage()
    {
        $total = self::count();

        if ($total == 0) {
            return 0;
        }

        $present = self::where('status', 'Present')->count();

        return round(($present / $total) * 100, 2);
    }
}