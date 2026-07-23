<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = [
        'employee_id',

        // Salary Details
        'basic_salary',
        'bonus',
        'overtime_amount',
        'tax',
        'deduction',
        'net_salary',

        // Payroll Month
        'month',

        // Payment Information
        'payment_method',
        'payment_status',
        'payment_date',

        // Notes
        'notes',
    ];

    /**
     * Employee Relationship
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Calculate Gross Salary
     */
    public function getGrossSalaryAttribute()
    {
        return ($this->basic_salary ?? 0)
             + ($this->bonus ?? 0)
             + ($this->overtime_amount ?? 0);
    }

    /**
     * Calculate Total Deduction
     */
    public function getTotalDeductionAttribute()
    {
        return ($this->tax ?? 0)
             + ($this->deduction ?? 0);
    }
}