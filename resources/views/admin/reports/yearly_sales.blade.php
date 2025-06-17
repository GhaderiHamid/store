@extends('layouts.admin.master')

@section('content')
    <!-- ناحیه محتوای اصلی -->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 content">

        <canvas id="yearlySalesChart"></canvas>

        <script>
            var ctx = document.getElementById('yearlySalesChart').getContext('2d');
            var yearlySales = @json($yearlySales);

            var labels = yearlySales.map(data => data.year); // نمایش سال شمسی
            var values = yearlySales.map(data => data.total_sales);

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'مجموع فروش سالانه',
                        data: values,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2
                    }]
                }
            });
        </script>

    </main>

    </div>
    </div>

@endsection