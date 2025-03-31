@extends('layouts.admin.master')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 content">

        <!-- فرم سفارش‌های تکمیل شده -->
        <div id="form-completed-orders">
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
                                    <th>وضعيت</th>

                                    <th>كد رهگيري</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($orders as $order)

                                    <tr>
                                        <td> {{ $order->id }}</td>
                                        <td>{{ $order->user->first_name }}{{ $order->user->last_name  }}</td>
                            {{-- <td>{{ $order->statusorder->status_name }}</td> --}}
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->status }}</td>
                                         {{-- <td>{{ $order->statusorder ? $order->statusorder->status_name : 'نامشخص' }}</td>  --}}

                                        {{-- <td>{{ optional($order-> }}</td> --}}
                                        <td>{{ $order->tracking_number  }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-info">مشاهده</button>
                                        </td>
                                    </tr>

                                @endforeach 


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </main>
    </div>
    </div>
@endsection