@extends('layouts.admin.master')

@section('content')
    <!-- ناحیه محتوای اصلی -->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 content">

    <!-- داشبورد (نمایش پیش‌فرض) -->
    <div id="dashboard">
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <span class="navbar-brand">داشبورد اصلی</span>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">اعلان‌ها</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">پروفایل کاربر</a>
                </li>
            </ul>
        </nav>
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card text-white bg-info">
                    <div class="card-body text-center">
                        <h5 class="card-title">فروش کل</h5>
                        <p class="card-text">123,456 تومان</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-white bg-success">
                    <div class="card-body text-center">
                        <h5 class="card-title">سفارش‌های جدید</h5>
                        <p class="card-text">34</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-white bg-warning">
                    <div class="card-body text-center">
                        <h5 class="card-title">مشتریان فعال</h5>
                        <p class="card-text">78</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-white bg-danger">
                    <div class="card-body text-center">
                        <h5 class="card-title">سفارش در انتظار</h5>
                        <p class="card-text">12</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header">
                گزارش‌های فروش
            </div>
            <div class="card-body">
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </div>

    {{-- <!-- فرم افزودن دسته‌بندی -->
    <div id="form-add-category" class="d-none" >

        <div class="card">

            <div class="card-header">افزودن دسته‌بندی</div>
            @if (session('failed'))
                <div class="alert alert-danger">
                    {{ session('failed') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success ">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card-body">

                <form method="post" action="{{ route('admin.categories.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="categoryName">نام دسته‌بندی</label>
                        <input type="text" class="form-control" id="categoryName"
                            placeholder="نام دسته‌بندی را وارد کنید" name="category_name">
                    </div>
                    <div class="form-group">
                        <label for="categoryDescription">توضیحات</label>
                        <textarea class="form-control" id="categoryDescription" rows="2" placeholder="توضیحات دسته‌بندی"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">ذخیره دسته‌بندی</button>
                    <button type="reset" class="btn btn-secondary">بازنشانی</button>
                </form>
            </div>
        </div>
    </div> --}}

    {{--
    <!-- فرم افزودن محصول -->
    <div id="form-add-product" class="d-none">
    <div class="card">
      <div class="card-header">افزودن محصول جدید</div>
      <div class="card-body">
      <form>
        <div class="form-group">
        <label for="productName">نام محصول</label>
        <input type="text" class="form-control" id="productName" placeholder="نام محصول را وارد کنید">
        </div>
        <div class="form-group">
        <label for="productCategory">دسته‌بندی</label>
        <select class="form-control" id="productCategory">
          <option>کامپیوتر دسکتاپ</option>
          <option>لپ‌تاپ</option>
          <option>قطعات جانبی</option>
        </select>
        </div>
        <div class="form-group">
        <label for="productPrice">قیمت</label>
        <input type="number" class="form-control" id="productPrice" placeholder="قیمت محصول">
        </div>
        <div class="form-group">
        <label for="productDescription">توضیحات</label>
        <textarea class="form-control" id="productDescription" rows="3" placeholder="توضیحات محصول"></textarea>
        </div>
        <div class="form-group">
        <label for="productImage">تصویر محصول</label>
        <input type="file" class="form-control-file" id="productImage">
        </div>
        <button type="submit" class="btn btn-primary">ذخیره محصول</button>
        <button type="reset" class="btn btn-secondary">بازنشانی</button>
      </form>
      </div>
    </div>
    </div>

    <!-- فرم لیست محصولات -->
    <div id="form-list-products" class="d-none">
    <div class="card">
      <div class="card-header">لیست محصولات</div>
      <div class="card-body">
      <form class="form-inline mb-3">
        <input type="text" class="form-control mr-2" placeholder="جستجو بر اساس نام محصول">
        <button type="submit" class="btn btn-primary">جستجو</button>
      </form>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
        <thead>
          <tr>
          <th>شناسه</th>
          <th>نام محصول</th>
          <th>دسته‌بندی</th>
          <th>قیمت</th>
          <th>عملیات</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <td>1</td>
          <td>کامپیوتر دسکتاپ</td>
          <td>کامپیوتر</td>
          <td>10,000,000 تومان</td>
          <td>
            <button class="btn btn-sm btn-info">ویرایش</button>
            <button class="btn btn-sm btn-danger">حذف</button>
          </td>
          </tr>
        </tbody>
        </table>
      </div>
      </div>
    </div>
    </div>

    <!-- فرم دسته‌بندی محصولات (لیست دسته‌بندی‌ها) -->
    <div id="form-product-categories" class="d-none">
    <div class="card">
      <div class="card-header">دسته‌بندی محصولات</div>
      <div class="card-body">
      <form class="form-inline mb-3">
        <input type="text" class="form-control mr-2" placeholder="جستجو بر اساس نام دسته‌بندی">
        <button type="submit" class="btn btn-primary">جستجو</button>
      </form>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
        <thead>
          <tr>
          <th>شناسه</th>
          <th>نام دسته‌بندی</th>
          <th>توضیحات</th>
          <th>عملیات</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <td>1</td>
          <td>کامپیوتر</td>
          <td>دسته‌بندی مربوط به کامپیوتر‌ها</td>
          <td>
            <button class="btn btn-sm btn-info">ویرایش</button>
            <button class="btn btn-sm btn-danger">حذف</button>
          </td>
          </tr>
        </tbody>
        </table>
      </div>
      </div>
    </div>
    </div>

    <!-- فرم سفارش‌های جدید -->
    <div id="form-new-orders" class="d-none">
    <div class="card">
      <div class="card-header">سفارش‌های جدید</div>
      <div class="card-body">
      <form class="form-inline mb-3">
        <input type="text" class="form-control mr-2" placeholder="جستجو بر اساس شماره سفارش">
        <input type="date" class="form-control mr-2">
        <button type="submit" class="btn btn-primary">فیلتر</button>
      </form>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
        <thead>
          <tr>
          <th>شناسه سفارش</th>
          <th>نام مشتری</th>
          <th>تاریخ سفارش</th>
          <th>عملیات</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <td>1001</td>
          <td>علی رضایی</td>
          <td>1402/01/10</td>
          <td>
            <button class="btn btn-sm btn-info">مشاهده</button>
            <button class="btn btn-sm btn-success">تأیید</button>
            <button class="btn btn-sm btn-danger">حذف</button>
          </td>
          </tr>
        </tbody>
        </table>
      </div>
      </div>
    </div>
    </div>

    <!-- فرم سفارش‌های در حال پردازش -->
    <div id="form-processing-orders" class="d-none">
    <div class="card">
      <div class="card-header">سفارش‌های در حال پردازش</div>
      <div class="card-body">
      <form class="form-inline mb-3">
        <input type="text" class="form-control mr-2" placeholder="جستجو بر اساس شماره سفارش">
        <input type="date" class="form-control mr-2">
        <button type="submit" class="btn btn-primary">فیلتر</button>
      </form>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
        <thead>
          <tr>
          <th>شناسه سفارش</th>
          <th>نام مشتری</th>
          <th>تاریخ سفارش</th>
          <th>وضعیت</th>
          <th>عملیات</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <td>1002</td>
          <td>سارا محمدی</td>
          <td>1402/01/11</td>
          <td>در حال پردازش</td>
          <td>
            <button class="btn btn-sm btn-info">مشاهده</button>
            <button class="btn btn-sm btn-success">ادامه</button>
          </td>
          </tr>
        </tbody>
        </table>
      </div>
      </div>
    </div>
    </div>

    <!-- فرم سفارش‌های تکمیل شده -->
    <div id="form-completed-orders" class="d-none">
    <div class="card">
      <div class="card-header">سفارش‌های تکمیل شده</div>
      <div class="card-body">
      <form class="form-inline mb-3">
        <input type="text" class="form-control mr-2" placeholder="جستجو بر اساس شماره سفارش">
        <input type="date" class="form-control mr-2">
        <button type="submit" class="btn btn-primary">فیلتر</button>
      </form>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
        <thead>
          <tr>
          <th>شناسه سفارش</th>
          <th>نام مشتری</th>
          <th>تاریخ سفارش</th>
          <th>عملیات</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <td>1003</td>
          <td>مهدی حسینی</td>
          <td>1402/01/12</td>
          <td>
            <button class="btn btn-sm btn-info">مشاهده</button>
          </td>
          </tr>
        </tbody>
        </table>
      </div>
      </div>
    </div>
    </div>

    <!-- فرم افزودن مشتری جدید -->
    <div id="form-add-customer" class="d-none">
    <div class="card">
      <div class="card-header">افزودن مشتری جدید</div>
      <div class="card-body">
      <form>
        <div class="form-group">
        <label for="customerName">نام مشتری</label>
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
        <button type="submit" class="btn btn-primary">ذخیره مشتری</button>
        <button type="reset" class="btn btn-secondary">بازنشانی</button>
      </form>
      </div>
    </div>
    </div>

    <!-- فرم لیست مشتریان -->
    <div id="form-customer-list" class="d-none">
    <div class="card">
      <div class="card-header">لیست مشتریان</div>
      <div class="card-body">
      <form class="form-inline mb-3">
        <input type="text" class="form-control mr-2" placeholder="جستجو بر اساس نام مشتری">
        <button type="submit" class="btn btn-primary">جستجو</button>
      </form>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
        <thead>
          <tr>
          <th>شناسه</th>
          <th>نام مشتری</th>
          <th>ایمیل</th>
          <th>شماره تماس</th>
          <th>عملیات</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <td>1</td>
          <td>علی رضایی</td>
          <td>ali@example.com</td>
          <td>09123456789</td>
          <td>
            <button class="btn btn-sm btn-info">ویرایش</button>
            <button class="btn btn-sm btn-danger">حذف</button>
          </td>
          </tr>
        </tbody>
        </table>
      </div>
      </div>
    </div>
    </div>



    {{--
    <!-- فرم لیست دسته‌بندی‌ها -->
    <div id="form-category-list" class="d-none">
    <div class="card">
      <div class="card-header">لیست دسته‌بندی‌ها</div>
      <div class="card-body">
      <form class="form-inline mb-3">
        <input type="text" class="form-control mr-2" placeholder="جستجو بر اساس نام دسته‌بندی">
        <button type="submit" class="btn btn-primary">جستجو</button>
      </form>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
        <thead>
          <tr>
          <th>شناسه</th>
          <th>نام دسته‌بندی</th>
          <th>توضیحات</th>
          <th>عملیات</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <td>1</td>
          <td>کامپیوتر</td>
          <td>دسته‌بندی مربوط به کامپیوتر‌ها</td>
          <td>
            <button class="btn btn-sm btn-info">ویرایش</button>
            <button class="btn btn-sm btn-danger">حذف</button>
          </td>
          </tr>
        </tbody>
        </table>
      </div>
      </div>
    </div>
    </div>

    <!-- فرم ایجاد کوپن تخفیف -->
    <div id="form-add-coupon" class="d-none">
    <div class="card">
      <div class="card-header">ایجاد کوپن تخفیف</div>
      <div class="card-body">
      <form>
        <div class="form-group">
        <label for="couponCode">کد کوپن</label>
        <input type="text" class="form-control" id="couponCode" placeholder="کد کوپن را وارد کنید">
        </div>
        <div class="form-group">
        <label for="couponDiscount">درصد تخفیف</label>
        <input type="number" class="form-control" id="couponDiscount" placeholder="درصد تخفیف">
        </div>
        <div class="form-group">
        <label for="couponExpiry">تاریخ انقضا</label>
        <input type="date" class="form-control" id="couponExpiry">
        </div>
        <div class="form-group">
        <label for="couponDescription">توضیحات</label>
        <textarea class="form-control" id="couponDescription" rows="2" placeholder="توضیحات کوپن"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">ایجاد کوپن</button>
        <button type="reset" class="btn btn-secondary">بازنشانی</button>
      </form>
      </div>
    </div>
    </div>

    <!-- فرم تخفیف‌های فعال -->
    <div id="form-active-discounts" class="d-none">
    <div class="card">
      <div class="card-header">تخفیف‌های فعال</div>
      <div class="card-body">
      <form class="form-inline mb-3">
        <input type="text" class="form-control mr-2" placeholder="جستجو بر اساس کد تخفیف">
        <button type="submit" class="btn btn-primary">جستجو</button>
      </form>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
        <thead>
          <tr>
          <th>شناسه</th>
          <th>کد تخفیف</th>
          <th>درصد تخفیف</th>
          <th>تاریخ انقضا</th>
          <th>عملیات</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <td>1</td>
          <td>SAVE10</td>
          <td>10%</td>
          <td>1402/02/01</td>
          <td>
            <button class="btn btn-sm btn-info">ویرایش</button>
            <button class="btn btn-sm btn-danger">حذف</button>
          </td>
          </tr>
        </tbody>
        </table>
      </div>
      </div>
    </div>
    </div>

    <!-- فرم افزودن کاربر جدید -->
    <div id="form-add-user" class="d-none">
    <div class="card">
      <div class="card-header">افزودن کاربر جدید</div>
      <div class="card-body">
      <form>
        <div class="form-group">
        <label for="userName">نام کاربر</label>
        <input type="text" class="form-control" id="userName" placeholder="نام کاربر">
        </div>
        <div class="form-group">
        <label for="userEmail">ایمیل</label>
        <input type="email" class="form-control" id="userEmail" placeholder="ایمیل کاربر">
        </div>
        <div class="form-group">
        <label for="userRole">سطح دسترسی</label>
        <select class="form-control" id="userRole">
          <option>مدیر</option>
          <option>کاربر عادی</option>
        </select>
        </div>
        <div class="form-group">
        <label for="userPassword">رمز عبور</label>
        <input type="password" class="form-control" id="userPassword" placeholder="رمز عبور">
        </div>
        <div class="form-group">
        <label for="userConfirmPassword">تکرار رمز عبور</label>
        <input type="password" class="form-control" id="userConfirmPassword" placeholder="تکرار رمز عبور">
        </div>
        <button type="submit" class="btn btn-primary">ذخیره کاربر</button>
        <button type="reset" class="btn btn-secondary">بازنشانی</button>
      </form>
      </div>
    </div>
    </div>

    <!-- فرم لیست کاربران -->
    <div id="form-user-list" class="d-none">
    <div class="card">
      <div class="card-header">لیست کاربران</div>
      <div class="card-body">
      <form class="form-inline mb-3">
        <input type="text" class="form-control mr-2" placeholder="جستجو بر اساس نام کاربر">
        <button type="submit" class="btn btn-primary">جستجو</button>
      </form>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
        <thead>
          <tr>
          <th>شناسه</th>
          <th>نام کاربر</th>
          <th>ایمیل</th>
          <th>نقش</th>
          <th>عملیات</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <td>1</td>
          <td>مجتبی حسینی</td>
          <td>mojtaba@example.com</td>
          <td>مدیر</td>
          <td>
            <button class="btn btn-sm btn-info">ویرایش</button>
            <button class="btn btn-sm btn-danger">حذف</button>
          </td>
          </tr>
        </tbody>
        </table>
      </div>
      </div>
    </div>
    </div>

    <!-- فرم گزارش فروش -->
    <div id="form-sales-report" class="d-none">
    <div class="card">
      <div class="card-header">گزارش فروش</div>
      <div class="card-body">
      <form class="form-inline mb-3">
        <label class="mr-2">تاریخ شروع:</label>
        <input type="date" class="form-control mr-2">
        <label class="mr-2">تاریخ پایان:</label>
        <input type="date" class="form-control mr-2">
        <button type="submit" class="btn btn-primary">نمایش گزارش</button>
      </form>
      <canvas id="salesReportChart"></canvas>
      </div>
    </div>
    </div>

    <!-- فرم گزارش مشتریان -->
    <div id="form-customer-report" class="d-none">
    <div class="card">
      <div class="card-header">گزارش مشتریان</div>
      <div class="card-body">
      <form class="form-inline mb-3">
        <input type="text" class="form-control mr-2" placeholder="نام مشتری یا ایمیل">
        <button type="submit" class="btn btn-primary">جستجو</button>
      </form>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
        <thead>
          <tr>
          <th>شناسه</th>
          <th>نام مشتری</th>
          <th>ایمیل</th>
          <th>تعداد سفارش‌ها</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <td>1</td>
          <td>علی رضایی</td>
          <td>ali@example.com</td>
          <td>5</td>
          </tr>
        </tbody>
        </table>
      </div>
      </div>
    </div>
    </div>

    <!-- فرم گزارش سفارش‌ها -->
    <div id="form-order-report" class="d-none">
    <div class="card">
      <div class="card-header">گزارش سفارش‌ها</div>
      <div class="card-body">
      <form class="form-inline mb-3">
        <input type="text" class="form-control mr-2" placeholder="شماره سفارش">
        <input type="date" class="form-control mr-2">
        <button type="submit" class="btn btn-primary">جستجو</button>
      </form>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
        <thead>
          <tr>
          <th>شناسه سفارش</th>
          <th>نام مشتری</th>
          <th>تاریخ سفارش</th>
          <th>مبلغ</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <td>1004</td>
          <td>سارا محمدی</td>
          <td>1402/01/15</td>
          <td>500,000 تومان</td>
          </tr>
        </tbody>
        </table>
      </div>
      </div>
    </div>
    </div> --}}

        </main>
   
      </div>
    </div>
    
@endsection
