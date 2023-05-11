<?php

use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\AuthController;
use App\HTTP\Controllers\ModuleController;
use App\HTTP\Controllers\CourseController;
use App\HTTP\Controllers\LessonController;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Get Methods
// Route::get('/', function()
// {
//    return View::make('pages.home');
// });

// Auth pages



//$modules = Module::all();
// foreach($modules as $module)
// {
  
//     Route::view('/'.$module->name, 'pages.modules',['data'=>$module]);

// }


Route::view('/forgot-passwaord', 'pages.forgot-password');
Route::get('/login', [AuthController::class,'loginView'])->name('login');
Route::post('/login', [AuthController::class,'index']);
Route::view('/register', 'pages.registration');

// Site Pages
// Route::get('/theory', function()
// {
//    return View::make('pages.theory');
// })->name('theory');

// Route::get('/theory', [AuthController::class,'showusers'])->name('theory');


Route::middleware(['auth'])->group(function () {
  Route::get('/', [ModuleController::class,'index'])->name('home');
  Route::post('/register', [AuthController::class,'store']);
  Route::post('/logout', [AuthController::class,'logout'])->name('logout');
  Route::get('/{name}/{id}', [ModuleController::class,'chapters'])->name('chapters');
  // Route::get('/theory/{id}', [ModuleController::class,'chapters'])->name('chapters');
  Route::get('/getting-started/{chapter_id}/{lesson_id}', [LessonController::class,'lessons'])->name('lessons.show');
});