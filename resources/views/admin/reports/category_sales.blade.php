@extends('layouts.admin.master')

@section('content')
<title> گزارش فروش دسته بندی ها</title>
<main class="col-md-9 ml-sm-auto col-lg-10 px-4 content">
    <h4 class="my-4">گزارش فروش دسته‌بندی‌ها</h4>

    <canvas id="categoryChart"></canvas>

    <script>
        const categories = @json($categorySales);
        const labels = categories.map(item => item.category);
        const values = categories.map(item => item.total_sales);

        new Chart(document.getElementById('categoryChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'فروش (تومان)',
                    data: values,
                    backgroundColor: 'rgba(255, 159, 64, 0.4)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { callback: value => value.toLocaleString() + ' تومان' }
                    }
                }
            }
        });
    </script>
</main>
@endsection