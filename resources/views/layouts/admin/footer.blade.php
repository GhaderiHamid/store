
  <!-- اسکریپت‌های مورد نیاز -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="/script/AdminJavaScript.js"></script>
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
    
  </script> 
  @if(isset($formattedSales))
<script>
    var monthlySales = @json($formattedSales);
    var labels = monthlySales.map(item => item.month); // نمایش نام فارسی ماه‌ها
    var data = monthlySales.map(item => item.total);

    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'گزارش فروش ماهانه (شمسی)',
                data: data,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2
            }]
        }
    });
</script>
@endif
<script>
  function confirmDelete() {
      return confirm('آیا از این حذف اطمینان دارید؟');
  }
</script>
</body>
</html>
