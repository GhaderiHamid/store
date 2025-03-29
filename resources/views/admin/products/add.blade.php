@extends('layouts.admin.master')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 content">

    <!-- فرم افزودن محصول -->
    <div id="form-add-product" >
        <div class="card">
            <div class="card-header">افزودن محصول جدید</div>
            @include('errors.message')
            <div class="card-body">
                <form method="post" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                    @csrf  
                    <div class="form-group">
                        <label for="productName">نام محصول</label>
                        <input type="text" class="form-control" name="name" id="productName" placeholder="نام محصول را وارد کنید">
                    </div>
                    <div class="form-group">
                        <label for="productCategory">دسته‌بندی</label>
                        <select class="form-control" name="category_id" id="productCategory">
                            @foreach ($categories as $category)
                               <option value="{{ $category->id }}">{{ $category->category_name }} </option> 
                            @endforeach
                          
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="productPrice">قیمت</label>
                        <input type="number" class="form-control" name="price" id="productPrice" placeholder="قیمت محصول">
                    </div>
                    <div class="form-group">
                        <label for="productDescription">توضیحات</label>
                        <textarea class="form-control" name="description" id="productDescription" rows="3"
                            placeholder="توضیحات محصول"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="productImage">تصویر محصول</label>
                        <input type="file" class="form-control-file" name="image_path" id="productImage">
                    </div>
                    <button type="submit" class="btn btn-primary">ذخیره محصول</button>
                    <button type="reset" class="btn btn-secondary">بازنشانی</button>
                </form>
            </div>
        </div>
    </div>
    </main>
    </div>
    </div>  
@endsection