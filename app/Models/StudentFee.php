<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFee extends Model
{
    use HasFactory;
    protected $fillable = [
        'student',
        'student_fee',
        'paid_fee',
        'remaining_fee',
        'invoice_number',
    ];

    public function students()
    {
        return $this->belongsTo('App\Models\Student', 'student');
    }
}
