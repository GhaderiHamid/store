<!DOCTYPE html>
<html lang="fa">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>درگاه پرداخت</title>
        <link rel="stylesheet" href="/css/payment.css">
    </head>

    <body>
        <div class="payment-form">
            <h5> درگاه پرداخت</h5>

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

                <div class="captcha-error" id="captchaError">کپچا صحیح وارد نشده است.</div>
                <div class="expiry-error" id="expiryError" style="color: red; display: none;">سال باید بین 00 تا 10 و
                    ماه بین 01 تا 12 باشد.</div>
                <!-- نمایش قیمت -->
                <div id="priceBox"
                    style="background:linear-gradient(90deg,#ffe066 60%,#fffbe6 100%);color:#222;font-size:1.35rem;font-weight:bold;border-radius:12px;padding:12px 0;margin:18px auto 10px auto;width:75%;box-shadow:0 2px 8px 0 #ffe06655;">
                    مبلغ قابل پرداخت: <span
                        id="priceValue">{{ isset($subtotal) ? number_format($subtotal) : number_format($basket->subTotal()) }}</span> تومان
                </div>
                <div class="expiry-row">
                    <button type="reset" class="btn-cancel"
                        onclick="event.preventDefault(); document.getElementById('cancelForm').submit();">انصراف</button>
                    <button type="submit" class="btn-pay">پرداخت</button>
                </div>
            </form>
            <!-- فرم انصراف -->
            <form id="cancelForm" action="{{ route('payment.failed') }}" method="POST" style="display:none;">
                @csrf
                <input type="hidden" name="amount" value="{{ isset($subtotal) ? $subtotal : $basket->subTotal() }}">
            </form>
        </div>

        <script>
            // کپچا محاسباتی (جمع دو عدد تصادفی)
            function generateCaptchaMath() {
                const a = Math.floor(Math.random() * 10) + 1;
                const b = Math.floor(Math.random() * 10) + 1;
                document.getElementById('captchaQuestion').textContent = `${a} + ${b} = ?`;
                return a + b;
            }
            let captchaAnswer = generateCaptchaMath();

            // بررسی کپچا هنگام ارسال فرم
            document.getElementById('paymentForm').addEventListener('submit', function (e) {
                const userInput = parseInt(document.getElementById('captchaInput').value.trim(), 10);
                const errorDiv = document.getElementById('captchaError');

                // اعتبارسنجی سال و ماه
                const yearInput = document.getElementById('yearInput').value;
                const monthInput = document.getElementById('monthInput').value;
                const expiryError = document.getElementById('expiryError');

                const yearValid = /^[0-9]{2}$/.test(yearInput) && parseInt(yearInput) >= 0 && parseInt(yearInput) <= 10;
                const monthValid = /^[0-9]{2}$/.test(monthInput) && parseInt(monthInput) >= 1 && parseInt(monthInput) <= 12;

                if (!yearValid || !monthValid) {
                    e.preventDefault();
                    expiryError.style.display = 'block';
                    return;
                } else {
                    expiryError.style.display = 'none';
                }

                if (userInput !== captchaAnswer) {
                    e.preventDefault();
                    errorDiv.style.display = 'block';
                    captchaAnswer = generateCaptchaMath();
                    document.getElementById('captchaInput').value = '';
                } else {
                    errorDiv.style.display = 'none';
                }
            });

            // فرمت شماره کارت با خط تیره بین هر ۴ رقم
            function formatCardNumber(input) {
                let value = input.value.replace(/[^0-9]/g, '').slice(0, 16);
                let formatted = value.match(/.{1,4}/g);
                input.value = formatted ? formatted.join('-') : '';
            }

            // اعتبارسنجی سال هنگام فشار دادن کلید
            function validateYearKeyPress(event) {
                const charCode = event.which ? event.which : event.keyCode;
                const currentValue = event.target.value;

                // فقط اعداد مجاز
                if (charCode < 48 || charCode > 57) {
                    return false;
                }

                // اگر اولین رقم 1 باشد، رقم دوم فقط می‌تواند 0 باشد (برای محدوده 00-10)
                if (currentValue.length === 0 && charCode === 49) { // اگر اولین رقم 1 باشد
                    return true;
                } else if (currentValue.length === 1 && currentValue === '1') {
                    return charCode === 48; // فقط 0 مجاز است (10)
                } else if (currentValue.length === 1 && currentValue === '0') {
                    return charCode >= 48 && charCode <= 57; // 0-9 برای رقم دوم (00-09)
                }

                return currentValue.length < 2;
            }

            // اعتبارسنجی نهایی سال
            function validateYearInput(input) {
                const value = input.value;
                if (value.length === 2 && (parseInt(value) < 0 || parseInt(value) > 10)) {
                    input.value = '';
                    alert('سال باید بین 00 تا 10 باشد');
                }
            }

            // اعتبارسنجی ماه هنگام فشار دادن کلید
            function validateMonthKeyPress(event) {
                const charCode = event.which ? event.which : event.keyCode;
                const currentValue = event.target.value;

                // فقط اعداد مجاز
                if (charCode < 48 || charCode > 57) {
                    return false;
                }

                // اگر اولین رقم 0 باشد، رقم دوم باید 1-9 باشد (01-09)
                if (currentValue.length === 0 && charCode === 48) { // 0
                    return true;
                } else if (currentValue.length === 1 && currentValue === '0') {
                    return charCode >= 49 && charCode <= 57; // 1-9
                }
                // اگر اولین رقم 1 باشد، رقم دوم می‌تواند 0-2 باشد (10-12)
                else if (currentValue.length === 0 && charCode === 49) { // 1
                    return true;
                } else if (currentValue.length === 1 && currentValue === '1') {
                    return charCode >= 48 && charCode <= 50; // 0-2
                }

                return currentValue.length < 2;
            }

            // اعتبارسنجی نهایی ماه
            function validateMonthInput(input) {
                const value = input.value;
                if (value.length === 2 && (parseInt(value) < 1 || parseInt(value) > 12)) {
                    input.value = '';
                    alert('ماه باید بین 01 تا 12 باشد');
                }
            }
        </script>
    </body>

</html>