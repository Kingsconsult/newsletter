<?php

namespace App\Listeners;

use App\Events\RegisteredMail;
use App\Mail\Gmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendCongratulatoryMail
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
     * @param  RegisteredMail  $event
     * @return void
     */
    public function handle(RegisteredMail $event)
    {
        $userinfo = $event->user->email;

        Mail::to($userinfo)->send(new Gmail());

    }
}
