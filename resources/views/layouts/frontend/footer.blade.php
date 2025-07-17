<!-- end all products nav -->
    <!-- start shiping nav -->
    <div class="container my-5 custom-container">
        <div class="row justify-content-between no-gutters">
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-2">
                <div class="d-flex align-items-center custom-shipping mt-3">
                    <img class="img-fluid float-right" src="/img/shipping/shipp- (1).png" alt="" />
                    <p>ارسال رایگان به تمام نقاط کشور</p>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-2">
                <div class="d-flex align-items-center custom-shipping mt-3">
                    <img class="img-fluid float-right" src="/img/shipping/shipp- (2).png" alt="" />
                    <p>ضمانت اصالت کالا</p>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-2">
                <div class="d-flex align-items-center custom-shipping mt-3">
                    <img class="img-fluid float-right" src="/img/shipping/shipp- (3).png" alt="" />
                    <p>هفت روز ضمانت بازگشت کالا</p>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-2">
                <div class="d-flex align-items-center custom-shipping mt-3">
                    <img class="img-fluid float-right" src="/img/shipping/shipp- (4).png" alt="" />
                    <p>پرداخت آنلاین</p>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-2">
                <div class="d-flex align-items-center custom-shipping mt-3">
                    <img class="img-fluid float-right" src="/img/shipping/shipp- (5).png" alt="" />
                    <p>پشتیبانی 24 ساعته</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end shiping nav -->
    
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
    </script>
    

<script src="/script/javaScript.js"></script>
<script src="/script/cart.js"></script>

<script src="/script/zoomy.js"></script>

@if (Route::currentRouteName() === 'frontend.product.single' && isset($product))
<script>
    var urls = [
        '/{{ $product->image_path }}',
        // '/img/products/zoom/s2.jpg',
        // '/img/products/zoom/s3.jpg',
        // '/img/products/zoom/s4.jpg'
    ];
    var options = {
        // thumbLeft:true,
        // thumbRight:true,
        // thumbHide: false,
        // width: 400,
        // height:450,
    };
    $('#el').zoomy(urls, options);
</script>
@endif

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="/script/owl.carousel.min.js"></script>



<!-- بارگذاری فونت‌های Material Icons -->


<!-- اسکریپت اصلی -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    window.addToCartAjaxUrl = "{{ route('frontend.cart.add.ajax') }}";
</script>

<script>
    function toggleTheme() {
      const body = document.body;
      const icon = document.querySelector('.theme-toggle-btn span');
  
      body.classList.toggle('light-mode');
  
      // تغییر آیکون بسته به حالت تم
      if (body.classList.contains('light-mode')) {
        icon.textContent = 'light_mode';
        localStorage.setItem('theme', 'light');
      } else {
        icon.textContent = 'dark_mode';
        localStorage.setItem('theme', 'dark');
      }
    }
  
    // هنگام لود صفحه، بازیابی حالت از localStorage
    window.onload = function () {
      const savedTheme = localStorage.getItem("theme");
      const icon = document.querySelector('.theme-toggle-btn span');
      if (savedTheme === "light") {
        document.body.classList.add("light-mode");
        if (icon) icon.textContent = "light_mode";
      }
    };
  </script>
  
</body>
</html>