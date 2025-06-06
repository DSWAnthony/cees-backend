<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Middleware\AuthAdmin;
use App\Http\Middleware\AuthTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


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