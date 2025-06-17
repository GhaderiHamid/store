<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Order_detail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;

class ReportController extends Controller
{
    public function dailySalesReport()
    {
        $salesData = Order_detail::selectRaw('DATE(created_at) as date, SUM(quantity * price * (1 - discount / 100)) as total_sales')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->map(function ($data) {
                // تبدیل تاریخ به شمسی
                $data->date = Jalalian::fromDateTime($data->date)->format('%Y/%m/%d');
                return $data;
            });

        return view('admin.reports.daily_sales', compact('salesData'));
    }
    public function monthlySalesReport()
    {
        $monthlySales = Order_detail::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(quantity * price * (1 - discount / 100)) as total_sales')
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
            ->orderBy('month', 'asc')
            ->get()
            ->map(function ($data) {
                // تبدیل ماه میلادی به شمسی
                $year = substr($data->month, 0, 4);
                $month = substr($data->month, 5, 2);
                $data->month = Jalalian::fromDateTime("$year-$month-01")->format('%Y/%m');
                return $data;
            });

        return view('admin.reports.monthly_sales', compact('monthlySales'));
    }
    public function annualSalesReport()
    {
        $orders = Order_detail::select('quantity', 'price', 'discount', 'created_at')->get();

        $annualSales = $orders->groupBy(function ($item) {
            return \Morilog\Jalali\Jalalian::fromDateTime($item->created_at)->format('%Y');
        })->map(function ($group) {
            return $group->reduce(function ($carry, $item) {
                return $carry + ($item->quantity * $item->price * (1 - $item->discount / 100));
            }, 0);
        })->sortKeys()->map(function ($sales, $year) {
            return (object)[
                'year' => $year,
                'total_sales' => $sales
            ];
        })->values();

        return view('admin.reports.annual_sales', compact('annualSales'));
    }
   

    public function weeklySalesReport()
    {
        $orders = Order_detail::select('quantity', 'price', 'discount', 'created_at')->get();

        $weeklySales = $orders->groupBy(function ($item) {
            $date = Jalalian::fromDateTime($item->created_at);
            return $date->format('%Y-%W'); // سال/هفته شمسی
        })->map(function ($group) {
            return $group->reduce(function ($carry, $item) {
                return $carry + ($item->quantity * $item->price * (1 - $item->discount / 100));
            }, 0);
        })->sortKeys()->map(function ($sales, $week) {
            return (object)[
                'week' => $week,
                'total_sales' => $sales
            ];
        })->values();

        return view('admin.reports.weekly_sales', compact('weeklySales'));
    }
    public function topSellingProducts()
    {
        $topProducts = Order_detail::select(
            'product_id',
            DB::raw('SUM(quantity) as total_quantity'),
            DB::raw('SUM(quantity * price * (1 - discount / 100)) as total_sales')
        )
            ->groupBy('product_id')
            ->with('product')
            ->orderByDesc('total_quantity') // 🔁 مرتب‌سازی بر اساس تعداد فروش
            ->take(20)
            ->get();

        return view('admin.reports.top_products', compact('topProducts'));
    }
    public function topCustomersReport(Request $request)
    {
        $customerStats = DB::table('order_details')
            ->join('orders', 'orders.id', '=', 'order_details.order_id')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->select(
                'users.id as user_id',
                'users.first_name',
                'users.last_name',
                'users.email',
                DB::raw('COUNT(DISTINCT orders.id) as orders_count'),
                DB::raw('SUM(order_details.quantity * order_details.price * (1 - order_details.discount / 100)) as total_spent')
            )
            ->groupBy('users.id', 'users.first_name', 'users.last_name', 'users.email')
            ->orderByDesc('total_spent')
            ->paginate(20);

        return view('admin.reports.top_customers', compact('customerStats'));
    }
}
