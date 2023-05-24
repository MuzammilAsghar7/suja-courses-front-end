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
// Route::get('/questions/{id}', [QuestionController::class,'show']);

Route::get('/lessons', [LessonController::class,'index']);
Route::get('/lessons/{id}', [LessonController::class,'lesson']);
Route::post('/lessons/{id}', [LessonController::class,'update']);
Route::post('/add-lesson', [LessonController::class,'store']);

Route::get('/questions', [QuestionController::class,'index']);
Route::get('/lesson_questions/{lesson_id}/{chapter_id}', [QuestionController::class,'lesson_questions']);
Route::get('/questions/{id}', [QuestionController::class,'show']);
Route::post('/questions/{id}', [QuestionController::class,'edit']);
Route::post('/add-question', [QuestionController::class,'store']);


Route::post('/add-lesson', [LessonController::class,'store']);
Route::post('/create-course', [ChapterController::class,'create_course']);
Route::post('/update-course', [ChapterController::class,'update']);
Route::post('/create-question', [QuestionController::class,'store']);

Route::get('/chapters/{id}/lessons', [LessonController::class,'show']);

Route::post('/create-option', [ChapterController::class,'create_option']);
Route::post('/delete-option', [ChapterController::class,'delete_option']);
Route::get('/options', [ChapterController::class,'options']);
Route::post('/page/mark-read', [LessonController::class,'markread']);


Route::post('/delete-media-item/{id}', [LessonController::class,'delete_media']);


