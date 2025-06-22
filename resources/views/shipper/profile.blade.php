<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>پروفایل مامور ارسال</title>

    <!-- فونت‌ها و آیکون‌ها -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- استایل‌ها -->
    <link rel="stylesheet" href="/css/bootstrap-rtl.css">
    <link rel="stylesheet" href="/css/shipper.css">
</head>

<body class="rtl">
    <header class="main-header">
        <div class="container">
            <div class="header-content d-flex align-items-center justify-content-between py-3">
                <div class="logo">
                    <h1 class="text-white mb-0">پروفایل کاربری</h1>
                </div>
                
                <div class="user-profile">
                    <div class="dropdown">
                        <button class="btn-user-profile dropdown-toggle d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-avatar">
                                <span class="material-symbols-outlined">account_circle</span>
                            </div>
                            <div class="user-info ms-2">
                                <span class="user-name">{{ $shipper->first_name }} {{ $shipper->last_name }}</span>
                            </div>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item d-flex align-items-center active" href="{{ route('shipper.profile') }}">
                                    <span class="material-symbols-outlined me-2">person</span>
                                    پروفایل کاربری
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('ShipperIndex') }}">
                                    <span class="material-symbols-outlined me-2">list_alt</span>
                                    لیست سفارشات
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center " href="{{ route('logoutShipper') }}">
                                    <span class="material-symbols-outlined me-2">logout</span>
                                    خروج از سیستم
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container custom-container mt-5 mb-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="profile-sidebar card shadow-sm">
                    <div class="card-body text-center">
                        <div class="profile-avatar mb-3">
                            <span class="material-symbols-outlined" style="font-size: 100px; color: #3a7bd5;">account_circle</span>
                        </div>
                        <h4 class="profile-name">{{ $shipper->first_name }} {{ $shipper->last_name }}</h4>
                        <p class="text-muted mb-4">مامور ارسال</p>
                        
                        <div class="profile-stats d-flex justify-content-around">
                            <div>
                                <h5 class="mb-0">{{ $ordersCount ?? 0 }}</h5>
                                <small class="text-muted">سفارشات</small>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="profile-content card shadow-sm">
                    <div class="card-body">
                        <ul class="nav nav-tabs mb-4" id="profileTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">
                                    <span class="material-symbols-outlined align-middle me-1">person</span>
                                    اطلاعات شخصی
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button" role="tab">
                                    <span class="material-symbols-outlined align-middle me-1">lock</span>
                                    امنیت
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content" id="profileTabsContent">
                            @include('errors.message')
                            <div class="tab-pane fade show active" id="info" role="tabpanel">
                              
                                <form action="{{ route('shipper.profile.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">نام</label>
                                            <input type="text" class="form-control" name="first_name" value="{{ $shipper->first_name }}" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">نام خانوادگی</label>
                                            <input type="text" class="form-control" name="last_name" value="{{ $shipper->last_name }}" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">شماره تماس</label>
                                            <input type="tel" class="form-control rtl" name="phone" value="{{ $shipper->phone }}" required >
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">شهر</label>
                                            <input type="text" class="form-control" name="city" value="{{ $shipper->city }}" required >
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">آدرس</label>
                                            <input type="text" class="form-control" name="address" value="{{ $shipper->address }}" required >
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">ایمیل</label>
                                            <input type="email" class="form-control" name="email" value="{{ $shipper->email }}" required >
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">تاریخ عضویت</label>
                                            <input type="text" class="form-control" value="{{ \Morilog\Jalali\Jalalian::fromCarbon($shipper->created_at)->format('Y/m/d') }}" disabled>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <span class="material-symbols-outlined align-middle me-1">save</span>
                                        ذخیره تغییرات
                                    </button>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="security" role="tabpanel">
                               
                                <form action="{{ route('shipper.password.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label class="form-label">رمز عبور فعلی</label>
                                        <input type="password" class="form-control" name="current_password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">رمز عبور جدید</label>
                                        <input type="password" class="form-control" name="new_password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">تکرار رمز عبور جدید</label>
                                        <input type="password" class="form-control" name="new_password_confirmation" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <span class="material-symbols-outlined align-middle me-1">lock_reset</span>
                                        تغییر رمز عبور
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- اسکریپت‌ها -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // فعال کردن تب‌ها
        const profileTabs = document.querySelector('#profileTabs');
        if (profileTabs) {
            const tab = new bootstrap.Tab(profileTabs.querySelector('button[data-bs-target="#info"]'));
            tab.show();
        }
    </script>
</body>
</html>