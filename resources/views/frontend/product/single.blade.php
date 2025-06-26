@extends('layouts.frontend.master')

@section('content')
<title> مشخصات محصول {{ $product->name }}</title>
    <!-- start product-details nav -->

    <div class="container my-5">
        <div class="row">
            <div class="col-sm-12 bg-white ">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb custom-breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.home.all') }}"
                                class="text-decoration-none">خانه</a></li>
                        <li class=" breadcrumb-item active" aria-current="page"> {{ $product->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container custom-container mt-5">
        <div class="row border-bottom d-flex align-items-center">
            <a href="/{{ $product->image_path }}">
                <div class="col-sm-12 col-md-6 col-lg-5 border-left ">
                    <div id="el" class="my-5 "><img src="/{{ $product->image_path }}" alt=""></div>
                </div>
            </a>

            <div class="col-sm-12 col-md-7  col-lg-7 mt-4">
                <div>
                    <h2> {{ $product->name }}</h2>
                    <hr>
                    @auth
                        <div class="d-flex ">
                            <div class="custom-icone mx-1">




                                <div class="product" data-product-id="{{ $product->id }}">
                                    <button class="bookmark-button" data-product-id="{{ $product->id }}"
                                        style="border: none; background: none; cursor: pointer;">
                                        <span class="material-symbols-outlined " id="bookmark-icon-{{ $product->id }}">
                                            bookmark
                                        </span>

                                    </button>

                                </div>
                            </div>



                            <div class="custom-icone mx-1">
                                <!-- فرض کنید چند محصول دارید، هر کدام با کلاس به جای id -->
                                <div class="product" data-product-id="{{ $product->id }}">
                                    <button class="like-button" data-product-id="{{ $product->id }}"
                                        style="border: none; background: none; cursor: pointer;">
                                        <span class="material-symbols-outlined favorite "
                                            id="favorite-icon-{{ $product->id }}">
                                            favorite
                                        </span>
                                    </button>
                                </div>
                            </div>

                            <div class="custom-icone mx-1 d-flex align-items-center">
                                <p class="text-white">
                                    تا حالا
                                <p class="text-white mx-1" id="like-count-{{ $product->id }}">
                                    {{ $product->likedByUsers->count() }}
                                </p>
                                <p> نفر این محصول را لایک کرده اند
                                </p>
                                </p>
                            </div>


                        </div>

                    @endauth

                </div>
                <p class="mt-5">
                    {!! $product->description !!}
                </p>

                <form action="" class="mt-5">
                    @if ($product->quntity <= 3 && $product->quntity > 0)
                        <div class="col-sm-5 w-100 bg-warning rounded d-flex align-items-center justify-content-center">
                            <div class="badge-danger rounded-circle mr-2 d-flex align-items-center justify-content-center "
                                style="width: 20px;height: 20px;">
                               !
                            </div>

                            <span>تنها {{ $product->quntity }} عدد در انبار باقی مانده</span>
                        </div>
                    @endif
                    <div class="form-group row  d-flex align-items-center justify-content-end">
                       

                        <div class="col-sm-12 mt-2  d-flex align-items-center justify-content-end">
                         
                            @if ($product->quntity == 0)
                                <p class="text-secondary lead mt-3">ناموجود</p>
                            @else
                                <div class="d-flex align-items-center justify-content-center mr-4">
                                    <p class="d-inline-block">قیمت:</p>
                                    @if ($product->discount > 0)
                                        <p class=" d-flex align-items-center ">
                                            <s class="mr-2 d-flex align-items-center">{{ number_format($product->price) }} تومان</s>
                                            <span class="d-flex align-items-center badge badge-pill badge-danger mt-1 mx-1"
                                                style="width: 38px ;height: 35px">
                                                {{ $product->discount }} %
                                            </span>
                                        </p>
                                        <p class="mt-1 d-inline-block justify-content-center align-items-center">
                                            {{ number_format($product->price - ($product->price * $product->discount) / 100) }} &nbsp;
                                            تومان
                                        </p>
                                    @else
                                        <!-- نمایش قیمت اصلی اگر تخفیف وجود نداشته باشد -->
                                        <p class="mx-1 d-inline-block justify-content-center align-items-center">
                                            {{ number_format($product->price) }}
                                        </p>
                                        <p class=" mx-1 d-inline-block justify-content-center align-items-center">
                                            تومان
                                        </p>
                                    @endif
                                </div>
                                <div>
                                    @auth
                                        <!-- اگر کاربر لاگین کرده -->

                                        
                                         <button class="btn btn-danger mt-2  add-to-cart-btn" 
                                        data-product-id="{{ $product->id }}"
                                        data-limited="{{ $product->limited }}" 
                                        data-cart-quantity="{{ session('cart.'.$product->id, 0) }}"
                                        data-product-quantity="{{ $product->quntity }}">
                                        افزودن به سبد خرید
                                    </button>
                                    @else
                                        <!-- اگر کاربر لاگین نکرده -->
                                        <div class=" btn btn-danger mb-2 " onclick="alert('لطفاً وارد حساب کاربری خود شوید!')">
                                            افزودن به سبد خرید</div>
                                    @endauth
                                </div>
                            @endif


                        </div>

                    </div>
                </form>
            </div>

        </div>

        <div class="row mt-5">
            <div class="col-sm-12 ">
                <ul class="nav nav-tabs custom-nav-tabs-product-page" id="myTab" role="tablist">
                   

                    <li class="nav-item">
                        <a class="nav-link active" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                            aria-controls="contact" aria-selected="true">نظرات و پرسش و پاسخ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">مشخصات فنی</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  
                    <div class="tab-pane fade custom-tab-product-detail" id="profile" role="tabpanel"
                        aria-labelledby="profile-tab">
                        <h4 class="ml-3 mt-3"> مشخصات کلی</h4>
                        <ul class="nav flex-column">

                            @foreach (explode('،', $product->description) as $item)
                                <li class="nav-item d-flex mb-3 col-sm-12 ">
                                    <div class="col-sm-5 bg-info rounded  mr-3 d-flex align-items-center p-0">
                                        <p class="ml-2 text-dark">{{ Str::before($item, ':') }}</p>
                                    </div>
                                    <div class="col-sm-7 bg-info rounded  d-flex align-items-center p-0">
                                        <p class="ml-2 text-dark">{{ Str::after($item, ':') }}</p>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="tab-pane fade show active" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="container my-5 mx-2">
                            <div class="row">
                                <div class="col-sm-12 col-md-7">
                                    <div class="progress-product p-4">
                                        <div class="rating-distribution mt-3">
                                            <div class="d-flex align-items-start justify-content-between">
                                                <h5 class="mb-1">توزیع امتیازها</h5>
                                                <div class="custom-icone  ">
                                                    <div class="d-flex align-items-end">
                                                        <p class="mx-1">{{ round($product->votes->avg('value'), 1) }}
                                                        </p>
                                                        <span class="material-symbols-outlined  text-warning lead"
                                                            style="font-size: 30px">
                                                            star
                                                        </span>

                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            @php
                                                $votes = $product->votes->groupBy('value')->map->count();
                                                $totalVotes = $product->votes->count();
                                            @endphp

                                            @for ($i = 5; $i >= 1; $i--)
                                                <div class="row align-items-center mb-2">
                                                    <div class="col-2 text-center text-white p-0">
                                                        <span class="">{{ $i }} ستاره</span>
                                                    </div>
                                                    <div class="col-9 p-1">
                                                        <div class="progress" style="height: 10px;">
                                                            @php
                                                                $voteCount = $votes->has($i) ? $votes->get($i) : 0;
                                                                $percentage =
                                                                    $totalVotes > 0
                                                                        ? ($voteCount / $totalVotes) * 100
                                                                        : 0;
                                                            @endphp
                                                            <div class="progress-bar bg-warning" role="progressbar"
                                                                style="width: {{ $percentage }}%;"
                                                                aria-valuenow="{{ $percentage }}" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-1 text-center text-white p-0">
                                                        <span>({{ $voteCount }})</span>
                                                    </div>
                                                </div>
                                            @endfor
                                        </div>
                                       
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="add-comment">

                                        @guest
                                            <p class="mb-3">شما هم میتوانید برای این محصول نظر دهید</p>
                                            <p class="mb-3">برای نظردهی ابتدا باید وارد حساب کاربری خود شوید</p>
                                            <a href="{{ route('sigIn') }}" class="btn btn-success btn-sm d-inline-flex">
                                                <span class="material-symbols-outlined">
                                                    login
                                                </span> ورود | ثبت نام </a>
                                        @endguest
                                    </div>
                                </div>

                            </div>
                            @foreach ($product->comments as $comment)
                                <div class="row mt-5">
                                    <div class="col-sm-12 col-md-2">
                                        <div class="media custom-product-media">
                                            <div class="d-flex flex-column align-items-center">
                                                <div class=" user-details  ">
                                                    <img class="rounded-circle " src="/img/profile/Untitled.jpg"
                                                        class="mr-3" alt="">

                                              


                                            </div> --}}
                                                </div>
                                                <p class="mt-2">
                                                    {{ $comment->user->first_name }}&nbsp;{{ $comment->user->last_name }}
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-9">
                                        <div class="media-body ">
                                            <p>{{ $comment->comment_text }} </p>
                                            <ul class="nav flex-column">
                                                <span>
                                                    <p class="mt-2 text-color-1">نقاط قوت:</p>
                                                </span>

                                                @foreach (json_decode($comment->analysis)->positives as $positive)
                                                    <li class="nav-item">
                                                        <p class="d-flex  align-items-center">✅{{ $positive }}</p>
                                                    </li>
                                                @endforeach



                                            </ul>
                                            <ul class="nav flex-column">
                                                <span>
                                                    <p class="mt-2  text-color-2 "> نقاط ضعف:</p>
                                                </span>
                                                @foreach (json_decode($comment->analysis)->negatives as $negative)
                                                    <li class="nav-item">
                                                        <p class="d-flex  align-items-center">❌{{ $negative }} </p>
                                                    </li>
                                                @endforeach



                                            </ul>

                                            <div class="d-flex justify-content-end mt-5">

                                                <p class="d-inline-block mr-3">آیا این نظر برای شما مفید بود؟ </p>

                                                <div
                                                    class=" thumb mx-2 d-flex flex-column align-items-center position-relative">

                                                    <div class="d-flex align-items-center">
                                                        <span class="material-symbols-outlined text-color-1  thumb-up ml-4"
                                                            data-comment-id="{{ $comment->id }}"
                                                            style="cursor: pointer;">
                                                            thumb_up
                                                        </span>
                                                        <p class="thumbup">بله</p>
                                                    </div>

                                                    <span class="thumb-up-count  text-white"
                                                        id="thumb-up-count-{{ $comment->id }}">{{ $comment->reactions->where('reaction', 'like')->count() }}</span>
                                                </div>
                                                <div
                                                    class="thumb mx-2 d-flex flex-column align-items-center position-relative">

                                                    <div class="d-flex align-items-center">
                                                        <span
                                                            class="material-symbols-outlined text-color-2   thumb-down ml-4 "
                                                            data-comment-id="{{ $comment->id }}"
                                                            style="cursor: pointer;">
                                                            thumb_down
                                                        </span>
                                                        <p class="thumbdown">خیر</p>
                                                    </div>

                                                    <span class="thumb-down-count  text-white"
                                                        id="thumb-down-count-{{ $comment->id }}">{{ $comment->reactions->where('reaction', 'dislike')->count() }}</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <hr>
                            @endforeach



                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="add-comment-user d-flex px-3 py-2" id="comment">
                                    <span class="material-symbols-outlined text-white mt-1">
                                        add_comment
                                    </span>
                                    <p class="d-inline-block ml-2"> دیدگاه خود را وارد کنید:</p>
                                </div>
                                <form class="w-100 mt-4" method="POST"
                                    action="{{ route('frontend.product.comment', $product->id) }}"
                                    @guest onsubmit="event.preventDefault(); alert('لطفاً وارد حساب کاربری خود شوید!');" @endguest>
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-sm-12 col-md-12">
                                            <textarea name="comment_text" class="form-control mt-3 p-2" placeholder="دیدگاه شما..." cols="30"
                                                rows="6"></textarea>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary my-3">ارسال دیدگاه </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- اضافه کردن قسمت کالاهای مشابه -->
    <div class="container mt-5">
        <div class="col-sm-12">
            <h3 class="text-center ">
                <p>كالاهای مشابه</p>
            </h3>
            <div class="row">
                @foreach ($similarProducts as $similarProduct)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card mb-4 custom-card-body1">
                            <img src="/{{ $similarProduct->image_path }}" class="card-img-top" alt="">

                            <div class="card-body  ">
                                <h5 class="card-title ">{{ Str::limit($similarProduct->name, 20) }}</h5>
                                <br>
                                <h5 class="border-0 ">ویژگی ها:&nbsp;</h5>
                                <h5 class="card-title ">
                                    <p class="card-text ">{{ Str::limit($similarProduct->description, 60) }}</p>
                                </h5>
                                <br>
                                <div style="text-align: center">
                                    @if ($similarProduct->discount > 0)
                                        <p class="mt-2 d-flex justify-content-center align-items-center">
                                            <s class="mr-2 ">{{ number_format($similarProduct->price) }} تومان</s>
                                            <span class="d-flex align-items-center badge badge-pill badge-danger mt-1"
                                                style="width: 38px ;height: 35px">
                                                {{ $similarProduct->discount }} %
                                            </span>
                                        </p>
                                        <p class="mt-4 d-flex justify-content-center align-items-center">
                                            {{ number_format($similarProduct->price - ($similarProduct->price * $similarProduct->discount) / 100) }}
                                            &nbsp; تومان
                                        </p>
                                    @else
                                        <!-- نمایش قیمت اصلی اگر تخفیف وجود نداشته باشد -->
                                        <p class="mt-4 d-flex justify-content-center align-items-center">
                                            {{ number_format($similarProduct->price) }}
                                        </p>
                                        <p class="mt-4 d-flex justify-content-center align-items-center">
                                            تومان
                                        </p>
                                    @endif
                                </div>
                                <div class="text-center"> <!-- اینجا برای وسط‌چین کردن دکمه -->
                                    <a href="{{ route('frontend.product.single', $similarProduct->id) }}"
                                        class="btn btn-danger mt-2">مشاهده</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <!-- end product-details nav -->
@endsection
