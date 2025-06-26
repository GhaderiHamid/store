@extends('layouts.admin.master')

@section('content')
<title> گزارش فروش ماهانه</title>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 content">
    <h2>گزارش فروش ماهانه</h2>

    <canvas id="monthlySalesChart"></canvas>

    <script>
        const ctx = document.getElementById('monthlySalesChart').getContext('2d');
        const monthlySales = @json($monthlySales);

        const labels = monthlySales.map(item => item.month);
        const values = monthlySales.map(item => item.total_sales);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'فروش ماهانه (تومان)',
                    data: values,
                    backgroundColor: 'rgba(75, 192, 192, 0.3)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString() + ' تومان';
                            }
                        }
                    }
                }
            }
        });
    </script>
</main>
@endsection