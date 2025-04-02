@extends('layouts.frontend.master')
@section('content')


    <nav class="w-100">
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-expand-lg navbar-dark w-100">
                    <!-- <a class="navbar-brand" href="#">فروشگاه</a> -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav custom-navbar-nav mr-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown">
                                    دسته بندی محصولات
                                </a>
                                <div class="dropdown-menu custom-dropdown-menu border-0 shadow"aria-labelledby="navbarDropdown">

                                    <div class="row">
                                        @foreach ($categories as $category)
                                            <div class="col-md-4">
                                                <a class="nav-link active text-dark" href="#">
                                                    <span class="material-symbols-outlined">chevron_left</span>
                                                    {{ $category->category_name }}
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('frontend.home.all') }}">خانه </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">درباره ما</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">تماس با ما</a>
                            </li>
                        </ul>
                    </div>
                </nav>

            </div>
        </div>
    </nav>
    </div>
    </div>
    <!-- end top nav -->
    <!-- start slider nav -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-12 col-md-8">
                <div id="carouselExampleIndicators" class="carousel slide custom-border " data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>


                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active ">
                            <img class="d-block w-100 radius" src="/img/slider/t1.jpg" alt="First slide" />
                        </div>
                        <div class="carousel-item rounded">
                            <img class="d-block w-100 radius" src="/img/slider/t2.jpg" alt="Second slide" />
                        </div>
                        <div class="carousel-item rounded">
                            <img class="d-block w-100 radius" src="/img/slider/t3.jpg" alt="Third slide" />
                        </div>

                        <div class="carousel-item rounded">
                            <img class="d-block w-100 radius" src="/img/slider/slider_ (5).png" alt="Second slide" />
                        </div>
                    </div>
                    <a class="carousel-control-prev " href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next " href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 d-flex flex-column justify-content-between">
                <a href="#"><img class="img-fluid custom-border mt-2" src="/img/slider/motherboard-1.jpg" alt="" /></a>
                <a href="#"><img class="img-fluid custom-border mt-2" src="/img/slider/ssd-1.jpg" alt="" /></a>
            </div>
        </div>
    </div>
    <!-- end slider nav -->
    <!-- start cat nav -->
    <section class="container mt-5 custom-container">


        <p class="title">دسته بندی ها</p>
        <div class="row mt-5">



            <div class="col-sm-12 col-md-3 col-lg-2 mb-3  ">
                <a href=" ">
                    <div class="cat-desc">
                        <img src="" alt="">
                        <p>

                        </p>
                    </div>
                </a>
            </div>

        </div>
    </section>
    <!-- end cat nav -->
    <!-- start offer nav -->
    <section class="container mt-5 custom-container">

        <p class="title">تخفیفات</p>
        <div class="row">

            <div class="col-sm-12 col-lg-2">
                <div class="card d-flex flex-column align-items-center mt-5 custom-card">
                    <img class="card-img-top" src="/img/offer/off- (1).jpg" alt="Card image cap" />
                    <div class="card-body custom-card-body">
                        <p class="card-text">گرافیک</p>
                    </div>
                </div>
            </div>





        </div>
    </section>
    <!-- end offer nav -->
    <!-- start special offer nav -->


    <section class="container custom-container mt-5">
        <p class="title mb-3"> پیشنهاد ویژه امروز </p>
        <div class="row">

            <div class="col-sm-12 mt-3">

                <div class="owl-carousel owl-theme bg-white position-relative">
                    <a href="#" class="text-decoration-none">
                        <div class="p-3">
                            <div class="card custom-card1">
                                <img class="p-img align-self-center mt-5" src="/img/offer/off- (1).jpg"
                                    alt="Card image cap">
                                <div class="card-body text-center">
                                    <p class="card-text">
                                    <p class="p-title mt-2">گوشی</p>
                                    <p class="p-price mt-2"><s>1000 تومان</s>500 تومان <span class="badge badge-pill badge-danger mt-1">15%</span></p>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="text-decoration-none">
                        <div class="p-3">
                            <div class="card custom-card1">
                                <img class="p-img align-self-center mt-5" src="/img/offer/off- (2).jpg"
                                    alt="Card image cap">
                                <div class="card-body text-center">
                                    <p class="card-text">
                                    <p class="p-title mt-2">گوشی</p>
                                    <p class="p-price mt-2"><s>1000 تومان</s>500 تومان <span class="badge badge-pill badge-danger mt-1">15%</span></p>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="text-decoration-none">
                        <div class="p-3">
                            <div class="card custom-card1">
                                <img class="p-img align-self-center mt-5" src="/img/offer/off- (3).jpg"
                                    alt="Card image cap">
                                <div class="card-body text-center">
                                    <p class="card-text">
                                    <p class="p-title mt-2">گوشی</p>
                                    <p class="p-price mt-2"><s>1000 تومان</s>500 تومان <span class="badge badge-pill badge-danger mt-1">15%</span></p>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="text-decoration-none">
                        <div class="p-3">
                            <div class="card custom-card1">
                                <img class="p-img align-self-center mt-5" src="/img/offer/off- (4).jpg"
                                    alt="Card image cap">
                                <div class="card-body text-center">
                                    <p class="card-text">
                                    <p class="p-title mt-2">گوشی</p>
                                    <p class="p-price mt-2"><s>1000 تومان</s>500 تومان <span class="badge badge-pill badge-danger mt-1">15%</span></p>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="text-decoration-none">
                        <div class="p-3">
                            <div class="card custom-card1">
                                <img class="p-img align-self-center mt-5" src="/img/offer/off- (5).jpg"
                                    alt="Card image cap">
                                <div class="card-body text-center">
                                    <p class="card-text">
                                    <p class="p-title mt-2">گوشی</p>
                                    <p class="p-price mt-2"><s>1000 تومان</s>500 تومان <span class="badge badge-pill badge-danger mt-1">15%</span></p>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="text-decoration-none">
                        <div class="p-3">
                            <div class="card custom-card1">
                                <img class="p-img align-self-center mt-5" src="/img/offer/off- (6).jpg"
                                    alt="Card image cap">
                                <div class="card-body text-center">
                                <p class="card-text">
                                <p class="p-title mt-2">گوشی</p>
                                <p class="p-price mt-2"><s>1000 تومان</s>500 تومان <span class="badge badge-pill badge-danger mt-1">15%</span></p>
                                </p>

                                </div>
                            </div>
                        </div>
                    </a>


                </div>
            </div>
        </div>
    </section>
@endsection