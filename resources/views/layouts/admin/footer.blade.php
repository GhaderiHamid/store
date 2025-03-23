
  <!-- اسکریپت‌های مورد نیاز -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <!-- تابع جاوااسکریپت برای جابجایی بین نماها/فرم‌ها -->
   <script>
    const sections = [
      'dashboard',
      'form-add-product',
      'form-list-products',
      'form-product-categories',
      'form-new-orders',
      'form-processing-orders',
      'form-completed-orders',
      'form-add-customer',
      'form-customer-list',
      'form-add-category',
      'form-category-list',
      'form-add-coupon',
      'form-active-discounts',
      'form-add-user',
      'form-user-list',
      'form-sales-report',
      'form-customer-report',
      'form-order-report'
    ];
    
    function hideAllSections() {
      sections.forEach(id => {
        document.getElementById(id).classList.add('d-none');
      });
    }
    
    function showForm(sectionId) {
      hideAllSections();
      document.getElementById(sectionId).classList.remove('d-none');
    }
    
    // نمونه کد برای نمودار فروش در داشبورد
    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور'],
            datasets: [{
                label: 'فروش',
                data: [30, 50, 40, 60, 70, 90],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    
    // نمونه کد برای نمودار گزارش فروش در فرم گزارش فروش
    var reportCtx = document.getElementById('salesReportChart').getContext('2d');
    var salesReportChart = new Chart(reportCtx, {
        type: 'bar',
        data: {
            labels: ['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور'],
            datasets: [{
                label: 'گزارش فروش',
                data: [20, 40, 30, 50, 60, 80],
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
  </script> 
</body>
</html>
