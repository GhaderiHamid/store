@extends('layouts.frontend.master')
@section('content')

{{-- <div class="container-fluid bg-top-nav">
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
                    <form action="product.php" method="post">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder=" به دنبال محصول خاصی هستید؟ " />

                            <button class="btn btn-success custom-btn-font-size" name="search-btn" type="submit">
                                جستجو
                            </button>

                        </div>
                    </form>




                </div>





                <div class="col-sm-12 col-md-5 d-flex mt-2">
                    <div class="d-inline-block mr-2">
                        <a class="btn  btn-secondary d-inline-block  shop-card custom-btn-font-size" href="cart.php">
                            <span class="material-symbols-outlined"> shopping_cart </span>
                            سبد خرید
                        </a>
                    </div>



                    <div class="d-inline-block">
                        <a href="login/signIn.php" class=" btn btn-secondary login text-white shop-card text-decoration-none d-flex align-items-center ">
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
</div> --> --}}
<nav class="w-100">
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-dark w-100">
                <!-- <a class="navbar-brand" href="#">فروشگاه</a> -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav custom-navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                                دسته بندی محصولات
                            </a>
                            <div class="dropdown-menu custom-dropdown-menu border-0 shadow" aria-labelledby="navbarDropdown">
                                <!-- <img src="img/menu/pngaaa.com-2319705.png" class="d-none d-xl-block mx-2 my-2" alt="" /> -->
                                <ul class="nav flex-column pl-3">
                                   // <?php
                                    // 2. execute query

                                    //$sql = "SELECT * FROM category";
                                   // $result = $dbc->query($sql);
                                  //  while ($row = mysqli_fetch_array($result)) :
                                  //  ?>

                                        <li class="nav-item">
                                            <a class="nav-link active" href="#">
                                                <span class="material-symbols-outlined">
                                                    chevron_left </span>
                                                {{-- <?php echo $row['Category_Name']; ?> --}}
                                            </a>
                                        </li>


                                    {{-- <?php endwhile; ?> --}}

                                </ul>


                            </div>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="index.php">خانه </a>
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


       // <?php
          // 2. execute query
         // $sql = "SELECT * FROM category";
        //  $result = $dbc->query($sql);
         // while ($row = mysqli_fetch_array($result)) :
      //  ?>
             <div class="col-sm-12 col-md-3 col-lg-2 mb-3  ">
                <a href="product.php?cat=
                {{-- <?php echo $row['Category_Id']; ?> --}}
                ">
                    <div class="cat-desc">
                        <img src="/img/category/
                        {{-- <?php echo $row['Category_Image']; ?> --}}
                        " alt="" />
                        <p>
                            {{-- <?php echo $row['Category_Name']; ?> --}}
                        </p>
                    </div>
                </a>
            </div>
        {{-- <?php endwhile; ?> --}}
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
                            <img class="p-img align-self-center mt-5" src="/img/offer/off- (1).jpg" alt="Card image cap">
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
                            <img class="p-img align-self-center mt-5" src="/img/offer/off- (2).jpg" alt="Card image cap">
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
                            <img class="p-img align-self-center mt-5" src="/img/offer/off- (3).jpg" alt="Card image cap">
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
                            <img class="p-img align-self-center mt-5" src="/img/offer/off- (4).jpg" alt="Card image cap">
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
                            <img class="p-img align-self-center mt-5" src="/img/offer/off- (5).jpg" alt="Card image cap">
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
                            <img class="p-img align-self-center mt-5" src="/img/offer/off- (6).jpg" alt="Card image cap">
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