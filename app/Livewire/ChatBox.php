<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PrivateMessage;
use App\Models\User;
use App\Events\MessageSentEvent;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;


class ChatBox extends Component
{

    public $receiver_id;
    public $sender_id;
    public $receiver;
    public $messages = [];
    public $message = '';
    public $ev;

    public function mount($username)
    {
        // dd($username);
        $this->sender_id = Auth::user()->id;
        $this->receiver_id = User::where('username',$username)->first()->id;
        // dd($this->receiver_id);
        $this->receiver = User::find($this->receiver_id)->first();

        $messages = PrivateMessage::where(function ($query) {
            $query->where('sender_id', $this->sender_id)
                  ->where('receiver_id', $this->receiver_id);
        })->orWhere(function ($query) {
            $query->where('sender_id', $this->receiver_id)
                  ->where('receiver_id', $this->sender_id);
        })->with('sender','receiver') 
           ->orderBy('created_at', 'asc')
           ->get();

        //    dd($messages);
        foreach ($messages as $message) 
        {
            $this->appendChatMessage($message);
        }
        // dd($messages);
        $this->dispatch('scrollToBottom');

    }

    public function appendChatMessage($message)
    {
        $this->messages[] = [
            'id' => $message->id,
            'sender_id' => $message->sender->id,
            'receiver_id' => $message->receiver->id,
            'message' => $message->message,
            'created_at'=>$message->created_at,
            'updated_at'=>$message->updated_at
        ];
    }

    public function sendMessage(){
        $newMessage = PrivateMessage::create([
            'sender_id'=>$this->sender_id,
            'receiver_id'=>$this->receiver_id,
            'message'=>$this->message
        ]);
        // dd($newMessage);
        $this->appendChatMessage($newMessage);
        broadcast(new MessageSentEvent($newMessage))->toOthers();

        $this->message = '';
        $this->dispatch('scrollToBottom');
    }


    #[On('echo-private:chat-channel.{receiver_id},MessageSentEvent')]
    // #[On('MessageSentEvent')]
    public function listenForMessage($event)
    {

        $chatMessage = PrivateMessage::whereId($event['message']['id'])
            ->with('sender', 'receiver')->get()
            ->first();

        $this->appendChatMessage($chatMessage);
    }

    public function render()
    {
        view()->share('title', "Chat with {$this->receiver->username}");
        return view('livewire.chat-box');
    }
}
