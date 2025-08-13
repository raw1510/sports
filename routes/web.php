<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\register\RegisterController;
use App\Http\Controllers\register\admin\adminRegister;

Route::get('/', function () {
    return view('main.main');
});
Route::get('/admin', [adminRegister::class,'adminRegistrations']);

Route::post('/register', [RegisterController::class, 'regitserPost'])->name('main.register.post');



Route::get('/register',[RegisterController::class,'registerShow'])->name('main.register');
