<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendEmail;
use Carbon\Carbon;

class MailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:newsletter,email'
        ]);

        event(new \App\Events\SendEmailService($request->all()));
        \Log::info(['111111111111', Carbon::now()]);
        return 'ok';
    }
}
