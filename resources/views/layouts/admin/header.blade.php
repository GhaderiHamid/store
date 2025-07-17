<!DOCTYPE html>
<html lang="fa">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
     
        <!-- لینک به Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="/admin/css/style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    </head>

    <body>
        
        <div class="container-fluid">
            <div class="row">
                <button class="btn btn-dark d-md-none mb-2" type="button" data-bs-toggle="collapse"
                    data-bs-target="#sidebar">
                    منو
                </button>

                <!-- منوی کناری با منوهای کشویی -->
                <nav id="sidebar" class="col-md-3 col-lg-2  bg-dark text-white sidebar collapse d-md-block">


                    <div class="sidebar-sticky pt-3">
                        <h4 class="text-center text-white mb-4">مدیریت</h4>
                        <ul class="nav flex-column">
                            <!-- داشبورد -->
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('admin.index') }}">
                                    داشبورد
                                </a>
                            </li>
                            <!-- تیکت های کاربران -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.tickets.index') }}">
                                    <span class="material-symbols-outlined align-middle text-info"
                                        style="font-size:1.2rem;"></span>
                                    تیکت‌های کاربران
                                </a>
                            </li>
                            <!-- مدیریت محصولات -->
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#collapseProducts" role="button"
                                    aria-expanded="false" aria-controls="collapseProducts">
                                    مدیریت محصولات
                                </a>
                                <div class="collapse" id="collapseProducts">
                                    <ul class="nav flex-column submenu">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.products.create') }}">افزودن
                                                محصول</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.product.all') }}">لیست
                                                محصولات</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>
                            <!-- مدیریت سفارش‌ها -->
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#collapseOrders" role="button"
                                    aria-expanded="false" aria-controls="collapseOrders">
                                    مدیریت سفارش‌ها
                                </a>
                                <div class="collapse" id="collapseOrders">
                                    <ul class="nav flex-column submenu">
                                        
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.orders.all') }}">لیست سفارشات</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- مدیریت کاربران -->
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#collapseCustomers" role="button"
                                    aria-expanded="false" aria-controls="collapseCustomers">
                                    مدیریت کاربران
                                </a>
                                <div class="collapse" id="collapseCustomers">
                                    <ul class="nav flex-column submenu">

                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.users.create') }}">افزودن کاربر
                                                جدید</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.users.all') }}">لیست
                                                کاربران</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.shippers.create') }}">افزودن مامور ارسال
                                                </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.shippers.all') }}">لیست
                                                ماموران ارسال</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- مدیریت دسته‌بندی‌ها -->
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#collapseCategories" role="button"
                                    aria-expanded="false" aria-controls="collapseCategories">
                                    مدیریت دسته‌بندی‌ها
                                </a>
                                <div class="collapse" id="collapseCategories">
                                    <ul class="nav flex-column submenu">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.categories.create')}}">افزودن
                                                دسته‌بندی</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.categories.all')}}">لیست
                                                دسته‌بندی‌ها</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>


                            <!-- گزارش‌گیری و تحلیل‌ها -->
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#collapseReports" role="button"
                                    aria-expanded="false" aria-controls="collapseReports">
                                    گزارش‌گیری و تحلیل‌ها
                                </a>
                                <div class="collapse" id="collapseReports">
                                    <ul class="nav flex-column submenu">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.reports.daily_sales') }}">
                                                فروش روزانه</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.reports.weekly_sales') }}">
                                                فروش هفتگی</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.reports.monthly_sales') }}">
                                                فروش ماهانه</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.reports.annual_sales') }}">
                                                فروش سالانه</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.reports.category_sales') }}">فروش بر حسب دسته بندي</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.reports.city_sales') }}">فروش بر حسب شهر</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.reports.top_products') }}">
                                                 محصولات پر فروش</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.reports.top_customers') }}">مشتریان وفادار</a>
                                        </li>
                                       
                                    </ul>
                                </div>
                            </li>
                            <!-- مدیریت پرداخت‌ها -->
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#collapsePayments" role="button"
                                    aria-expanded="false" aria-controls="collapsePayments">
                                    مدیریت پرداخت‌ها
                                </a>
                                <div class="collapse" id="collapsePayments">
                                    <ul class="nav flex-column submenu">
                                       
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.payments.all') }}">لیست
                                                پرداخت‌ها</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logoutAdmin') }}"> خروج</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                