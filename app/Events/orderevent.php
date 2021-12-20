<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use DB;

class orderevent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $neworderscount;
    public $revieworderscount;
    public $acceptorderscount;
    public $cancelorderscount;
    public $finishedorderscount;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($neworderscount,$revieworderscount,$acceptorderscount,$cancelorderscount,$finishedorderscount)
    {   
        $this->neworderscount      = $neworderscount;
        $this->revieworderscount   = $revieworderscount;
        $this->acceptorderscount   = $acceptorderscount;
        $this->cancelorderscount   = $cancelorderscount;
        $this->finishedorderscount = $finishedorderscount;
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('order-count');
    }
}
