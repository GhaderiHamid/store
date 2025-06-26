@extends('layouts.frontend.master')

@section('content')

<title>  درخواست مرجوعی کالا</title>
    <div class="container custom-container mt-5" >
        <h4 class="mb-4">درخواست مرجوعی برای سفارش شماره {{ $order->id }}</h4>

        <form id="returnForm" class="card card-body" >

            @csrf



            <div class="table-responsive  rounded">
                <table class="table table-bordered table-striped ">
                    <thead class="table-secondary">
                        <tr >
                            <th class="text-center" style="border: solid 2px;border-color: #b59fff">تصویرمحصول</th>
                            <th class="text-center" style="border: solid 2px;border-color: #b59fff">محصول</th>
                            <th class="text-center" style="border: solid 2px;border-color: #b59fff">تعداد خریداری‌ شده</th>
                            <th class="text-center" style="border: solid 2px;border-color: #b59fff">تعداد مرجوعی</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->order_detail as $detail)
                            @if($detail->status === 'delivered' || $detail->status === 'return_requested')
                                <tr  style="border: solid 2px;border-color: #b59fff">
                                    <td class="text-center"><img class="card-img-top  rounded" style="width: 100px;height: 100px" src="/{{ $detail->product->image_path }}"
                                            alt="Product Image" style="border: solid 2px;border-color: #b59fff"></td>
                                    <td class="text-center" style="border: solid 2px;border-color: #b59fff">{{ $detail->product->name }}</td>
                                    <td class="text-center" style="border: solid 2px;border-color: #b59fff">{{ $detail->quantity }}</td>
                                    <td style="width: 140px;" style="border: solid 2px;border-color: #b59fff">
                                        <input type="number" name="items[{{ $detail->id }}][return_quantity]" min="0"
                                            max="{{ $detail->quantity }}" value="0"  class="form-control text-center" />
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="my-3">
                <h4 for="reason" class="form-label text-dark">دلیل مرجوعی:</h4>

                <textarea name="reason" id="reason" class="form-control border border-primary mt-3" rows="3" placeholder="مثلاً: محصول آسیب‌دیده بود"
                    required></textarea>
            </div>
            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-danger btn-lg ms-auto">
                    <i class="bi bi-arrow-repeat me-2"></i>ثبت درخواست 
                </button>      </div>

        </form>

        </div>

        <script>
            document.getElementById('returnForm').addEventListener('submit', function (e) {
                e.preventDefault();

                let form = this;
                let data = new FormData(form);

                fetch("{{ route('user.return.submit', $order->id) }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                    },
                    body: data
                })
                    .then(res => res.json())
                    .then(data => {
                        alert(data.message);
                        form.reset();
                    })
                    .catch(err => alert("خطا در ارسال درخواست."));
            });
        </script>


    </div>
@endsection