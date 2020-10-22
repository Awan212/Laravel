<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFeeDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_fee',
        'fee_amount',
        'invoice_number',
        'fee_of_month',
        'paid_date'
    ];


    public function student_fees()
    {
        
        return $this->belongsTo('App\Models\StudentFee', 'student_fee');
        
    }
}
