<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'salary_id',
        'teacher_id',
        'advance_salary',
        'salary_of_month',
        'remaining_salary'
    ];

    public function teacherSalary()
    {
        return $this->belongsTo('App\Models\TeacherSalary', 'salary_id');
    }
    public function teachers()
    {
        return $this->belongsTo('App\Models\Teacher', 'teacher_id');
    }
}
