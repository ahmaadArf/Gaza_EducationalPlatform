<?php

namespace App\Models;

use App\Models\Grade;
use App\Models\Degree;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Question;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Quizze extends Model
{
    use HasTranslations;
    public $translatable = ['name'];
    protected $guarded=[];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }


    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }


    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }


    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function Questions()
    {
        return $this->hasMany(Question::class);
    }

    public function degree()
    {
        return $this->hasOne(Degree::class);
    }
}
