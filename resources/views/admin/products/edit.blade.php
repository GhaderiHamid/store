@extends('layouts.admin.master')

@section('content')
<title> ویرایش محصول</title>
    <main role="main" class="col-md-9  col-lg-10 px-4 content">

            <!-- فرم افزودن محصول -->
            <div id="form-add-product">
                <div class="card">
                    <div class="card-header">بروزرسانی محصول </div>
                    @include('errors.message')
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="productName">نام محصول</label>
                                <input type="text" class="form-control" name="name" id="productName"
                                    placeholder="نام محصول را وارد کنید" value="{{ $product->name }}">
                            </div>
                            <div class="form-group">
                                <label for="productBrand"> برند</label>
                                <input type="text" class="form-control" name="brand" id="productBrand" placeholder="برند محصول " value="{{ $product->brand }}">
                                </div>
                            <div class="form-group">
                                <label for="productCategory">دسته‌بندی</label>
                                <select class="form-control" name="category_id" id="productCategory">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->category_name }} </option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="productPrice">قیمت</label>
                                <input type="number" class="form-control" name="price" id="productPrice"
                                    placeholder="قیمت محصول" value="{{ $product->price  }}">
                            </div>
                            <div class="form-group">
                                <label for="productQuantity">تعداد</label>
                                <input type="number" class="form-control" name="quntity" id="productQuantity" placeholder="تعداد" value="{{ $product->quntity }}">
                            </div>
                            <div class="form-group">
                                <label for="productDiscount">درصد تخفیف</label>
                                <input type="number" class="form-control" name="discount" id="productDiscount" placeholder="درصد" value="{{ $product->discount }}" min="0"
                                    max="80" >
                            </div>
                            <div class="form-group">
                                <label for="productLimited"> محدودیت خرید</label>
                                <input type="number" class="form-control" name="limited" id="productLimited" placeholder="تعداد محدودیت" value="{{ $product->limited }}">
                                </div>
                            <div class="form-group">
                                <label for="productDescription">توضیحات</label>
                                <textarea class="form-control" name="description" id="productDescription" rows="3"
                                    placeholder="توضیحات محصول" >{{ $product->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="productImage">تصویر محصول</label>
                                <input type="file" class="form-control-file" name="image_path" id="productImage">
                            </div>
                            <img src="/{{ $product->image_path}}" alt="" width="100px" height="100px">
                            <button type="submit" class="btn btn-primary">بروزرسانی محصول</button>
                            <button type="reset" class="btn btn-secondary">بازنشانی</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        </div>
        </div>
@endsection