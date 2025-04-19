<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PrivateMessage;
use App\Models\User;
class ChatBox extends Component
{

    public $receiverId;
    public $receiver;
    public $messages = [];

    public function mount($username)
    {
        $this->receiverId = $this->getUserId($username);
        // dd($this->receiverId);
        $this->receiver = User::find($this->receiverId);
        // $this->loadReceiver();
        $this->loadMessages();
    }
    public function getUserId($uname){
        return (User::where('username',$uname)->first()->id);
    }



    public function openChat($receiverId){
        $this->receiverId = $receiverId;
        $this->receiver = User::find($receiverId);

        dd($this->receiver);
        // $this->receiver = User::find(2);
        // $this->loadMessages();

    }

    public function loadReceiver()
    {
        $this->receiver = User::find($this->receiverId);
    }

    public function loadMessages()
    {
        $this->messages = PrivateMessage::where(function ($query) {
            $query->where('sender_id', auth()->id())
                ->where('receiver_id', $this->receiverId);
        })->orWhere(function ($query) {
            $query->where('sender_id', $this->receiverId)
                ->where('receiver_id', auth()->id());
        })->get();
    }


    public function render()
    {
        view()->share('title', "Chat with {$this->receiver->username}");
        return view('livewire.chat-box');
    }
}
