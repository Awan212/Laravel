<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectTeacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'teachers_id',
        'class_sections_id',
        'subject_title',
        'leacture_start_timing',
        'lecture_end_timing',
    ];

    public function teachers()
    {
        return $this->belongsTo('App\Models\Teacher', 'teacher_id');
    }
    public function class()
    {
        return $this->belongsTo('App\Models\ClassSection','class_section_id');
    }
}
