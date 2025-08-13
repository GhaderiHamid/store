@extends('layouts.admin.master')

@section('content')
<title>لیست پرداخت ها </title>
    <main role="main" class="col-md-9 col-lg-10 px-4 content">
        <div id="form-payment-list">
            <div class="card">
                <div class="card-header">لیست پرداخت‌ها</div>
                <div class="card-body">

                    <!-- فرم فیلتر -->
                    <form class="form-inline mb-3" method="GET" action="{{ route('admin.payments.all') }}">
                        <input type="text" name="search" class="form-control mr-2"
                            placeholder="جستجو بر اساس نام مشتری"
                            value="{{ request('search') }}">

                        <select name="status" class="form-control mr-2">
                            <option value="">همه وضعیت‌ها</option>
                            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>پرداخت شده</option>
                            <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>پرداخت ناموفق</option>
                        </select>

                        <button type="submit" class="btn btn-primary">فیلتر</button>
                    </form>

                    <!-- جدول پرداخت‌ها -->
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
                                @forelse ($payments as $payment)
                                    <tr class="text-center">
                                        <td>{{ $payment->id }}</td>
                                        <td>
                                            @if($payment->user)
                                            {{ $payment->user->first_name }} {{ $payment->user->last_name }}
                                        @else
                                        {{ $payment->order->user->first_name ?? '-' }}
                                        {{ $payment->order->user->last_name ?? '' }}
                                        @endif
                                    
                                           
                                        </td>
                                        <td>{{ number_format($payment->amount) }} تومان</td>
                                        <td>{{ hexdec($payment->transaction) }}</td>
                                        <td>{{ \Morilog\Jalali\Jalalian::fromCarbon($payment->created_at)->format('Y/m/d H:i') }}</td>
                                        <td class="{{ $payment->status == 'paid' ? 'bg-success' : 'bg-danger' }} text-white">
                                            {{ $payment->status == 'paid' ? 'پرداخت شده' : 'پرداخت ناموفق' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">پرداختی یافت نشد.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                         <!-- صفحه‌بندی -->
                    <div class="d-flex justify-content-center">
                        {{ $payments->appends(request()->only(['search', 'status']))->links() }}
                    </div>
                    </div>

                   
                </div>
            </div>
        </div>
    </main>
@endsection