<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PrivateMessage;
use App\Models\User;
use App\Events\SendMessage;
use Illuminate\Support\Facades\Auth;


class ChatBox extends Component
{

    public $receiverId;
    public $receiver;
    public $messages = [];
    public $message;

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


    public function loadMessages()
    {
        $this->messages = PrivateMessage::where(function ($query) {
            $query->where('sender_id', auth()->id())
                  ->where('receiver_id', $this->receiverId);
        })->orWhere(function ($query) {
            $query->where('sender_id', $this->receiverId)
                  ->where('receiver_id', auth()->id());
        })->with('sender') 
           ->orderBy('created_at', 'asc')
           ->get()
           ->toArray();
    }

    public function sendMessage(){
        if (trim($this->message) === '') {
            return;
        }


        $message = PrivateMessage::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $this->receiverId,
            'message' => $this->message,
        ]);
        // dd($this->message);
        $this->messages[] = $message->toArray();

        broadcast(new SendMessage($message))->toOthers();
        // $this->messages[] = $message->toArray(); 

        
        $this->message = '';
        $this->dispatch('scrollToBottom');
    }
    // #[On('echo-private:chat.'. auth()->id() .',private-message.sent')]
    #[On('echo-private:chat.{{ auth()->id() }},private-message.sent')]
    // #[On('echo-private:chat.{auth()->id()},private-message.sent')]
    public function listenForMessage($eventData)
    {
        if ($eventData['sender_id'] == $this->receiverId && $eventData['receiver_id'] == auth()->id()) {
            $this->messages[] = [
                'id' => $eventData['id'],
                'sender_id' => $eventData['sender_id'],
                'receiver_id' => $eventData['receiver_id'],
                'message' => $eventData['message'],
                'created_at' => $eventData['created_at'],
            ];
            $this->message = '';
            $this->dispatch('scrollToBottom');
        }
    }

    public function render()
    {
        view()->share('title', "Chat with {$this->receiver->username}");
        return view('livewire.chat-box');
    }
}
