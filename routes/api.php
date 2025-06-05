<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassAttendanceController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ForumReplyController;
use App\Http\Controllers\ForumTopicController;
use App\Http\Controllers\LiveClassController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskSubmissionController;
use App\Http\Middleware\AuthAdmin;
use App\Http\Middleware\AuthTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);

Route::get('/quiz/{id}/question',[QuestionController::class, 'index']);
Route::get('/quiz', [QuizController::class, 'index']);


Route::middleware(AuthAdmin::class)->group(function () {
    Route::get('/admin', function () {
       return "prueba" ;
    });
});

Route::middleware(AuthTeacher::class)->group(function (){
   
    Route::post('/quiz',[QuizController::class, 'store']);
});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('courses', CourseController::class);
    Route::apiResource("modules",ModuleController::class);
    Route::apiResource("registrations",RegistrationController::class);
    Route::apiResource("tasks",TaskController::class);
    Route::apiResource("events",EventController::class);

    Route::get("classes-upcoming", [LiveClassController::class, "classFuture"]);
    Route::apiResource("classes",LiveClassController::class);
    
    Route::apiResource("forums",ForumController::class);
    Route::apiResource("forums-topics",ForumTopicController::class);

    Route::get("/forums-topics/{topicId}/replies",[ForumReplyController::class, "findByIdTopic"]);
    Route::apiResource("forums-replies",ForumReplyController::class);
    
    
    Route::get('/teachers/{idTeacher}/graded-submissions', [TaskSubmissionController::class, 'getGradedByTeacher']);
    Route::get('/students/{studentId}/pending-tasks', [TaskSubmissionController::class, 'getPendingTasksByStudent']);
    Route::get('/students/{idStudent}/submission-tasks',[TaskSubmissionController::class,"getTasksSubmittedByStudent"]);
    Route::apiResource("task-submissions",TaskSubmissionController::class);

    Route::get("/class/{idClass}/class-attendance",[ClassAttendanceController::class,"attendanceByClass"]);
    Route::get("/student/{id}/class-attendance",[ClassAttendanceController::class,"attendanceClassesByStudents"]);
    Route::apiResource("class-attendances",ClassAttendanceController::class);


    Route::get("courses/teacher/{id}", [CourseController::class , "findByIdTeacher"]);
});


