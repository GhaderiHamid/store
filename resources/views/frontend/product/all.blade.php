@extends('layouts.frontend.master')


@section('content')
    <!-- start offer nav -->
    <section class="container mt-5 custom-container">
        <h5 class="custom-font"></h5>
        <hr>
        <div class="row "> 


            <div class="col-sm-12 col-md-6 col-lg-3  position-relative">
                <div id="offer-expire-text" class="position-absolute mt-5"></div>
                <div id="offer-blur" class="">
                    <div class="card d-flex flex-column align-items-center mt-5 custom-card">

                        <img class="card-img-top" src="/img/products/motherboard/motherboard_ (1).jpg" alt="Card image cap" />
                        <div class="card-body custom-card-body text-center w-100 ">
                            <p class="card-text custom-card-text">مادربرد از شرکت </p>
                            <p class="mt-4 d-flex justify-content-center align-items-center "> <s> 40000000 </s> &nbsp;
                                <span class="b badge-pill badge-danger custom-span d-flex align-items-center "> 20% </span>
                            </p>
                            <p class="mt-2 b">&nbsp; تومان</p>
                            <div class="count-down-timer">
                                <!-- <p class="custom-font-color">فرصت باقیمانده تا پایان این پیشنهاد</p> -->
                                <div id="demo"></div>
                            </div>

                            <input type="button" name="" id="" value="افزودن به سبد خرید" class="price-btn mt-4">


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- end offer nav -->
@endsection