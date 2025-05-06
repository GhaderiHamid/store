@extends('layouts.frontend.master')

@section('content')
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

            <div class="col-sm-12 col-md-6  col-lg-7 mt-4">
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
                                        <span class="material-symbols-outlined favorite" id="favorite-icon-{{ $product->id }}">
                                            favorite
                                        </span>
                                    </button>

                                </div>


                            </div>
                            {{-- <div class="custom-icone mx-1">
                                <div class="stars-container" data-product-id="{{ $product->id }}" style="cursor: pointer">
                                    @for ($i = 5; $i >= 1; $i--)
                                    <span class="material-symbols-outlined star" data-star="{{ $i }}">star_border</span>
                                    @endfor
                                </div>


                            </div> --}}

                        </div>
                    @endauth

                </div>
                <p class="mt-5">
                    {!! $product->description !!}
                </p>

                <form action="" class="mt-5">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label text-white mt-2">تعداد</label>
                        <div class="col-sm-3 mt-2">
                            <input type="text" readonly class="form-control" id="staticEmail" value="1">
                        </div>
                        <div class="col-sm-7 mt-2">
                            <button type="submit" class="btn btn-danger mb-2">افزودن به سبد خرید </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

        <div class="row mt-5">
            <div class="col-sm-12 ">
                <ul class="nav nav-tabs custom-nav-tabs-product-page" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                            aria-selected="false">توضیحات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">مشخصات فنی</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                            aria-controls="contact" aria-selected="true">نظرات و پرسش و پاسخ</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    {{-- <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <p class="mt-3 p-3 product-desc ">


                        </p>
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="progress-product p-4">

                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-7 mt-3">
                                    <h4 class=" ">ویژگی های محصول</h4>
                                    <ul class="nav flex-column  my-3 pl-3">
                                        <li class="nav-item ">
                                            <a class="nav-link " href="#"> <span class="material-symbols-outlined mr-1">
                                                    adjust
                                                </span>درباره ما</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#"> <span class="material-symbols-outlined mr-1">
                                                    adjust
                                                </span>نحوه خرید</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#"> <span class="material-symbols-outlined mr-1">
                                                    adjust
                                                </span>محصولات منتخب</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " href="#"> <span class="material-symbols-outlined mr-1">
                                                    adjust
                                                </span>پیشنهادات</a>
                                        </li>
                                    </ul>
                                </div>

                            </div>

                        </div>
                    </div> --}}
                    <div class="tab-pane fade custom-tab-product-detail" id="profile" role="tabpanel"
                        aria-labelledby="profile-tab">
                        <h4 class="ml-3 mt-3"> مشخصات کلی</h4>
                        <ul class="nav flex-column">

                            @foreach(explode('،', $product->description) as $item)
                                <li class="nav-item d-flex mb-3">
                                    <div class="key mr-3 d-flex align-items-center">
                                        <p class="ml-2 text-dark">{{ Str::before($item, ':') }}</p>
                                    </div>
                                    <div class="value d-flex align-items-center">
                                        <p class="ml-2 text-dark">{{ Str::after($item, ':') }}</p>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="tab-pane fade show active" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="container my-5 mx-2">
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="progress-product p-4">
                                        <div class="mt-3 product-rate">
                                            <div>
                                                <p class="mb-2 "> ارزش خرید نسبت به قیمت</p>
                                            </div>
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar" role="progressbar" style="width: 25%;"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3 product-rate">
                                            <div>
                                                <p class="mb-2 "> کیفیت ساخت</p>
                                            </div>
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar" role="progressbar" style="width: 75%;"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3 product-rate">
                                            <div>
                                                <p class="mb-2 "> امکانات</p>
                                            </div>
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar" role="progressbar" style="width: 55%;"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3 product-rate">
                                            <div>
                                                <p class="mb-2 "> آرگونامی</p>
                                            </div>
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar" role="progressbar" style="width: 45%;"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="add-comment">
                                        <p class="mb-3">شما هم میتوانید برای این محصول نظر دهید</p>
                                        <p class="mb-3">برای نظردهی ابتدا باید وارد حساب کاربری خود شوید</p>
                                        <a href="login/signIn.php" class="btn btn-success btn-sm d-inline-flex">
                                            <span class="material-symbols-outlined">
                                                login
                                            </span> ورود | ثبت نام </a>
                                    </div>
                                </div>
                            </div>
                       @foreach ($product->comments as $comment)
                        <div class="row mt-5">
                            <div class="col-sm-12 col-md-2">
                                <div class="media custom-product-media">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class=" user-details  ">
                                            <img class="rounded-circle " src="/img/profile/Untitled.jpg" class="mr-3" alt="">

                                            {{-- <div class="bg-custom">
                                                <p class="bg-primary d-flex rounded p-2"> خرید این محصول را پیشنهاد
                                                    میکنم &nbsp;<span class="material-symbols-outlined text-white">
                                                        thumb_up
                                                    </span> </p>


                                            </div> --}}
                                        </div>
                                        <p class="mt-2"> {{ $comment->user->first_name }}&nbsp;{{ $comment->user->last_name }}</p>
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

                                        @foreach(json_decode($comment->analysis)->positives as $positive)
                                            <li class="nav-item">
                                                <p class="d-flex  align-items-center">✅{{ $positive }}</p>
                                            </li>

                                        @endforeach



                                    </ul>
                                    <ul class="nav flex-column">
                                        <span>
                                            <p class="mt-2  text-color-2 "> نقاط ضعف:</p>
                                        </span>
                                        @foreach(json_decode($comment->analysis)->negatives as $negative)

                                            <li class="nav-item">
                                                <p class="d-flex  align-items-center">❌{{ $negative }} </p>
                                            </li>
                                        @endforeach



                                    </ul>

                                    <div class="d-flex justify-content-end mt-5">

                                        <p class="d-inline-block mr-3">آیا این نظر برای شما مفید بود؟ </p>

                                    <div class="media-body" data-comment-id="{{ $comment->id }}">
                                        ...
                                        <div class="d-flex justify-content-end mt-5">
                                            <p class="d-inline-block mr-3">آیا این نظر برای شما مفید بود؟ </p>

                                        <div class="thumb d-flex position-relative">
                                            <button class="btn btn-outline-success d-flex align-items-center ml-1">
                                                <span class="material-symbols-outlined text-color-1 ml-2">
                                                    thumb_up
                                                </span>
                                                <p class="mb-0">بله</p>
                                            </button>
                                            <span class="thumb-up-count">{{ $comment->likes_count }}</span>
                                        </div>
                                        <div class="thumb d-flex position-relative">
                                            <button class="btn btn-outline-danger d-flex align-items-center ml-1">
                                                <span class="material-symbols-outlined text-color-2">
                                                    thumb_down
                                                </span>
                                                <p class="mb-0">خیر</p>
                                            </button>
                                            <span class="thumb-down-count">{{ $comment->dislikes_count }}</span>
                                        </div>

                                        </div>
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
                                    action="{{ route('frontend.product.comment', $product->id) }}">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-sm-12 col-md-12">
                                            <textarea name="comment_text" class="form-control mt-3 p-2"
                                                placeholder="دیدگاه شما..." cols="30" rows="6"></textarea>
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
                @foreach($similarProducts as $similarProduct)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card mb-4 custom-card-body1">
                            <img src="/{{ $similarProduct->image_path }}" class="card-img-top" alt="">

                            <div class="card-body  ">
                                <h5 class="card-title ">{{Str::limit($similarProduct->name, 20) }}</h5>
                                <h5 class="border-0 ">ویژگی ها:&nbsp;</h5>
                                <h5 class="card-title ">
                                    <p class="card-text ">{{ Str::limit($similarProduct->description, 50) }}</p>
                                </h5>
                                <div style="text-align: center">
                                    <p class=" ">
                                        قیمت:&nbsp;{{ $similarProduct->price - ($similarProduct->price * $similarProduct->discount / 100)  }}
                                        &nbsp;تومان</p>
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