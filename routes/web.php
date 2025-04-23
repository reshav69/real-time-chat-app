<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Register;
use App\Livewire\Login;
use App\Livewire\Dashboard;
use App\Livewire\Logout;
use App\Livewire\UserProfile;
use App\Livewire\UserEdit;
use App\Livewire\FriendRequestsPage;
use App\Livewire\ChatBox;
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

    Route::get('/chat/{username}', ChatBox::class)->name('chat.show');
});
// Route::get('/chat/{username}', function ($username) {
//     $receiver = \App\Models\User::where('username', $username)->firstOrFail();
//     return view('livewire.chat-box', ['receiver' => $receiver]);
// })->middleware('auth')->name('chat.show');


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
    send request --
    receive request --
    accept request --
    unfriend
*/

//STYLING -

/*
private messaging
    select user to message to --
    go to message box --
    include web socket --
    make events --
    broadcast events
    wire events
    send/receive message
*/

// GENERAL FIXES

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
    create algorithm
    host algorithm
    read from endpoint
    apply on frontend

*/