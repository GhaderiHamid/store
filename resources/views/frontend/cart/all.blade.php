@extends('layouts.frontend.master')
@section('content')
    @inject('basket', 'App\Support\Basket\Basket')
    <!-- start cart nav -->
    <div class="container custom-container mt-5">
        @if (!$items->isEmpty())
            <div class="row d-flex align-items-center">
                <!-- Product Details -->
                <div class="col-sm-12 col-md-8">
                    @foreach ($items as $item)
                        <div class="w-100 d-flex align-items-center mt-2 product-border p-2">
                            <img class="card-img-top w-25 rounded" src="/{{ $item['image_path'] }}" alt="Card image cap">
                            <div class="card-body col-sm-12 col-md-4">
                                <p class="card-text">{{ $item['name'] }}</p>
                                <div class="text-center mt-3 text-white">{{ $item['price'] }} تومان</div>
                            </div>
                            <div class="card-body col-sm-9 col-md-7 d-flex align-items-center">
                                <form action="/cart/update/{{ $item->id }}" method="POST">
                                    @csrf
                                    <div class="form-group row align-items-center">
                                        <label for="quantity-{{ $item->id }}"
                                            class="col-sm-2 col-form-label text-white mt-2">تعداد</label>
                                        <div class="d-flex align-items-center justify-content-between ml-2">
                                            <button type="button" class="btn btn-secondary px-3"
                                                onclick="decreaseQuantity({{ $item->id }})">-</button>
                                            <input type="text" name="quantity" id="quantity-{{ $item->id }}"
                                                class="form-control text-center mx-2 input_cart"
                                                value="{{ $item['quantity'] ?? 1 }}" readonly>
                                            <button type="button" class="btn btn-secondary px-3"
                                                onclick="increaseQuantity({{ $item->id }})">+</button>
                                            <a href="{{ route('frontend.cart.remove', $item->id) }}"
                                                class="btn btn-danger ml-2">حذف</a>
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
                                <span>{{ $basket->subTotal() }} تومان</span>
                            </h5>
                         
                  
                    <a href="{{ route('checkout') }}" class="btn btn-primary w-100 mt-3"> پرداخت</a>
                </div>

            </div>
    </div>
@else
    <p class="text-white">سبد خرید شما خالی است!</p>
    @endif
    </div>
    <!-- end cart nav -->


@endsection
