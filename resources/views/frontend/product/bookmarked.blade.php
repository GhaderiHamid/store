@extends('layouts.frontend.master')

@section('content')
<title> محصولات ذخیره شده  </title>
    <section class="container mt-5 custom-container">
        <h5 class="custom-font mb-3">محصولات ذخیره شده:</h5>
        <div class="row">
            @if (!$bookmarkedProducts->isEmpty())
            @foreach ($bookmarkedProducts as $product)
                <div class="col-sm-12 col-md-6 col-lg-3 position-relative">

                    <div id="offer-expire-text" class="position-absolute mt-5"></div>
                    <div id="offer-blur">
                        <div class="card d-flex flex-column align-items-center mt-5 custom-card">
                            <a href="{{ route('frontend.product.single', $product->id) }}">
                                <img class="card-img-top" src="/{{ $product->image_path }}" alt="Card image cap" />
                            </a>
                            <div class="card-body custom-card-body text-center w-100">
                                <p class="card-text custom-card-text">

                                    {{ $product->name }}

                                </p>

                                <!-- شرط برای نمایش تخفیف -->
                                @if ($product->discount > 0)
                                    <p class=" d-flex justify-content-center align-items-center">
                                        <s class="mr-2 ">{{ number_format($product->price) }} تومان</s>
                                        <span class="d-flex align-items-center badge badge-pill badge-danger mt-1"
                                            style="width: 38px ;height: 35px">
                                            {{ $product->discount }} %
                                        </span>
                                    </p>
                                    <p class=" d-flex justify-content-center align-items-center">
                                        {{ number_format($product->price - ($product->price * $product->discount) / 100) }} &nbsp; تومان
                                    </p>
                                @else
                                    <!-- نمایش قیمت اصلی اگر تخفیف وجود نداشته باشد -->
                                    <p class="mt-2 d-flex justify-content-center align-items-center">
                                        {{ number_format($product->price) }}
                                    </p>
                                    <p class="mt-2 d-flex justify-content-center align-items-center">
                                        تومان

                                    </p>
                                @endif
                                <button
                                    class="btn d-inline-flex align-items-center btn-danger btn-sm remove-bookmarked-product mt-4"
                                    data-product-id="{{ $product->id }}">

                                    <span class="material-symbols-outlined">
                                        delete
                                    </span>
                                    <p><mak2> حذف از لیست </mak2></p>
                                </button>


                                @if ($product->quntity == 0)
                                    <p class="text-secondary lead mt-3">ناموجود</p>
                                @else
                                    {{-- <a href="{{ route('frontend.cart.add', $product->id) }}" class="align-items-center"> --}}
                                        <button class="price-btn mt-4 d-inline-block add-to-cart-btn" 
                                        data-product-id="{{ $product->id }}"
                                        data-limited="{{ $product->limited }}" 
                                        data-cart-quantity="{{ session('cart.'.$product->id, 0) }}"
                                        data-product-quantity="{{ $product->quntity }}">
                                        افزودن به سبد خرید
                                    </button>
                                @endif





                            </div>
                            @if($product->quntity <= 3 && $product->quntity > 0)
                                <div class="w-100 bg-warning   d-flex align-items-center justify-content-center">
                                    <div class="badge-danger rounded-circle mr-2 d-flex align-items-center justify-content-center "
                                        style="width: 20px;height: 20px;">
                                        {{-- <span class="material-symbols-outlined" style="font-size: 20px">warning</span> --}}
                                        !
                                    </div>

                                    <span>تنها {{ $product->quntity }} عدد در انبار باقی مانده</span>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            @endforeach
            @else
            <p class="text-white"><mak> شما هیچ محصولی ذخیره نکرده‌اید.</mak></p>
        @endif
        </div>
    </section>
@endsection
