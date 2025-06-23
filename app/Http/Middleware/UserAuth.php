<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuth
{
    public function handle(Request $request, Closure $next)
    {
        // بررسی لاگین بودن کاربر
        if (!Auth::guard('web')->check()) {
            return redirect('/login')->with('error', 'برای دسترسی به این بخش لطفاً وارد حساب خود شوید.');
        }
      
        return $next($request);
    }
}