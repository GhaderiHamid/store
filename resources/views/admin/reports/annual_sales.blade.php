@extends('layouts.admin.master')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 content">
        <h3 class="mt-4 mb-4">گزارش فروش سالیانه</h3>
        <canvas id="annualSalesChart"></canvas>

        <script>
            var ctx = document.getElementById('annualSalesChart').getContext('2d');
            var annualSales = @json($annualSales);

            var labels = annualSales.map(data => data.year); // نمایش سال شمسی
            var values = annualSales.map(data => data.total_sales);

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'میزان فروش (تومان)',
                        data: values,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function (value) {
                                    return value.toLocaleString(); // جداکننده هزارگان
                                }
                            }
                        }
                    }
                }
            });
        </script>
    </main>
@endsection