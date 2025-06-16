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
        $totalSales = Order_detail::sum(DB::raw('(price * quantity) * (1 - discount / 100)'));

        $totalOrders = Order::count();
        $todayOrders = Order::whereDate('created_at', Carbon::today())->count();
        $processingOrders = Order::where('status', 'processing')->count();

        // دریافت سال و ماه شمسی فعلی
        $currentJalali = Jalalian::now();
        $currentYearShamsi = $currentJalali->getYear();
        $currentMonthShamsi = $currentJalali->getMonth();

        // تعریف ماه‌های شمسی
        $jalaliMonths = [
            1 => 'فروردین',
            2 => 'اردیبهشت',
            3 => 'خرداد',
            4 => 'تیر',
            5 => 'مرداد',
            6 => 'شهریور',
            7 => 'مهر',
            8 => 'آبان',
            9 => 'آذر',
            10 => 'دی',
            11 => 'بهمن',
            12 => 'اسفند'
        ];

        // ایجاد ساختار اولیه برای تمام ماه‌های از فروردین تا ماه جاری
        $allMonthsData = [];
        foreach (range(1, $currentMonthShamsi) as $month) {
            $allMonthsData[$month] = [
                'month' => $jalaliMonths[$month],
                'total' => 0
            ];
        }

        // تاریخ شروع سال شمسی (۱ فروردین)
        $startOfPersianYear = Jalalian::fromFormat('Y-m-d', $currentYearShamsi . '-01-01')->toCarbon();

        // دریافت تمام سفارشات از ابتدای سال شمسی
        $orderDetails = Order_detail::where('created_at', '>=', $startOfPersianYear)
            ->get(['created_at', 'price', 'quantity', 'discount']);

        // محاسبه فروش بر اساس ماه شمسی
        $monthlySales = [];
        foreach ($orderDetails as $detail) {
            $jalaliDate = Jalalian::fromCarbon($detail->created_at);
            $month = $jalaliDate->getMonth();
            $amount = ($detail->price * $detail->quantity) * (1 - $detail->discount / 100);

            if (!isset($monthlySales[$month])) {
                $monthlySales[$month] = 0;
            }
            $monthlySales[$month] += $amount;
        }

        // ادغام داده‌های واقعی با ساختار اولیه
        foreach ($monthlySales as $month => $total) {
            if (isset($allMonthsData[$month])) {
                $allMonthsData[$month]['total'] = $total;
            }
        }

        $formattedSales = array_values($allMonthsData);

        return view('admin.index', compact('totalSales', 'totalOrders', 'todayOrders', 'processingOrders', 'formattedSales'));
    }
}
