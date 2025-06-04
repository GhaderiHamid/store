@extends('layouts.frontend.master')
@section('content')

                <!-- start cart nav -->
                <div class="container custom-container mt-5">
                    @php
    $cart = session('cart', []);
    $products = \App\Models\Product::whereIn('id', array_keys($cart))->get();
    $total = 0;
                    @endphp

                    @if (count($cart) > 0 && $products->count() > 0)
                        <div class="row d-flex align-items-center">
                            <!-- Product Details -->
                            <div class="col-sm-12 col-md-8">
                                @foreach ($products as $item)
                                                                                                @php
                                    $quantity = is_array($cart[$item->id])
                                        ? $cart[$item->id]['quantity'] ?? 1
                                        : $cart[$item->id];
                                    $discount = $item->discount ?? 0;
                                    $final_price = $item->price;
                                    if ($discount > 0) {
                                        $final_price = $item->price - ($item->price * $discount) / 100;
                                    }
                                    $final_price = round($final_price);
                                    $subtotal = $final_price * intval($quantity);
                                    $total += $subtotal;
                                                                                                @endphp
                                                                                                <div class="w-100 d-flex align-items-center mt-2 product-border p-2">
                                                                                                    <img class="card-img-top w-25 rounded" src="/{{ $item['image_path'] }}" alt="Card image cap">
                                                                                                    <div class="card-body col-sm-12 ">
                                                                                                        <p class="card-text">{{ $item->name }}</p>
                                                                                                        <div class="text-center mt-3 text-white">
                                                                                                            @if (!empty($item->discount) && $item->discount > 0)
                                                                                                                <span
                                                                                                                    style="text-decoration:line-through;color:#bbb">{{ number_format($item->price) }}</span>
                                                                                                                <span class="ml-2">{{ number_format($final_price) }} &nbsp;تومان </span>
                                                                                                                <span class="badge badge-success ml-1">{{ $item->discount }}٪ تخفیف</span>
                                                                                                            @else
                                                                                                                {{ number_format($item->price) }} تومان
                                                                                                            @endif
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="card-body col-sm-12 ">
                                                                                                        <form action="/cart/update/{{ $item->id }}" method="POST">
                                                                                                            @csrf
                                                                                                            <div class="d-flex flex-column align-items-center justify-content-center">
                                                                                                                <div class="form-group d-flex   justify-content-center row align-items-center">

                                                                                                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                                                                                                        <label for="quantity-{{ $item->id }}" class=" col-form-label text-white mt-2">تعداد</label>
                                                                                                                        <div class="d-flex align-items-center justify-content-between ">
                                                                                                                            <button type="button" class="btn btn-secondary m-1"
                                                                                                                                onclick="changeQuantity({{ $item->id }}, {{ $item->price }}, {{ $item->discount ?? 0 }}, -1)">-</button>
                                                                                                                            <input type="text" name="quantity" id="quantity-{{ $item->id }}" class="form-control text-center  input_cart "
                                                                                                                                value="{{ $quantity }}" readonly data-price="{{ $item->price }}" data-discount="{{ $item->discount ?? 0 }}"
                                                                                                                                data-limited="{{ $item->limited }}">
                                                                                                                            <button type="button" class="btn btn-secondary m-1"
                                                                                                                                onclick="changeQuantity({{ $item->id }}, {{ $item->price }}, {{ $item->discount ?? 0 }}, 1)">+</button>
                                                                                                                            </div>
                                                                                                                            <div>
                                                                                                                                <a href="{{ route('frontend.cart.remove', $item->id) }}" class="btn btn-danger mt-2 ">حذف</a>      </div>
                                                                                                                    </div>

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
                                        <span id="cart-total">{{ number_format($total) }} تومان</span>
                                    </h5>
                                    <form action="{{ route('payment.process') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="subtotal" id="subtotal-input" value="{{ $total }}">
                                        <button type="submit" class="btn btn-primary w-100 mt-3"> پرداخت</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="text-white">سبد خرید شما خالی است!</p>
                    @endif
                </div>
                <!-- end cart nav -->
           
@endsection
