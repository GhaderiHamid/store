@extends('layouts.admin.master')

@section('content')
@php
    $test=0;
@endphp
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
                                            <label for="tracking_code" class="col-sm-3 col-form-label">شناسه پرداخت</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="tracking_code" id="tracking_code" class="form-control"
                                                    value="{{ $order->payment->transaction }}" readonly>
                                            </div>
                                        </div>
                                        @if ($order->status === 'processing' || $order->status === 'shipped')
                                            <div class="form-group row">
                                                <label for="tracking_code" class="col-sm-3 col-form-label">انتخاب مامور ارسال</label>
                                                <div class="col-sm-9">
                                                    <select name="send_shipper" class="form-control">
                                                        <option value="" disabled @if(is_null($order->send_shipper)) selected @endif>--
                                                            انتخاب مامور ارسال --</option>

                                                        @foreach($shippers as $shipper)
                                                            @if($shipper->city == $order->user->city)
                                                                <option value="{{ $shipper->id }}" @if($shipper->id == $order->send_shipper)
                                                                selected @endif>
                                                                    {{ $shipper->first_name }} {{ $shipper->last_name }} (تعداد ارسال:
                                                                    {{ $shipper->send_orders }}</> سفارش *** تعداد بازگشت:
                                                                    {{ $shipper->receive_orders }} سفارش)

                                                                </option>
                                                            @endif
                                                        @endforeach

                                                    </select>
                                                </div>

                                            </div>
                                        @endif
                                        @if ($order->status === 'return_requested')
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">تایید بازگشت</label>
                                                <div class="col-sm-9">
                                                    <input class="d-inline-block" type="radio" name="yes" id="yes" value="yes">
                                                    <label class="d-inline-block" for="yes">تایید</label>
                                                    <input class="d-inline-block" type="radio" name="yes" id="no" value="no"> 
                                                    <label  class="d-inline-block" for="no"> عدم تایید</label>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($order->status === 'return_requested' || ($order->status === 'return_in_progress'))
                                            <div class="form-group row" id="d">
                                                <label  for="tracking_code" class="col-sm-3 col-form-label ">انتخاب مامور بازگشت</label>
                                                <div class="col-sm-9">
                                                    <select name="receive_shipper" class="form-control" >
                                                        <option value="" disabled @if(is_null($order->receive_shipper)) selected @endif>--
                                                            انتخاب مامور بازگشت --</option>

                                                        @foreach($shippers as $shipper)
                                                            @if($shipper->city == $order->user->city)
                                                                <option value="{{ $shipper->id }}" @if($shipper->id == $order->receive_shipper) selected @endif>
                                                                    {{ $shipper->first_name }} {{ $shipper->last_name }} (تعداد ارسال:
                                                                    {{ $shipper->send_orders }}</> سفارش *** تعداد بازگشت:
                                                                    {{ $shipper->receive_orders }} سفارش)

                                                                </option>
                                                            @endif
                                                        @endforeach

                                                    </select>
                                                </div>

                                            </div>
                                        @endif





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
                                    @if ($order->send_shipper != null)
                                        <p><strong>مامور ارسال:</strong> {{ $order->sendShipper->first_name }}
                                            {{ $order->sendShipper->last_name }}</p>

                                    @endif
                                    @if ($order->receive_shipper != null)
                                        <p><strong>مامور بازگشت:</strong> {{ $order->receiveShipper->first_name }}
                                            {{ $order->receiveShipper->last_name }}
                                        </p>

                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            </div>

            </div>
    <script>
        // function toggle(){
        //     const radioButton=document.getElementById('no');
        //     const radioButton2 = document.getElementById('yes');
        //     const divTo=document.getElementById('d');
        //     if(radioButton.checked){
        //         divTo.style.display='none';

        //     }
        //     else{
        //         divTo.style.display='block';
        //     }
        // }
        document.addEventListener('DOMContentLoaded',function(){
            const radioButton=document.getElementById('no');
            const radioButton2 = document.getElementById('yes');
            const divTo = document.getElementById('d');
            function uptogle(){
                if (radioButton.checked) {
                    divTo.style.display='none';
                    $test=1;

                }
                else{
                  divTo.style.display='flex';
                   $test=0;
                }
                console.log($test)
            }
            radioButton.addEventListener('change',uptogle);
            radioButton2.addEventListener('change', uptogle);
            uptogle();
        });


    </script>

@endsection