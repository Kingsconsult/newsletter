<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Console\Scheduling\CallbackEvent;

class FrequencyEvent extends CallbackEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function everySecondTuesdayMonthly($time = '0:0')
    {
        $this->dailyAt($time);

        $now = Carbon::now();
        $month = $now->format('F');
        $year = $now->format('yy');

        $secondTuesdayMonthly = new Carbon('second tuesday of ' . $month . ' ' . $year);

        return $this->spliceIntoPosition(3, $secondTuesdayMonthly->day);
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
