<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassTeacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'teachers_id',
        'class_sections_id',
    ];

    public function teachers()
    {
        return $this->belongsTo('App\Models\Teacher','teachers_id');
    }
    public function class()
    {
        return $this->belongsTo('App\Models\ClassSection','class_sections_id');
    }
}
