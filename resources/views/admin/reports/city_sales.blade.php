@extends('layouts.admin.master')

@section('content')
<title> گزارش فروش استانی</title>
<main class="col-md-9 ml-sm-auto col-lg-10 px-4 content">
    <h4 class="my-4">گزارش فروش به تفکیک استان</h4>

    <div style="overflow-x: auto;">
        <canvas id="cityChart" width="{{ count($citySales) * 90 }}" height="500"></canvas>
    </div>

   
    {{-- بارگذاری فونت فارسی --}}
    <link href="https://cdn.fontcdn.ir/Font/Persian/Vazir/Vazir.css" rel="stylesheet">
    <style>
        canvas {
            font-family: 'Vazir', Tahoma, sans-serif !important;
        }
    </style>

    <script>
        const citySales = @json($citySales);
        const labels = citySales.map(item => item.city);
        const values = citySales.map(item => item.total_sales);

        new Chart(document.getElementById('cityChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'فروش (تومان)',
                    data: values,
                    backgroundColor: 'rgba(255, 99, 132, 0.3)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: false,
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
                    x: {
                        ticks: {
                            autoSkip: false,
                            maxRotation: 60,
                            minRotation: 45,
                            font: {
                                family: 'Vazir, Tahoma, sans-serif',
                                size: 12
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: value => value.toLocaleString(),
                            font: {
                                family: 'Vazir, Tahoma, sans-serif'
                            }
                        }
                    }
                }
            }
        });
    </script>
</main>
@endsection