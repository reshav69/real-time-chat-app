<?php

namespace App\Events;

use App\Models\GroupMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GroupMessageSent implements ShouldBroadcastNow 
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $groupMessage;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\GroupMessage  $groupMessage
     * @return void
     */
    public function __construct(GroupMessage $groupMessage)
    {
        $this->groupMessage = $groupMessage->load('sender');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('group.' . $this->groupMessage->group_id);
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */


     /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith(): array
    {

        return [
            'id' => $this->groupMessage->id,
            'group_id' => $this->groupMessage->group_id,
            'sender_id' => $this->groupMessage->sender_id,
            'message' => $this->groupMessage->message,
            'created_at' => $this->groupMessage->created_at->toIso8601String(),
            'sender' => [
                'id' => $this->groupMessage->sender->id,
                'username' => $this->groupMessage->sender->username,
                'profile_image_url' => $this->groupMessage->sender->profile_image_url, 
            ],
        ];
    }
}