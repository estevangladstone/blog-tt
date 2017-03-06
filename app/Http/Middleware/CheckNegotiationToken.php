<?php

namespace App\Http\Middleware;

use Closure;

class CheckNegotiationToken
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
        if($negotiation = Negotiation::findByToken($request->token)) {
            return $next($request);
        } else {
            abort(404);
        }
    }
}
