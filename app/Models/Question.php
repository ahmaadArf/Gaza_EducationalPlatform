<?php

namespace App\Models;

use App\Models\Quizze;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded=[];

    public function quizze()
    {
        return $this->belongsTo(Quizze::class);
    }
}
