<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::middleware('auth')->group(function () {
    Route::resource('courses', CourseController::class);
    Route::resource('exercises', ExerciseController::class);
    Route::resource('students', StudentController::class);
    Route::resource('grades', GradeController::class);
});

require __DIR__.'/auth.php';