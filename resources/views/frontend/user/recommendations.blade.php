@extends('layouts.frontend.master')
@section('content')
<title>محصولات پیشنهادی من </title>
    <section class="container mt-5 custom-container">
        <h5 class="custom-font mb-3">پیشنهادات ویژه برای شما</h5>
        <div class="row">


            @if (!empty($recommendedProducts) && count($recommendedProducts) > 0)
                @foreach ($recommendedProducts as $product)
                 
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="card mb-4 custom-card-body1">
                                <img src="/{{ $product->image_path }}" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h5 class="card-title">{{ \Illuminate\Support\Str::limit($product->name, 20) }}</h5>
                                    <br>
                                    <h5 class="features-title">ویژگی ها:&nbsp;</h5>
                                    <h5 class="card-title">
                                        <p class="card-text">
                                            {{ \Illuminate\Support\Str::limit($product->description ?? '', 60) }}</p>
                                    </h5>
                                    <div style="text-align: center">
                                        @if ($product->discount > 0)
                                            <p class="mt-2 d-flex justify-content-center align-items-center">
                                                <s class="mr-2 ">{{ number_format($product->price) }} تومان</s>
                                                <span class="d-flex align-items-center badge badge-pill badge-danger mt-1" style="width: 38px ;height: 35px">
                                                    {{ $product->discount }} %
                                                </span>
                                            </p>
                                            <p class="mt-4 d-flex justify-content-center align-items-center">
                                                {{ number_format($product->price - ($product->price * $product->discount) / 100) }}
                                                &nbsp; تومان
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
                                    </div>
                                    <div class="text-center">
                                        <a href="{{ route('frontend.product.single', $product->id) }}"
                                            class="btn btn-danger mt-2">مشاهده</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach
               
            @else
                <p class="no-recommend">متأسفانه محصولی برای شما پیشنهاد نشده است.</p>
            @endif

        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $recommendedProducts->appends(request()->query())->links() }}
        </div>
    </section>

@endsection
