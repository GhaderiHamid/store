<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
        
        {{-- <title>Document</title> --}}

        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
       
        <link rel="stylesheet" href="/css/bootstrap-rtl.css">
        <link rel="stylesheet" href="/css/owl.carousel.css">
        <link rel="stylesheet" href="/css/owl.theme.default.css">
        <link rel="stylesheet" href="/css/zoomy.css">
        {{--
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> --}}

        <link rel="stylesheet" href="/css/style.css">
         

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
    </head>

    <body class="rtl">





        

        <!-- start top nav -->

        <div class="container-fluid bg-top-nav">
            <div class="row">
                <div class="container">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-sm-12 col-md-6 d-none d-md-block">
                            <p class="text-white">ارسال رایگان -ضمانت بازگشت وجه 30 روزه</p>
                        </div>
                        <div class="col-sm-12 col-md-6 d-flex justify-content-center align-items-center">
                            <nav class="nav custom-top-nav">
                                <a class="nav-link text-white border-left" href="{{ route('frontend.home.all') }}">خانه</a>
                                <p class="nav-link text-white border-left" href="">پرداخت امن </p>
                                <p class="nav-link text-white border-left" href=""> ارسال فوری</p>
                              
                                <p class="nav-link text-white border-left d-none d-md-block" href="">ضمانت کیفیت
                                    محصولات</p>
                                    
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="container my-4">
                    <div class="row mx-0">
                        <div class="col-sm-12 col-md-7 mt-2">
                            <form action="{{ route('frontend.product.all') }}">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        placeholder=" به دنبال محصول خاصی هستید؟ " />

                                    <button class="btn btn-success custom-btn-font-size" name="" type="submit">
                                        جستجو
                                    </button>

                                </div>
                            </form>




                        </div>





                        <div class="col-sm-12 col-md-5 d-flex mt-2">
                            @if(Auth::guard('web')->check())
                                <div class="d-inline-block mr-2">
                                    <a class="btn btn-secondary login text-white shop-card text-decoration-none d-flex align-items-center"
                                        href="{{ route('frontend.cart.all') }}">
                                        <span id="cart-count"
                                            class="d-inline-block badge bg-danger ">
                                            {{ session('cart') ? array_sum(session('cart')) : 0 }}
                                        </span>
                                        <span class="material-symbols-outlined  ">shopping_cart</span>

                                        سبد خرید
                                    </a>
                                </div>
                            @endif




                            <div class="d-inline-block">
                                @if(Auth::guard('web')->check())
                                    <div class="dropdown ">
                                        <a href="#"
                                            class="btn btn-secondary dropdown-toggle  login text-white shop-card text-decoration-none d-flex align-items-center"
                                            id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="material-symbols-outlined">
                                                account_circle
                                            </span>
                                            پروفایل
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                                            <li><a class="dropdown-item border " href="{{ route('user.orders.index') }}">سفارش‌ها</a></li>

                                            <li><a class="dropdown-item border " href="{{ route('user.bookmarked.products') }}">محصولات ذخیره شده</a></li>
                                            <li><a class="dropdown-item border " href="{{ route('user.liked.products') }}">محصولات لایک‌ شده</a></li>
                                            <li><a class="dropdown-item border " href="{{ route('comments.index') }}">کامنت‌ها</a></li>
                                            <li><a class="dropdown-item border " href="{{ route('user.profile.edit') }}">بروزرسانی حساب کاربری</a></li>
                                            <li><a class="dropdown-item border " href="{{ route('user.recommendations', ['userId' => Auth::guard('web')->user()->id]) }}"> توصیه ها و پیشنهادات</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item border " href="{{ route('logout') }}">خروج از حساب
                                                    کاربری</a></li>
                                        </ul>
                                    </div>
                                @else
                                    <a href="{{ route('sigIn') }}"
                                        class="btn btn-secondary login text-white shop-card text-decoration-none d-flex align-items-center">
                                        <span class="material-symbols-outlined">
                                            person
                                        </span>
                                        ثبت نام | ورود
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>