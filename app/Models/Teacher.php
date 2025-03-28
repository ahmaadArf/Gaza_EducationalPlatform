<?php

namespace App\Models;

use App\Models\Gender;
use App\Models\Section;
use App\Models\Specialization;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    use HasTranslations;
    public $translatable = ['name'];
    protected $guarded =[];

    public function specializations()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id');
    }
    public function genders()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }
    public function Sections()
    {
        return $this->belongsToMany(Section::class,'teacher_section');
    }
    public function Quizzes()
    {
        return $this->hasMany(Quizze::class);
    }
    public function Subjects()
    {
        return $this->hasMany(Subject::class);
    }


}
