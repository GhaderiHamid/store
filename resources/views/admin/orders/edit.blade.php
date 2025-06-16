@extends('layouts.admin.master')

@section('content')
        <main role="main" class="col-md-9  col-lg-10 px-4 content">
            <div class="container-fluid">
                <div class="row mb-3">
                    <div class="col-12">
                        <h2 class="page-title">ویرایش سفارش #{{ $order->id }}</h2>
                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-right"></i> بازگشت به جزئیات سفارش
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="card shadow mb-4">
                            <div class="card-header bg-warning">
                                <h6 class="m-0 font-weight-bold text-white">ویرایش وضعیت سفارش</h6>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.orders.update', $order) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">وضعیت فعلی</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $statusLabels[$order->status] }}"
                                                readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="status" class="col-sm-3 col-form-label">وضعیت جدید</label>
                                        <div class="col-sm-9">
                                            <select name="status" id="status" class="form-control">
                                                @foreach($statusLabels as $key => $label)
                                                    @if(!in_array($key, ['delivered']))
                                                        <option value="{{ $key }}" {{ $order->status == $key ? 'selected' : '' }}>{{ $label }}</option>
                                                    @endif
                                                @endforeach                                   </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="tracking_code" class="col-sm-3 col-form-label">شناسه پرداخت</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="tracking_code" id="tracking_code" class="form-control"
                                                value="{{ $order->payment->transaction }}" readonly>
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <div class="col-sm-9 offset-sm-3">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save"></i> ذخیره تغییرات
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow mb-4">
                            <div class="card-header bg-info text-white">
                                <h6 class="m-0 font-weight-bold">خلاصه سفارش</h6>
                            </div>
                            <div class="card-body">
                                <p><strong>مشتری:</strong> {{ $order->user->first_name }} {{ $order->user->last_name }}</p>
                                <p><strong>تاریخ سفارش:</strong>
                                    {{ \Morilog\Jalali\Jalalian::fromCarbon($order->created_at)->format('Y/m/d H:i') }}</p>
                                <p><strong>مبلغ کل:</strong> {{ number_format($order->payment->amount) }} تومان</p>
                                {{-- <p><strong>تعداد آیتم‌ها:</strong> {{ $order->items->sum('quantity') }}</p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </div>

    </div>

    
@endsection