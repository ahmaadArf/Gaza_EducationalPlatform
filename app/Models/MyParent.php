<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MyParent extends Model
{
    use HasTranslations;
    public $translatable = ['name_Father','job_Father','name_Mother','job_Mother'];
    protected $guarded=[];
}
