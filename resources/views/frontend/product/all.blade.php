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
                    <a href="{{ route('frontend.product.single', $product->id) }}">
                        <div id="offer-expire-text" class="position-absolute mt-5"></div>
                        <div id="offer-blur">
                            <div class="card d-flex flex-column align-items-center mt-5 custom-card">
                                <img class="card-img-top" src="/{{ $product->image_path }}" alt="Card image cap" />
                                <div class="card-body custom-card-body text-center w-100">
                                    <p class="card-text custom-card-text">{{ $product->name }}</p>
                                    <p class="mt-4 d-flex justify-content-center align-items-center">{{ $product->price }}
                                        &nbsp;
                                    </p>
                                    <p class="mt-2 b">تومان</p>
                                    <a href="{{ route('frontend.cart.add', $product->id) }}" class="align-items-center"><div class="price-btn mt-4 d-inline-block">افزودن به سبد خرید</div></a>

                                </div>
                            </div>
                        </div>
                    </a>
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
    </script>
    <!-- end offer nav -->
@endsection