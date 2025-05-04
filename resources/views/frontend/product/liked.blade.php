@extends('layouts.frontend.master')

@section('content')
    <section class="container mt-5 custom-container">
        <h5 class="custom-font mb-3">محصولات لایک شده:</h5>
        <div class="row">
            @foreach ($likedProducts as $product)
                <div class="col-sm-12 col-md-6 col-lg-3 position-relative">

                    <div id="offer-expire-text" class="position-absolute mt-5"></div>
                    <div id="offer-blur">
                        <div class="card d-flex flex-column align-items-center mt-5 custom-card">
                            <a href="{{ route('frontend.product.single', $product->id) }}">
                                <img class="card-img-top" src="/{{ $product->image_path }}" alt="Card image cap" />
                            </a>
                            <div class="card-body custom-card-body text-center w-100">
                                <p class="card-text custom-card-text">
                                    <button class="btn btn-danger btn-sm remove-liked-product mr-2" data-product-id="{{ $product->id }}" >
                                        <span class="material-symbols-outlined">
                                            delete
                                        </span>
                                    </button>
                                    {{ $product->name }}
                                </p>

                                <!-- شرط برای نمایش تخفیف -->
                                @if($product->discount > 0)
                                    <p class="mt-4 d-flex justify-content-center align-items-center">
                                        <s class="mr-2 ">{{ $product->price }} تومان</s>
                                        <span class="d-flex align-items-center badge badge-pill badge-danger mt-1"
                                            style="width: 38px ;height: 35px">
                                            {{ $product->discount }} %
                                        </span>
                                    </p>
                                    <p class="mt-4 d-flex justify-content-center align-items-center">
                                        {{ $product->price - ($product->price * $product->discount / 100) }} &nbsp;   تومان  
                                    </p>
                                @else
                                    <!-- نمایش قیمت اصلی اگر تخفیف وجود نداشته باشد -->
                                    <p class="mt-4 d-flex justify-content-center align-items-center">
                                        {{ $product->price }}
                                    </p>
                                    <p class="mt-4 d-flex justify-content-center align-items-center">
                                        تومان 
                                    </p>

                                @endif




                                {{-- <a href="{{ route('frontend.cart.add', $product->id) }}" class="align-items-center"> --}}
                                    <a href="{{ route('basket.add', $product->id) }}" class="align-items-center">

                                        <div class="price-btn mt-4 d-inline-block">افزودن به سبد خرید</div>
                                    </a>

                                    <!-- اگر کاربر لاگین نکرده -->
                                    <div class="price-btn mt-4 d-inline-block">
                                        افزودن به سبد خرید
                                    </div>





                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </section>

    
@endsection