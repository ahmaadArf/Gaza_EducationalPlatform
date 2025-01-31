<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TypeBlood extends Model
{
    use HasTranslations;
    public $translatable = ['name'];
    protected $fillable=['name'];
}
