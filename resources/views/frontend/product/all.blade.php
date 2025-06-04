@extends('layouts.frontend.master')

@section('content')
    <!-- start offer nav -->
    <section class="container mt-5 custom-container">
        @if(request()->filled('category_id'))
        <h5 class="custom-font mb-3">
            مرتب‌سازی محصولات:
        </h5>
        <div class="input-group">
            <select id="sortSelect" class="form-select mr-1 rounded">
                <option value="">انتخاب معیار</option>
                <option value="{{ route('frontend.product.all', ['category_id' => request('category_id'), 'sort' => 'price_asc']) }}">ارزان‌ترین</option>
                <option value="{{ route('frontend.product.all', ['category_id' => request('category_id'), 'sort' => 'price_desc']) }}">گران‌ترین</option>
                <option value="{{ route('frontend.product.all', ['category_id' => request('category_id'), 'sort' => 'newest']) }}">جدیدترین</option>
                <option value="{{ route('frontend.product.all', array_merge(request()->only('category_id', 'sort'), ['in_stock' => 1])) }}"
                    {{ request('in_stock') ? 'selected' : '' }}>محصولات موجود</option>
            </select>
            <button type="button" id="sortButton" class="btn btn-primary">مرتب کن</button>
        </div>
        <hr>
        @endif
        @include('errors.message')
        <div class="row">
            @foreach ($products as $product)
                <div class="col-sm-12 col-md-6 col-lg-3 position-relative">

                    <div id="offer-expire-text" class="position-absolute mt-5"></div>
                    <div id="offer-blur">
                        <div class="card d-flex flex-column align-items-center mt-5 custom-card">
                            <a href="{{ route('frontend.product.single', $product->id) }}">
                                <img class="card-img-top" src="/{{ $product->image_path }}" alt="Card image cap" />
                            </a>
                            <div class="card-body custom-card-body text-center w-100">
                                <p class="card-text custom-card-text">{{ $product->name }}</p>

                                <!-- شرط برای نمایش تخفیف -->
                                @if($product->discount > 0)
                                    <p class="mt-4 d-flex justify-content-center align-items-center">
                                        <s class="mr-2 ">{{ number_format($product->price) }} تومان</s>
                                        <span class="d-flex align-items-center badge badge-pill badge-danger mt-1"
                                            style="width: 38px ;height: 35px">
                                            {{ $product->discount }} %
                                        </span>
                                    </p>
                                    <p class="mt-4 d-flex justify-content-center align-items-center">
                                        {{ number_format($product->price - ($product->price * $product->discount / 100)) }} &nbsp; تومان
                                    </p>
                                @else
                                    <!-- نمایش قیمت اصلی اگر تخفیف وجود نداشته باشد -->
                                    <p class="mt-4 d-flex justify-content-center align-items-center">
                                        {{ number_format($product->price) }}
                                    </p>
                                    <p class="mt-4 d-flex justify-content-center align-items-center">
                                        تومان
                                    </p>
                                @endif

                                <!-- شرط برای نمایش موجودی -->
                                @if($product->quntity == 0)
                                    <p class="text-secondary lead mt-3"> نا موجود</p>
                                @else
                                    <!-- شرط برای دکمه افزودن به سبد خرید -->
                                    @auth
                                        <!-- اگر کاربر لاگین کرده -->
                                        <button class="price-btn mt-4 d-inline-block add-to-cart-btn" data-product-id="{{ $product->id }}"
                                            data-limited="{{ $product->limited }}" data-cart-quantity="{{ $product->cart_quantity ?? 0 }}">
                                            افزودن به سبد خرید
                                        </button>
                                    @else
                                        <!-- اگر کاربر لاگین نکرده -->
                                        <div class="price-btn mt-4 d-inline-block"
                                            onclick="alert('لطفاً وارد حساب کاربری خود شوید!')">افزودن به سبد خرید</div>
                                    @endauth
                                @endif



                            </div>
                            @if($product->quntity <= 3 && $product->quntity > 0)
                                <div class="w-100 bg-warning   d-flex align-items-center justify-content-center" >
                                    <div class="badge-danger rounded-circle mr-2 d-flex align-items-center justify-content-center " style="width: 20px;height: 20px;">
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
        </div>

    </section>
    <div class="d-flex justify-content-center mt-5">
        {{ $products->links() }}
    </div>
    <!-- end offer nav -->
@endsection