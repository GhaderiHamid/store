<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>پنل مدیریت فروشگاه لوازم کامپیوتر</title>
    <!-- لینک به Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/admin/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">


</head>

<body>
    <div class="container-fluid">
        <div class="row">

                <!-- منوی کناری با منوهای کشویی -->
                <nav id="sidebar" class="col-md-2 d-none d-md-block bg-dark sidebar">
                    <div class="sidebar-sticky pt-3">
                        <h4 class="text-center text-white mb-4">مدیریت</h4>
                        <ul class="nav flex-column">
                            <!-- داشبورد -->
                            <li class="nav-item">
                                <a class="nav-link active" onclick="showForm('dashboard');">
                                    داشبورد
                                </a>
                            </li>
                            <!-- تیکت های کاربران -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.tickets.index') }}">
                                    <span class="material-symbols-outlined align-middle text-info" style="font-size:1.2rem;"></span>
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
                                            <a class="nav-link" href="{{ route('admin.products.create') }}">افزودن محصول</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.product.all') }}">لیست
                                                محصولات</a>
                                        </li>
                                        {{-- <li class="nav-item">
                                            <a class="nav-link" onclick="showForm('form-product-categories');">دسته‌بندی
                                                محصولات</a>
                                        </li> --}}
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
                                            <a class="nav-link" onclick="showForm('form-new-orders');">سفارش‌های
                                                جدید</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" onclick="showForm('form-processing-orders');">سفارش‌های
                                                در حال پردازش</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.orders.all') }}">سفارش‌های
                                                تکمیل شده</a>
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
                            <!-- تخفیف‌ها و کوپن‌ها -->
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#collapseDiscounts" role="button"
                                    aria-expanded="false" aria-controls="collapseDiscounts">
                                    تخفیف‌ها و کوپن‌ها
                                </a>
                                <div class="collapse" id="collapseDiscounts">
                                    <ul class="nav flex-column submenu">
                                        <li class="nav-item">
                                            <a class="nav-link" onclick="showForm('form-active-discounts');">تخفیف‌های
                                                فعال</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" onclick="showForm('form-add-coupon');">ایجاد کوپن
                                                تخفیف</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- مدیریت کاربران -->
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#collapseUsers" role="button"
                                    aria-expanded="false" aria-controls="collapseUsers">
                                    مدیریت کاربران
                                </a>
                                <div class="collapse" id="collapseUsers">
                                    <ul class="nav flex-column submenu">
                                        <li class="nav-item">
                                            <a class="nav-link" onclick="showForm('form-user-list');">لیست کاربران</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" onclick="showForm('form-add-user');">افزودن کاربر
                                                جدید</a>
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
                                            <a class="nav-link" onclick="showForm('form-sales-report');">گزارش
                                                فروش</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" onclick="showForm('form-customer-report');">گزارش
                                                مشتریان</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" onclick="showForm('form-order-report');">گزارش
                                                سفارش‌ها</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- مدیریت پرداخت‌ها -->
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#collapsePayments" role="button" aria-expanded="false"
                                    aria-controls="collapsePayments">
                                    مدیریت پرداخت‌ها
                                </a>
                                <div class="collapse" id="collapsePayments">
                                    <ul class="nav flex-column submenu">
                                        {{-- <li class="nav-item">
                                            <a class="nav-link" >پرداخت‌های جدید</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" >پرداخت‌های
                                                تکمیل شده</a>
                                        </li> --}}
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.payments.all') }}">لیست
                                                پرداخت‌ها</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                {{-- <p></p> --}}
