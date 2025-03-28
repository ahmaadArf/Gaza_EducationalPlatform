<?php

namespace App\Models;

use App\Models\Grade;
use App\Models\Image;
use App\Models\Degree;
use App\Models\Gender;
use App\Models\Section;
use App\Models\MyParent;
use App\Models\Classroom;
use App\Models\Attendance;
use App\Models\FinalDegree;
use App\Models\Nationalitie;
use App\Models\StudentAccount;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use SoftDeletes;

    use HasTranslations;
    public $translatable = ['name'];
    protected $guarded =[];

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    public function Nationality()
    {
        return $this->belongsTo(Nationalitie::class, 'nationalitie_id');
    }
    public function myparent()
    {
        return $this->belongsTo(MyParent::class, 'parent_id');
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function student_account()
    {
        return $this->hasMany(StudentAccount::class, 'student_id');
    }
    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }
    public function degrees()
    {
        return $this->hasMany(Degree::class, 'student_id');
    }
    public function finaldegrees()
    {
        return $this->hasMany(FinalDegree::class, 'student_id');
    }
}
