<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login'); // نمایش صفحه ورود
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            // چک کردن نقش کاربر و هدایت به صفحه مناسب
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.index'); // هدایت مدیر به داشبورد
            }
            return redirect()->route('home'); // هدایت کاربر به صفحه اصلی
        }

        return back()->withErrors(['email' => 'اطلاعات ورود صحیح نیست']);
    }
    public function logout()
    {
        Auth::logout();
        // return redirect()->route('frontend.home.all')->with('success', 'با موفقیت خارج شدید');
        return back();
    }
}
