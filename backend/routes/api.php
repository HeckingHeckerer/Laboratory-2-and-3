<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\{StudentController, ProgramController, CourseController, AcademicTermController, CourseOfferingController, EnrollmentController, GradeController};
use Illuminate\Support\Facades\Route;

Route::prefix('v1/auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
    });
});

Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::apiResource('students', StudentController::class);
    Route::apiResource('programs', ProgramController::class);
    Route::apiResource('courses', CourseController::class);
    Route::apiResource('academic-terms', AcademicTermController::class);
    Route::apiResource('course-offerings', CourseOfferingController::class);
    Route::apiResource('enrollments', EnrollmentController::class);
    Route::apiResource('grades', GradeController::class)->except('destroy');
});
