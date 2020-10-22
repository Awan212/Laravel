<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherAttendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'teacher',
        'attendance_date',
        'attendance',
    ];

    public function teachers()
    {
        return $this->belongsTo('App\Models\Teacher','teacher');
    }
}
