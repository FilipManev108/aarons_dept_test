<?php

namespace App\Models;

use App\Models\Status;
use App\Models\ShiftType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function shiftType()
    {
        return $this->belongsTo(ShiftType::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
