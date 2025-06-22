<?php

namespace App\Http\Controllers\shipper;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Shipper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ShipperProfileController extends Controller
{
    public function profile()
    {
        $shipper = Auth::guard('shipper')->user();
        $ordersCount = Order::where(function ($query) {
            $query->where('send_shipper', auth('shipper')->id())
                ->orWhere('receive_shipper', auth('shipper')->id());
        })->count();
        
        return view('shipper.profile', compact('shipper','ordersCount'));
    }
    public function updateProfile(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|min:3|max:255',
            'last_name' => 'required|string|min:3|max:255',
            'email' => 'nullable|email|max:255|unique:shippers,email,' . Auth::guard('shipper')->id(),
            'city' => 'nullable|string|min:2|max:255',
            'phone' => 'nullable|digits:11|unique:users,phone',
            'address' => 'nullable|string|min:3|max:255',
        ]);

        $id = Auth::guard('shipper')->id();
        $data=[
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email'=>$request->email,
            'city' => $request['city'] ?? null,
            'phone' => $request['phone'] ?? null,
            'address' => $request['address'] ?? null,
        ];
        Shipper::where('id', $id)->update($data);
        return redirect()->route('shipper.profile')->with('success', 'پروفایل با موفقیت به‌روزرسانی شد.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:4|confirmed',
        ]);
        $data = [
            'password' => Hash::make($request->new_password),
           
        ];
        $shipper = Auth::guard('shipper')->user();

        if (!Hash::check($request->current_password, $shipper->password)) {
            return back()->withErrors(['current_password' => 'رمز عبور فعلی نادرست است.']);
        }
        Shipper::where('id', $shipper->id)->update($data);
    

        

        return back()->with('success', 'رمز عبور با موفقیت تغییر یافت.');
    }
}
