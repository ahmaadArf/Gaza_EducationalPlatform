<?php

use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Dashboard\Student\ExamsController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Student\ProfileController;
use App\Http\Controllers\Dashboard\Students\Dashboard\SubjectController;
use App\Http\Controllers\Dashboard\Student\Dashboard\finalDegreeController;
Route::prefix(LaravelLocalization::setLocale())
->middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:student'])->group(function () {

    Route::prefix('student/dashboard')->name('student.dashboard.')->group(function(){

    Route::get('/', function () {
        $subjects=Subject::where('classroom_id',Auth::user()->classroom_id)
        ->where('grade_id',Auth::user()->grade_id)->get();
        return view('pages.Students.dashboard.dashboard',compact('subjects'));
    })->name('index');

    Route::resource('subjects', SubjectController::class);


    });

});
