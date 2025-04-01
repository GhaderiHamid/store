@extends('layouts.admin.master')

@section('content')
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 content">
            <!-- فرم لیست پرداخت‌ها -->
            <div id="form-payment-list" >
                <div class="card">
                    <div class="card-header">لیست پرداخت‌ها</div>
                    <div class="card-body">
                        <form class="form-inline mb-3">
                            <input type="text" class="form-control mr-2" placeholder="جستجو بر اساس نام مشتری یا شماره پرداخت">
                            <button type="submit" class="btn btn-primary">جستجو</button>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>شناسه پرداخت</th>
                                        <th>نام مشتری</th>
                                        <th>مبلغ</th>
                                        <th>کد رهگیری</th>
                                        <th>تاریخ پرداخت</th>
                                        <th>وضعیت</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td></td>
                                            {{-- <td>{{ $payment->id }}</td>
                                            <td>{{ $payment->order->user->first_name }}{{ $payment->order->user->last_name }} </td>
                                           
                                            {{-- <td>{{ $payment->order_detail->price }}</td> --}}
                                            <td>2000</td>
                                            {{-- <td>{{ $payment->order->tracking_number  }}</td> --}}
                                            <td>{{ $payment->created_at }}</td>
                                            <td>{{ $payment->status }}</td> --}}
                                            <td>
                                                <button class="btn btn-sm btn-info">مشاهده</button>
                                                <button class="btn btn-sm btn-danger">حذف</button>
                                            </td>
                                        </tr>
                                    @endforeach

                                    <!-- می‌توانید ردیف‌های بیشتری به اینجا اضافه کنید -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $payments->links() }}
                    </div>
                </div>
            </div>

    </main>
    </div>
    </div>
@endsection