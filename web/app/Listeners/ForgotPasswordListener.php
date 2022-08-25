<?php

namespace App\Listeners;

use App\Events\ForgotPassWordEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Password;

class ForgotPasswordListener implements ShouldQueue 
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
     * @param  \App\Events\ForgotPassWordEvent  $event
     * @return void
     */
    public function handle(ForgotPassWordEvent $event)
    {
        $status = Password::sendResetLink($event->email);
        return $status;
    }
}
