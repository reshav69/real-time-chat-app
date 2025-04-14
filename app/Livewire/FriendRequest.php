<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\FriendRequest as FR;
class FriendRequest extends Component
{
    public $receiver_id;
    public $sender_id;
    public $request_sent = false;

    public function mount($receiver_id)
    {
        $this->receiver_id = $receiver_id;
        $this->sender_id = auth()->id();
        $this->request_sent = $this->requestExist();
    }


    public function requestExist(){
        return FR::where(function ($query) {
            $query->where('sender_id', $this->sender_id)
                  ->where('receiver_id', $this->receiver_id);
        })->orWhere(function ($query) {
            $query->where('sender_id', $this->receiver_id)
                  ->where('receiver_id', $this->sender_id);
        })->exists();
    }

    public function sendRequest(){
        if($this->requestExist()){
            session()->flash('error', 'Friend request already exists.');
            return;
        }

        FR::create([
            'sender_id' => $this->sender_id,
            'receiver_id' => $this->receiver_id,
            'status' => 'pending',
        ]);
        $this->request_sent = true;
        session()->flash('success', 'Friend request sent!');
    }


    public function cancelRequest(){
        if($this->requestExist()){
            $request = FR::where('sender_id', $this->sender_id)
                ->where('receiver_id', $this->receiver_id)
                ->first();
            
                $request->delete();
                $this->request_sent = false;
                session()->flash('success', 'Friend request canceled.');
            return;
        }
        session()->flash('error', 'friend request cancel failed.');
    }


    //accept
    //reject
    //unfriend

    public function render()
    {
        return view('livewire.friend-request');
    }
}
