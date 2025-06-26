@extends('layouts.admin.master')

@section('content')
<title> جزئیات سفارش</title>
        <main role="main" class="col-md-9  col-lg-10 px-4 content">
        <div class="container-fluid">
                <div class="row mb-3">
                    <div class="col-12">
                        <h2 class="page-title">جزئیات سفارش #{{ $order->id }}</h2>
                        <a href="{{ route('admin.orders.all') }}" class="btn btn-sm btn-primary text-white">
                            <i class="fas fa-arrow-right"></i> بازگشت به لیست سفارشات
                        </a>
                        <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-sm btn-warning text-white">
                            <i class="fas fa-arrow-right"></i>ویرایش سفارش
                        </a>
                    </div>
                </div>

                <div class="row">
                    <!-- اطلاعات سفارش -->
                    <div class="col-md-6">
                        <div class="card shadow mb-4">
                            <div class="card-header bg-primary text-white">
                                <h6 class="m-0 font-weight-bold">اطلاعات سفارش</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>شماره سفارش:</strong> {{ $order->id }}</p>
                                        <p><strong>تاریخ سفارش:</strong>
                                            {{ \Morilog\Jalali\Jalalian::fromCarbon($order->created_at)->format('Y/m/d H:i') }}</p>
                                        <p><strong>وضعیت:</strong>
                                            <span>
                                                {{ $statusLabels[$order->status] ?? $order->status }}
                                            </span>
                                        </p>
                                        @if ($order->send_shipper != null)
                                            <p><strong>مامور ارسال:</strong> {{ $order->sendShipper->first_name }} {{ $order->sendShipper->last_name }}</p>

                                        @endif
                                        @if ($order->receive_shipper != null)
                                            <p><strong>مامور بازگشت:</strong> {{ $order->receiveShipper->first_name }} {{ $order->receiveShipper->last_name }}</p>

                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>مبلغ کل:</strong> {{ number_format($order->payment->amount) }} تومان</p>

                                    </div>
                                    <div class="col-md-12">
                                    @if ($order->status === 'return_requested'||$order->status === 'returned'||$order->status==='return_rejected'||$order->status==='return_in_progress')
                                        <p><strong>علت مرجوعی:</strong>
                                            <span>
                                                {{ $order->return_note }}
                                            </span>
                                        </p>
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- اطلاعات مشتری -->
                    <div class="col-md-6">
                        <div class="card shadow mb-4">
                            <div class="card-header bg-info text-white">
                                <h6 class="m-0 font-weight-bold">اطلاعات مشتری</h6>
                            </div>
                            <div class="card-body">
                                <p><strong>نام:</strong> {{ $order->user->first_name }} {{ $order->user->last_name }}</p>
                                <p><strong>تلفن:</strong> {{ $order->user->phone }}</p>
                                <p><strong>ایمیل:</strong> {{ $order->user->email }}</p>
                                <p><strong>شهر:</strong> {{ $order->user->city }}</p>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- آیتم های سفارش -->
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow mb-4">
                            <div class="card-header bg-secondary text-white">
                                <h6 class="m-0 font-weight-bold">محصولات سفارش</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="text-center">
                                                <th>شناسه محصول</th>
                                                <th>تصویرمحصول</th>
                                                <th>نام محصول</th>
                                                <th>تعداد</th>
                                                @if ($order->status === 'return_requested'||$order->status === 'returned'||$order->status==='return_in_progress')
                                                <th class="text-white bg-danger">تعداد مرجوعی</th>
                                               @endif
                                                <th>قیمت واحد</th>
                                                <th>درصد تخفیف</th>
                                                <th>قیمت کل</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($order->order_detail as $detail)
                                                <tr class="text-center">
                                                    <td>{{ $detail->product->id }}</td>
                                                    <td><img class="card-img-top  rounded" style="width: 100px;height: 100px " src="/{{ $detail->product->image_path }}"
                                                        alt="Product Image"></td>
                                                    <td>{{ $detail->product->name }}</td>
                                                    <td >{{ $detail->quantity }}</td>
                                                    @if ($order->status === 'return_requested'||$order->status === 'returned'||$order->status==='return_in_progress')
                                               <td>{{ $detail->return_quantity?!null:0 }}</td>
                                               @endif
                                                   
                                                    <td>{{ number_format($detail->price) }} تومان</td>
                                                    <td>{{ $detail->discount }}</td>
                                                    <td>{{ number_format($detail->price - ($detail->price * $detail->discount) / 100) }} تومان</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    </div>

@endsection