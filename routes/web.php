<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\register\RegisterController;
use App\Http\Controllers\register\admin\adminRegister;
use App\Http\Controllers\register\admin\SliderController;
use App\Http\Controllers\contact\admin\ContactController;
use App\Http\Controllers\register\admin\GalleryController;
use App\Http\Controllers\register\admin\LoginController;

use App\Http\Controllers\HomepageController;


// add login middleware

Route::middleware(['login'])->group(function () {


    
    Route::get('/login',[LoginController::class,'showLoginForm'])->name('admin.login');
    Route::post('/login',[LoginController::class,'login'])->name('admin.login.post');
    
    Route::middleware(['login2'])->group(function () {
        Route::get('/admin', [adminRegister::class,'adminRegistrations'])->name('admin.registrations');
        Route::get('/admin/slider',[SliderController::class,'index'])->name('admin.sidebar');
        Route::post('/admin/slider/post', [SliderController::class,'sliderPost'])->name('admin.slider.post');

    });
    
    
    Route::get('/', [HomepageController::class,'frontendSlider']);


    
    
    
    Route::post('/admin/gallery/post', [GalleryController::class,'galleryPost'])->name('admin.gallery.post');
    Route::post('/contact', [ContactController::class, 'ContactUsFormPost'])->name('contact.submit');
    
    
    
    
    Route::post('/register', [RegisterController::class, 'regitserPost'])->name('main.register.post');
    
    
    
    Route::get('/register',[RegisterController::class,'registerShow'])->name('main.register');
});



