@extends('layouts.admin.master')

@section('content')
<main role="main" class="col-md-9 col-lg-10 px-4 content">
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
                        <form method="POST" action="{{ route('admin.orders.update', $order) }}" id="orderForm">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">وضعیت فعلی</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ $statusLabels[$order->status] }}" readonly>
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
                                    <label for="send_shipper" class="col-sm-3 col-form-label">انتخاب مامور ارسال</label>
                                    <div class="col-sm-9">
                                        <select name="send_shipper" class="form-control" required>
                                            <option value="" disabled @if(is_null($order->send_shipper)) selected @endif>
                                                -- انتخاب مامور ارسال --
                                            </option>
                                            @foreach($shippers as $shipper)
                                                @if($shipper->city == $order->user->city)
                                                    <option value="{{ $shipper->id }}" @if($shipper->id == $order->send_shipper) selected @endif>
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
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="return_approval" id="yes" value="yes" 
                                                @if(old('return_approval', 'yes') === 'yes') checked @endif required>
                                            <label class="form-check-label" for="yes">تایید</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="return_approval" id="no" value="no"
                                                @if(old('return_approval') === 'no') checked @endif>
                                            <label class="form-check-label" for="no">عدم تایید</label>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($order->status === 'return_requested' || $order->status === 'return_in_progress')
                                <div class="form-group row return-shipper-container">
                                    <label for="receive_shipper" class="col-sm-3 col-form-label">انتخاب مامور بازگشت</label>
                                    <div class="col-sm-9">
                                        <select name="receive_shipper" id="receive_shipper" class="form-control">
                                            <option value="" @if(is_null($order->receive_shipper)) selected @endif>
                                                -- انتخاب مامور بازگشت --
                                            </option>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const noRadio = document.getElementById('no');
    const yesRadio = document.getElementById('yes');
    const returnShipperContainer = document.querySelector('.return-shipper-container');
    const receiveShipperSelect = document.getElementById('receive_shipper');
    const orderForm = document.getElementById('orderForm');

    function toggleReturnShipper() {
        if (noRadio && noRadio.checked) {
            returnShipperContainer.style.display = 'none';
            if (receiveShipperSelect) {
                receiveShipperSelect.value = '';
                receiveShipperSelect.removeAttribute('required');
            }
        } else {
            returnShipperContainer.style.display = 'flex';
            if (receiveShipperSelect) {
                receiveShipperSelect.setAttribute('required', 'required');
            }
        }
    }

    // Add event listeners if radio buttons exist
    if (noRadio && yesRadio) {
        noRadio.addEventListener('change', toggleReturnShipper);
        yesRadio.addEventListener('change', toggleReturnShipper);
        
        // Initialize on page load
        toggleReturnShipper();
    }

    // Handle form submission
    if (orderForm) {
        orderForm.addEventListener('submit', function() {
            if (noRadio && noRadio.checked && receiveShipperSelect) {
                receiveShipperSelect.disabled = false;
                receiveShipperSelect.value = '';
            }
        });
    }
});
</script>
@endsection

