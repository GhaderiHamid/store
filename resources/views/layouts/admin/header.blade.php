<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>پنل مدیریت فروشگاه لوازم کامپیوتر</title>
    <!-- لینک به Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/admin/css/style.css">



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
                            <!-- مدیریت محصولات -->
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#collapseProducts" role="button"
                                    aria-expanded="false" aria-controls="collapseProducts">
                                    مدیریت محصولات
                                </a>
                                <div class="collapse" id="collapseProducts">
                                    <ul class="nav flex-column submenu">
                                        <li class="nav-item">
                                            <a class="nav-link" onclick="showForm('form-add-product');">افزودن محصول</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" onclick="showForm('form-list-products');">لیست
                                                محصولات</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" onclick="showForm('form-product-categories');">دسته‌بندی
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
                                            <a class="nav-link" onclick="showForm('form-new-orders');">سفارش‌های
                                                جدید</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" onclick="showForm('form-processing-orders');">سفارش‌های
                                                در حال پردازش</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" onclick="showForm('form-completed-orders');">سفارش‌های
                                                تکمیل شده</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- مدیریت مشتریان -->
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#collapseCustomers" role="button"
                                    aria-expanded="false" aria-controls="collapseCustomers">
                                    مدیریت مشتریان
                                </a>
                                <div class="collapse" id="collapseCustomers">
                                    <ul class="nav flex-column submenu">
                                        <li class="nav-item">
                                            <a class="nav-link" onclick="showForm('form-customer-list');">لیست
                                                مشتریان</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" onclick="showForm('form-add-customer');">افزودن مشتری
                                                جدید</a>
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
                                            <a class="nav-link" href="categories/create">افزودن
                                                دسته‌بندی</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" onclick="showForm('form-category-list');">لیست
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
                        </ul>
                    </div>
                </nav>
    