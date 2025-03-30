@extends('layouts.admin.master')

@section('content')
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 content">

            <!-- فرم افزودن مشتری جدید -->
            <div id="form-add-customer" >
                <div class="card">
                    <div class="card-header">افزودن کاربر جدید</div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="customerName">نام و نام خانوادگی</label>
                                <input type="text" class="form-control" id="customerName" placeholder="نام مشتری را وارد کنید">
                            </div>
                            <div class="form-group">
                                <label for="customerEmail">ایمیل</label>
                                <input type="email" class="form-control" id="customerEmail" placeholder="ایمیل مشتری">
                            </div>
                            <div class="form-group">
                                <label for="customerPhone">شماره تماس</label>
                                <input type="text" class="form-control" id="customerPhone" placeholder="شماره تماس">
                            </div>
                            <div class="form-group">
                                <label for="customerAddress">آدرس</label>
                                <textarea class="form-control" id="customerAddress" rows="2" placeholder="آدرس مشتری"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">ذخیره کاربر</button>
                            <button type="reset" class="btn btn-secondary">بازنشانی</button>
                        </form>
                    </div>
                </div>
            </div>
    </main>
    </div>
    </div>
@endsection