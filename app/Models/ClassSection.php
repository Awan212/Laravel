<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use App\Models\Subject;
class ClassSection extends Model
{
    use HasFactory;
    protected $fillable = [
        'class_title',
        'section_name',
        'subjects',
        'seats'
    ];

    public function subjects()
    {
        return $this->belongsTo('App\Models\Subject');
    }

}
