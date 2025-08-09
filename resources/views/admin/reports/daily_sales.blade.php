@extends('layouts.admin.master')

@section('content')
<title> گزارش فروش روزانه</title>
    <!-- ناحیه محتوای اصلی -->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 content">

        <canvas id="salesChart"></canvas>

        <script>
            var ctx = document.getElementById('salesChart').getContext('2d');
            var salesData = @json($salesData);

            var labels = salesData.map(data => data.date); // نمایش تاریخ شمسی
            var values = salesData.map(data => data.total_sales);

            new Chart(ctx, {
                type: 'line', // تغییر نوع نمودار به ستونی
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'مجموع فروش روزانه',
                        data: values,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2
                    }]
                }
            });
        </script>

    </main>

    </div>
    </div>

@endsection