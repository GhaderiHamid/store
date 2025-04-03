<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title>

        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
        <link rel="stylesheet" href="/css/bootstrap-rtl.css">
        <link rel="stylesheet" href="/css/owl.carousel.css">
        <link rel="stylesheet" href="/css/owl.theme.default.css">
                <link rel="stylesheet" href="/css/zoomy.css">

        <link rel="stylesheet" href="/css/style.css">


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
                                <a class="nav-link text-white border-left" href="#">آدرس فروشگاه</a>
                                <a class="nav-link text-white border-left" href="#">پیگیری سفارش</a>
                                <a class="nav-link text-white border-left" href="#">تلفن</a>
                                <a class="nav-link text-white border-left d-none d-md-block" href="#">ضمانت کیفیت
                                    محصولات</a>
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

                                    <button class="btn btn-success custom-btn-font-size" name=""
                                        type="submit">
                                        جستجو
                                    </button>

                                </div>
                            </form>




                        </div>





                        <div class="col-sm-12 col-md-5 d-flex mt-2" >
                        <div class="d-inline-block mr-2">
                            <a class="btn btn-secondary login text-white shop-card text-decoration-none d-flex align-items-center" href="{{ route('frontend.cart.all') }}">
                                <span id="cart-count" class="d-inline-block badge bg-danger ">{{is_null(Cookie::get('cart'))?0: count(json_decode(Cookie::get('cart'), true)) }}</span>
                                    <span class="material-symbols-outlined  ">shopping_cart</span>
                                
                              
                      
                                سبد خرید
                            </a>
                        </div>




                            <div class="d-inline-block">
                                <a href="login/signIn.php"
                                    class=" btn btn-secondary login text-white shop-card text-decoration-none d-flex align-items-center ">
                                    <span class="material-symbols-outlined">
                                        person
                                    </span>
                                    ثبت نام | ورود
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>