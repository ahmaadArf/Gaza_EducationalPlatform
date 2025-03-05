<?php


use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Students\Dashboard\ExamsController;
use App\Http\Controllers\Dashboard\Students\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\Students\Dashboard\SubjectController;
use App\Http\Controllers\Dashboard\Students\Dashboard\finalDegreeController;

Route::prefix(LaravelLocalization::setLocale())
->middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:student'])->group(function () {

    Route::prefix('student/dashboard')->name('student.dashboard.')->group(function(){

    Route::get('/', function () {
        $subjects=Subject::where('classroom_id',Auth::user()->classroom_id)
        ->where('grade_id',Auth::user()->grade_id)->get();
        return view('pages.Students.dashboard.dashboard',compact('subjects'));
    })->name('index');

    Route::resource('subjects', SubjectController::class);
    Route::get('/quiz/{quizze_id}/{question_index?}', [ExamsController::class, 'show'])->name('quiz.show');
    Route::resource('student_exams', ExamsController::class);
    Route::post('/quiz/{quizze_id}/{question_index}/answer', [ExamsController::class, 'storeAnswer'])->name('quiz.answer');
    Route::resource('final-degree', finalDegreeController::class);
    Route::resource('profile', ProfileController::class);


    });

});
