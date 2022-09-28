<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function maintain (Request $request)
    {
        if (in_array($request->code, config('page.uri'))) {
            $time = Carbon::now()->addHour()->timestamp;
            session(['maintain' => $time]);
            session(['maintain_uri' => $request->code]);
            return redirect($request->code);
        }
        return redirect('/');
    }
}
