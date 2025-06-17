@extends('layouts.admin.master')

@section('content')
    <!-- ناحیه محتوای اصلی -->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 content">

        <canvas id="monthlySalesChart"></canvas>

        <script>
            var ctx = document.getElementById('monthlySalesChart').getContext('2d');
            var monthlySales = @json($monthlySales);

            var labels = monthlySales.map(data => data.month); // نمایش ماه شمسی
            var values = monthlySales.map(data => data.total_sales);

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'فروش ماهانه',
                        data: values,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 2
                    }]
                }
            });
        </script>

    </main>

    </div>
    </div>

@endsection