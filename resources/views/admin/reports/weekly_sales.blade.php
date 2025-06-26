@extends('layouts.admin.master')

@section('content')
<main class="col-md-9 ml-sm-auto col-lg-10 px-4 content">
    <h4 class="my-4">گزارش فروش هفتگی</h4>

    <canvas id="weeklySalesChart" style="max-height: 450px;"></canvas>

    <script>
        const weeklySales = @json($weeklySales);

        const labels = weeklySales.map(data => `${data.week_label} / ${data.year}`);
        const values = weeklySales.map(data => data.total_sales);

        new Chart(document.getElementById('weeklySalesChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'فروش هفتگی',
                    data: values,
                    fill: true,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.1)',
                    borderWidth: 2,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                family: 'Vazir, Tahoma, sans-serif'
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: value => value.toLocaleString(),
                            font: {
                                family: 'Vazir, Tahoma, sans-serif'
                            }
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                family: 'Vazir, Tahoma, sans-serif',
                                size: 11
                            },
                            maxRotation: 60,
                            minRotation: 45
                        }
                    }
                }
            }
        });
    </script>
</main>
@endsection