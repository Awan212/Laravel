<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'student',
        'class_section',
        'attendance_date',
        'attendance'
    ];

    public function students()
    {
        return $this->belongsTo('App\Models\Student', 'student');
    }
    public function class()
    {
        return $this->belongsTo('App\Models\ClassSection', 'class_section');
    }
}
