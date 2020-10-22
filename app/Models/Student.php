<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClassSection;
class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_roll_no',
        'student_name',
        'student_father_name',
        'class_sections_id',
        'student_cnic',
        'student_email',
        'dob',
        'student_fee',
        'student_address',
        'student_religion',
        'student_guardian_name',
        'student_guardian_cnic',
        'student_guardian_phone_no',
        'student_guardian_occopation',
        'student_profile_pic',
    ];



    public function class()
    {
        return $this->belongsTo('App\Models\ClassSection','class_sections_id');
    }
}
