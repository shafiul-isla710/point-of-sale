<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\AuthenticationMiddleware;

//user font end page routes
Route::get('/',[UserController::class, 'homePage']);
Route::get('/registrationPage',[UserController::class, 'registrationPage']);
Route::get('/LoginPage',[UserController::class, 'loginPage']);
Route::get('/forgetPass',[UserController::class, 'sentOtp']);
Route::get('/verifyOtpPage',[UserController::class, 'verifyOtpPage']);
Route::get('/resetPassword',[UserController::class, 'resetPasswordPage'])->middleware([AuthenticationMiddleware::class]);

//Dashboard page routes

Route::get('/dashboard',[DashboardController::class, 'dashboardPage'])->middleware([AuthenticationMiddleware::class]);
Route::get('/ProfilePage',[DashboardController::class, 'profilePage'])->middleware([AuthenticationMiddleware::class]);


//api routes
Route::post('/Registration',[UserController::class,'userRegistration']);
Route::post('/login',[UserController::class,'userLogin']);
Route::post('/sent-opt',[UserController::class,'sentOpt']);
Route::post('/verify-otp',[UserController::class,'verifyOtp']);
Route::put('/update-user/{id}',[UserController::class, 'updateUserData'])->middleware([AuthenticationMiddleware::class]);
Route::post('reset-password',[UserController::class,'resetPassword'])->middleware([AuthenticationMiddleware::class]);
Route::get('/logout',[UserController::class,'logout'])->middleware([AuthenticationMiddleware::class]);

//user 
Route::get('/users',[UserController::class,'getUser']);
Route::get('/user/{id}',[UserController::class, 'getUserById']);


//group Middleware
Route::middleware([AuthenticationMiddleware::class])->group(function(){
    //Category routes
    Route::post('/create-category',[CategoryController::class,'createCategory']);
    Route::get('/category-list',[CategoryController::class,'categoryList']);
    Route::delete('/delete-category/{id}',[CategoryController::class,'destroyCategory']);
    Route::put('/update-category/{id}',[CategoryController::class,'updateCategoryName']);
});
