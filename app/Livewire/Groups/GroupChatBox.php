<?php

namespace App\Livewire\Groups;

use App\Models\Group;
use App\Models\GroupMessage;
use App\Events\GroupMessageSent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\On;
class GroupChatBox extends Component
{
    public Group $group;
    public $gid;
    public $messages = [];
    // Removed: public $message;


    public function mount(Group $group)
    {
        $this->group = $group;
        $this->gid=$this->group->id;
        $this->loadGroupMessages();

    }

    public function loadGroupMessages()
    {
        $this->messages = GroupMessage::where('group_id', $this->group->id)
           ->with('sender')
           ->orderBy('created_at', 'asc')
           ->get()
           ->toArray();
           $this->dispatch('scrollToBottom');
    }
    public function getListeners()
    {

        if (!isset($this->group) || !$this->group instanceof Group) {
            return [];
        }

        $channel = 'echo-private:group.'.$this->gid.',GroupMessageSent';

        return [
            $channel => 'listenForGroupMessage',
            'messageSubmitted' => 'processMessage',
        ];
    }


    // #[On('messageSubmitted')]
    public function processMessage($messageContent)
    {

        if (trim($messageContent) === '') {
             return;
        }

        $sender = Auth::user();
        // dd($this->group->users->contains($sender->id));
        if (!$this->group->users->contains($sender->id)) {
              session()->flash('error', 'You must be a member to send messages in this group.');
              $this->dispatch('clearInput');
             return;
        }
        $newMessage = GroupMessage::create([
            'group_id' => $this->group->id,
            'sender_id' => $sender->id,
            'message' => trim($messageContent),
        ]);

        $newMessage->load('sender');

        broadcast(new GroupMessageSent($newMessage));
        logger('Broadcasting group message to group.' . $this->group->id);
        $this->appendGroupChatMessage($newMessage);
        $this->dispatch('clearInput');
        $this->dispatch('scrollToBottom');
    }


    // #[On('echo-private:group.{gid},GroupMessageSent')]
    public function listenForGroupMessage($event)
    {
        $messageData = $event['groupMessage'];
        $this->appendGroupChatMessage($messageData);

        $this->dispatch('scrollToBottom');
        
    }
    
    public function appendGroupChatMessage($messageData)
    {

        if ($messageData instanceof GroupMessage) {
            $this->messages[] = $messageData->toArray();
        } else {
           
             $this->messages[] = $messageData;
        }
    }


    public function render()
    {
        view()->share('title', "Group Chat: {$this->group->name}");
        return view('livewire.groups.group-chat-box');
    }
}