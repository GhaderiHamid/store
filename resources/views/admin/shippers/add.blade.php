@extends('layouts.admin.master')

@section('content')
    <main role="main" class="col-md-9  col-lg-10 px-4 content">

            <!-- فرم افزودن مامور ارسال جدید -->
            <div id="form-add-customer">
                <div class="card">
                    <div class="card-header">افزودن مامور ارسال جدید</div>
                    @include('errors.message')
                    <div class="card-body">
                        <form action="{{ route('admin.shippers.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="customerName">نام </label>
                                <input type="text" class="form-control" name="first_name" id="customerName" placeholder="نام را وارد کنید">
                            </div>
                            <div class="form-group">
                                <label for="customerName">نام خانوادگی </label>
                                <input type="text" class="form-control" name="last_name" id="customerName"
                                    placeholder="نام خانوادگی را وارد کنید">
                            </div>
                            <div class="form-group">
                                <label for="customerEmail">ایمیل</label>
                                <input type="email" class="form-control" name="email" id="customerEmail" placeholder="ایمیل خود را وارد کنید">
                            </div>
                            <div class="form-group">
                                <label for="customerAddress">شهر</label>
                                <input type="text" class="form-control" name="city" id="customercity" placeholder=" شهر خود را وارد کنید">

                            </div>
                            <div class="form-group">
                                <label for="customerPhone">شماره تماس</label>
                                <input type="text" class="form-control" name="phone" id="customerPhone" placeholder=" شماره تماس خود را وارد کنید">
                            </div>
                            <div class="form-group">
                                <label for="customerPassword"> پسورد</label>
                                <input type="password" class="form-control" name="password" id="customerPassword" placeholder=" پسورد خود را وارد کنید">
                            </div>
                            <div class="form-group">
                                <label for="customerAddress">آدرس خود را وارد کنید</label>
                                <textarea class="form-control" name="address" id="customerAddress" rows="2"
                                    placeholder="آدرس مامور ارسال"></textarea>
                            </div>
                           
                            <button type="submit" class="btn btn-primary">ذخیره مامور</button>
                            <button type="reset" class="btn btn-secondary">بازنشانی</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        </div>
        </div>
@endsection