@extends('layouts.frontend.master')

@section('content')
    <div class="container custom-container mt-5">
        <h2 class="text-white">لیست سفارشات شما</h2>

        @if (!$orders->isEmpty())
            @foreach ($orders as $order)
                <div class="w-100 product-border p-3 mt-3 text-white  border-white">
                    <h5>شماره سفارش: {{ $order->id }}</h5>
                    <p>تاریخ سفارش: {{ \Morilog\Jalali\Jalalian::fromDateTime($order->created_at)->format('Y/m/d') }}</p>
                    <p>وضعیت سفارش: {{ $order->status }}</p>
                    <p>جمع کل: {{ $order->total }} تومان</p>

                    <h6 class="mt-3">جزئیات محصولات:</h6>

                    @foreach ($order->order_detail as $detail)

                        <div class="  product-border p-2 mt-2 border-secondary  ">

                            <div class="d-flex">
                                <img class="card-img-top  rounded" style="width: 100px;height: 100px "
                                    src="/{{ $detail->product->image_path }}" alt="Product Image">
                                <div class="card-body col-sm-12 col-md-4">
                                    <p class="card-text"> نام: {{ $detail->product->name }} </p>
                                    @if($detail->discount != 0)
                                        <p class="card-text">تخفیف: {{ $detail->discount }} درصد</p>
                                    @endif

                                    <p class="card-text">تعداد: {{ $detail->quantity }}</p>
                                    <p class="card-text">قیمت واحد: {{ $detail->price }} تومان</p>

                                </div>
                            </div>




                            <div class="d-flex align-items-center justify-content-around mt-3 ">
                               <div class="d-flex align-items-center">
                                 <p class="card-text ">امتیاز دهید:</p>
                                <div class="custom-icone mx-1">
                                    <div class="d-flex align-items-center  stars-container" data-product-id="{{ $detail->product_id  }}" style="cursor: pointer">
                                        @for ($i = 5; $i >= 1; $i--)
                                               <div class="d-flex flex-column align-items-center">
                                                <span class="material-symbols-outlined star" data-star="{{ $i }}">star_border</span>
                                                <p>{{ $i }}</p>
                                               </div>
                                        @endfor
                                    </div>


                                </div>
                               </div>
                               
                                 <button  type="button" class="btn btn-danger d-flex "><span class="material-symbols-outlined">
                                    chat_bubble
                                </span> <p class="mx-1">ثبت دیدگاه</p>  </button>
                               
                            </div>

                        </div>



                    @endforeach

                </div>
            @endforeach
        @else
            <p class="text-white">شما هیچ سفارش ثبت‌شده‌ای ندارید.</p>
        @endif
    </div>
@endsection