<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;

use App\Http\Requests\Login\StoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function signIn()
    {
        return view('auth.signIn');

    }
    
    public function signUp()
    {
        return view('auth.signUp');
    }
    
    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();
        $createdUser =  User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'password'=> Hash::make($validatedData['password']),
            'phone' => $validatedData['phone'],
            'role' => 'user',


        ]);
        if (! $createdUser) {
            return back()->with('failed', '    ثبت نام انجام نشد');
        }

        Auth::guard('web')->login($createdUser);
        return redirect()->route('frontend.home.all')->with('success','ثبت نام با موفقیت انجام شد');
        // return back()->with('success', 'ثبت نام با موفقیت انجام شد ');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('frontend.home.all')->with('success', 'ورود موفقیت‌آمیز بود');
        }

        return back()->withErrors([
            'email' => 'اطلاعات وارد شده صحیح نیست',
        ]);
    }
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('frontend.home.all')->with('success','با موفقیت خارج شدید');
    }
}
