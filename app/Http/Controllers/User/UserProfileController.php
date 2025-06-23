<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::guard('web')->user();
        return view('frontend.user.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::guard('web')->user();

        $data = $request->validate([
            'first_name' => 'required|string|min:3|max:255',
            'last_name' => 'required|string|min:3|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'city' => 'nullable|string|min:2|max:255',
            'phone' => 'nullable|digits:11|unique:users,phone,' . $user->id,
            'sheba_number'=>'nullable|string|min:26|',
            'address' => 'nullable|string|min:3|max:255',
        ]);

        $updateData = [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'city' => $data['city'] ?? null,
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
            'sheba_number'=>$data['sheba_number']??null,
        ];

        if (!empty($data['password'])) {
            $updateData['password'] = Hash::make($data['password']);
        }

        User::where('id', $user->id)->update($updateData);

        return redirect()->back()->with('success', 'اطلاعات با موفقیت بروزرسانی شد.');
    }

    
}
