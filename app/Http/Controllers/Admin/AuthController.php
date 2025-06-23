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

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.index');
        }

        return back()->withErrors(['email' => 'اطلاعات ورود صحیح نیست']);
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        // return redirect()->route('frontend.home.all')->with('success', 'با موفقیت خارج شدید');
        return back();
    }
}
