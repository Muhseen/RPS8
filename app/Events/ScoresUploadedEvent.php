<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ScoresUploadedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $file_no;
    public $dept_id;
    public $score_type;
    public $course_id;
    public $prog_id;
    public function __construct($file_no, $prog_id, $course_id, $dept_id, $score_type)
    {
        $this->prog_id = $prog_id;
        $this->dept_id = $dept_id;
        $this->score_type = $score_type;
        $this->course_id = $course_id;
        $this->file_no = $file_no;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}