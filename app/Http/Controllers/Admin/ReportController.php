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
    public function yearlySalesReport()
    {
        $yearlySales = Order_detail::selectRaw('YEAR(created_at) as year, SUM(quantity * price * (1 - discount / 100)) as total_sales')
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->orderBy('year', 'asc')
            ->get()
            ->map(function ($data) {
                // تبدیل سال میلادی به شمسی
                $data->year = Jalalian::fromDateTime("$data->year-01-01")->format('%Y');
                return $data;
            });

        return view('admin.reports.yearly_sales', compact('yearlySales'));
    }
}
