@extends('layouts.frontend.master')

@section('content')
    <!-- start product-details nav -->

    <div class="container my-5">
        <div class="row">
            <div class="col-sm-12 bg-white ">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb custom-breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.home.all') }}" class="text-decoration-none">خانه</a></li>
                        <li class=" breadcrumb-item active" aria-current="page"> {{ $product->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container custom-container mt-5">
        <div class="row border-bottom d-flex align-items-center">
            <div class="col-sm-12 col-md-6 col-lg-5 border-left ">
                <div id="el" class="my-5 "><img src="/{{ $product->image_path }}"   alt=""></div>
            </div>

            <div class="col-sm-12 col-md-6  col-lg-7 mt-4">
                <div class=" d-flex justify-content-between align-items-center">
                    <h2> {{ $product->name }}</h2>
                    <div class="d-flex ">
                        <div class="custom-icone mx-3">
                            <span class="material-symbols-outlined">
                                notifications
                            </span>
                        </div>
                        <div class="custom-icone mx-3">
                            <span class="material-symbols-outlined">
                                share
                            </span>
                        </div>
                        <div class="custom-icone mx-3"><span class="material-symbols-outlined">
                                favorite
                            </span>
                        </div>






                    </div>

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
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">توضیحات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">مشخصات فنی</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                            aria-controls="contact" aria-selected="false"> نظرات و پرسش و پاسخ</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    {{-- <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <p class="mt-3 p-3 product-desc ">
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                            گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و
                            برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی
                            می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و
                            متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی
                            الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید
                            داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان
                            مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود
                            طراحی اساسا مورد استفاده قرار گیرد.

                        </p>
                        <div class="container">
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
                            <div class="row ">
                                <div class="col-sm-12 mt-5">
                                    <h4 class="ml-3 ">نقد و بررسی کلی</h4>
                                    <p class="p-3 product-desc ">
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
                                        استفاده از طراحان
                                        گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان
                                        که لازم است و
                                        برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود
                                        ابزارهای کاربردی
                                        می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت
                                        فراوان جامعه و
                                        متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان
                                        رایانه ای علی
                                        الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این
                                        صورت می توان امید
                                        داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به
                                        پایان رسد وزمان
                                        مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل
                                        دنیای موجود
                                        طراحی اساسا مورد استفاده قرار گیرد.

                                    </p>
                                    <ul class="nav flex-column product-desc-step">
                                        <li class="nav-item px-4 mt-3">
                                            <div class="p-img-wrapper">
                                                <img src="/{{ $product->image_path }} " alt="">
                                            </div>
                                            <p class="product-desc"> متخصصان را می طلبد تا با نرم افزارها شناخت
                                                بیشتری را برای طراحان
                                                رایانه ای علی
                                                الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این
                                                صورت می توان امید
                                                داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به
                                                پایان رسد وزمان
                                                مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل
                                                دنیای موجود
                                                طراحی اساسا مورد استفاده قرار گیرد.</p>
                                        </li>
                                        <li class="nav-item px-4 mt-3">
                                            <div class="p-img-wrapper">
                                                <img src="/{{ $product->image_path }}" alt="">
                                            </div>
                                            <p class="product-desc"> متخصصان را می طلبد تا با نرم افزارها شناخت
                                                بیشتری را برای طراحان
                                                رایانه ای علی
                                                الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این
                                                صورت می توان امید
                                                داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به
                                                پایان رسد وزمان
                                                مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل
                                                دنیای موجود
                                                طراحی اساسا مورد استفاده قرار گیرد.</p>
                                        </li>
                                        <li class="nav-item px-4 mt-3">
                                            <div class="p-img-wrapper">
                                                <img src="/{{ $product->image_path }}" alt="">
                                            </div>
                                            <p class="product-desc"> متخصصان را می طلبد تا با نرم افزارها شناخت
                                                بیشتری را برای طراحان
                                                رایانه ای علی
                                                الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این
                                                صورت می توان امید
                                                داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به
                                                پایان رسد وزمان
                                                مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل
                                                دنیای موجود
                                                طراحی اساسا مورد استفاده قرار گیرد.</p>
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
                            <li class="nav-item d-flex mb-3">
                                <div class="key mr-3 d-flex align-items-center">
                                    <p class="ml-2 text-dark">ابعاد</p>
                                </div>
                                <div class="value d-flex align-items-center">
                                    <p class="ml-2 text-dark">150*60*50 میلی متر</p>
                                </div>

                            </li>
                            <li class="nav-item d-flex mb-3">
                                <div class="key mr-3 d-flex align-items-center">
                                    <p class="ml-2 text-dark">وزن</p>
                                </div>
                                <div class="value d-flex align-items-center">
                                    <p class="ml-2 text-dark">700 گرم </p>
                                </div>

                            </li>


                        </ul>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
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
                            <div class="row mt-5">
                                <div class="col-sm-12 col-md-3">
                                    <div class="media custom-product-media">
                                        <div class="user-details">
                                            <img class="rounded-circle" src="/img/profile/Untitled.jpg" class="mr-3" alt="">
                                            <p class="my-2">نام کاربر</p>
                                            <div class="bg-custom">
                                                <p class="bg-primary d-flex rounded p-2"> خرید این محصول را پیشنهاد
                                                    میکنم &nbsp;<span class="material-symbols-outlined text-white">
                                                        thumb_up
                                                    </span> </p>

                                                <div class="mt-2 ">
                                                    <p>رنگ: مشکی</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-9">
                                    <div class="media-body ">
                                        <p>از خرید خود به شدت راضی هستم</p>
                                        <ul class="nav flex-column">
                                            <span>
                                                <p class="mt-2 text-color-1">نقاط قوت:</p>
                                            </span>
                                            <li class="nav-item">
                                                <p class="d-flex  align-items-center"><span
                                                        class="material-symbols-outlined mr-2 small">
                                                        radio_button_unchecked
                                                    </span> قیمت مناسب </p>
                                            </li>
                                            <li class="nav-item">
                                                <p class="d-flex align-items-center"><span
                                                        class="material-symbols-outlined mr-2 small">
                                                        radio_button_unchecked
                                                    </span> کیفیت مطلوب </p>
                                            </li>
                                            <li class="nav-item">
                                                <p class="d-flex align-items-center"><span
                                                        class="material-symbols-outlined mr-2 small">
                                                        radio_button_unchecked
                                                    </span> ظاهر زیبا </p>
                                            </li>

                                        </ul>
                                        <ul class="nav flex-column">
                                            <span>
                                                <p class="mt-2  text-color-2 "> نقاط ضعف:</p>
                                            </span>
                                            <li class="nav-item">
                                                <p class="d-flex  align-items-center"> <span
                                                        class="material-symbols-outlined mr-2 small">
                                                        radio_button_unchecked
                                                    </span>عدم خدمات پس از فروش</p>
                                            </li>
                                            <li class="nav-item">
                                                <p class="d-flex  align-items-center"> <span
                                                        class="material-symbols-outlined mr-2 small">
                                                        radio_button_unchecked
                                                    </span>نازک</p>
                                            </li>

                                        </ul>

                                        <div class="d-flex justify-content-end mt-5">

                                            <p class="d-inline-block mr-3">آیا این نظر برای شما مفید بود؟ </p>

                                            <div class=" thumb d-flex position-relative">


                                                <span class="material-symbols-outlined text-color-1 ml-5 ">
                                                    thumb_up

                                                </span>
                                                <p class="thumbup">بله</p>

                                            </div>
                                            <div class=" thumb  d-flex  position-relative">


                                                <span class="material-symbols-outlined text-color-2 ml-5 mt-1">
                                                    thumb_down

                                                </span>
                                                <p class="thumbdown">خیر</p>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                            </div>
                            <hr>
                            <div class="row mt-5">
                                <div class="col-sm-12 col-md-3">
                                    <div class="media custom-product-media">
                                        <div class="user-details">
                                            <img class="rounded-circle" src="/img/profile/Untitled.jpg" class="mr-3" alt="">
                                            <p class="my-2">نام کاربر</p>
                                            <div class="bg-custom">
                                                <p class="bg-danger d-flex rounded p-2"> خرید این محصول را پیشنهاد
                                                    میکنم &nbsp;<span class="material-symbols-outlined text-white">
                                                        thumb_up
                                                    </span> </p>

                                                <div class="mt-2 ">
                                                    <p>رنگ: مشکی</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-9">
                                    <div class="media-body ">
                                        <p>از خرید خود به شدت راضی هستم</p>
                                        <ul class="nav flex-column">
                                            <span>
                                                <p class="mt-2 text-color-1">نقاط قوت:</p>
                                            </span>
                                            <li class="nav-item">
                                                <p class="d-flex  align-items-center"><span
                                                        class="material-symbols-outlined mr-2 small">
                                                        radio_button_unchecked
                                                    </span> قیمت مناسب </p>
                                            </li>
                                            <li class="nav-item">
                                                <p class="d-flex align-items-center"><span
                                                        class="material-symbols-outlined mr-2 small">
                                                        radio_button_unchecked
                                                    </span> کیفیت مطلوب </p>
                                            </li>
                                            <li class="nav-item">
                                                <p class="d-flex align-items-center"><span
                                                        class="material-symbols-outlined mr-2 small">
                                                        radio_button_unchecked
                                                    </span> ظاهر زیبا </p>
                                            </li>

                                        </ul>
                                        <ul class="nav flex-column">
                                            <span>
                                                <p class="mt-2  text-color-2 "> نقاط ضعف:</p>
                                            </span>
                                            <li class="nav-item">
                                                <p class="d-flex  align-items-center"> <span
                                                        class="material-symbols-outlined mr-2 small">
                                                        radio_button_unchecked
                                                    </span>عدم خدمات پس از فروش</p>
                                            </li>
                                            <li class="nav-item">
                                                <p class="d-flex  align-items-center"> <span
                                                        class="material-symbols-outlined mr-2 small">
                                                        radio_button_unchecked
                                                    </span>نازک</p>
                                            </li>

                                        </ul>

                                        <div class="d-flex justify-content-end mt-5">

                                            <p class="d-inline-block mr-3">آیا این نظر برای شما مفید بود؟ </p>

                                            <div class=" thumb d-flex position-relative">


                                                <span class="material-symbols-outlined text-color-1 ml-5 ">
                                                    thumb_up

                                                </span>
                                                <p class="thumbup">بله</p>

                                            </div>
                                            <div class=" thumb  d-flex  position-relative">


                                                <span class="material-symbols-outlined text-color-2 ml-5 mt-1">
                                                    thumb_down

                                                </span>
                                                <p class="thumbdown">خیر</p>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                            </div>
                            <hr>
                            <div class="row mt-5">
                                <div class="col-sm-12 col-md-3">
                                    <div class="media custom-product-media">
                                        <div class="user-details">
                                            <img class="rounded-circle" src="/img/profile/Untitled.jpg" class="mr-3" alt="">
                                            <p class="my-2">نام کاربر</p>
                                            <div class="bg-custom">
                                                <p class="bg-primary d-flex rounded p-2"> خرید این محصول را پیشنهاد
                                                    میکنم &nbsp;<span class="material-symbols-outlined text-white">
                                                        thumb_up
                                                    </span> </p>

                                                <div class="mt-2 ">
                                                    <p>رنگ: مشکی</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-9">
                                    <div class="media-body ">
                                        <p>از خرید خود به شدت راضی هستم</p>
                                        <ul class="nav flex-column">
                                            <span>
                                                <p class="mt-2 text-color-1">نقاط قوت:</p>
                                            </span>
                                            <li class="nav-item">
                                                <p class="d-flex  align-items-center"><span
                                                        class="material-symbols-outlined mr-2 small">
                                                        radio_button_unchecked
                                                    </span> قیمت مناسب </p>
                                            </li>
                                            <li class="nav-item">
                                                <p class="d-flex align-items-center"><span
                                                        class="material-symbols-outlined mr-2 small">
                                                        radio_button_unchecked
                                                    </span> کیفیت مطلوب </p>
                                            </li>
                                            <li class="nav-item">
                                                <p class="d-flex align-items-center"><span
                                                        class="material-symbols-outlined mr-2 small">
                                                        radio_button_unchecked
                                                    </span> ظاهر زیبا </p>
                                            </li>

                                        </ul>
                                        <ul class="nav flex-column">
                                            <span>
                                                <p class="mt-2  text-color-2 "> نقاط ضعف:</p>
                                            </span>
                                            <li class="nav-item">
                                                <p class="d-flex  align-items-center"> <span
                                                        class="material-symbols-outlined mr-2 small">
                                                        radio_button_unchecked
                                                    </span>عدم خدمات پس از فروش</p>
                                            </li>
                                            <li class="nav-item">
                                                <p class="d-flex  align-items-center"> <span
                                                        class="material-symbols-outlined mr-2 small">
                                                        radio_button_unchecked
                                                    </span>نازک</p>
                                            </li>

                                        </ul>

                                        <div class="d-flex justify-content-end mt-5">

                                            <p class="d-inline-block mr-3">آیا این نظر برای شما مفید بود؟ </p>

                                            <div class=" thumb d-flex position-relative">


                                                <span class="material-symbols-outlined text-color-1 ml-5 ">
                                                    thumb_up

                                                </span>
                                                <p class="thumbup">بله</p>

                                            </div>
                                            <div class=" thumb  d-flex  position-relative">


                                                <span class="material-symbols-outlined text-color-2 ml-5 mt-1">
                                                    thumb_down

                                                </span>
                                                <p class="thumbdown">خیر</p>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                            </div>
                            <hr>


                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="add-comment-user d-flex px-3 py-2">
                                    <span class="material-symbols-outlined text-white mt-1">
                                        add_comment
                                    </span>
                                    <p class="d-inline-block ml-2"> دیدگاه خود را وارد کنید:</p>
                                </div>
                                <form class="w-100 mt-4">
                                    <div class="form-row">
                                        <div class="form-group col-sm-12 col-md-6">

                                            <input type="email" class="form-control" placeholder="نام و نام خانوادگی...">
                                        </div>
                                        <div class="form-group col-sm-12 col-md-6">

                                            <input type="password" class="form-control" placeholder="ایمیل...">
                                        </div>
                                        <div class="form-group col-sm-12 col-md-12">

                                            <textarea name="" class="form-control mt-3 p-2" placeholder="دیدگاه شما..."
                                                id="" cols="30" rows="6"></textarea>
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
                            <img src="/{{ $similarProduct->image_path }}" class="card-img-top"
                                alt="">

                            <div class="card-body  ">
                                <h5 class="card-title ">{{ $similarProduct->name}}</h5>
                                <h5 class="border-0 ">ویژگی ها:&nbsp;</h5>
                                <h5 class="card-title ">
                                    <p class="card-text ">{{ Str::limit($similarProduct->description, 2000) }}</p>
                                </h5>
                                <div style="text-align: center"><p class=" ">قیمت:&nbsp;{{ $similarProduct->price }} &nbsp;تومان</p></div>
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

</script>