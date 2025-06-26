<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Order_detail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;

class HomeAdminController extends Controller
{


    public function home()
    {
    
        $totalSales = Order_detail::whereNotIn('status', ['returned', 'return_in_progress'])->sum(DB::raw('(price * quantity) * (1 - discount / 100)'));
        $totalOrders = Order::count();
        $todayOrders = Order::whereDate('created_at', Carbon::today())->count();
        $processingOrders = Order::where('status', 'processing')->count();

        // جمع فروش روزانه ۷ روز اخیر
        $sevenDaysAgo = Carbon::now()->subDays(6)->startOfDay();

        $weeklySales = Order_detail::where('created_at', '>=', $sevenDaysAgo)
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(quantity * price * (1 - discount / 100)) as total_sales')
            )
            ->whereNotIn('status', ['returned', 'return_in_progress'])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date', 'asc')
            ->get()
            ->map(function ($item) {
                $item->jalali_date = Jalalian::fromDateTime($item->date)->format('%A %d %B');
                return $item;
            });

        return view('admin.index', [
            'totalSales' => $totalSales,
            'totalOrders' => $totalOrders,
            'todayOrders' => $todayOrders,
            'processingOrders' => $processingOrders,
            'weeklySales' => $weeklySales,
        ]);
    }
}
