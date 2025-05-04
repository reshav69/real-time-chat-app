<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Dashboard;
use App\Livewire\Auth\Logout;

use App\Livewire\UserProfile;
use App\Livewire\UserEdit;

use App\Livewire\Friend\FriendRequestsPage;
use App\Livewire\ChatBox;

use App\Livewire\Groups\CreateGroup;
use App\Livewire\Groups\EditGroup;
use App\Livewire\Groups\GroupChatBox;
use App\Livewire\Groups\GroupsList;
use App\Livewire\Groups\ShowGroup;

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

    Route::get('/group/list',GroupsList::class)->name('groups.list');
    Route::get('/group/create',CreateGroup::class)->name('groups.create');
    Route::get('/group/edit/{group}',EditGroup::class)->name('groups.edit');
    Route::get('/group/{group}',ShowGroup::class)->name('groups.show');
    Route::get('/group/chat/{group}', GroupChatBox::class)->name('groups.chat');
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
    broadcast events --
    wire events -- 
    send/receive message -- 
*/

// GENERAL FIXES
    //online status
    //notify?
    //better ui

/*
Creating groups
    create groups --
    list groups --
    joining groups -- 
    seeing members -- 
    leaving groups --
    inviting members --
    kicking members
    assigning admins
*/
/*
sending group messages
    make event --
    make chatbox
    send message
*/

/*
next word suggestion
    ngram --
    create algorithm --
    get dataset -
    include in chat --
    optimize

*/