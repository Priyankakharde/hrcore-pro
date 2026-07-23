<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [

        'employee_id',

        'invoice_number',

        'invoice_date',

        'due_date',

        'subtotal',

        'tax',

        'discount',

        'total_amount',

        'status',

        'payment_method',

        'notes',

    ];

    protected $casts = [

        'invoice_date' => 'date',

        'due_date' => 'date',

        'subtotal' => 'decimal:2',

        'tax' => 'decimal:2',

        'discount' => 'decimal:2',

        'total_amount' => 'decimal:2',

    ];

    /**
     * Employee Relationship
     */

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}