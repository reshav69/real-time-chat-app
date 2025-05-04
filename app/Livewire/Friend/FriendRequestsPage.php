<?php

namespace App\Livewire\Friend;

use Livewire\Component;
use App\Models\FriendRequest;
use Illuminate\Support\Facades\Auth;
class FriendRequestsPage extends Component
{

    public $sentRequests;
    public $receivedRequests;

    public function mount(){
        $userId = Auth::id();

        $this->sentRequests = FriendRequest::with('receiver')->where('sender_id', $userId)->get();

        $this->receivedRequests = FriendRequest::with('sender')->where('receiver_id', $userId)->get();

    }
    public function render()
    {
        return view('livewire.friend.friend-requests-page');
    }
}
