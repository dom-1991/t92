<?php

namespace App\Listeners;

use App\Events\SendEmailService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Mail\SendMail;
use Carbon\Carbon;

class SendEmailServiceListener implements ShouldQueue
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
     * @param  \App\Events\SendEmailService  $event
     * @return void
     */
    public function handle(SendEmailService $event)
    {
        \Log::info(['2222222222222', Carbon::now()]);
        DB::table('newsletter')->insert([
            'email' => $event->email['email']
        ]);

        Mail::to($event->email['email'])->send(new SendMail($event->email));
    }
}
