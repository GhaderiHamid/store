<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Order_detail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Morilog\Jalali\Jalalian;

class ReportController extends Controller
{
    public function dailySalesReport()
    {
        $salesData = Order_detail::selectRaw('DATE(created_at) as date, SUM(quantity * price * (1 - discount / 100)) as total_sales')
            ->whereNotIn('status', ['returned', 'return_in_progress'])
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
        // گرفتن همه سفارش‌ها با created_at و قیمت‌ها
        $allOrders = Order_detail::select('created_at', 'quantity', 'price', 'discount')
        ->whereNotIn('status', ['returned', 'return_in_progress'])
        ->get();

        // گروه‌بندی سفارش‌ها بر اساس ماه شمسی
        $monthlyGrouped = $allOrders->groupBy(function ($item) {
            $tehranTime = Carbon::parse($item->created_at)->setTimezone('Asia/Tehran');
            return Jalalian::fromCarbon($tehranTime)->format('%Y/%m');
        });

        // محاسبه مجموع فروش برای هر ماه
        $monthlySales = $monthlyGrouped->map(function ($orders, $month) {
            $total = $orders->sum(function ($item) {
                return $item->price * $item->quantity * (1 - $item->discount / 100);
            });

            return (object)[
                'month' => $month,
                'total_sales' => $total
            ];
        })
            ->sortBy('month') // 💡 این خط مهمه
            ->values();

        return view('admin.reports.monthly_sales', compact('monthlySales'));
    }




    public function annualSalesReport()
    {
        $orders = Order_detail::select('created_at', 'quantity', 'price', 'discount')
            ->whereNotIn('status', ['returned', 'return_in_progress'])
            ->get();

        // مرحله ۱: گروه‌بندی سفارش‌ها بر اساس سال شمسی (با تایم‌زون تهران)
        $grouped = $orders->groupBy(function ($item) {
            $tehranTime = $item->created_at->copy()->setTimezone('Asia/Tehran');
            return Jalalian::fromCarbon($tehranTime)->format('%Y'); // مثل "1403"
        });

        // مرحله ۲: محاسبه مجموع فروش سالانه بدون رشد
        $annualData = $grouped->map(function ($orders) {
            return $orders->sum(function ($item) {
                return $item->quantity * $item->price * (1 - $item->discount / 100);
            });
        });

        // مرحله ۳: مرتب‌سازی بر اساس سال صعودی
        $annualData = $annualData->sortKeys();

        // مرحله ۴: محاسبه درصد رشد سالانه
        $previous = null;
        $annualSales = collect();
        foreach ($annualData as $year => $total) {
            $growth = $previous !== null ? round((($total - $previous) / $previous) * 100, 1) : null;
            $annualSales->push((object)[
                'year' => $year,
                'total_sales' => round($total),
                'growth_percent' => $growth
            ]);
            $previous = $total;
        }

        return view('admin.reports.annual_sales', compact('annualSales'));
    }



    public function weeklySalesReport()
    {
        $orders = Order_detail::select('quantity', 'price', 'discount', 'created_at')
        ->whereNotIn('status', ['returned', 'return_in_progress'])
        ->get();

        $grouped = $orders->groupBy(function ($item) {
            $tehran = $item->created_at->copy()->setTimezone('Asia/Tehran');
            $startOfWeek = $tehran->copy()->startOfWeek(Carbon::SATURDAY);
            return $startOfWeek->toDateString(); // کلید یکتا: تاریخ شروع هفته
        });

        $weeklySales = $grouped->map(function ($orders, $weekStartDate) {
            $carbonStart = Carbon::parse($weekStartDate)->setTimezone('Asia/Tehran');
            $startOfWeekJalali = Jalalian::fromCarbon($carbonStart);
            $endOfWeekJalali = Jalalian::fromCarbon($carbonStart->copy()->addDays(6));

            $jalaliStart = $startOfWeekJalali->format('%d %B');
            $jalaliEnd = $endOfWeekJalali->format('%d %B');

            $year = $startOfWeekJalali->format('%Y');

            $total = $orders->sum(
                fn($item) =>
                $item->quantity * $item->price * (1 - $item->discount / 100)
            );

            return (object)[
                'year' => $year,
                'week_label' => "از $jalaliStart تا $jalaliEnd",
                'total_sales' => round($total),
                'sort_key' => $weekStartDate,
            ];
        })
            ->sortBy('sort_key')
            ->values();

        return view('admin.reports.weekly_sales', compact('weeklySales'));
    }
    public function topSellingProducts()
    {
        $topProducts = Order_detail::select(
            'product_id',
            DB::raw('SUM(quantity) as total_quantity'),
            DB::raw('SUM(quantity * price * (1 - discount / 100)) as total_sales')
        )
            ->whereNotIn('status', ['returned', 'return_in_progress'])    
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
            ->whereNotIn('order_details.status', ['returned', 'return_in_progress'])
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
    public function categorySalesReport()
    {
        $orders = Order_detail::with('product.category')
        ->whereNotIn('status', ['returned', 'return_in_progress'])
        ->get();

        $categorySales = $orders->groupBy(function ($item) {
            return optional($item->product->category)->category_name ?? 'بدون دسته‌بندی';
        })->map(function ($group, $category) {
            $total = $group->sum(function ($item) {
                return $item->price * $item->quantity * (1 - $item->discount / 100);
            });

            return (object)[
                'category' => $category,
                'total_sales' => round($total)
            ];
        })->sortByDesc('total_sales')->values();

        return view('admin.reports.category_sales', compact('categorySales'));
    }
    
    public function citySalesReport()
    {
        $orders = Order_detail::with('order.user')
        ->whereNotIn('status', ['returned', 'return_in_progress'])
        ->get();

        $citySales = $orders->groupBy(function ($item) {
            return optional($item->order->user)->city ?? 'نامشخص';
            
        })->map(function ($group, $city) {
            $total = $group->sum(function ($item) {
                return $item->price * $item->quantity * (1 - $item->discount / 100);
            });

            return (object)[
                'city' => $city,
                'total_sales' => round($total)
            ];
        })->sortByDesc('total_sales')->values();
        

        return view('admin.reports.city_sales', compact('citySales'));
    }
}
