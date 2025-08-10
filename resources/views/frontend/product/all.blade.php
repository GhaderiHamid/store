@extends('layouts.frontend.master')

@section('content')

<title>  فروشگاه اینترنتی - انتخاب محصول </title>
    <!-- start offer nav -->
    <section class="container mt-5 custom-container">
      
        @if(request()->filled('category_id'))
    <div class="card shadow-sm rounded mb-4 p-3">
        <form method="GET" action="{{ route('frontend.product.all') }}">
            <input type="hidden" name="category_id" value="{{ request('category_id') }}">
            <div class="row g-3 align-items-end">
                <!-- مرتب‌سازی -->
                <div class="col-md-3">
                    <label for="sort" class="form-label">مرتب‌سازی:</label>
                    <select name="sort" id="sort" class="form-select">
                        <option value="">انتخاب معیار</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>ارزان‌ترین</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>گران‌ترین</option>
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>جدیدترین</option>
                    </select>
                </div>

                <!-- فیلتر قیمت -->
                <div class="col-md-3">
                    <label for="min_price" class="form-label">حداقل قیمت:</label>
                    <input type="number" min="0" name="min_price" id="min_price" class="form-control" value="{{ request('min_price') }}" placeholder="مثلاً 1000000">
                </div>
                <div class="col-md-3">
                    <label for="max_price" class="form-label">حداکثر قیمت:</label>
                    <input type="number" min="0" name="max_price" id="max_price" class="form-control" value="{{ request('max_price') }}" placeholder="مثلاً 5000000">
                </div>

                <!-- محصولات موجود -->
                <div class="col-md-2 mb-1 ">
                    <div class="form-check pl-3">
                        <input class="form-check-input  " type="checkbox" name="in_stock" value="1" id="in_stock" {{ request('in_stock') ? 'checked' : '' }}>
                        <label class="form-check-label pl-1" for="in_stock">فقط موجودها</label>
                    </div>
                </div>

                <!-- دکمه فیلتر -->
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary w-100">اعمال</button>
                </div>
            </div>
        </form>
    </div>
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
                                    <button class="price-btn mt-4 d-inline-block add-to-cart-btn" 
                                        data-product-id="{{ $product->id }}"
                                        data-limited="{{ $product->limited }}" 
                                        data-cart-quantity="{{ session('cart.'.$product->id, 0) }}"
                                        data-product-quantity="{{ $product->quntity }}">
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
        <div class="d-flex justify-content-center mt-5">
            {{ $products->links() }}
            </div>
    </section>

    <!-- end offer nav -->
@endsection