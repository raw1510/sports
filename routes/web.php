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

    Route::get('/', [HomepageController::class,'frontendSlider']);

    
    Route::get('/login',[LoginController::class,'showLoginForm'])->name('admin.login');
    Route::post('/login',[LoginController::class,'login'])->name('admin.login.post');
    Route::post('/logout',[LoginController::class,'logout'])->name('admin.logout');
    
    Route::middleware(['login2'])->group(function () {
        Route::get('/admin/approved', [adminRegister::class,'adminApprovedRegistrations'])->name('admin.registrations');
        Route::get('/admin/pending', [adminRegister::class,'adminPendingRegistrations'])->name('admin.registrations.pending');  

        Route::patch('/admin/pending/{id}/{btn}', [adminRegister::class,'acceptOrReject'])->name('admin.registrations.acceptOrReject'); 

        Route::get('/admin/slider',[SliderController::class,'index'])->name('admin.sidebar');
        Route::post('/admin/slider/post', [SliderController::class,'sliderPost'])->name('admin.slider.post');
        Route::post('/admin/gallery/post', [GalleryController::class,'galleryPost'])->name('admin.gallery.post');
    });
    
    


    
    
    
    Route::get('/contact', [ContactController::class, 'ContactUsFormGet'])->name('admin.contact.view');
    Route::post('/contact', [ContactController::class, 'ContactUsFormPost'])->name('contact.submit');
    
    
    
    
    Route::post('/register', [RegisterController::class, 'regitserPost'])->name('main.register.post');
    
    
    
    Route::get('/register',[RegisterController::class,'registerShow'])->name('main.register');
});



