<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Admin\GradeController;
use App\Http\Controllers\Api\Admin\TeacherController;
use App\Http\Controllers\Api\Admin\ClassroomController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum', 'auth.api:user-api');

Route::prefix('admin')->middleware(['auth:sanctum', 'auth.api:user-api'])->group(function () {
    Route::apiResource('grades', GradeController::class);
    Route::apiResource('classrooms', ClassroomController::class);
    Route::apiResource('teachers', TeacherController::class);
    Route::get('specialization', [TeacherController::class, 'getSpecialization']);
    Route::get('gender', [TeacherController::class, 'getGender']);
});



    // restful api //done


    // request life cycle


    // sunctum (package)
    // - create token (access token) (bearer token)
    // - get user current tokens
    // - destroy token / tokens

    // resources

    // model binding //done

    // eager loading (get data in one database session) //done
