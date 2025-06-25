@extends('layouts.frontend.master')
@section('content')

<div class="container custom-container mt-5">
    @if (request('message') === 'unavailable')
    <div class="alert alert-danger text-center mt-3">
        ⚠️ متأسفیم، محصول انتخاب‌شده شما قبلاً توسط کاربر دیگری خریداری شده است.
    </div>
@endif
    @if (count($cart) > 0 && $products->count() > 0)
        <div class="row d-flex align-items-center">
            <!-- Product Details -->
            <div class="col-sm-12 col-md-8">
                @foreach ($products as $item)
                    @if (isset($reservations[$item->id]))
                        @php
                            $quantity = is_array($cart[$item->id]) ? $cart[$item->id]['quantity'] ?? 1 : $cart[$item->id];
                            $discount = $item->discount ?? 0;
                            $final_price = round($item->price - ($item->price * $discount / 100));
                            $remaining = 900 - (now()->timestamp - $reservations[$item->id]);
                        @endphp

                        <div class="w-100 d-flex align-items-center mt-2 product-border p-2" data-product-wrapper="{{ $item->id }}">
                            <img class="card-img-top w-25 rounded" src="/{{ $item['image_path'] }}" alt="{{ $item->name }}">
                            <div class="card-body col-sm-12">
                                <p class="card-text text-center">{{ $item->name }}</p>
                                <div class="text-center mt-3 text-white">
                                    @if ($discount > 0)
                                        <span style="text-decoration:line-through;color:#bbb">{{ number_format($item->price) }}</span>
                                        <span class="ml-2">{{ number_format($final_price) }} تومان</span>
                                        <span class="badge badge-success ml-1">{{ $discount }}٪ تخفیف</span>
                                    @else
                                        {{ number_format($item->price) }} تومان
                                    @endif
                                </div>
                            </div>

                            <div class="card-body col-sm-12">
                                <form method="POST" action="/cart/update/{{ $item->id }}">
                                    @csrf
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <div class="form-group d-flex justify-content-center row align-items-center">
                                            <div class="d-flex flex-column align-items-center justify-content-center">
                                                <label for="quantity-{{ $item->id }}" class="col-form-label text-white mt-2">تعداد</label>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <button type="button" class="btn btn-secondary m-1"
                                                            onclick="changeQuantity({{ $item->id }}, {{ $item->price }}, {{ $discount }}, -1)">
                                                        -
                                                    </button>

                                                    <input type="text" name="quantity" id="quantity-{{ $item->id }}"
                                                           class="form-control text-center input_cart"
                                                           value="{{ $quantity }}" readonly
                                                           data-price="{{ $item->price }}"
                                                           data-discount="{{ $discount }}"
                                                           data-limited="{{ $item->limited }}">

                                                    <button type="button" class="btn btn-secondary m-1"
                                                            onclick="changeQuantity({{ $item->id }}, {{ $item->price }}, {{ $discount }}, 1, {{ $item->limited ?? 'null' }})">
                                                        +
                                                    </button>
                                                </div>

                                                <a href="{{ route('frontend.cart.remove', $item->id) }}" class="btn btn-danger mt-2">حذف</a>

                                                <div class="text-warning text-center mt-2">
                                                    رزرو این محصول 
                                                    <span class="reservation-timer"
                                                          data-seconds="{{ $remaining }}"
                                                          data-product-id="{{ $item->id }}">
                                                    </span> دیگر اعتبار دارد.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Total and Payment -->
            <div class="col-sm-12 col-md-4 mt-1">
                <div class="w-100 product-border p-3 text-white" >
                    <h5>جمع کل: &nbsp;
                        <span id="cart-total">{{ number_format($total) }} تومان</span>
                    </h5>
                    <form action="{{ route('payment.process') }}" method="POST">
                        @csrf
                        <input type="hidden" name="data" id="data-input"
                        value="{{ json_encode([
                            'subtotal' => $total,
                            'user_id' => auth('web')->id(),
                            'products' => $products->filter(fn($item) => isset($reservations[$item->id]))
                                ->map(function ($item) use ($cart) {
                                    $quantity = is_array($cart[$item->id]) ? $cart[$item->id]['quantity'] ?? 1 : $cart[$item->id];
                                    $discount = $item->discount ?? 0;
                                    $final_price = round($item->price - ($item->price * $discount / 100));
                                    return [
                                        'product_id' => $item->id,
                                        'name' => $item->name,
                                        'price' => $item->price,
                                        'discount' => $discount,
                                        'final_price' => $final_price,
                                        'quantity' => intval($quantity),
                                    ];
                                })
                                ->values()
                                ->toArray(),
                        ]) }}">

                        <button type="submit" class="btn btn-primary w-100 mt-3">پرداخت</button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <p class="text-white">سبد خرید شما خالی است!</p>
    @endif
</div>

@endsection