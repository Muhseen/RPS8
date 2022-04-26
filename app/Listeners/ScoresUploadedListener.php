<?php

namespace App\Listeners;

use App\Models\ScoresUploadLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ScoresUploadedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {

        ScoresUploadLog::create([
            'score_type' => $event->score_type,
            'dept_id'  => $event->dept_id,
            'prog_id' => $event->prog_id,
            'file_no' => $event->file_no,
            'course_id' => $event->course_id
        ]);
    }
}