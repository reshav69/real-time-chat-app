<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Register;
use App\Livewire\Login;
use App\Livewire\Dashboard;
use App\Livewire\Logout;

Route::get('/', function () {
    return view('livewire.auth.dashboard');
});

Route::group(['middleware'=>'guest'], function(){
    Route::get('/register', Register::class)->name('register');
    Route::get('/login', Login::class)->name('login');
});

Route::group(['middleware'=>'auth'], function(){
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/logout', Logout::class)->name('logout');
});

// Route::get('/login', Login::class)->name('login');
// Route::get('/register', Register::class)->name('register');
// Route::get('/dashboard', Dashboard::class)->name('dashboard');
// Route::get('/logout', Logout::class)->name('logout');

//todo
/*
user authentication
    login--
    register--
    logout--

user profiling
    edit data
*/
/*
friend system
*/

