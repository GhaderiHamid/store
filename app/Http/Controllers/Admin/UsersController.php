<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\StoreRequest;
use App\Http\Requests\Admin\Users\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function all()
    {
        $users = User::paginate(10);
        return view('admin.users.all', compact('users'));
    }
    public function create()
    {
        return view('admin.users.add');
    }

    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();
        $createdUser =  User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'city' => $validatedData['city'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
            'role' => $validatedData['role'],
        ]);
        if (! $createdUser) {
            return back()->with('failed', 'كاربر ايجاد نشد');
        }
        return back()->with('success', 'كاربر ايجاد شد' );
    }
    public function edit($user_id) {
        $user= User::findOrFail($user_id);
        return view('admin.users.edit', compact('user'));
    }
    public function update(UpdateRequest $request,$user_id) {
        $validatedData = $request->validated();
        $user= User::findOrFail($user_id);
       $updatedUser= $user->update([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'city' => $validatedData['city'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
            'role' => $validatedData['role'],
        ]);
        if (! $updatedUser) {
            return back()->with('failed','كاربر بروزرساني نشد');
        }
        return back()->with('success','كاربر بروزرساني شد');
    }

    public function delete($user_id) {
        $user=User::findOrFail($user_id);
        $user->delete();
        return back()->with('success','كاربر حذف شد');
    }
}
