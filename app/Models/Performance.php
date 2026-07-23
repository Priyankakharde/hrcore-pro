<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    use HasFactory;

    protected $fillable = [

        'employee_id',

        'review_month',
        'review_year',

        'attendance',
        'task_completion',
        'productivity',
        'communication',
        'teamwork',
        'leadership',
        'problem_solving',
        'punctuality',
        'discipline',
        'innovation',
        'learning',

        'overall_score',
        'rating',

        'strengths',
        'weaknesses',
        'remarks',
        'goals',
        'improvement_plan',

        'next_review_date',

    ];

    protected $casts = [
        'next_review_date' => 'date',
        'overall_score' => 'decimal:2',
    ];

    /**
     * Employee Relationship
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Calculate Overall Score
     */
    public function calculateOverallScore()
    {
        $total =
            $this->attendance +
            $this->task_completion +
            $this->productivity +
            $this->communication +
            $this->teamwork +
            $this->leadership +
            $this->problem_solving +
            $this->punctuality +
            $this->discipline +
            $this->innovation +
            $this->learning;

        return round($total / 11, 2);
    }

    /**
     * Get Rating Automatically
     */
    public function calculateRating($score)
    {
        if ($score >= 90) {
            return 'Excellent';
        }

        if ($score >= 80) {
            return 'Very Good';
        }

        if ($score >= 70) {
            return 'Good';
        }

        if ($score >= 60) {
            return 'Average';
        }

        return 'Poor';
    }
}