@extends('layouts.frontend.master')
@section('content')
    <!-- start cart nav -->
    <div class="container custom-container mt-5">
        @if(!is_null(Cookie::get('cart')) && count(json_decode(Cookie::get('cart'), true)) > 0)
            <div class="row d-flex align-items-center">
                <!-- Product Details -->
                <div class="col-sm-12 col-md-8">
                    @foreach (json_decode(Cookie::get('cart'), true) as $id => $value)
                        <div class="w-100 d-flex align-items-center mt-2 product-border p-2">
                            <img class="card-img-top w-25 rounded" src="/{{ $value['image_path'] }}" alt="Card image cap">
                            <div class="card-body col-sm-12 col-md-4">
                                <p class="card-text">{{ $value['name'] }}</p>
                                <div class="text-center mt-3 text-white">{{ $value['price'] }} تومان</div>
                            </div>
                            <div class="card-body col-sm-9 col-md-7 d-flex align-items-center">
                                <form action="/cart/update/{{ $id }}" method="POST">
                                    @csrf
                                    <div class="form-group row align-items-center">
                                        <label for="quantity-{{ $id }}" class="col-sm-2 col-form-label text-white mt-2">تعداد</label>
                                        <div class="d-flex align-items-center justify-content-between ml-2">
                                            <button type="button" class="btn btn-secondary px-3"
                                                onclick="decreaseQuantity({{ $id }})">-</button>
                                            <input type="text" name="quantity" id="quantity-{{ $id }}"
                                                class="form-control text-center mx-2 input_cart" value="{{ $value['quantity'] ?? 1 }}"
                                                readonly>
                                            <button type="button" class="btn btn-secondary px-3"
                                                onclick="increaseQuantity({{ $id }})">+</button>
                                            <a href="{{ route('frontend.cart.remove', $id) }}" class="btn btn-danger ml-2">حذف</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Total and Payment -->
                <div class="col-sm-12 col-md-4 ">
                    <div class="w-100 product-border p-3 text-white">
                        <h5>جمع کل: &nbsp;
                            <span>{{ array_sum(array_column(json_decode(Cookie::get('cart'), true), 'price')) }} تومان</span>
                        </h5>
                        <a href="" class="btn btn-primary w-100 mt-3"> پرداخت</a>
                    </div>
                </div>
            </div>
        @else
            <p class="text-white">سبد خرید شما خالی است!</p>
        @endif
    </div>
    <!-- end cart nav -->


@endsection