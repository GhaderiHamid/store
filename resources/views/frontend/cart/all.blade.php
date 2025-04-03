@extends('layouts.frontend.master')
@section('content')
    <!-- start cart nav -->
    <div class="container custom-container mt-5">
        <div class="row d-flex align-items-center">
            <!-- Product Details -->
            <div class="col-sm-12 col-md-8">
                @if(!is_null(Cookie::get('cart')))
                    @foreach (json_decode(Cookie::get('cart'), true) as $id => $value)

                        <div class="w-100 d-flex align-items-center mt-2 product-border p-2">
                            <img class="card-img-top w-25 rounded" src="/{{ $value['image_path'] }}" alt="Card image cap">
                            <div class="card-body">
                                <p class="card-text">{{ $value['name'] }}</p>
                                <div class="text-center mt-3 text-white">{{ $value['price'] }} تومان</div>
                            </div>
                            <form action="/cart/remove/{{ $id }}" method="POST" class="">
                                @csrf <!-- محافظت در برابر حملات CSRF -->
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label text-white mt-2">تعداد</label>
                                    <div class="col-sm-3 mt-2">
                                        <input type="text" class="form-control" id="staticEmail" value="1">
                                    </div>
                                    <a href="{{ route('frontend.cart.remove', $id)  }}" class="btn btn-danger mt-2">حذف</a>

                                </div>
                            </form>
                        </div>

                    @endforeach
                @endif

            </div>
            <!-- Total and Payment -->
            <div class="col-sm-12 col-md-4 ">
                <div class="w-100 product-border p-3 text-white">
                    <h5>جمع کل: &nbsp; <span>{{is_null(Cookie::get('cart'))? 0 : array_sum(array_column(json_decode(Cookie::get('cart'), true), 'price'))  }} تومان</span></h5>
                    <a href="" class="btn btn-primary w-100 mt-3">   پرداخت</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end cart nav -->
@endsection