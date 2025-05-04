<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PrivateMessage;
use App\Models\User;
use App\Events\MessageSentEvent;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use App\Services\NgramService;


class ChatBox extends Component
{

    public $receiver_id;
    public $sender_id;
    public $receiver;
    public $messages = [];
    // public $message = '';
    public $suggestions;

    public function mount($username)
    {
        // dd($username);
        $this->sender_id = Auth::user()->id;
        $this->receiver_id = User::where('username',$username)->first()->id;
        // dd($this->receiver_id);
        $this->receiver = User::find($this->receiver_id);
        // dd($this->receiver);

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


        //    dd($this->message);
        foreach ($messages as $message) 
        {
            $this->appendChatMessage($message);
        }
        // dd($messages);
        $this->dispatch('scrollToBottom');
    }

    public function appendChatMessage($messageData)
    {
        if ($messageData instanceof PrivateMessage) {
            // $this->messages[] = $messageData->toArray();
            $this->messages[] = [
                'id' => $messageData->id,
                'sender_id' => $messageData->sender->id,
                'receiver_id' => $messageData->receiver->id,
                'message' => $messageData->message,
                'created_at'=>$messageData->created_at,
                'updated_at'=>$messageData->updated_at
            ];
        } else {
             $this->messages[] = $messageData;
        }


    }

    public function getListeners(){
        $channel = 'echo-private:chat-channel.' . $this->sender_id . ',MessageSentEvent';
        return[
            'messageSubmitted'=>'sendMessage',
            $channel=>'listenForMessage',
        ];
    }

    // #[On('messageSubmitted')]
    public function sendMessage($messageContent){
        // dd($this->message);
        if($messageContent == '') return;
        $newMessage = PrivateMessage::create([
            'sender_id'=>$this->sender_id,
            'receiver_id'=>$this->receiver_id,
            'message'=>$messageContent
        ]);
        // dd($newMessage);
        $this->appendChatMessage($newMessage);
        broadcast(new MessageSentEvent($newMessage))->toOthers();


        $this->dispatch('clearInput');
        $this->dispatch('scrollToBottom');
        $this->dispatch('messageupdates');
    }




    // #[On('echo-private:chat-channel.{sender_id},MessageSentEvent')]
    // #[On('MessageSentEvent')]
    public function listenForMessage($event)
    {
        logger('message broadcast listener method called', $event);

        // dd($event);
        $chatMessage = $event['message'];
        // $chatMessage = PrivateMessage::whereId($event['message']['id'])
        //     ->with('sender', 'receiver')->get()
        //     ->first();
        $this->appendChatMessage($chatMessage);
        $this->dispatch('scrollToBottom');
        $this->dispatch('messageupdates');
    }

    public function render()
    {
        view()->share('title', "Chat with {$this->receiver->username}");
        return view('livewire.chat-box');
    }
}
