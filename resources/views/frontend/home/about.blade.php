@extends('layouts.frontend.master')
@section('content')
<title>  درباره ما</title>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-lg rounded bg-dark text-white border-0">
                <div class="card-body p-5">
                    <div class=" d-flex align-items-center  mb-4"> 
                        <span class="material-symbols-outlined" style="font-size:48px;color:#ffc107;">info</span>
                        <p class="" style="color:#ffc107; font-size: 30px;">درباره ما</p>
                    </div>
                    <hr class="bg-secondary mb-4">
                    <p class="mb-3">
                        فروشگاه ما با هدف ارائه بهترین محصولات و خدمات به مشتریان عزیز راه‌اندازی شده است.
                        <br>
                        ما همواره تلاش می‌کنیم تا تجربه خریدی آسان، مطمئن و لذت‌بخش را برای شما فراهم کنیم.
                    </p>
                    <p class="mb-3">
                        فروشگاه ما فعالیت خود را از سال ۱۴۰۰ آغاز کرده و در این مدت کوتاه توانسته است اعتماد مشتریان زیادی را جلب کند. ما با بهره‌گیری از جدیدترین فناوری‌ها و همکاری با برندهای معتبر، سعی داریم همواره محصولات به‌روز و متنوعی را ارائه دهیم.
                    </p>
                    <p class="mb-3">
                        تیم ما متشکل از افراد متخصص و با تجربه در زمینه فروش و پشتیبانی محصولات دیجیتال است. ما به کیفیت محصولات و رضایت مشتریان اهمیت ویژه‌ای می‌دهیم و همواره در تلاش برای بهبود خدمات خود هستیم.
                    </p>
                    <p class="mb-4">
                        ارزش‌های اصلی ما <span class="badge badge-warning text-dark">صداقت</span>، <span class="badge badge-warning text-dark">شفافیت</span> و <span class="badge badge-warning text-dark">احترام به حقوق مشتریان</span> است. ما باور داریم که موفقیت ما در گرو رضایت و اعتماد شماست و به همین دلیل همواره به دنبال ارتقاء سطح خدمات و محصولات خود هستیم.
                    </p>
                    <div class="mb-4">
                        <strong class="d-block mb-3" style="color:#ffc107; font-size: 22px;">
                            <span class="material-symbols-outlined align-middle" style="vertical-align: middle;">star</span>
                            خدمات ما
                        </strong>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled mx-2">
                                    <li class="mb-3 d-flex align-items-center">
                                        <span class="material-symbols-outlined text-success mr-2" style="font-size: 28px;">check_circle</span>
                                        <span><mak> ارائه محصولات اصل و با کیفیت </mak></span>
                                    </li>
                                    <li class="mb-3 d-flex align-items-center">
                                        <span class="material-symbols-outlined text-success mr-2" style="font-size: 28px;">check_circle</span>
                                        <span><mak>پشتیبانی ۲۴ ساعته و پاسخگویی سریع به سوالات شما </mak></span>
                                    </li>
                                    <li class="mb-3 d-flex align-items-center">
                                        <span class="material-symbols-outlined text-success mr-2" style="font-size: 28px;">check_circle</span>
                                        <span><mak>ارسال سریع و مطمئن به سراسر کشور</mak></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled mx-2">
                                    <li class="mb-3 d-flex align-items-center">
                                        <span class="material-symbols-outlined text-success mr-2" style="font-size: 28px;">check_circle</span>
                                        <span><mak>تضمین بازگشت وجه در صورت عدم رضایت </mak></span>
                                    </li>
                                    <li class="mb-3 d-flex align-items-center">
                                        <span class="material-symbols-outlined text-success mr-2" style="font-size: 28px;">check_circle</span>
                                        <span><mak>ارائه مشاوره تخصصی پیش از خرید </mak></span>
                                    </li>
                                    <li class="mb-3 d-flex align-items-center">
                                        <span class="material-symbols-outlined text-success mr-2" style="font-size: 28px;">check_circle</span>
                                        <span><mak>برگزاری جشنواره‌های فروش و تخفیف‌های ویژه </mak></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-warning text-dark mb-4 shadow-sm border-0" role="alert" style="font-size: 1.1rem;">
                        <span class="material-symbols-outlined align-middle mr-2" style="color:#ff9800;">flag</span>
                        هدف ما در آینده، گسترش دامنه محصولات و خدمات، ایجاد شعب حضوری در شهرهای مختلف و توسعه بستر فروش آنلاین با امکانات بیشتر است تا بتوانیم پاسخگوی نیازهای متنوع شما عزیزان باشیم.
                    </div>
                    <div class="bg-gradient rounded p-4 d-flex flex-column flex-md-row align-items-center justify-content-between" style="background: linear-gradient(90deg, #343a40 60%, #ffc107 100%);">
                        <div class="mb-3 mb-md-0 d-flex align-items-center">
                            <span class="material-symbols-outlined align-middle mr-2" style="color:#fff; font-size: 30px;">mail</span>
                            <span class="font-weight-bold ml-1" style="color:#fff; font-size: 18px;"> ایمیل:</span>
                            <a href="mailto:hamid@yahoo.com" class="ml-2 px-3 py-1 rounded-pill" style="background:#fff;color:#343a40;font-weight:bold;text-decoration:none;transition:background 0.2s; background:#ffc107 !important;">hamid@yahoo.com</a>
                        </div>
                        
                        <div class="d-flex align-items-center">
                            <span class="material-symbols-outlined align-middle mr-2" style="color:#fff; font-size: 30px;">call</span>
                            <span class="font-weight-bold ml-1" style="color:#fff; font-size: 18px;">تلفن:</span>
                            <a href="tel:09123456789" class="ml-2 px-3 py-1 rounded-pill" style="background:#fff;color:#343a40;font-weight:bold;text-decoration:none;transition:background 0.2s; background:#ffc107 !important;">09123456789</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
