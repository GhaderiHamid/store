@extends('layouts.admin.master')

@section('content')

    <main role="main" class="col-md-9  col-lg-10 px-4 content">
            @include('errors.message')
            <!-- فرم لیست دسته‌بندی‌ها -->
            <div id="form-category-list">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>لیست دسته‌بندی‌ها</span>
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-success">
                            افزودن دسته‌بندی جدید
                        </a>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th class="align-middle">شناسه</th>
                                        <th class="align-middle">نام دسته‌بندی</th>
                                        <th class="align-middle">تاریخ ایجاد</th>
                                        <th class="align-middle">عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td class="align-middle">{{ $category->id }}</td>
                                            <td class="align-middle">{{ $category->category_name }}</td>
                                            <td class="align-middle">{{ \Morilog\Jalali\Jalalian::fromCarbon($category->created_at)->format('Y/m/d H:i')}}</td>
                                            <td class="align-middle">
                                                <a href="{{ route('admin.categories.edit', $category->id) }}"><button
                                                        class="btn action-btn  btn-info">ویرایش</button>
                                                </a>
                                                <form action="{{ route('admin.categories.delete', $category->id) }}" method="post"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn action-btn btn-danger">حذف</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </main>
        </div>
        </div>

@endsection