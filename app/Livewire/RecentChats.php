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
    $user = Auth::user();
    $userId = $user?->id;

    if (!$userId) {
        $this->chats = [];
        return;
    }

    // --- Private Messages with eager loading ---
    $latestPrivateMessages = PrivateMessage::with(['sender', 'receiver'])
        ->where(function ($query) use ($userId) {
            $query->where('sender_id', $userId)
                  ->orWhere('receiver_id', $userId);
        })
        ->latest('created_at')
        ->get()
        ->unique(function ($message) use ($userId) {
            return ($message->sender_id === $userId) ? $message->receiver_id : $message->sender_id;
        })->filter();

    $groupIds = $user->groups->pluck('id');

    $latestGroupMessages = GroupMessage::with('group')
        ->whereIn('group_id', $groupIds)
        ->latest('created_at')
        ->get()
        ->unique('group_id')->filter();

    $privateChats = $latestPrivateMessages->map(function ($message) use ($userId) {
        $otherUser = ($message->sender_id === $userId) ? $message->receiver : $message->sender;

        if (! $otherUser || ! $otherUser instanceof \App\Models\User) {
            return null;
        }

        return [
            'name' => $otherUser->username,
            'type' => 'private',
            'time' => $message->created_at,
            'link' => route('chat.show', ['username' => $otherUser->username]),
        ];
    })->filter();

    // --- Group Chats Mapping ---
    $groupChats = $latestGroupMessages->map(function ($message) {
        $group = $message->group;

        if (! $group || ! $group instanceof \App\Models\Group) {
            return null;
        }

        return [
            'name' => $group->name,
            'type' => 'group',
            'time' => $message->created_at,
            'link' => route('groups.chat', ['group' => $group->id]),
        ];
    })->filter();

    // --- Merge and sort all chats ---
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