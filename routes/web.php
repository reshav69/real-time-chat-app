<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Register;
use App\Livewire\Login;
use App\Livewire\Dashboard;
use App\Livewire\Logout;
use App\Livewire\UserProfile;
use App\Livewire\UserEdit;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=>'guest'], function(){
    Route::get('/register', Register::class)->name('register');
    Route::get('/login', Login::class)->name('login');
});

Route::group(['middleware'=>'auth'], function(){
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/logout', Logout::class)->name('logout');
    Route::get('/profile/edit', UserEdit::class)->name('profile.edit');
    Route::get('/profile/{username}', UserProfile::class)->name('profile.show');
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

