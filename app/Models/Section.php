<?php

namespace App\Models;

use App\Models\Grade;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasTranslations;
    public $translatable = ['name'];

    protected $guarded=[];

    public function My_classs()
    {
        return $this->belongsTo(Classroom::class,'class_id');
    }
    public function Grades()
    {
        return $this->belongsTo(Grade::class);
    }
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class,'teacher_section');
    }

}
