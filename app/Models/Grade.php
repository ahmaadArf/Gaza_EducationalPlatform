<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{
    use HasTranslations;
    public $translatable = ['name'];
    protected $fillable = [
        'name',
        'notes',
    ];
    protected $hidden = [
        // 'password',
    ];
    protected $guarded=[];
    public function Classrooms()
    {
        return $this->hasMany(Classroom::class);
    }
    public function Sections()
    {
        return $this->hasMany(Section::class,);
    }
}
