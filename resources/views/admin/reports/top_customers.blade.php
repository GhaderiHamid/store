@extends('layouts.admin.master')

@section('content')
    <main class="col-md-9 col-lg-10 px-4 content">
        <h4 class="my-4">📊 مشتریان با بیشترین خرید</h4>

        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>ردیف</th>
                        <th>نام مشتری</th>
                        <th>ایمیل</th>
                        <th>تعداد سفارش</th>
                        <th>جمع کل خرید (تومان)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customerStats as $index => $customer)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ number_format($customer->orders_count) }}</td>
                            <td>{{ number_format($customer->total_spent) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">هیچ مشتری‌ای یافت نشد.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
                {{ $customerStats->links() }}      </div>
        </div>
    </main>
@endsection