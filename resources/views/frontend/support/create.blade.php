@extends('layouts.frontend.master')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4 d-flex align-items-center gap-2" style="background: linear-gradient(90deg,#007bff 0,#6610f2 100%);">
                    <span class="material-symbols-outlined align-middle" style="font-size:1.5rem;">add_comment</span>
                    <span class="ml-2">ثبت تیکت جدید</span>
                </div>
                <div class="card-body">
                    <form action="{{ route('frontend.support.store') }}" method="post">
                        @csrf
                        <div class="form-group mb-4">
                            <label class="font-weight-bold mb-2">موضوع</label>
                            <input type="text" name="subject" class="form-control rounded-pill px-4 py-2" required placeholder="موضوع تیکت را وارد کنید">
                        </div>
                        <div class="form-group mb-4">
                            <label class="font-weight-bold mb-2">پیام</label>
                            <textarea name="message" class="form-control rounded-3 px-3 py-2" rows="5" required placeholder="متن پیام خود را بنویسید"></textarea>
                        </div>
                        <button class="btn btn-success rounded-pill px-4 py-2 d-flex align-items-center gap-1" type="submit">
                            <span class="material-symbols-outlined align-middle">send</span>
                            ارسال تیکت
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
