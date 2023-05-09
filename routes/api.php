<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Module;
use App\HTTP\Controllers\ChapterController;
use App\HTTP\Controllers\AuthController;
use App\HTTP\Controllers\ModuleController;
use App\HTTP\Controllers\QuestionController;
use App\HTTP\Controllers\LessonController;
use App\HTTP\Controllers\ConfigController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group( function () {
  
});

Route::get('/config',[ConfigController::class,'index']);


Route::get('/modules',[ModuleController::class,'get_modules']);
Route::get('/chapters', [ChapterController::class,'index']);
Route::get('/questions', [QuestionController::class,'index']);
Route::get('/questions/{id}', [QuestionController::class,'show']);

Route::get('/lessons', [LessonController::class,'index']);
Route::get('/lessons/{id}', [LessonController::class,'lesson']);
Route::put('/lessons/{id}', [LessonController::class,'update']);
Route::post('/add-lesson', [LessonController::class,'store']);

Route::get('/questions', [QuestionController::class,'index']);
Route::get('/questions/{id}', [QuestionController::class,'show']);
Route::put('/questions/{id}', [QuestionController::class,'update']);
Route::post('/add-question', [QuestionController::class,'store']);


Route::post('/add-lesson', [LessonController::class,'store']);
Route::post('/create-course', [ChapterController::class,'create_course']);
Route::post('/create-question', [QuestionController::class,'store']);

Route::get('/chapters/{id}/lessons', [LessonController::class,'show']);



