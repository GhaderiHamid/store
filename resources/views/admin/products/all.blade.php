@extends('layouts.admin.master')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 content">
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
                    <form class="form-inline mb-3">
                        <input type="text" class="form-control w-25 mr-2" placeholder="جستجو بر اساس نام محصول">
                        <button type="submit" class="btn btn-primary">جستجو</button>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center">
                            <thead class="text-center">
                                <tr>
                                    <th>شناسه</th>
                                    <th>نام محصول</th>
                                    <th>برند</th>
                                    <th>دسته‌بندی</th>
                                    <th>قیمت</th>
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
                                        <td>{{ $product->price }} تومان</td>
                                        <td>{{ $product->description }}</td>
                                        <td>{{ $product->created_at }}</td>
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
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection