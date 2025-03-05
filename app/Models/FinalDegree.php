<?php

namespace App\Models;

use App\Models\Grade;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Model;

class FinalDegree extends Model
{
    protected $guarded=[];

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
        return $this->belongsTo(Section::class,);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class,);
    }
}
