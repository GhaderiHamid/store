<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shipper\StoreRequest;
use App\Models\Shipper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ShipperController extends Controller
{

    public function all(Request $request)
    {
        $query = $request->input('query');

        $shippers = Shipper::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where(function ($subQuery) use ($query) {
                $subQuery->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$query}%"])
                    ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%{$query}%"]);
            });
        
        })->paginate(10); // صفحه‌بندی نتایج
        return view('admin.shippers.all', compact('shippers'));
    }
    public function create()
    {
        return view('admin.shippers.add');
    }

    public function store(StoreRequest $request)
    {
        $validated = $request->validated();


        $createdShipper = DB::table('shippers')->insert([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'],
            'city' => $validated['city'],
            'address' => $request['address'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),

        ]);
            
        
        if (! $createdShipper) {
            return back()->with('failed', 'مامور ارسال ايجاد نشد');
        }
        return back()->with('success', 'مامور ارسال ايجاد شد');
    }
    public function edit($shipper_id)
    {
        $shipper = Shipper::findOrFail($shipper_id);
        return view('admin.shippers.edit', compact('shipper'));
    }
    public function update(Request $request, $shipper_id)
    {
        $request->validate([
            'first_name' => 'required|string|min:3|max:255',
            'last_name' => 'required|string|min:3|max:255',
            'email' => 'nullable|email|max:255' . Auth::guard('shipper')->id(),
            'city' => 'nullable|string|min:2|max:255',
            'phone' => 'nullable|digits:11',
           
            'address' => 'nullable|string|min:3|max:255',
           
        ]);

        $id = Auth::guard('shipper')->id();
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'city' => $request['city'] ?? null,
            'phone' => $request['phone'] ?? null,
            'address' => $request['address'] ?? null,
            
           
        ];
        Shipper::where('id', $id)->update($data);
        return back()->with('success', 'مامور ارسال با موفقیت به‌روزرسانی شد.');
    }
      

    public function delete($shipper_id)
    {
        $shipper = Shipper::findOrFail($shipper_id);
        $shipper->delete();
        return back()->with('success', 'مامور ارسال حذف شد');
    }
}
