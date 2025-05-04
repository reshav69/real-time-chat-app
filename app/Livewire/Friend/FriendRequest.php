<?php

namespace App\Livewire\Friend;

use Livewire\Component;
use App\Models\FriendRequest as FR;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FriendRequest extends Component
{
    public $sender_id;
    public $receiver_id;
    public $request_status = '';
    public $requestId;
    public $receiveruname;
    
    public function mount($receiver_id,$requestId = null){
        $this->sender_id = Auth::id();
        $this->receiver_id = $receiver_id;
        $this->requestId = $requestId;
        $this->request_status = $this->checkFriendRequestStatus();
    }

    public function checkRequest(){
        $req=  FR::where(function ($query) {
            $query->where('sender_id', $this->sender_id)
                  ->where('receiver_id', $this->receiver_id);
        })->orWhere(function ($query) {
            $query->where('sender_id', $this->receiver_id)
                  ->where('receiver_id', $this->sender_id);
        });
        return $req->exists();
    }

    public function checkFriendRequestStatus(){
        //if req exist, sender = auth -> sent
        $request = FR::where(function ($query) {
            $query->where('sender_id', $this->sender_id)
                  ->where('receiver_id', $this->receiver_id);
        })->orWhere(function ($query) {
            $query->where('sender_id', $this->receiver_id)
                  ->where('receiver_id', $this->sender_id);
        })->first();
        // dd($request);

        if($this->checkRequest() && $request->sender_id === $this->sender_id ){
            return 'sent';
        }
        if($this->checkRequest() && $request->sender_id === $this->receiver_id){
            return 'received';
        }

        if($this->isFriends())
            return 'friends';
        return 'none';
    }

    public function isFriends(){
        return Friend::where(function($q){
            $q->where('user_id',$this->sender_id)->where('friend_id',$this->receiver_id);
        })->orWhere(function($q){
            $q->where('user_id',$this->receiver_id)->where('friend_id',$this->sender_id);
        })->exists();
    }

    //send request
    public function sendRequest(){
        if($this->checkRequest()){
            session()->flash('error', 'Friend request already exists.');
            return;
        }
        FR::create([
            'sender_id' => $this->sender_id,
            'receiver_id' => $this->receiver_id,
            'status' => 'pending',
        ]);

        $this->request_status = 'sent';
        session()->flash('success', 'Friend request sent!');
    }

    public function cancelRequest(){
        if($this->checkRequest()){
            $request = FR::where('sender_id', $this->sender_id)
                ->where('receiver_id', $this->receiver_id)
                ->first();
            
                $request->delete();
                $this->request_status = 'none';

                session()->flash('success', 'Friend request canceled.');
            return;
        }
        session()->flash('error', 'friend request cancel failed.');
    }

    public function acceptRequest(){
        if($this->isFriends()){
            session()->flash('error', 'Already Friends.');
            return;
        }
        $request = FR::find($this->requestId);
        // dd($request);
        if($request && $request->receiver_id ===Auth::id()){
            Friend::create([
                'user_id'=>$request->sender_id,
                'friend_id'=>$request->receiver_id
            ]);

            Friend::create([
                'user_id' => $request->receiver_id,
                'friend_id' => $request->sender_id,
            ]);
            $request->delete();
            $this->request_status = 'friends';
            session()->flash('success', 'Friend request accepted.');
        }

    }

    public function rejectRequest(){
        $request = FR::find($this->requestId);

        if ($request && $request->receiver_id === Auth::id()) {
            $request->delete();
            $this->request_status = 'none';
            session()->flash('success', 'Friend request rejected.');
        }
    }
    //unfriend
    public function unfriend(){
        $friendId = $this->receiver_id;
        Friend::where(function ($query) use ($friendId) {
            $query->where('user_id', Auth::id())
                ->where('friend_id', $friendId);
        })->orWhere(function ($query) use ($friendId) {
            $query->where('user_id', $friendId)
                ->where('friend_id', Auth::id());
        })->delete();
        $this->request_status = 'none';
        session()->flash('success', 'Unfriended successfully.');
    }
    public function render()
    {
        return view('livewire.friend.friend-request');
    }
}
