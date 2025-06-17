@extends('layouts.admin.master')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 content">
        <h3 class="mt-4 mb-4">گزارش فروش هفتگی</h3>
        <canvas id="weeklySalesChart"></canvas>

        <script>
            var ctx = document.getElementById('weeklySalesChart').getContext('2d');
            var weeklySales = @json($weeklySales);

            var labels = weeklySales.map(data => data.week); // نمایش سال/هفته
            var values = weeklySales.map(data => data.total_sales);

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'فروش هفتگی',
                        data: values,
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 2,
                        tension: 0.3
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function (value) {
                                    return value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
        </script>
    </main>
@endsection