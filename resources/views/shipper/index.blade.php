<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>پنل مامور ارسال </title>

    
    <!-- فونت‌ها و آیکون‌ها -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preload" href="/fonts/Vazir-Medium.woff2" as="font" type="font/woff2" crossorigin="anonymous">
<link rel="preload" href="/fonts/Vazir-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous">

    <!-- استایل‌های اختصاصی -->
    <link rel="stylesheet" href="/css/bootstrap-rtl.css">
    <link rel="stylesheet" href="/css/shipper.css">

</head>

<body class="rtl">
    <button class="theme-toggle-btn border border-info" onclick="toggleTheme()" aria-label="تغییر حالت تم">
        <span class="material-symbols-outlined ">dark_mode</span>
      </button>
    <header class="main-header">
        <div class="container">
            <div class="header-content d-flex align-items-center justify-content-between py-3">
                <div class="logo">
                    <h1 class="text-white mb-0">پنل مامور ارسال</h1>
                </div>
                
                <div class="user-profile">
                    <div class="dropdown">
                        <button class="btn-user-profile dropdown-toggle d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-avatar">
                                <span class="material-symbols-outlined">account_circle</span>
                            </div>
                            <div class="user-info ms-2">
                                <span class="user-name">{{ Auth::guard('shipper')->user()->first_name  ?? '' }} {{ Auth::guard('shipper')->user()->last_name  ?? '' }}</span>
                                
                            </div>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('shipper.profile') }}">
                                    <span class="material-symbols-outlined me-2">person</span>
                                    پروفایل کاربری
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
    <div class="container custom-container mt-5">
        <div class="header-container d-flex align-items-center justify-content-between mb-4">
            <h2 class="text-white mb-0"><mak>لیست سفارشات شما </mak></h2>
            
            
        </div>
        <div class="row">
            <div class="col-12">
                @if ($counts > 0)
                    <ul class="nav mak nav-tabs custom-nav-tabs-product-page justify-content-center rounded-pill bg-dark p-2 shadow-lg"
                        id="myTab" role="tablist">
                        <li class="nav-item m-1">
                            <a class="nav-link {{ request('status') == 'shipped' || !request('status') ? 'active' : '' }} text-white d-flex align-items-center px-4 py-2 rounded-pill fw-bold bg-primary shadow-sm"
                                href="?status=shipped">
                                <span class="material-symbols-outlined me-2 text-white">local_shipping</span>
                                ارسالی  
                                <span class="badge bg-white text-dark mx-1">{{ $counts['shipped'] ?? 0 }}</span>
                            </a>
                        </li>

                        <li class="nav-item m-1">
                            <a class="nav-link {{ request('status') == 'return_in_progress' ? 'active' : '' }} text-white d-flex align-items-center px-4 py-2 rounded-pill fw-bold bg-danger shadow-sm"
                                href="?status=return_in_progress">
                                <span class="material-symbols-outlined me-2">undo</span>
                                مرجوعی
                                <span class="badge bg-white text-dark mx-1">{{ $counts['return_in_progress'] ?? 0 }}</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content mt-3" id="myTabContent">
                        <!-- تب سفارشات ارسالی -->
                        <div class="tab-pane fade {{ request('status') == 'shipped' || !request('status') ? 'show active' : '' }}" id="shipped" role="tabpanel" aria-labelledby="shipped-tab">
                            <div class="container my-5 mx-2">
                                <div class="row">
                                    @if ($orders->where('status', 'shipped')->isEmpty())
                                        <p class="text-white"><mak> شما هیچ سفارش برای ارسال ندارید. </mak></p>
                                    @endif
                                    
                                    @foreach ($orders as $order)
                                        @if ($order->status == 'shipped')
                                            <div class="col-md-6 col-lg-4 mb-4">
                                                <div class="order-card delivered-order">
                                                    <div class="order-header">
                                                        <h5 class="mb-0">سفارش #{{ $order->id }}</h5>
                                                    </div>
                                                    <div class="order-body">
                                                        <div class="order-detail">
                                                            <div><span class="material-symbols-outlined order-detail-icon">person</span>
                                                                <span class="order-detail-label">نام:</span></div>
                                                            <span>{{ $order->user->first_name }} {{ $order->user->last_name }}</span>
                                                        </div>
                                                        <div class="order-detail">
                                                           <div> <span class="material-symbols-outlined order-detail-icon">phone</span>
                                                            <span class="order-detail-label">شماره همراه:</span></div>
                                                            <span>{{ $order->user->phone }}</span>
                                                        </div>
                                                        <div class="order-detail">
                                                           <div class="d-flex align-items-center justify-content-center "> 
                                                              <div><span class="material-symbols-outlined order-detail-icon">location_on</span></div>
                                                               <div>
                                                                  <span class="order-detail-label">آدرس:</span>
                                                               </div>
                                                            </div>
                                                       
                                                            <div class="w-75 text-right">{{ $order->user->address }}</div>
                                                        </div>
                                                        <div class="order-detail">
                                                           <div> <span class="material-symbols-outlined order-detail-icon">calendar_today</span>
                                                            <span class="order-detail-label">تاریخ سفارش:</span></div>
                                                            <span>{{ \Morilog\Jalali\Jalalian::fromCarbon($order->created_at)->format('Y/m/d H:i') }}</span>
                                                        </div>
                                                        <div class="order-detail">
                                                           <div> <span class="material-symbols-outlined order-detail-icon">info</span>
                                                            <span class="order-detail-label">وضعیت:</span></div>
                                                            <span class="badge bg-info">{{ $statusLabels[$order->status] }}</span>
                                                        </div>
                                                        <div class="order-actions">
                                                            <button onclick="deliverOrder({{ $order->id }})" class="btn btn-success btn-sm text-white flex-grow-1 d-flex align-items-center justify-content-center">
                                                                <span class="material-symbols-outlined me-1 ">check_circle</span>
                                                                <p class="d-inline-block m-0">تحویل</p>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                
                                <!-- صفحه‌بندی -->
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $orders->appends(['status' => 'shipped'])->links() }}
                                </div>
                            </div>
                        </div>

                        <!-- تب سفارشات مرجوعی -->
                        <div class="tab-pane fade {{ request('status') == 'return_in_progress' ? 'show active' : '' }}" id="return_in_progress" role="tabpanel" aria-labelledby="return_in_progress-tab">
                            <div class="container my-5 mx-2">
                                <div class="row">
                                    @if ($orders->where('status', 'return_in_progress')->isEmpty())
                                        <p class="text-white"><mak> شما هیچ سفارش برای مرجوع ندارید. </mak></p>
                                    @endif
                                    
                                    @foreach ($orders as $order)
                                    @if ($order->status == 'return_in_progress')
                                    <div class="col-md-6 col-lg-4 mb-4">
                                        <div class="order-card return-order">
                                            <div class="order-header">
                                                <h5 class="mb-0">سفارش #{{ $order->id }}</h5>
                                            </div>
                                            <div class="order-body">
                                                <div class="order-detail">
                                                    <div><span class="material-symbols-outlined order-detail-icon">person</span>
                                                        <span class="order-detail-label">نام:</span></div>
                                                    <span>{{ $order->user->first_name }} {{ $order->user->last_name }}</span>
                                                </div>
                                                <div class="order-detail">
                                                    <div><span class="material-symbols-outlined order-detail-icon">phone</span>
                                                        <span class="order-detail-label">شماره همراه:</span></div>
                                                    <span>{{ $order->user->phone }}</span>
                                                </div>
                                                <div class="order-detail">
                                                    <div class="d-flex align-items-center justify-content-center "> 
                                                       <div><span class="material-symbols-outlined order-detail-icon">location_on</span></div>
                                                        <div>
                                                           <span class="order-detail-label">آدرس:</span>
                                                        </div>
                                                     </div>
                                                
                                                     <div class="w-75 text-right">{{ $order->user->address }}</div>
                                                 </div>
                                                
                                                <!-- نمایش محصولات مرجوعی -->
                                                <div class="order-detail">
                                                   <div> <span class="material-symbols-outlined order-detail-icon">shopping_bag</span>
                                                    <div><span class="order-detail-label">محصولات مرجوعی:</span></div></div>
                                                    <div class="mt-2">
                                                        @foreach($order->details as $item)
                                                            @if($item->status === 'return_in_progress')
                                                                <div class="d-flex align-items-center mb-2 p-2 bg-light rounded">
                                                                    <img src="/{{ $item->product->image_path }}" 
                                                                        alt="{{ $item->product->name }}" 
                                                                        class="img-thumbnail" 
                                                                        style="width: 80px; height: 80px; object-fit: cover;">
                                                                    <div class="m-2">
                                                                        <small class="d-block">{{ $item->product->name }}</small>
                                                                        <small class="text-muted">تعداد: {{ $item->return_quantity }}</small>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                                
                                                <div class="order-detail">
                                                    <div><span class="material-symbols-outlined order-detail-icon">calendar_today</span>
                                                        <span class="order-detail-label">تاریخ درخواست:</span></div>
                                                    <span>{{ \Morilog\Jalali\Jalalian::fromCarbon($order->updated_at)->format('Y/m/d H:i') }}</span>
                                                </div>
                                                <div class="order-detail">
                                                    <div><span class="material-symbols-outlined order-detail-icon">info</span>
                                                        <span class="order-detail-label">وضعیت:</span></div>
                                                    <span class="badge bg-danger text-white">{{ $statusLabels[$order->status] }}</span>
                                                </div>
                                                
                                                <div class="order-actions">
                                                    <button onclick="returnOrder({{ $order->id }})" class="btn btn-success btn-sm text-white flex-grow-1 d-flex align-items-center justify-content-center">
                                                        <span class="material-symbols-outlined me-1">undo</span>
                                                        <p class="d-inline-block m-0">مرجوع</p>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                    @endforeach
                                </div>
                                
                                <!-- صفحه‌بندی -->
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $orders->appends(['status' => 'return_in_progress'])->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <p class="text-white">شما هیچ سفارش ثبت‌ شده‌ای ندارید.</p>
                @endif
            </div>
        </div>
       
    </div>

    <!-- اسکریپت‌های مورد نیاز -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function deliverOrder(orderId) {
            if (confirm('آیا از تحویل این سفارش اطمینان دارید؟')) {
                fetch(`/shipper/orders/${orderId}/deliver`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('وضعیت سفارش با موفقیت به "تحویل داده شده" تغییر یافت.');
                        location.reload();
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }

        function returnOrder(orderId) {
            if (confirm('آیا از مرجوع کردن این سفارش اطمینان دارید؟')) {
                fetch(`/shipper/orders/${orderId}/return`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('وضعیت سفارش با موفقیت به "مرجوع شده" تغییر یافت.');
                        location.reload();
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }
    </script>
 <script>
    function toggleTheme() {
      const body = document.body;
      const icon = document.querySelector('.theme-toggle-btn span');
  
      body.classList.toggle('light-mode');
  
      // تغییر آیکون بسته به حالت تم
      if (body.classList.contains('light-mode')) {
        icon.textContent = 'light_mode';
        localStorage.setItem('theme', 'light');
      } else {
        icon.textContent = 'dark_mode';
        localStorage.setItem('theme', 'dark');
      }
    }
  
    // هنگام لود صفحه، بازیابی حالت از localStorage
    window.onload = function () {
      const savedTheme = localStorage.getItem("theme");
      const icon = document.querySelector('.theme-toggle-btn span');
      if (savedTheme === "light") {
        document.body.classList.add("light-mode");
        if (icon) icon.textContent = "light_mode";
      }
    };
  </script>
</body>
</html>