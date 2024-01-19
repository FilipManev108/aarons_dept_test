<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'user_id',
        'company_id',
        'hours',
        'rate_per_hour',
        'total_pay',
        'taxable',
        'status_id',
        'shift_type_id',
        'paid_at'
    ];
}
