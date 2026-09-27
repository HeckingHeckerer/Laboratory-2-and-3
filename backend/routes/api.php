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
    Route::get('my/course-offerings', function (\Illuminate\Http\Request $request) {
        abort_unless($request->user()->role?->name === 'Instructor', 403);
        return response()->json(['success'=>true,'data'=>\App\Models\CourseOffering::where('instructor_id',$request->user()->id)->paginate(20)]);
    });
    Route::get('my/student', function (\Illuminate\Http\Request $request) {
        abort_unless($request->user()->role?->name === 'Student', 403);
        return response()->json(['success'=>true,'data'=>\App\Models\Student::where('user_id',$request->user()->id)->firstOrFail()]);
    });
});

Route::middleware(['auth:sanctum','role:Admin,Staff'])->prefix('v1')->group(function () {
    Route::apiResource('students', StudentController::class);
    Route::apiResource('programs', ProgramController::class);
    Route::apiResource('courses', CourseController::class);
    Route::apiResource('academic-terms', AcademicTermController::class);
    Route::apiResource('course-offerings', CourseOfferingController::class);
    Route::apiResource('enrollments', EnrollmentController::class);
    Route::apiResource('grades', GradeController::class)->except('destroy');
    Route::get('students/{student}/academic-record', function (\App\Models\Student $student, \Illuminate\Http\Request $request) {
        $user = $request->user();
        if ($user->role?->name === 'Student' && $student->user_id !== $user->id) abort(403);
        $records = \App\Models\Enrollment::with(['courseOffering.course','courseOffering.academicTerm','grade'])->where('student_id', $student->id)->get();
        return response()->json(['success'=>true,'data'=>['student'=>$student,'records'=>$records]]);
    });
});
