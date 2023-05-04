<?php

use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\AuthController;
use App\HTTP\Controllers\ModuleController;
use App\Models\Module;

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

Route::get('/', [ModuleController::class,'index']);
Route::view('/forgot-passwaord', 'pages.forgot-password');
Route::view('/login', 'pages.login');
Route::view('/register', 'pages.registration');


// Site Pages
// Route::get('/theory', function()
// {
//    return View::make('pages.theory');
// })->name('theory');

// Route::get('/theory', [AuthController::class,'showusers'])->name('theory');


// Post Methods
Route::post('/login', [AuthController::class,'index']);
Route::post('/register', [AuthController::class,'store']);
Route::post('/logout', [AuthController::class,'logout'])->name('logout');
