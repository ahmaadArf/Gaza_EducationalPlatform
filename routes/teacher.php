<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Teacher\Dashboard\TeacherDashboardController;


Route::prefix(LaravelLocalization::setLocale())->middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:teacher'])->group(function () {

    Route::prefix('/teacher/dashboard')->name('teacher.dashboard.')->group(function(){

        Route::get('/',[TeacherDashboardController::class,'index'])->name('index');
        Route::get('sections',[TeacherDashboardController::class,'sections'])->name('sections');

    });

});

