@extends('layouts.frontend.master')

@section('content')
<title>  سفارشات من</title>
    @php
        $statusColors = [
            'processing' => 'badge bg-warning',
            'shipped' => 'badge bg-primary',
            'delivered' => 'badge bg-success',
            'returned' => 'badge bg-danger',
            'return_requested' => 'badge bg-info',
        ];
    @endphp
    {{-- {{ request('status') == 'processing' || !request('status') ? 'bg-warning' : 'bg-secondary' }} --}}
    <div class="container custom-container mt-5">
      
        <h5 class="custom-font mb-3">لیست سفارشات شما </h5>
        <div class="row mt-5">
            <div class="col-sm-12">
                {{-- @if (!$orders->isEmpty()) --}}
                <ul class="nav mak nav-tabs custom-nav-tabs-product-page justify-content-center rounded-pill bg-dark p-2 shadow-lg" id="myTab" role="tablist">
                    <!-- در حال پردازش -->
                    <li class="nav-item m-1">
                        <a class="nav-link {{ request('status') == 'processing' || !request('status') ? 'active' : '' }} text-white d-flex align-items-center px-4 py-2 rounded-pill fw-bold bg-warning shadow-sm"
                           href="?status=processing">
                            <span class="material-symbols-outlined me-2 text-white">autorenew</span>
                            در حال پردازش
                            <span class="badge bg-white text-dark mx-1">{{ $counts['processing'] ?? 0 }}</span>
                        </a>
                    </li>
                    
                    <!-- در حال ارسال -->
                    <li class="nav-item m-1">
                        <a class="nav-link {{ request('status') == 'shipped' ? 'active' : '' }} text-white d-flex align-items-center px-4 py-2 rounded-pill fw-bold bg-primary shadow-sm"
                           href="?status=shipped">
                            <span class="material-symbols-outlined me-2 text-white">local_shipping</span>
                            در حال ارسال
                            <span class="badge bg-white text-dark mx-1">{{ $counts['shipped'] ?? 0 }}</span>
                        </a>
                    </li>
                    
                    <!-- تحویل داده شده -->
                    <li class="nav-item m-1">
                        <a class="nav-link {{ request('status') == 'delivered' ? 'active' : '' }} d-flex align-items-center px-4 py-2 rounded-pill fw-bold bg-success text-white"
                           href="?status=delivered">
                            <span class="material-symbols-outlined me-2">check_circle</span>
                            تحویل شده
                            <span class="badge bg-white text-dark mx-1">{{ $counts['delivered'] ?? 0 }}</span>
                        </a>
                    </li>
                    
                    <!-- مرجوع شده -->
                    <li class="nav-item m-1">
                        <a class="nav-link {{ request('status') == 'returned' ? 'active' : '' }} d-flex align-items-center px-4 py-2 rounded-pill fw-bold bg-danger text-white"
                           href="?status=returned">
                            <span class="material-symbols-outlined me-2">undo</span>
                            مرجوع شده
                            <span class="badge bg-white text-dark mx-1">{{ $counts['returned'] ?? 0 }}</span>
                        </a>
                    </li>
                </ul>

                    <div class="tab-content mt-3" id="myTabContent">
                        <!-- تب سفارشات در حال پردازش -->
                        <div class="tab-pane fade {{ request('status') == 'processing' || !request('status') ? 'show active' : '' }}" 
                            id="processing" role="tabpanel" aria-labelledby="processing-tab">
                            <div class="container my-5 mx-2">
                                <div class="row">
                                    @if ($orders->isEmpty())
                                        <p class="text-white"><mak> شما هیچ سفارش در حال پردازش ندارید. </mak></p>
                                    @endif

                                    @foreach ($orders as $order)
                                        <div class="w-100 product-border p-3 mt-3 text-white border-white">
                                            <mak3>
                                            <h5>شماره سفارش: {{ $order->id }}</h5>
                                            <p>تاریخ سفارش:
                                                {{ \Morilog\Jalali\Jalalian::fromDateTime($order->created_at)->format('H:i Y/m/d') }}
                                            </p>

                                            <p>وضعیت سفارش:
                                                <span class="{{ $statusColors[$order->status] ?? 'badge bg-secondary' }} p-2">
                                                    
                                                    {{ $statusLabels[$order->status] ?? 'نامشخص' }}
                                                </span>
                                            </p>

                                            <p>جمع کل:
                                                {{ optional($order->payment)->amount ? number_format(optional($order->payment)->amount) : 'بدون پرداخت' }}
                                                تومان</p>

                                            <h6 class="mt-3">جزئیات محصولات:</h6>

                                            @foreach ($order->order_detail as $detail)
                                                <div class="product-border p-2 mt-2 border-secondary">
                                                    <div class="d-flex">
                                                        <img class="card-img-top rounded" 
                                                            style="width: 100px; height: 100px" 
                                                            src="/{{ $detail->product->image_path }}" 
                                                            alt="Product Image">
                                                        <div class="card-body col-sm-12 col-md-4">
                                                            <p class="card-text"> نام: {{ $detail->product->name }} </p>
                                                            @if ($detail->discount != 0)
                                                                <p class="card-text d-inline-block">تخفیف:
                                                                <p class="d-inline-block bg-danger mx-1 p-1 rounded">
                                                                    {{ $detail->discount }} درصد
                                                                </p>
                                                                </p>
                                                            @endif

                                                            <p class="card-text">تعداد: {{ $detail->quantity }}</p>

                                                            <div class="card-text d-flex">
                                                                <p class="">قیمت: </p>
                                                                @if ($detail->discount > 0)
                                                                    <p class="d-inline-block mx-1">
                                                                        <s class="mr-2 d-inline-block">{{ number_format($detail->price) }}
                                                                            تومان</s>
                                                                    </p>
                                                                    <p class="d-inline-block">
                                                                        {{ number_format($detail->price - ($detail->price * $detail->discount) / 100) }}
                                                                        &nbsp;تومان
                                                                    </p>
                                                                @else
                                                                    <p class="d-inline-block mx-1">
                                                                        {{ number_format($detail->price) }}
                                                                    </p>
                                                                    <p class="d-inline-block">تومان</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            </mak3>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- صفحه‌بندی -->
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $orders->appends(['status' => 'processing'])->links() }}
                                </div>
                            </div>
                        </div>

                        <!-- تب سفارشات در حال ارسال -->
                        <div class="tab-pane fade {{ request('status') == 'shipped' ? 'show active' : '' }}" 
                            id="shipped" role="tabpanel" aria-labelledby="shipped-tab">
                            <div class="container my-5 mx-2">
                                <div class="row">
                                    @if ($orders->isEmpty())
                                        <p class="text-white"><mak> شما هیچ سفارش در حال ارسال ندارید.</mak></p>
                                    @endif

                                    @foreach ($orders as $order)
                                        <div class="w-100 product-border p-3 mt-3 text-white border-white">
                                            <h5>شماره سفارش: {{ $order->id }}</h5>
                                            <p>تاریخ سفارش:
                                                {{ \Morilog\Jalali\Jalalian::fromDateTime($order->created_at)->format('H:i Y/m/d') }}
                                            </p>

                                            <p>وضعیت سفارش:
                                                <span class="{{ $statusColors[$order->status] ?? 'badge bg-secondary' }} p-2">
                                                    {{ $statusLabels[$order->status] ?? 'نامشخص' }}
                                                </span>
                                            </p>

                                            <p>جمع کل: {{ optional(value: $order->payment)->amount ? number_format(optional($order->payment)->amount) : 'بدون پرداخت' }} تومان</p>

                                            <h6 class="mt-3">جزئیات محصولات:</h6>

                                            @foreach ($order->order_detail as $detail)
                                                <div class="product-border p-2 mt-2 border-secondary">
                                                    <div class="d-flex">
                                                        <img class="card-img-top rounded" 
                                                            style="width: 100px; height: 100px" 
                                                            src="/{{ $detail->product->image_path }}" 
                                                            alt="Product Image">
                                                        <div class="card-body col-sm-12 col-md-4">
                                                            <p class="card-text"> نام: {{ $detail->product->name }} </p>
                                                            @if ($detail->discount != 0)
                                                                <p class="card-text d-inline-block">تخفیف:
                                                                <p class="d-inline-block bg-danger mx-1 p-1 rounded">
                                                                    {{ $detail->discount }} درصد
                                                                </p>
                                                                </p>
                                                            @endif

                                                            <p class="card-text">تعداد: {{ $detail->quantity }}</p>

                                                            <div class="card-text d-flex">
                                                                <p class="">قیمت: </p>
                                                                @if ($detail->discount > 0)
                                                                    <p class="d-inline-block mx-1">
                                                                        <s class="mr-2 d-inline-block">{{ number_format($detail->price) }}
                                                                            تومان</s>
                                                                    </p>
                                                                    <p class="d-inline-block">
                                                                        {{ number_format($detail->price - ($detail->price * $detail->discount) / 100) }}
                                                                        &nbsp;تومان
                                                                    </p>
                                                                @else
                                                                    <p class="d-inline-block mx-1">
                                                                        {{ number_format($detail->price) }}
                                                                    </p>
                                                                    <p class="d-inline-block">تومان</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>

                                <!-- صفحه‌بندی -->
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $orders->appends(['status' => 'shipped'])->links() }}
                                </div>
                            </div>
                        </div>

                        <!-- تب سفارشات تحویل شده -->
                        <div class="tab-pane fade {{ request('status') == 'delivered' ? 'show active' : '' }}" 
                            id="delivered" role="tabpanel" aria-labelledby="delivered-tab">
                            <div class="container my-5 mx-2">
                                <div class="row">
                                    @if ($orders->isEmpty())
                                        <p class="text-white"> <mak>شما هیچ سفارش تحویل داده شده ندارید.</mak></p>
                                    @endif

                                    @foreach ($orders as $order)
                                        <div class="w-100 product-border p-3 mt-3 text-white border-white">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5>شماره سفارش: {{ $order->id }}</h5>
                                                @if ($order->status == 'delivered' && $order->updated_at->gt(now()->subWeek()))
                                                    <a href="{{ route('user.return.form', $order->id) }}" 
                                                        class="btn btn-warning">
                                                        ثبت درخواست مرجوعی
                                                    </a>
                                                @endif
                                            </div>
                                            <p>تاریخ سفارش:
                                                {{ \Morilog\Jalali\Jalalian::fromDateTime($order->updated_at)->format('H:i Y/m/d') }}
                                            </p>
                                            <p>وضعیت سفارش:
                                                <span class="{{ $statusColors[$order->status] ?? 'badge bg-secondary' }} p-2">
                                                    {{ $statusLabels[$order->status] ?? 'نامشخص' }}
                                                </span>
                                            </p>

                                            <p>جمع کل: {{ optional(value: $order->payment)->amount ? number_format(optional($order->payment)->amount) : 'بدون پرداخت' }} تومان</p>

                                            <h6 class="mt-3">جزئیات محصولات:</h6>
                                            @foreach ($order->order_detail as $detail)
                                                <div class="product-border p-2 mt-2 border-secondary">
                                                    <div class="d-flex">
                                                        <img class="card-img-top rounded" 
                                                            style="width: 100px; height: 100px" 
                                                            src="/{{ $detail->product->image_path }}" 
                                                            alt="Product Image">
                                                        <div class="card-body col-sm-12 col-md-4">
                                                          @if ($order->status!='delivered')
                                                          <p class="card-text"> وضعیت: <span class="{{ $statusColors[$detail->status] ?? 'badge bg-secondary' }} p-2">
                                                            {{ $statusLabels[$detail->status] ?? 'نامشخص' }}
                                                        </span> </p>
                                                          @endif
                                                         
                                                            <p class="card-text"> نام: {{ $detail->product->name }} </p>
                                                            @if ($detail->discount != 0)
                                                                <p class="card-text d-inline-block">تخفیف:
                                                                <p class="d-inline-block bg-danger mx-1 p-1 rounded">
                                                                    {{ $detail->discount }} درصد
                                                                </p>
                                                                </p>
                                                            @endif
                                                            <p class="card-text">تعداد: {{ $detail->quantity }}</p>
                                                            <div class="card-text d-flex">
                                                                <p class="">قیمت: </p>
                                                                @if ($detail->discount > 0)
                                                                    <p class="d-inline-block mx-1">
                                                                        <s class="mr-2 d-inline-block">{{ number_format($detail->price) }}
                                                                            تومان</s>
                                                                    </p>
                                                                    <p class="d-inline-block">
                                                                        {{ number_format($detail->price - ($detail->price * $detail->discount) / 100) }}
                                                                        &nbsp;تومان
                                                                    </p>
                                                                @else
                                                                    <p class="d-inline-block mx-1">
                                                                        {{ number_format($detail->price) }}
                                                                    </p>
                                                                    <p class="d-inline-block">تومان</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex  align-items-center justify-content-around mt-3 ">
                                                        <div class="d-flex align-items-center">
                                                            <p class="card-text">امتیاز دهید:</p>
                                                            <div class="custom-icone ">
                                                                <div class="d-flex align-items-center stars-container"
                                                                    data-product-id="{{ $detail->product_id }}"
                                                                    style="cursor: pointer">
                                                                    @for ($i = 5; $i >= 1; $i--)
                                                                        <div class="d-flex flex-column align-items-center">
                                                                            <span class="material-symbols-outlined star mat"
                                                                                data-star="{{ $i }}">star_border</span>
                                                                            <p>{{ $i }}</p>
                                                                        </div>
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a href="{{ url('/products/' . $detail->product_id . '/single#comment') }}">
                                                            <button type="button" class="btn btn-primary d-flex">
                                                                <span class="material-symbols-outlined">chat_bubble</span>
                                                                <p >ثبت دیدگاه</p>
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>

                                <!-- صفحه‌بندی -->
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $orders->appends(['status' => 'delivered'])->links() }}
                                </div>
                            </div>
                        </div>

                        <!-- تب سفارشات مرجوع شده -->
                        <div class="tab-pane fade {{ request('status') == 'returned' ? 'show active' : '' }}" 
                            id="returned" role="tabpanel" aria-labelledby="returned-tab">
                            <div class="container my-5 mx-2">
                                <div class="row">
                                    @if ($orders->isEmpty())
                                        <p class="text-white"><mak> شما هیچ سفارش مرجوع شده ندارید.</mak></p>
                                    @endif

                                    @foreach ($orders as $order)
                                        <div class="w-100 product-border p-3 mt-3 text-white border-white">
                                            <h5>شماره سفارش: {{ $order->id }}</h5>
                                            <p>تاریخ سفارش:
                                                {{ \Morilog\Jalali\Jalalian::fromDateTime($order->created_at)->format('H:i Y/m/d') }}
                                            </p>

                                            <p>وضعیت سفارش:
                                                <span class="{{ $statusColors[$order->status] ?? 'badge bg-secondary' }} p-2">
                                                    {{ $statusLabels[$order->status] ?? 'نامشخص' }}
                                                </span>
                                            </p>

                                            <p>جمع کل: {{ optional(value: $order->payment)->amount ? number_format(optional($order->payment)->amount) : 'بدون پرداخت' }} تومان</p>

                                            <h6 class="mt-3">جزئیات محصولات:</h6>

                                            @foreach ($order->order_detail as $detail)
                                                <div class="product-border p-2 mt-2 border-secondary">
                                                    <div class="d-flex">
                                                        <img class="card-img-top rounded" 
                                                            style="width: 100px; height: 100px" 
                                                            src="/{{ $detail->product->image_path }}" 
                                                            alt="Product Image">
                                                        <div class="card-body col-sm-12 col-md-4">
                                                            <p class="card-text"> نام: {{ $detail->product->name }} </p>
                                                            @if ($detail->discount != 0)
                                                                <p class="card-text d-inline-block">تخفیف:
                                                                <p class="d-inline-block bg-danger mx-1 p-1 rounded">
                                                                    {{ $detail->discount }} درصد
                                                                </p>
                                                                </p>
                                                            @endif

                                                            <p class="card-text">تعداد: {{ $detail->quantity }}</p>

                                                            <div class="card-text d-flex">
                                                                <p class="">قیمت: </p>
                                                                @if ($detail->discount > 0)
                                                                    <p class="d-inline-block mx-1">
                                                                        <s class="mr-2 d-inline-block">{{ number_format($detail->price) }}
                                                                            تومان</s>
                                                                    </p>
                                                                    <p class="d-inline-block">
                                                                        {{ number_format($detail->price - ($detail->price * $detail->discount) / 100) }}
                                                                        &nbsp;تومان
                                                                    </p>
                                                                @else
                                                                    <p class="d-inline-block mx-1">
                                                                        {{ number_format($detail->price) }}
                                                                    </p>
                                                                    <p class="d-inline-block">تومان</p>
                                                                @endif
                                                            </div>
                                                            <p>وضعیت:
                                                                <span class="{{ $statusColors[$detail->status] ?? 'badge bg-secondary' }} p-2">
                                                                    {{ $statusLabels[$detail->status] ?? 'نامشخص' }}
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex align-items-center justify-content-around mt-3">
                                                        <div class="d-flex align-items-center">
                                                            <p class="card-text">امتیاز دهید:</p>
                                                            <div class="custom-icone ">
                                                                <div class="d-flex align-items-center stars-container"
                                                                    data-product-id="{{ $detail->product_id }}"
                                                                    style="cursor: pointer">
                                                                    @for ($i = 5; $i >= 1; $i--)
                                                                        <div class="d-flex flex-column align-items-center">
                                                                            <span class="material-symbols-outlined star mat"
                                                                                data-star="{{ $i }}">star_border</span>
                                                                            <p>{{ $i }}</p>
                                                                        </div>
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <a href="{{ url('/products/' . $detail->product_id . '/single#comment') }}">
                                                            <button type="button" class="btn btn-primary d-flex">
                                                                <span class="material-symbols-outlined">chat_bubble</span>
                                                                <p >ثبت دیدگاه</p>
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>

                                <!-- صفحه‌بندی -->
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $orders->appends(['status' => 'returned'])->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- @else
                    <p class="text-white"><mak> شما هیچ سفارش ثبت‌ شده‌ای ندارید.</mak></p>
                @endif --}}
            </div>
        </div>
    </div>
@endsection