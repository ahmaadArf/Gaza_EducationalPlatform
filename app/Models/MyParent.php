<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;


class MyParent extends Authenticatable
{
    use HasTranslations;
    public $translatable = ['name_Father','job_Father','name_Mother','job_Mother'];
    protected $guarded=[];
}
