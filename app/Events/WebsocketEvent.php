<?php

namespace App\Events;

use App\Post;
use App\Comment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class WebsocketEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $comment;

    public function __construct(Comment $comment)
    {
        $this->comment =  $comment;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('post.'.$this->comment->post->id);
    }

    public function broadcastWith(){
        return [
            'comment' => $this->comment->comment,
            'created_at_format' => $this->comment->created_at_format,
            'user' => [
                    'name' => $this->comment->user->name
                ]
        ];
    }


}
