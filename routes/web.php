<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\AuthenticationMiddleware;

//user font end page routes
Route::get('/',[UserController::class, 'homePage']);
Route::get('/registrationPage',[UserController::class, 'registrationPage']);
Route::get('/LoginPage',[UserController::class, 'loginPage']);
Route::get('/forgetPass',[UserController::class, 'sentOtp']);
Route::get('/verifyOtpPage',[UserController::class, 'verifyOtpPage']);
Route::get('/resetPassword',[UserController::class, 'resetPasswordPage'])->middleware([AuthenticationMiddleware::class]);
 

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
    //Page routes
    Route::get('/dashboard',[DashboardController::class, 'dashboardPage']);
    Route::get('/ProfilePage',[DashboardController::class, 'profilePage']);

    Route::get('/CategoryPage',[CategoryController::class, 'CategoryPage']);
    Route::get('/categoryUpdatePage',[CategoryController::class, 'categoryUpdatePage']);

    Route::get('/CustomerPage',[CustomerController::class, 'customerPage']);
    Route::get('/customerEditPage',[CustomerController::class, 'customerEditPage']);

    Route::get('/product-page',[ProductController::class,'ProductPage']);
    Route::get('/product-edit',[ProductController::class, 'ProductEditPage']);

    Route::get('/invoice-page',[InvoiceController::class, 'SalePage']);

    //Category routes
    Route::post('/create-category',[CategoryController::class,'createCategory']);
    Route::get('/category-list',[CategoryController::class,'categoryList']);
    Route::get('/delete-category/{id}',[CategoryController::class,'destroyCategory']);
    Route::put('/update-category/{id}',[CategoryController::class,'updateCategoryName']);

    //Customer routes
    Route::post('/create-customer',[CustomerController::class,'createCustomer']);
    Route::get('/customer/{id}',[CustomerController::class,'customerById']);
    Route::put('/update-customer/{id}',[CustomerController::class,'updateCustomer']);
    Route::delete('/delete-customer/{id}',[CustomerController::class,'deleteCustomer']);

    //Product routes
    Route::get('/product-list',[ProductController::class,'getAllProduct']);
    Route::post('/create-product',[ProductController::class,'createProduct']);
    Route::delete('/destroy-product/{id}',[ProductController::class,'destroyProduct']);
    Route::get('/product/{id}',[ProductController::class,'productById']);
    Route::post('/update-product/{id}',[ProductController::class,'updateProduct']);

    //Product routes
    Route::post('/invoice-create',[InvoiceController::class, 'createInvoice']);
    Route::get('/invoice-list',[InvoiceController::class, 'InvoiceList']);
    Route::get('/invoiceDetails',[InvoiceController::class, 'InvoiceDetails']);
    Route::delete('/invoice-delete',[InvoiceController::class, 'InvoiceDelete']);

});
