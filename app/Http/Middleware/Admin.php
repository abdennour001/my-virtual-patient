<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

// php artisan make:middleware Admin


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
   
//middleware

    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->check()) {
            return redirect('admin/login');
        }

        return $next($request);
    }
}
