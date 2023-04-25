<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\StudentController;

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


Route::middleware(['guard'])->group(function(){
    
    Route::get('/dashboard',[StudentAuthController::class,'dashboard']);
    
    Route::get('/logout',[StudentAuthController::class,'logout']);  
    
    
    Route::get("/quiz",[StudentController::class,'start_quiz']);

    Route::post("/status",[StudentController::class,'add']);

    Route::post("/result",[StudentController::class,'evaluate']);


});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',[StudentAuthController::class,'login']);
Route::get("/registration",[StudentAuthController::class,'registration']);
Route::post('/register-user',[StudentAuthController::class,'registerUser']);
Route::post('/login-user',[StudentAuthController::class,'loginUser']);

Route::get("/is",[StudentController::class,'isCorrectMethod']);

Route::get("/prev",[StudentController::class,'showResult']);

Route::get("/leaderBoard",[StudentController::class,'showHistory']);


