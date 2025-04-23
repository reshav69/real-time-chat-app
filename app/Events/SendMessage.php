<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


use App\Models\PrivateMessage;
class SendMessage implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $privateMessage;


    public function __construct(PrivateMessage $privateMessage)
    {
        $this->privateMessage = $privateMessage;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chat.' . $this->privateMessage->receiver_id),
        ];
    }
    
    public function broadcastAs()
    {

        return 'private-message.sent';
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->privateMessage->id,
            'sender_id' => $this->privateMessage->sender_id,
            'receiver_id' => $this->privateMessage->receiver_id,
            'message' => $this->privateMessage->message,
            'created_at' => $this->privateMessage->created_at->toIso8601String(), 

        ];
        
    }


}
