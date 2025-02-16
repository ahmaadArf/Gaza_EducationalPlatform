<?php

namespace App\Models;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $guarded =[];
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
