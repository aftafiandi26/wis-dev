<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class AuthPipelineTechnology
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
        $user = User::where('level_hrd', 'like', '%Pipeline%')->where('position', 'like', '%Technology%')->where('active', 1)->where('id', auth()->user()->id)->first();
        if ($user) {
            return $next($request);
        }
        return redirect()->route('index')->with('getError', Lang::get('messages.no_access'));
    }
}