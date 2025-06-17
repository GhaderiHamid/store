@extends('layouts.admin.master')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 content">
        <h3 class="mt-4 mb-4">پرفروش‌ترین محصولات</h3>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ردیف</th>

                    <th>تصویر محصول</th>
                    <th>نام محصول</th>
                    <th>تعداد فروش</th>
                    <th>مبلغ کل فروش (تومان)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($topProducts as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>

                        <td><img class="card-img-top  rounded" style="width: 100px;height: 100px " src="/{{ $item->product->image_path }}"
                                alt="Product Image"></td>
                                <td>{{ $item->product->name ?? 'محصول حذف شده' }}</td>
                                <td>{{ number_format($item->total_quantity) }}</td>
                        <td>{{ number_format($item->total_sales) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
@endsection