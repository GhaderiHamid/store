<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        // بررسی ورود و نقش کاربر
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/loginAdmin')->with('error', 'دسترسی به این بخش فقط برای مدیران امکان‌پذیر است.');
        }

        return $next($request);
    }
}