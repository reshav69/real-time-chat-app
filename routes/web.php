<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Register;
use App\Livewire\Login;
use App\Livewire\Dashboard;
use App\Livewire\Logout;
use App\Livewire\UserProfile;
use App\Livewire\UserEdit;
use App\Livewire\FriendRequestsPage;

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
    Route::get('/friendrequests', FriendRequestsPage::class)->name('friend.requests');
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
    visit other user's profile --
    edit data -- 
*/
/*
friend system
    send request
    receive request
    accept request
    unfriend
*/

//STYLING

/*
private messaging
    select user to message to
    go to message box
    include web socket
    send/receive message
*/

/*
Creating groups
    private groups
    public groups
    adding members
    inviting
*/
/*
sending group messages
*/

/*
next word suggestion
    ngram

*/