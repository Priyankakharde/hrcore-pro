<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    protected $fillable = [
        'title',
        'event_type',
        'organizer',
        'event_date',
        'start_time',
        'end_time',
        'location',
        'priority',
        'description',
        'status',
        'banner',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    public function getFormattedDateAttribute()
    {
        return $this->event_date
            ? Carbon::parse($this->event_date)->format('d M Y')
            : '-';
    }

    public function getEventDurationAttribute()
    {
        if (!$this->start_time || !$this->end_time) {
            return '-';
        }

        return $this->start_time . ' - ' . $this->end_time;
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopeUpcoming($query)
    {
        return $query->where('status', 'Upcoming');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'Completed');
    }

    public function scopeOngoing($query)
    {
        return $query->where('status', 'Ongoing');
    }

    public function scopeHighPriority($query)
    {
        return $query->where('priority', 'High');
    }
}