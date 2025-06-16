@extends('layouts.admin.master')

@section('content')
    <main role="main" class="col-md-9  col-lg-10 px-4 content">



            <!-- فرم سفارش‌های تکمیل شده -->
            <div id="form-completed-orders">
                <div class="card">
                    <div class="card-header">سفارش‌های تکمیل شده</div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.orders.all') }}" class="form-inline mb-3">

                            {{-- <input type="date" name="date" class="form-control mr-2"> --}}

                            <select name="status" class="form-control mr-2">
                                <option value="">همه وضعیت‌ها</option>
                                @foreach($statusLabels as $key => $label)
                                    <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>


                            <button type="submit" class="btn btn-primary">فیلتر</button>             </form>

                        <div class="table-responsive d-flex flex-column "> 
                           <div>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>شناسه سفارش</th>
                                        <th>نام مشتری</th>
                                        <th>مبلغ</th>
                                        <th>تاریخ سفارش</th>
                                        <th>وضعيت</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)

                                        <tr>
                                            <td> {{ $order->id }}</td>
                                            <td>{{ $order->user->first_name }} {{ $order->user->last_name  }}</td>
                                            <td>{{ optional($order->payment)->amount ? number_format(optional($order->payment)->amount) : 'بدون پرداخت' }}
                                            </td>
                                            <td>{{ \Morilog\Jalali\Jalalian::fromCarbon($order->created_at)->format('Y/m/d H:i')}}</td>
                                            <td>{{ $statusLabels[$order->status]  }}</td>

                                            <td class="text-center">
                                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-info btn-sm text-white">
                                                    <i class="fas fa-eye"></i> مشاهده جزئیات
                                                </a>
                                                <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-warning btn-sm text-white">
                                                    <i class="fas fa-edit"></i> ویرایش وضعیت
                                                </a>
                                            </td>
                                        </tr>

                                    @endforeach


                                </tbody>

                            </table>
                            <div class="d-flex justify-content-center mt-4">
                                {{ $orders->appends(request()->query())->links() }}                 
                            </div>

                           </div>



                </div>

            </div>

        </main>

        </div>

        </div>


@endsection

