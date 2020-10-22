<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherSalary extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher',
        'salary',

    ];

    public function teachers()
    {
        return $this->belongsTo('App\Models\Teacher','teacher');
    }
}
