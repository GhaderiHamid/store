@extends('layouts.frontend.master')
@section('content')

        <!-- start cart nav -->
        <div class="container custom-container mt-5">
            @php
    $cart = session('cart', []);
    $products = \App\Models\Product::whereIn('id', array_keys($cart))->get();
    $total = 0;
            @endphp

            @if(count($cart) > 0 && $products->count() > 0)
                <div class="row d-flex align-items-center">
                    <!-- Product Details -->
                    <div class="col-sm-12 col-md-8">
                        @foreach($products as $item)
                                            @php
                            $quantity = is_array($cart[$item->id]) ? ($cart[$item->id]['quantity'] ?? 1) : $cart[$item->id];
                            $subtotal = $item->price * intval($quantity);
                            $total += $subtotal;
                                            @endphp
                                            <div class="w-100 d-flex align-items-center mt-2 product-border p-2">
                                                <img class="card-img-top w-25 rounded" src="/{{ $item['image_path'] }}" alt="Card image cap">
                                                <div class="card-body col-sm-12 col-md-4">
                                                    <p class="card-text">{{ $item->name }}</p>
                                                    <div class="text-center mt-3 text-white">{{ number_format($item->price) }} تومان</div>
                                                </div>
                                                <div class="card-body col-sm-9 col-md-7 d-flex align-items-center">
                                                    <form action="/cart/update/{{ $item->id }}" method="POST">
                                                        @csrf
                                                        {{-- تعداد و حذف --}}
                                                        <div class="form-group row align-items-center">
                                                            <label for="quantity-{{ $item->id }}"
                                                                class="col-sm-2 col-form-label text-white mt-2">تعداد</label>
                                                            <div class="d-flex align-items-center justify-content-between ml-2">
                                                                <button type="button" class="btn btn-secondary px-3"
                                                                    onclick="changeQuantity({{ $item->id }}, {{ $item->price }}, -1)">-</button>
                                                                <input type="text" name="quantity" id="quantity-{{ $item->id }}"
                                                                    class="form-control text-center mx-2 input_cart"
                                                                    value="{{ $quantity }}" readonly data-price="{{ $item->price }}" data-limited="{{ $item->limited }}">
                                                                <button type="button" class="btn btn-secondary px-3"
                                                                    onclick="changeQuantity({{ $item->id }}, {{ $item->price }}, 1)">+</button>
                                                                <a href="{{ route('frontend.cart.remove', $item->id) }}" class="btn btn-danger ml-2">حذف</a>
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
                            {{-- فرم پرداخت با ارسال subtotal --}}
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
        <script>
            function number_format(num) {
                return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            function updateTotal(total, formatted) {
                if (typeof total !== 'undefined' && typeof formatted !== 'undefined') {
                    document.getElementById('cart-total').innerText = formatted;
                    document.getElementById('subtotal-input').value = total;
                } else {
                    // fallback: محاسبه سمت کلاینت
                    let total = 0;
                    document.querySelectorAll('.input_cart').forEach(function(input) {
                        let price = parseInt(input.getAttribute('data-price'));
                        let quantity = parseInt(input.value);
                        total += price * quantity;
                    });
                    document.getElementById('cart-total').innerText = number_format(total) + ' تومان';
                    document.getElementById('subtotal-input').value = total;
                }
            }

            function changeQuantity(id, price, delta) {
                let input = document.getElementById('quantity-' + id);
                let val = parseInt(input.value) || 1;
                let limited = parseInt(input.getAttribute('data-limited')) || 1;
                let newVal = val + delta;
                if (newVal < 1) return;
                if (newVal > limited) {
                    alert('بیشتر از این نمیتوانید خرید کنید');
                    return;
                }
                input.value = newVal;

                // ارسال مقدار جدید با AJAX به سرور
                fetch("{{ route('frontend.cart.update.quantity') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        product_id: id,
                        quantity: newVal
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateTotal(data.total, data.total_formatted);
                    } else {
                        updateTotal();
                    }
                })
                .catch(() => {
                    updateTotal();
                });
            }
        </script>
@endsection
