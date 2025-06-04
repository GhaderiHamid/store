@extends('layouts.frontend.master')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg rounded bg-dark text-white border-0">
                <div class="card-body p-5">
                    <div class="d-flex align-items-center mb-4">
                        <span class="material-symbols-outlined" style="font-size:48px;color:#ffc107;">call</span>
                        <p class="mb-0 ml-3" style="color:#ffc107; font-size: 30px;">تماس با ما</p>
                    </div>
                    <hr class="bg-secondary mb-4">
                    <p class="mb-4">
                        خوشحال می‌شویم نظرات، پیشنهادات و سوالات خود را با ما در میان بگذارید.<br>
                        از طریق راه‌های زیر می‌توانید با ما در ارتباط باشید:
                    </p>
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <span class="material-symbols-outlined align-middle mr-2" style="color:#ffc107; font-size: 28px;">mail</span>
                            <span class="font-weight-bold ml-1" style="color:#fff; font-size: 18px;">ایمیل:</span>
                            <a href="mailto:hamid@yahoo.com" class="ml-2 px-3 py-1 rounded-pill" style="background:#ffc107;color:#343a40;font-weight:bold;text-decoration:none;">hamid@yahoo.com</a>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="material-symbols-outlined align-middle mr-2" style="color:#ffc107; font-size: 28px;">call</span>
                            <span class="font-weight-bold ml-1" style="color:#fff; font-size: 18px;">تلفن:</span>
                            <a href="tel:09123456789" class="ml-2 px-3 py-1 rounded-pill" style="background:#ffc107;color:#343a40;font-weight:bold;text-decoration:none;">09123456789</a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
