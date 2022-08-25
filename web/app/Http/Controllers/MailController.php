<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendEmail;
use Carbon\Carbon;
use App\Http\Requests\EmailRequest;

class MailController extends Controller
{
    public function sendEmail(EmailRequest $request)
    {
        event(new \App\Events\SendEmailService($request->all()));
        return response()->json([
            'message' => 'Sending .. OK'            
        ], 200);
    }

}
