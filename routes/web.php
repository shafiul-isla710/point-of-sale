<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthenticationMiddleware;
use Illuminate\Support\Facades\Route;


Route::get('/',[UserController::class, 'homePage']);
Route::get('/registrationPage',[UserController::class, 'registrationPage']);
Route::get('/LoginPage',[UserController::class, 'loginPage']);
Route::get('/forgetPass',[UserController::class, 'sentOtp']);
Route::get('/verifyOtpPage',[UserController::class, 'verifyOtpPage']);
Route::get('/resetPassword',[UserController::class, 'resetPasswordPage']);

//api routes

Route::post('/Registration',[UserController::class,'userRegistration']);
Route::post('/login',[UserController::class,'userLogin']);
Route::post('/sent-opt',[UserController::class,'sentOpt']);
Route::post('/verify-otp',[UserController::class,'verifyOtp']);
Route::post('reset-password',[UserController::class,'resetPassword'])->middleware([AuthenticationMiddleware::class]);

//user 
Route::get('/users',[UserController::class,'getUser']);
