@extends('layouts.admin.master')

@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 content">
    <h3 class="mt-4 mb-4">گزارش فروش سالانه</h3>

    <div class="row">
        <div class="col-md-6">
            <canvas id="annualSalesChart"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="annualPieChart"></canvas>
        </div>
    </div>

    <table class="table mt-4">
        <thead class="thead-light">
            <tr>
                <th>سال</th>
                <th>فروش کل (تومان)</th>
                <th>درصد رشد نسبت به سال قبل</th>
            </tr>
        </thead>
        <tbody>
            @foreach($annualSales as $item)
                <tr>
                    <td>{{ $item->year }}</td>
                    <td>{{ number_format($item->total_sales) }}</td>
                    <td>
                        @if(!is_null($item->growth_percent))
                            {{ $item->growth_percent }}٪
                            @if($item->growth_percent > 0)
                                ↑
                            @elseif($item->growth_percent < 0)
                                ↓
                            @endif
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        const annualSales = @json($annualSales);

        // داده‌ها برای نمودار خطی فروش سالانه
        const labels = annualSales.map(item => item.year);
        const totals = annualSales.map(item => item.total_sales);

        new Chart(document.getElementById('annualSalesChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'فروش سالانه (تومان)',
                    data: totals,
                    backgroundColor: 'rgba(54, 162, 235, 0.3)',
                    borderColor: 'rgba(54, 162, 235, 1)',
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
                                return value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        // داده‌ها برای نمودار دایره‌ای سهم هر سال
        const totalSum = totals.reduce((a, b) => a + b, 0);
        const percentages = annualSales.map(item =>
            ((item.total_sales / totalSum) * 100).toFixed(1)
        );

        new Chart(document.getElementById('annualPieChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: labels.map((y, i) => `${y} (${percentages[i]}٪)`),
                datasets: [{
                    data: percentages,
                    backgroundColor: ['#36a2eb', '#ff6384', '#ffcd56', '#4bc0c0', '#9966ff']
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</main>
@endsection