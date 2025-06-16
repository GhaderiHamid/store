@extends('layouts.admin.master')

@section('content')


        @extends('layouts.admin.master')

    @section('content')
        <!-- فرم افزودن دسته‌بندی -->

        <main role="main" class="col-md-9  col-lg-10 px-4 content">

            <div id="form-add-category">

                <div class="card">

                    <div class="card-header">بروزرسانی دسته‌بندی</div>
                    @include('errors.message')
                    <div class="card-body">

                        <form method="post" action="{{ route('admin.categories.update', $category->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input type="hidden" name="category_id" value="{{ $category->id}}">
                            <div class="form-group">
                                <label for="categoryName">نام دسته‌بندی</label>
                                <input type="text" class="form-control" id="categoryName"
                                    placeholder="نام دسته‌بندی را وارد کنید" name="category_name" value="{{ $category->category_name }}">
                            </div>
                            {{-- <div class="form-group">
                                    <label for="categoryDescription">توضیحات</label>
                                    <textarea class="form-control" id="categoryDescription" rows="2"
                                        placeholder="توضیحات دسته‌بندی"></textarea>
                                </div> --}}
                                <div class="form-group">
                                    <label for="categoryImage">تصویر </label>
                                    <input type="file" class="form-control-file" name="image_path" id="categoryImage">
                                </div>
                                <img src="/{{ $category->image_path}}" alt="" width="100px" height="100px">
                            <button type="submit" class="btn btn-primary"> بروزرسانی </button>
                            <button type="reset" class="btn btn-secondary">بازنشانی</button>
                        </form>
                    </div>
                </div>
            </div>

        </main>
        </div>
        </div>
    @endsection

@endsection
