<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentResult extends Model
{
    use HasFactory;
    protected $fillable = [
        'class_sections',
        'result_title',
        'result',
    ];
    public function classes()
    {
        
        return $this->belongsTo('App\Models\ClassSection', 'class_sections');
    }
}
