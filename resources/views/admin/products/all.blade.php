@extends('layouts.admin.master')

@section('content')
    <main role="main" class="col-md-9  col-lg-10 px-4 content">
            @include('errors.message')
            <!-- فرم لیست محصولات -->
            <div id="form-list-products">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>لیست محصولات</span>
                        <a href="{{ route('admin.products.create') }}" class="btn btn-success">
                            افزودن محصول جدید
                        </a>
                    </div>
                    <div class="card-body">
                        <form class="form-inline mb-3" method="GET" action="{{ route('admin.product.all') }}">
                            <input type="text" name="query" class="form-control  mr-2" placeholder="جستجو براساس نام محصول"
                                value="{{ request('query') }}">
                                <div class="form-check ">
                                   <div class=""> <input type="checkbox" name="no_stock" value="1" class="form-check-input " id="noStockCheckbox"
                                    {{ request('no_stock') ? 'checked' : '' }}></div>
                                  <div class=""><label class="form-check-label " for="noStockCheckbox">
                                    محصولات ناموجود
                                </label></div>
                                </div>

                            <button type="submit" class="btn btn-primary m-1">جستجو</button>             </form>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped text-center">
                                <thead class="text-center">
                                    <tr>
                                        <th>شناسه</th>
                                        <th>نام محصول</th>
                                        <th>برند</th>
                                        <th>دسته‌بندی</th>
                                        <th>قیمت</th>
                                        <th>تعداد</th>
                                        <th>درصد تخفیف</th>
                                        <th>محدودیت خرید</th>
                                        <th>توضیحات</th>
                                        <th>تاریخ ایجاد</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>
                                                {{-- <img src="/{{ $product->image_path }}" alt=""> --}}
                                                {{ $product->name }}
                                            </td>
                                            <td>{{ $product->brand }}</td>
                                            <td>{{ $product->category->category_name }}</td>
                                            <td>{{number_format($product->price)  }} تومان</td>
                                            <td>{{ $product->quntity }}</td>
                                            <td>{{ $product->discount }}</td>
                                            <td>{{ $product->limited }}</td>
                                            <td>{{ $product->description }}</td>
                                            <td>{{ \Morilog\Jalali\Jalalian::fromCarbon($product->created_at)->format('Y/m/d H:i') }}</td>
                                            <td>
                                                <a href="{{ route('admin.products.edit', $product->id) }}">
                                                    <button class="btn  action-btn btn-info">ویرایش</button>
                                                </a>
                                                <form action="{{ route('admin.products.delete', $product->id) }}" method="post"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn action-btn mt-2 btn-danger">حذف</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $products->appends(['query' => request('query')])->links() }}

                    </div>
                </div>
            </div>
        </main>

        </div>

        </div>
@endsection