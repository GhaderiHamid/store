<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>درگاه پرداخت</title>
    <link rel="stylesheet" href="/css/payment.css">
</head>

<body>
    <div class="captcha-error" id="captchaError">کپچا صحیح وارد نشده است.</div>
    <div class="payment-form">
        <!-- شمارش معکوس -->
        <div id="countdownBox">
            <span class="timer-icon">⏳</span>
            <span class="timer-label">زمان باقی‌مانده:</span>
            <span id="countdownTimer">15:00</span>
        </div>
        <h5> درگاه پرداخت</h5>
        @if ($subtotal <= 0 || empty($products))
            <div class="alert alert-danger text-center mt-3">
                ⚠️ متأسفیم، سبد خرید شما منقضی شده یا موجودی برخی محصولات تمام شده است.<br>
                لطفاً دوباره سبد خرید خود را بررسی کنید.
            </div>
        @endif
        <form id="paymentForm" action="{{ route('pay') }}" method="POST" autocomplete="off">
            @csrf
            
            <input type="hidden" name="amount" value="{{ isset($subtotal) ? $subtotal : $basket->subTotal() }}">


            <input class="cartNumber" type="text" placeholder="شماره کارت" required maxlength="19"
                oninput="formatCardNumber(this);">
            <div class="row-flex">
                <input type="password" placeholder="رمز دوم" required
                    oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                <input type="text" placeholder="CVV2" maxlength="4" required
                    oninput="this.value=this.value.replace(/[^0-9]/g,'');">
            </div>
            <div class="expiry-row">
                <input type="text" id="yearInput" placeholder="سال" maxlength="2" required
                    onkeypress="return validateYearKeyPress(event)" oninput="validateYearInput(this)">
                <p style="color: #38f9d7;">/</p>
                <input type="text" id="monthInput" placeholder="ماه" maxlength="2" required
                    onkeypress="return validateMonthKeyPress(event)" oninput="validateMonthInput(this)">
            </div>
            <div class="captcha-container">
                <span class="captcha-question" id="captchaQuestion"></span>
                <input type="text" id="captchaInput" class="captcha-input" placeholder="کد امنیتی " maxlength="2"
                    required oninput="this.value=this.value.replace(/[^0-9]/g,'');">
            </div>

            
            <div class="expiry-error" id="expiryError" style="color: red; display: none;">سال باید بین 04 تا 10 و
                ماه بین 01 تا 12 باشد.</div>
            <!-- نمایش قیمت -->
            <div id="priceBox"
                style="background:linear-gradient(90deg,#ffe066 60%,#fffbe6 100%);color:#222;font-size:1.35rem;font-weight:bold;border-radius:12px;padding:12px 0;margin:18px auto 10px auto;width:75%;box-shadow:0 2px 8px 0 #ffe06655;">
                مبلغ قابل پرداخت: <span
                    id="priceValue">{{ isset($subtotal) ? number_format($subtotal) : number_format($basket->subTotal()) }}</span>
                تومان
            </div>
            <div class="expiry-row">
                <button type="reset" class="btn-cancel"
                    onclick="event.preventDefault(); document.getElementById('cancelForm').submit();">انصراف</button>
                    <button type="submit" id="submitPay" class="btn-pay"
                    {{ $subtotal <= 0 || empty($products) ? 'disabled' : '' }}>
                    پرداخت
                </button>
            </div>
        </form>
        
        <!-- فرم انصراف -->
        <form id="cancelForm" action="{{ route('payment.failed') }}" method="POST" style="display:none;">
            @csrf
            <input type="hidden" name="amount" value="{{ isset($subtotal) ? $subtotal : $basket->subTotal() }}">
        </form>
    </div>

    <script>
        // کپچا ریاضی
        function generateCaptchaMath() {
            const a = Math.floor(Math.random() * 10) + 1;
            const b = Math.floor(Math.random() * 10) + 1;
            document.getElementById('captchaQuestion').textContent = `${a} + ${b} = ?`;
            return a + b;
        }
        let captchaAnswer = generateCaptchaMath();
    
        // رویداد ارسال فرم
        document.getElementById('paymentForm').addEventListener('submit', function (e) {
    e.preventDefault(); // جلوگیری موقت از ارسال

    const userInput = parseInt(document.getElementById('captchaInput').value.trim(), 10);
    const yearInput = document.getElementById('yearInput').value;
    const monthInput = document.getElementById('monthInput').value;
    const errorDiv = document.getElementById('captchaError');
    const expiryError = document.getElementById('expiryError');

    const yearValid = /^[0-9]{2}$/.test(yearInput) && parseInt(yearInput) >= 4 && parseInt(yearInput) <= 10;
    const monthValid = /^[0-9]{2}$/.test(monthInput) && parseInt(monthInput) >= 1 && parseInt(monthInput) <= 12;

    if (!yearValid || !monthValid) {
        expiryError.style.display = 'block';
        return;
    } else {
        expiryError.style.display = 'none';
    }

    if (userInput !== captchaAnswer) {
        errorDiv.style.display = 'block';
        captchaAnswer = generateCaptchaMath();
        document.getElementById('captchaInput').value = '';
        return;
    } else {
        errorDiv.style.display = 'none';
    }

    // 👇 بررسی نهایی موجودی از سرور
    fetch('/cart/check-reservation-status')
        .then(res => res.json())
        .then(data => {
            if (data.valid === false && data.reason === 'purchased_by_others') {
                alert("⛔️پرداخت انجام نشد.");
                window.location.href = '/cart?message=unavailable';
            } else {
                // اگر موجودی اوکی بود، فرم ارسال شود
                document.getElementById('paymentForm').submit();
            }
        })
        .catch(err => {
            console.error('⚠️ خطا در بررسی موجودی:', err);
            alert('مشکلی در بررسی موجودی پیش آمده است. لطفاً دوباره تلاش کنید.');
        });
});
        // فرمت شماره کارت
        function formatCardNumber(input) {
            let value = input.value.replace(/[^0-9]/g, '').slice(0, 16);
            let formatted = value.match(/.{1,4}/g);
            input.value = formatted ? formatted.join('-') : '';
        }
    
        // اعتبارسنجی سال
        function validateYearKeyPress(event) {
            const charCode = event.which ? event.which : event.keyCode;
            const currentValue = event.target.value;
            if (charCode < 48 || charCode > 57) return false;
            if (currentValue.length === 0) return charCode === 48 || charCode === 49;
    
            if (currentValue.length === 1 && currentValue === '0') {
                if (charCode < 52 || charCode > 57) {
                    setTimeout(() => {
                        event.target.value = '';
                        alert('سال باید بین 04 تا 10 باشد');
                    }, 0);
                    return false;
                }
            }
    
            if (currentValue.length === 1 && currentValue === '1' && charCode !== 48) {
                setTimeout(() => {
                    event.target.value = '';
                    alert('سال باید بین 04 تا 10 باشد');
                }, 0);
                return false;
            }
    
            return currentValue.length < 2;
        }
    
        function validateYearInput(input) {
            const value = input.value;
            if (value.length === 2 && (parseInt(value) < 4 || parseInt(value) > 10)) {
                input.value = '';
                alert('سال باید بین 04 تا 10 باشد');
            }
        }
    
        // اعتبارسنجی ماه
        function validateMonthKeyPress(event) {
            const charCode = event.which ? event.which : event.keyCode;
            const currentValue = event.target.value;
            if (charCode < 48 || charCode > 57) return false;
    
            if (currentValue.length === 0 && charCode === 48) return true;
            if (currentValue.length === 1 && currentValue === '0') return charCode >= 49 && charCode <= 57;
            if (currentValue.length === 0 && charCode === 49) return true;
            if (currentValue.length === 1 && currentValue === '1') return charCode >= 48 && charCode <= 50;
    
            return currentValue.length < 2;
        }
    
        function validateMonthInput(input) {
            const value = input.value;
            if (value.length === 2 && (parseInt(value) < 1 || parseInt(value) > 12)) {
                input.value = '';
                alert('ماه باید بین 01 تا 12 باشد');
            }
        }
    
        // شمارش معکوس
        let countdownSeconds = 15 * 60;
        const countdownTimer = document.getElementById('countdownTimer');
        const paymentForm = document.getElementById('paymentForm');
    
        function updateCountdown() {
            const min = String(Math.floor(countdownSeconds / 60)).padStart(2, '0');
            const sec = String(countdownSeconds % 60).padStart(2, '0');
            countdownTimer.textContent = `${min}:${sec}`;
    
            if (countdownSeconds <= 0) {
                clearInterval(countdownInterval);
                window.history.back();
            }
            countdownSeconds--;
        }
    
        updateCountdown();
        const countdownInterval = setInterval(updateCountdown, 1000);
    
        // جلوگیری از رفرش صفحه
window.addEventListener('beforeunload', function(e) {
    if (document.getElementById('submitPay').disabled) {
        e.preventDefault();
        e.returnValue = 'در حال پردازش پرداخت هستید. آیا مطمئنید می‌خواهید صفحه را ترک کنید؟';
        return e.returnValue;
    }
});
    </script>
</body>

</html>
