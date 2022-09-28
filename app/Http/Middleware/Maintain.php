<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class Maintain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $time = Carbon::now()->timestamp;
        $key = session()->get('maintain') ?? 0;
        $uri = session()->get('maintain_uri') ?? '/';
        if (!in_array($uri, config('page.uri')) && $time > $key) {
            return redirect('/');
        }
        return $next($request);
    }
}
