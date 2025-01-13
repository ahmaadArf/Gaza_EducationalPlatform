<?php

namespace App\Models;

use App\Models\Grade;
use App\Models\Section;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    use HasTranslations;
    public $translatable = ['name'];
    protected $guarded=[];

    public function Grades()
    {
        return $this->belongsTo(Grade::class,'grade_id');
    }
    public function Sections()
    {
        return $this->hasMany(Section::class);
    }
}


