<?php

namespace App\Http\Controllers\shipper;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shipper\StoreRequest;
use App\Models\Shipper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // public function guard(){
    //     return Auth::guard('shipper');
    // }
    public function showLoginForm()
    {
        return view('shipper.login'); // نمایش صفحه ورود
    }
   
    public function register(){
        return view('shipper.register');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('shipper')->attempt($credentials)) {
            $request->session()->regenerate(); // این خط مهم است

            // برای تست
            // dd(Auth::guard('shipper')->user()); // باید اطلاعات کاربر را نشان دهد

            return redirect()->route('ShipperIndex');
        }

        return back()->with('failed', "نام کاربری یا رمز عبور اشتباه است");
    }
    
    public function store(StoreRequest $request){

        $validated = $request->validated();


        $createdShipper =  Shipper::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'],
            'city' => $validated['city'],


        ]);

    


        if (! $createdShipper) {
            return back()->with('failed', '    ثبت نام انجام نشد');
        }

        Auth::guard('shipper')->login($createdShipper);
        return redirect()->route('ShipperIndex')->with('success', 'ثبت نام با موفقیت انجام شد');
        // return back()->with('success', 'ثبت نام با موفقیت انجام شد ');
    }
    
    public function logout()
    {
        Auth::guard('shipper');
        return redirect()->route('loginShipper')->with('success', 'با موفقیت خارج شدید');
        
    }
}
