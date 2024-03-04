<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    Route::prefix('admin')->name('admin.')->middleware('auth', 'check_user_type')->group(function() {
        Route::get('/', [AdminController::class, 'index'])->name('index');

        Route::resource('categories', CategoryController::class);
        Route::resource('skills', CategoryController::class);
    });


    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::view('/', 'welcome');

});