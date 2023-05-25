<?php

use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\AuthController;
use App\HTTP\Controllers\ModuleController;
use App\HTTP\Controllers\CourseController;
use App\HTTP\Controllers\LessonController;
use App\HTTP\Controllers\ChapterController;
use App\HTTP\Controllers\QuestionController;
use App\HTTP\Controllers\FoundationController;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


Route::view('/forgot-passwaord', 'pages.forgot-password');
Route::get('/login', [AuthController::class,'loginView'])->name('login');
Route::post('/login', [AuthController::class,'index']);
Route::view('/register', 'pages.registration');


Route::middleware(['auth'])->group(function () {
  Route::get('/', [ModuleController::class,'index'])->name('home');
  Route::post('/register', [AuthController::class,'store']);
  Route::post('/logout', [AuthController::class,'logout'])->name('logout');
  //Route::get('/{name}/{id}', [ModuleController::class,'chapters'])->name('chapters');
  //Route::get('/{name}/{id}', [ModuleController::class,'chapters'])->name('chapters');
  Route::get('/getting-started/multiple-choice/review-best',function(){
     return View::make('pages.mcqs.index');
  });

Route::get('/getting-started/multiple-choice/review/{id}/review-detail',function(){
  return View::make('pages.mcqs.detail');
});
Route::get('/sample',function(){
  
  return View::make('pages.foundation.index');
});
  // Route::get('/theory/{id}', [ModuleController::class,'chapters'])->name('chapters');
  Route::get('/{module}', [ModuleController::class,'show'])->name('module');
  Route::get('/{module}/{chapter}', [ChapterController::class,'show'])->name('chapters');
  Route::get('/{module}/{chapter}/{lesson}', [LessonController::class,'shown'])->name('parentlessons');
  Route::get('/{module}/{chapter}/{parentlesson}/{childlesson}', [LessonController::class,'childshown'])->name('lesson');

Route::get('/getting-started/{chapter_id}/{lesson_id}', [LessonController::class,'lessons'])->name('lessons.show');
Route::post('/getting-started/append-answer', [QuestionController::class,'append_answer'])->name('append-answer');
Route::post('/foundation-answer', [FoundationController::class,'store'])->name('append-foundation');

});