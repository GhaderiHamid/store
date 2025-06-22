@extends('layouts.admin.master')

@section('content')
    <main role="main" class="col-md-9  col-lg-10 px-4 content">
                <!-- فرم لیست پرداخت‌ها -->
                <div id="form-payment-list" >
                    <div class="card">
                        <div class="card-header">لیست پرداخت‌ها</div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th>شناسه پرداخت</th>
                                            <th>نام مشتری</th>
                                            <th>مبلغ</th>
                                            <th>کد رهگیری</th>
                                            <th>تاریخ پرداخت</th>
                                            <th>وضعیت</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($payments as $payment)
                                            <tr class="text-center">
                                               <td>{{ $payment->id }}</td>
                                               <td>{{ $payment->order->user->first_name }} {{ $payment->order->user->last_name }}</td>
                                               <td>{{ number_format($payment->amount)}} تومان</td>
                                            <td>{{ hexdec($payment->transaction) }}</td>
                                               <td>{{ \Morilog\Jalali\Jalalian::fromCarbon($payment->created_at)->format('Y/m/d H:i')}}</td>
                                            <td class="{{ $payment->status == 'paid' ? 'bg-success' : 'bg-danger' }} text-white" >
                                                {{ $payment->status == 'paid' ? 'پرداخت شده' : 'پرداخت نشده' }}                                       </td>



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