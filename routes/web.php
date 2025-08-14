<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\register\RegisterController;
use App\Http\Controllers\register\admin\adminRegister;
use App\Http\Controllers\register\admin\SliderController;
use App\Http\Controllers\HomepageController;

Route::get('/', [HomepageController::class,'frontendSlider']);



Route::get('/admin', [adminRegister::class,'adminRegistrations']);
Route::get('/admin/slider',[SliderController::class,'index']);
Route::post('/admin/slider/post', [SliderController::class,'sliderPost'])->name('admin.slider.post');



Route::post('/register', [RegisterController::class, 'regitserPost'])->name('main.register.post');



Route::get('/register',[RegisterController::class,'registerShow'])->name('main.register');


