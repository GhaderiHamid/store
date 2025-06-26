<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{

    public function all(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status'); // مقدار می‌تونه paid یا failed باشه

        $payments = Payment::with(['order.user'])
        ->when($search, function ($query) use ($search) {
                $query->whereHas('order.user', function ($q) use ($search) {
                    $q->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"])
                        ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%{$search}%"]);
                });
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->paginate(10);

        return view('admin.payments.all', compact('payments'));
    }
}
