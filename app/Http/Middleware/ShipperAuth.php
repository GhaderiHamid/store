<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShipperAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // بررسی لاگین بودن کاربر
        if (!Auth::guard('shipper')->check()) {
            return redirect('/loginShipper')->with('error', 'برای دسترسی به این بخش لطفاً وارد حساب خود شوید.');
        }

        return $next($request);
    }
}
