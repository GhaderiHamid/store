@extends('layouts.admin.master')

@section('content')
    <!-- ناحیه محتوای اصلی -->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 content">

    <!-- داشبورد (نمایش پیش‌فرض) -->
    <div id="dashboard">
    {{-- <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <span class="navbar-brand">داشبورد اصلی</span>
    <ul class="navbar-nav ml-auto">
    <li class="nav-item">
    <a class="nav-link" href="#">اعلان‌ها</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="#">پروفایل کاربر</a>
    </li>
    </ul>
    </nav> --}}
    <div class="row">
    <div class="col-md-3 mb-3">
    <div class="card text-white bg-info">
    <div class="card-body text-center">
    <h5 class="card-title">فروش کل</h5>
    <p class="card-text">{{ number_format($totalSales) }} تومان</p>
    </div>
    </div>
    </div>
    <div class="col-md-3 mb-3">
    <div class="card text-white bg-success">
    <div class="card-body text-center">
    <h5 class="card-title">سفارش‌های امروز</h5>
    <p class="card-text">{{ number_format($todayOrders) }}</p>
    </div>
    </div>
    </div>
    <div class="col-md-3 mb-3">
    <div class="card text-white bg-warning">
    <div class="card-body text-center">
    <h5 class="card-title"> تعداد سفارشات</h5>
    <p class="card-text">{{ number_format($totalOrders) }}</p>
    </div>
    </div>
    </div>
    <div class="col-md-3 mb-3">
    <div class="card text-white bg-danger">
    <div class="card-body text-center">
    <h5 class="card-title">سفارش در انتظار</h5>
    <p class="card-text">{{ number_format($processingOrders) }}</p>
    </div>
    </div>
    </div>
    </div>
    {{-- <div class="card mt-4">
    <div class="card-header">
    گزارش فروش ماهانه بر اساس تاریخ شمسی
    </div>
    <div class="card-body">
    <canvas id="salesChart"></canvas>
    </div>
    </div> --}}
    <div class="card mt-4">
    <div class="card-header">📈 فروش ۷ روز اخیر</div>
    <div class="card-body">
    <canvas id="weeklyChart"></canvas>
    </div>
    </div>

    </div>


    </main>

    </div>
    </div>
  

  <script>
    const weeklySales = @json($weeklySales);
    const labels = weeklySales.map(item => item.jalali_date);
    const values = weeklySales.map(item => item.total_sales);

    new Chart(document.getElementById('weeklyChart'), {
    type: 'line',
    data: {
      labels: labels,
      datasets: [{
      label: 'فروش روزانه (تومان)',
      data: values,
      backgroundColor: 'rgba(0, 128, 255, 0.2)',
      borderColor: 'rgba(0, 128, 255, 1)',
      borderWidth: 2,
      tension: 0.3
      }]
    },
    options: {
      scales: {
      y: {
        beginAtZero: true,
        ticks: {
        callback: value => value.toLocaleString()
        }
      }
      }
    }
    });
  </script>

@endsection