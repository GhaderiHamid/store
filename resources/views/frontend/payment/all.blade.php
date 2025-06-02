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
        
            <form id="paymentForm"  action="{{ route('pay') }}" method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="amount" value="{{ isset($subtotal) ? $subtotal : $basket->subTotal() }}">

              
                <input class="cartNumber" type="text" placeholder="شماره کارت" required maxlength="16">
                <div class="row-flex">
                    <input type="password" placeholder="رمز دوم" required>
                    <input type="text" placeholder="CVV2" maxlength="4" required>
                </div>
                <div class="expiry-row">
                    <input type="text" placeholder="سال" maxlength="2" required>
                    <p style="color: #38f9d7;">/</p>
                    <input type="text" placeholder="ماه" maxlength="2" required>
        
                </div>
                <div class="captcha-container">
                    <span class="captcha-question" id="captchaQuestion"></span>
                    <input type="text" id="captchaInput" class="captcha-input" placeholder="کد امنیتی " maxlength="2" required>
                </div>
        
                <div class="captcha-error" id="captchaError">کپچا صحیح وارد نشده است.</div>
                <!-- نمایش قیمت -->
                <div id="priceBox"
                    style="background:linear-gradient(90deg,#ffe066 60%,#fffbe6 100%);color:#222;font-size:1.35rem;font-weight:bold;border-radius:12px;padding:12px 0;margin:18px auto 10px auto;width:75%;box-shadow:0 2px 8px 0 #ffe06655;">
                    مبلغ قابل پرداخت: <span id="priceValue">{{ isset($subtotal) ? $subtotal : $basket->subTotal() }}</span> تومان
                </div>
                <div class="expiry-row">
                    <button type="reset" class="btn-cancel" onclick="event.preventDefault(); document.getElementById('cancelForm').submit();">انصراف</button>
                    <button type="submit" class="btn-pay" >پرداخت</button>
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
                    if (userInput !== captchaAnswer) {
                        e.preventDefault();
                        errorDiv.style.display = 'block';
                        captchaAnswer = generateCaptchaMath();
                        document.getElementById('captchaInput').value = '';
                    } else {
                        errorDiv.style.display = 'none';
                    }
                });
            </script>
    </body>

</html>