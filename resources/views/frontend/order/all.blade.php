@extends('layouts.frontend.master')

@section('content')
                    @php
    $statusColors = [
        'processing' => 'badge bg-warning',
        'shipped' => 'badge bg-primary',
        'delivered' => 'badge bg-success',
        'returned' => 'badge bg-danger',
    ];
                    @endphp
                    <div class="container custom-container mt-5">
                        <h2 class="text-white">لیست سفارشات شما</h2>
                        <div class="row mt-5">
                            <div class="col-sm-12 ">
                                @if (!$orders->isEmpty())
                                        <ul class="nav nav-tabs custom-nav-tabs-product-page justify-content-center rounded-pill bg-dark p-2 shadow-lg"
                                        id="myTab" role="tablist">
                                        <li class="nav-item m-1">
                                            <a class="nav-link active text-white d-flex align-items-center px-4 py-2 rounded-pill fw-bold bg-warning"
                                                id="processing-tab" data-toggle="tab" href="#processing" role="tab" aria-controls="processing"
                                                aria-selected="true" style="transition: all 0.3s ease-in-out;">
                                                <span class="material-symbols-outlined me-2 text-white">autorenew</span>
                                                در حال پردازش
                                            </a>
                                        </li>
                                        <li class="nav-item m-1">
                                            <a class="nav-link text-white d-flex align-items-center px-4 py-2 rounded-pill fw-bold bg-primary shadow-sm"
                                                id="shipped-tab" data-toggle="tab" href="#shipped" role="tab" aria-controls="shipped" aria-selected="false">
                                                <span class="material-symbols-outlined me-2 text-white">local_shipping</span>
                                                ارسال شده
                                            </a>
                                        </li>
                                        <li class="nav-item m-1">
                                            <a class="nav-link d-flex align-items-center px-4 py-2 rounded-pill fw-bold bg-success text-white"
                                                id="delivered-tab" data-toggle="tab" href="#delivered" role="tab" aria-controls="delivered"
                                                aria-selected="false">
                                                <span class="material-symbols-outlined me-2">check_circle</span>
                                                تحویل شده
                                            </a>
                                        </li>
                                        <li class="nav-item m-1">
                                            <a class="nav-link d-flex align-items-center px-4 py-2 rounded-pill fw-bold bg-danger text-white"
                                                id="returned-tab" data-toggle="tab" href="#returned" role="tab" aria-controls="returned"
                                                aria-selected="false">
                                                <span class="material-symbols-outlined me-2">undo</span>
                                                مرجوع شده
                                            </a>
                                        </li>
                                    </ul>
                                            <div class="tab-content" id="myTabContent">


                                                <div class="tab-pane fade show active" id="processing" role="tabpanel"
                                                    aria-labelledby="processing-tab">
                                                    <div class="container my-5 mx-2">
                                                        <div class="row">
                                                            @if ($orders->where('status', 'processing')->isEmpty())
                                                                <p class="text-white">شما هیچ سفارش در حال پردازش ندارید.</p>
                                                            @endif


                                                            @foreach ($orders as $order)
                                                                @if ($order->status == 'processing')
                                                                    <div class="w-100 product-border p-3 mt-3 text-white  border-white">
                                                                        <h5>شماره سفارش: {{ $order->id }}</h5>
                                                                        <p>تاریخ سفارش:
                                                                            {{ \Morilog\Jalali\Jalalian::fromDateTime($order->created_at)->format('H:i Y/m/d ') }}
                                                                        </p>


                                                                        <p>وضعیت سفارش:
                                                                            <span
                                                                                class="{{ $statusColors[$order->status] ?? 'badge bg-secondary' }} p-2 ">
                                                                                {{ $statusLabels[$order->status] ?? 'نامشخص' }}
                                                                            </span>
                                                                        </p>

                                                                        <p>جمع کل: {{ number_format($order->payment->amount) }} تومان</p>

                                                                        <h6 class="mt-3">جزئیات محصولات:</h6>

                                                                        @foreach ($order->order_detail as $detail)
                                                                            <div class="  product-border p-2 mt-2 border-secondary  ">

                                                                                <div class="d-flex">
                                                                                    <img class="card-img-top  rounded"
                                                                                        style="width: 100px;height: 100px "
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

                                                                                        <div class="card-text d-flex ">


                                                                                            <p class="">قیمت: </p>
                                                                                            @if ($detail->discount > 0)
                                                                                                <p class=" d-inline-block mx-1">
                                                                                                    <s class="mr-2 d-inline-block">{{ number_format($detail->price) }}
                                                                                                        تومان</s>

                                                                                                </p>
                                                                                                <p class="d-inline-block  ">
                                                                                                    {{ number_format($detail->price - ($detail->price * $detail->discount) / 100) }}
                                                                                                    &nbsp;
                                                                                                    تومان
                                                                                                </p>
                                                                                            @else
                                                                                                <!-- نمایش قیمت اصلی اگر تخفیف وجود نداشته باشد -->
                                                                                                <p class=" d-inline-block mx-1">
                                                                                                    {{ number_format($detail->price) }}
                                                                                                </p>
                                                                                                <p class=" d-inline-block ">
                                                                                                    تومان
                                                                                                </p>
                                                                                            @endif

                                                                                        </div>
                                                                                        {{-- <p>وضعیت:
                                                                                            <span
                                                                                                class="{{ $statusColors[$detail->status] ?? 'badge bg-secondary' }} p-2 ">
                                                                                                {{ $statusLabels[$detail->status] ?? 'نامشخص' }}
                                                                                            </span>
                                                                                        </p> --}}
                                                                                    </div>
                                                                                </div>




                                                                                

                                                                            </div>
                                                                        @endforeach

                                                                    </div>
                                                                @endif
                                                            @endforeach


                                                        </div>




                                                    </div>

                                                </div>
                                                <div class="tab-pane fade show " id="shipped" role="tabpanel" aria-labelledby="shipped-tab">
                                                    <div class="container my-5 mx-2">
                                                        <div class="row">
                                                            @if ($orders->where('status', 'shipped')->isEmpty())
                                                                <p class="text-white">شما هیچ سفارش در حال ارسال ندارید.</p>
                                                            @endif
                                                            @foreach ($orders as $order)
                                                                @if ($order->status == 'shipped')
                                                                    <div class="w-100 product-border p-3 mt-3 text-white  border-white">
                                                                        <h5>شماره سفارش: {{ $order->id }}</h5>
                                                                        <p>تاریخ سفارش:
                                                                            {{ \Morilog\Jalali\Jalalian::fromDateTime($order->created_at)->format('H:i Y/m/d ') }}
                                                                        </p>


                                                                        <p>وضعیت سفارش:
                                                                            <span
                                                                                class="{{ $statusColors[$order->status] ?? 'badge bg-secondary' }} p-2 ">
                                                                                {{ $statusLabels[$order->status] ?? 'نامشخص' }}
                                                                            </span>
                                                                        </p>

                                                                        <p>جمع کل: {{ number_format($order->payment->amount) }} تومان</p>

                                                                        <h6 class="mt-3">جزئیات محصولات:</h6>

                                                                        @foreach ($order->order_detail as $detail)
                                                                            <div class="  product-border p-2 mt-2 border-secondary  ">

                                                                                <div class="d-flex">
                                                                                    <img class="card-img-top  rounded"
                                                                                        style="width: 100px;height: 100px "
                                                                                        src="/{{ $detail->product->image_path }}"
                                                                                        alt="Product Image">
                                                                                    <div class="card-body col-sm-12 col-md-4">
                                                                                        <p class="card-text"> نام: {{ $detail->product->name }}
                                                                                        </p>
                                                                                        @if ($detail->discount != 0)
                                                                                            <p class="card-text d-inline-block">تخفیف:
                                                                                            <p class="d-inline-block bg-danger mx-1 p-1 rounded">
                                                                                                {{ $detail->discount }} درصد
                                                                                            </p>
                                                                                            </p>
                                                                                        @endif

                                                                                        <p class="card-text">تعداد: {{ $detail->quantity }}</p>

                                                                                        <div class="card-text d-flex ">


                                                                                            <p class="">قیمت: </p>
                                                                                            @if ($detail->discount > 0)
                                                                                                <p class=" d-inline-block mx-1">
                                                                                                    <s class="mr-2 d-inline-block">{{ number_format($detail->price) }}
                                                                                                        تومان</s>

                                                                                                </p>
                                                                                                <p class="d-inline-block  ">
                                                                                                    {{ number_format($detail->price - ($detail->price * $detail->discount) / 100) }}
                                                                                                    &nbsp;
                                                                                                    تومان
                                                                                                </p>
                                                                                            @else
                                                                                                <!-- نمایش قیمت اصلی اگر تخفیف وجود نداشته باشد -->
                                                                                                <p class=" d-inline-block mx-1">
                                                                                                    {{ number_format($detail->price) }}
                                                                                                </p>
                                                                                                <p class=" d-inline-block ">
                                                                                                    تومان
                                                                                                </p>
                                                                                            @endif

                                                                                        </div>
                                                                                        {{-- <p>وضعیت:
                                                                                            <span
                                                                                                class="{{ $statusColors[$detail->status] ?? 'badge bg-secondary' }} p-2 ">
                                                                                                {{ $statusLabels[$detail->status] ?? 'نامشخص' }}
                                                                                            </span>
                                                                                        </p> --}}
                                                                                    </div>
                                                                                </div>




                     
                                                                            </div>
                                                                        @endforeach

                                                                    </div>
                                                                @endif
                                                            @endforeach


                                                        </div>




                                                    </div>

                                                </div>
                                                <div class="tab-pane fade show " id="delivered" role="tabpanel" aria-labelledby="delivered-tab">
                                                    <div class="container my-5 mx-2">
                                                        <div class="row">
                                                            @if ($orders->where('status', 'delivered')->isEmpty())
                                                                <p class="text-white">شما هیچ سفارش تحویل داده شده ندارید.</p>
                                                            @endif
                                                            @foreach ($orders as $order)
                                                                @if ($order->status == 'delivered')
                                                                    <div class="w-100 product-border p-3 mt-3 text-white  border-white">
                                                                        <h5>شماره سفارش: {{ $order->id }}</h5>
                                                                        <p>تاریخ سفارش:
                                                                            {{ \Morilog\Jalali\Jalalian::fromDateTime($order->created_at)->format('H:i Y/m/d ') }}
                                                                        </p>


                                                                        <p>وضعیت سفارش:
                                                                            <span
                                                                                class="{{ $statusColors[$order->status] ?? 'badge bg-secondary' }} p-2 ">
                                                                                {{ $statusLabels[$order->status] ?? 'نامشخص' }}
                                                                            </span>
                                                                        </p>

                                                                        <p>جمع کل: {{ number_format($order->payment->amount) }} تومان</p>

                                                                        <h6 class="mt-3">جزئیات محصولات:</h6>

                                                                        @foreach ($order->order_detail as $detail)
                                                                            <div class="  product-border p-2 mt-2 border-secondary  ">

                                                                                <div class="d-flex">
                                                                                    <img class="card-img-top  rounded"
                                                                                        style="width: 100px;height: 100px "
                                                                                        src="/{{ $detail->product->image_path }}"
                                                                                        alt="Product Image">
                                                                                    <div class="card-body col-sm-12 col-md-4">
                                                                                        <p class="card-text"> نام: {{ $detail->product->name }}
                                                                                        </p>
                                                                                        @if ($detail->discount != 0)
                                                                                            <p class="card-text d-inline-block">تخفیف:
                                                                                            <p class="d-inline-block bg-danger mx-1 p-1 rounded">
                                                                                                {{ $detail->discount }} درصد
                                                                                            </p>
                                                                                            </p>
                                                                                        @endif

                                                                                        <p class="card-text">تعداد: {{ $detail->quantity }}</p>

                                                                                        <div class="card-text d-flex ">


                                                                                            <p class="">قیمت: </p>
                                                                                            @if ($detail->discount > 0)
                                                                                                <p class=" d-inline-block mx-1">
                                                                                                    <s class="mr-2 d-inline-block">{{ number_format($detail->price) }}
                                                                                                        تومان</s>

                                                                                                </p>
                                                                                                <p class="d-inline-block  ">
                                                                                                    {{ number_format($detail->price - ($detail->price * $detail->discount) / 100) }}
                                                                                                    &nbsp;
                                                                                                    تومان
                                                                                                </p>
                                                                                            @else
                                                                                                <!-- نمایش قیمت اصلی اگر تخفیف وجود نداشته باشد -->
                                                                                                <p class=" d-inline-block mx-1">
                                                                                                    {{ number_format($detail->price) }}
                                                                                                </p>
                                                                                                <p class=" d-inline-block ">
                                                                                                    تومان
                                                                                                </p>
                                                                                            @endif

                                                                                        </div>
                                                                                        {{-- <p>وضعیت:
                                                                                            <span
                                                                                                class="{{ $statusColors[$detail->status] ?? 'badge bg-secondary' }} p-2 ">
                                                                                                {{ $statusLabels[$detail->status] ?? 'نامشخص' }}
                                                                                            </span>
                                                                                        </p> --}}
                                                                                    </div>
                                                                                </div>




                                                                                <div
                                                                                    class="d-flex align-items-center justify-content-around mt-3 ">
                                                                                    <div class="d-flex align-items-center">
                                                                                        <p class="card-text ">امتیاز دهید:</p>
                                                                                        <div class="custom-icone mx-1">
                                                                                            <div class="d-flex align-items-center  stars-container"
                                                                                                data-product-id="{{ $detail->product_id }}"
                                                                                                style="cursor: pointer">
                                                                                                @for ($i = 5; $i >= 1; $i--)
                                                                                                    <div
                                                                                                        class="d-flex flex-column align-items-center">
                                                                                                        <span
                                                                                                            class="material-symbols-outlined star"
                                                                                                            data-star="{{ $i }}">star_border</span>
                                                                                                        <p>{{ $i }}</p>
                                                                                                    </div>
                                                                                                @endfor
                                                                                            </div>


                                                                                        </div>
                                                                                    </div>

                                                                                    <a
                                                                                        href="{{ url('/products/' . $detail->product_id . '/single#comment') }}">
                                                                                        <button type=" button" class="btn btn-primary d-flex">
                                                                                            <span
                                                                                                class="material-symbols-outlined">chat_bubble</span>
                                                                                            <p class="mx-1">ثبت دیدگاه</p>
                                                                                        </button>

                                                                                    </a>
                                                                                </div>

                                                                            </div>
                                                                        @endforeach

                                                                    </div>
                                                                @endif
                                                            @endforeach


                                                        </div>




                                                    </div>

                                                </div>
                                                <div class="tab-pane fade show " id="returned" role="tabpanel" aria-labelledby="returned-tab">
                                                    <div class="container my-5 mx-2">
                                                        <div class="row">
                                                            @if ($orders->where('status', 'returned')->isEmpty())
                                                                <p class="text-white">شما هیچ سفارش مرجوع شده ندارید.</p>
                                                            @endif
                                                            @foreach ($orders as $order)
                                                                @if ($order->status == 'returned')
                                                                    <div class="w-100 product-border p-3 mt-3 text-white  border-white">
                                                                        <h5>شماره سفارش: {{ $order->id }}</h5>
                                                                        <p>تاریخ سفارش:
                                                                            {{ \Morilog\Jalali\Jalalian::fromDateTime($order->created_at)->format('H:i Y/m/d ') }}
                                                                        </p>


                                                                        <p>وضعیت سفارش:
                                                                            <span
                                                                                class="{{ $statusColors[$order->status] ?? 'badge bg-secondary' }} p-2 ">
                                                                                {{ $statusLabels[$order->status] ?? 'نامشخص' }}
                                                                            </span>
                                                                        </p>

                                                                        <p>جمع کل: {{ number_format($order->payment->amount) }} تومان</p>

                                                                        <h6 class="mt-3">جزئیات محصولات:</h6>

                                                                        @foreach ($order->order_detail as $detail)
                                                                            <div class="  product-border p-2 mt-2 border-secondary  ">

                                                                                <div class="d-flex">
                                                                                    <img class="card-img-top  rounded"
                                                                                        style="width: 100px;height: 100px "
                                                                                        src="/{{ $detail->product->image_path }}"
                                                                                        alt="Product Image">
                                                                                    <div class="card-body col-sm-12 col-md-4">
                                                                                        <p class="card-text"> نام: {{ $detail->product->name }}
                                                                                        </p>
                                                                                        @if ($detail->discount != 0)
                                                                                            <p class="card-text d-inline-block">تخفیف:
                                                                                            <p class="d-inline-block bg-danger mx-1 p-1 rounded">
                                                                                                {{ $detail->discount }} درصد
                                                                                            </p>
                                                                                            </p>
                                                                                        @endif

                                                                                        <p class="card-text">تعداد: {{ $detail->quantity }}</p>

                                                                                        <div class="card-text d-flex ">


                                                                                            <p class="">قیمت: </p>
                                                                                            @if ($detail->discount > 0)
                                                                                                <p class=" d-inline-block mx-1">
                                                                                                    <s class="mr-2 d-inline-block">{{ number_format($detail->price) }}
                                                                                                        تومان</s>

                                                                                                </p>
                                                                                                <p class="d-inline-block  ">
                                                                                                    {{ number_format($detail->price - ($detail->price * $detail->discount) / 100) }}
                                                                                                    &nbsp;
                                                                                                    تومان
                                                                                                </p>
                                                                                            @else
                                                                                                <!-- نمایش قیمت اصلی اگر تخفیف وجود نداشته باشد -->
                                                                                                <p class=" d-inline-block mx-1">
                                                                                                    {{ number_format($detail->price) }}
                                                                                                </p>
                                                                                                <p class=" d-inline-block ">
                                                                                                    تومان
                                                                                                </p>
                                                                                            @endif

                                                                                        </div>
                                                                                        {{-- <p>وضعیت:
                                                                                            <span
                                                                                                class="{{ $statusColors[$detail->status] ?? 'badge bg-secondary' }} p-2 ">
                                                                                                {{ $statusLabels[$detail->status] ?? 'نامشخص' }}
                                                                                            </span>
                                                                                        </p> --}}
                                                                                    </div>
                                                                                </div>




                                                                                <div
                                                                                    class="d-flex align-items-center justify-content-around mt-3 ">
                                                                                    <div class="d-flex align-items-center">
                                                                                        <p class="card-text ">امتیاز دهید:</p>
                                                                                        <div class="custom-icone mx-1">
                                                                                            <div class="d-flex align-items-center  stars-container"
                                                                                                data-product-id="{{ $detail->product_id }}"
                                                                                                style="cursor: pointer">
                                                                                                @for ($i = 5; $i >= 1; $i--)
                                                                                                    <div
                                                                                                        class="d-flex flex-column align-items-center">
                                                                                                        <span
                                                                                                            class="material-symbols-outlined star"
                                                                                                            data-star="{{ $i }}">star_border</span>
                                                                                                        <p>{{ $i }}</p>
                                                                                                    </div>
                                                                                                @endfor
                                                                                            </div>


                                                                                        </div>
                                                                                    </div>

                                                                                    <a
                                                                                        href="{{ url('/products/' . $detail->product_id . '/single#comment') }}">
                                                                                        <button type=" button" class="btn btn-primary d-flex">
                                                                                            <span
                                                                                                class="material-symbols-outlined">chat_bubble</span>
                                                                                            <p class="mx-1">ثبت دیدگاه</p>
                                                                                        </button>

                                                                                    </a>
                                                                                </div>

                                                                            </div>
                                                                        @endforeach

                                                                    </div>
                                                                @endif
                                                            @break
                                                        @endforeach


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
@endsection
