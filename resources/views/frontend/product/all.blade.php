@extends('layouts.frontend.master')

@section('content')
    <!-- start offer nav -->
    <section class="container mt-5 custom-container">
        <h5 class="custom-font mb-3">
            مرتب‌سازی محصولات:

        </h5>
        <div class="input-group">
            <select id="sortSelect" class="form-select mr-1 rounded">
                <option value="">انتخاب معیار</option>
                <option value="{{ route('frontend.product.all', ['sort' => 'price_asc']) }}">ارزان‌ترین</option>
                <option value="{{ route('frontend.product.all', ['sort' => 'price_desc']) }}">گران‌ترین</option>
                <option value="{{ route('frontend.product.all', ['sort' => 'best_selling']) }}">پرفروش‌ترین</option>
                <option value="{{ route('frontend.product.all', ['sort' => 'newest']) }}">جدیدترین</option>
            </select>
            <button type="button" id="sortButton" class="btn btn-primary">مرتب کن</button>
        </div>
        <hr>
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
                                        <s class="mr-2 ">{{ $product->price }} تومان</s>
                                        <span class="d-flex align-items-center badge badge-pill badge-danger mt-1"
                                            style="width: 38px ;height: 35px">
                                            {{ $product->discount }} %
                                        </span>
                                    </p>
                                    <p class="mt-4 d-flex justify-content-center align-items-center">
                                        {{ $product->price - ($product->price * $product->discount / 100) }} &nbsp; تومان
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

                                <!-- شرط برای دکمه افزودن به سبد خرید -->
                                @auth
                                    <!-- اگر کاربر لاگین کرده -->
                                    <button 
                                        class="price-btn mt-4 d-inline-block add-to-cart-btn"
                                        data-product-id="{{ $product->id }}">
                                        افزودن به سبد خرید
                                    </button>
                                @else
                                    <!-- اگر کاربر لاگین نکرده -->
                                    <div class="price-btn mt-4 d-inline-block"
                                        onclick="alert('لطفاً وارد حساب کاربری خود شوید!')">افزودن به سبد خرید</div>
                                @endauth



                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

    </section>
    <div class="d-flex justify-content-center mt-5">
        {{ $products->links() }}
    </div>

    <script>
        document.getElementById('sortButton').addEventListener('click', function () {
            var sortValue = document.getElementById('sortSelect').value;
            if (sortValue) {
                window.location.href = sortValue;
            }
        });

        // افزودن به سبد خرید با AJAX
        document.querySelectorAll('.add-to-cart-btn').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                var productId = this.getAttribute('data-product-id');
                fetch("{{ route('frontend.cart.add.ajax') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name=\"csrf-token\"]').getAttribute('content')
                    },
                    body: JSON.stringify({ product_id: productId })
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success){
                        alert('محصول با موفقیت به سبد خرید اضافه شد.');
                        // اگر شمارنده سبد خرید دارید، اینجا مقدارش را آپدیت کنید
                        if(data.cart_count !== undefined){
                            let cartCountElem = document.getElementById('cart-count');
                            if(cartCountElem) cartCountElem.textContent = data.cart_count;
                        }
                    } else {
                        alert('خطا در افزودن به سبد خرید');
                    }
                })
                .catch(() => alert('خطا در ارتباط با سرور'));
            });
        });
    </script>
    <!-- end offer nav -->
@endsection