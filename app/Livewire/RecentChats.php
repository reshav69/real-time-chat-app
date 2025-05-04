<?php

namespace App\Livewire;

use App\Models\PrivateMessage;
use App\Models\GroupMessage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\User; 

class RecentChats extends Component
{
    public $chats = [];

    public function getListeners()
    {
        
        return [
            'messageupdates' => 'updatee',

        ];
    }

    public function updatee(){
        $this->mount();
    }
    public function mount()
    {
        $userId = Auth::id();

        if (!$userId) {
            $this->chats = [];
            return;
        }

        $latestPrivateMessages = PrivateMessage::where(function ($query) use ($userId) {
                $query->where('sender_id', $userId)
                      ->orWhere('receiver_id', $userId);
            })
            ->orderBy('created_at', 'desc')
            ->get()
            ->unique(function ($message) use ($userId) {
                return ($message->sender_id === $userId) ? $message->receiver_id : $message->sender_id;
            })
            ->take(4)
            ->sortByDesc('created_at');


        $privateChats = $latestPrivateMessages->map(function ($message) use ($userId) {
                $otherUser = ($message->sender_id === $userId) ? $message->receiver : $message->sender;
                return [
                    'name' => $otherUser->username,
                    'type' => 'private',
                    'time' => $message->created_at,
                    'link' => route('chat.show', ['username' => $otherUser->username]),
                ];
            });


        $groupIds = Auth::user()->groups->pluck('id'); 

        $latestGroupMessages = GroupMessage::whereIn('group_id', $groupIds)
            ->latest('created_at')
            ->get()
            ->unique('group_id')
            ->take(4)
            ->sortByDesc('created_at');

        $groupChats = $latestGroupMessages->map(function ($message) {
            $group = $message->group;
            return [
                'name' => $group->name,
                'type'=>'group',
                'time' => ($message->created_at),
                'link' => route('groups.chat', ['group' => $group->id]),
            ];
        });


        $allChats = $privateChats->merge($groupChats)
                         ->sortByDesc('time')
                         ->take(6) 
                         ->map(function ($chat) {
                             $chat['formatted_time'] = Carbon::parse($chat['time'])->format('Y.M.d - h:i');
                             return $chat;
                         })
                         ->values()
                         ->toArray();

        $this->chats = $allChats;
    }


    public function render()
    {
        return view('livewire.recent-chats');
    }
}