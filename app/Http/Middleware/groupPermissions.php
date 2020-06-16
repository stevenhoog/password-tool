<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class groupPermissions
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

        $user = $request->user();

        // If user has permissions to view the group
        if ($user && $user->groups->contains($request->group->id)) {
            return $next($request);
        } 
        // If user has no permissions to view the group, login again
        Auth::logout();
        return redirect()->route('login');

      
    }
}
