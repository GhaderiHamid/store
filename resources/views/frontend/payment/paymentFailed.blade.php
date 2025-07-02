<!DOCTYPE html>
<html lang="fa">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>خطای پرداخت</title>
        <style>
            body {
                font-family: 'Vazirmatn', Arial, sans-serif;
                background: linear-gradient(135deg, #ffe6e6 0%, #ff6b6b 100%);
                min-height: 100vh;
                margin: 0;
                padding: 0;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .error-container {
                background: #fff;
                border-radius: 22px;
                box-shadow: 0 8px 32px 0 rgba(135, 31, 38, 0.13), 0 0 0 4px #ff6b6b;
                border: 2px solid #ff6b6b;
                max-width: 420px;
                width: 80vw;
                margin: 40px auto;
                padding: 38px 32px 32px 32px;
                text-align: center;
                position: relative;
            }

            .error-container h2 {
                color: #ff6b6b;
                font-size: 2rem;
                margin-bottom: 28px;
                font-weight: bold;
                letter-spacing: 1px;
                text-shadow: 0 2px 8px #0002;
            }

            .transaction-details {
                background: linear-gradient(90deg, #ff6b6b 60%, #ff4040 100%);
                border-radius: 14px;
                padding: 18px 10px 14px 10px;
                margin-bottom: 28px;
                color: #222;
                font-size: 1.13rem;
                box-shadow: 0 2px 8px 0 #ff6b6b33;
                text-align: right;
            }

            .transaction-details p {
                margin: 10px 0;
                line-height: 1.8;
            }

            .transaction-details strong {
                color: #222;
                font-weight: bold;
            }

            .btn-retry {
                display: inline-block;
                background: linear-gradient(90deg, #ff4040 0%, #ff6b6b 100%);
                color: #111;
                border: 2px solid #ff6b6b;
                border-radius: 8px;
                padding: 12px 38px;
                font-size: 1.15rem;
                font-weight: bold;
                text-decoration: none;
                letter-spacing: 1px;
                box-shadow: 0 4px 16px 0 rgba(255, 107, 107, 0.13);
                transition: background 0.2s, box-shadow 0.2s, color 0.2s, border 0.2s;
            }

            .btn-retry:hover {
                background: linear-gradient(90deg, #ff6b6b 0%, #ff4040 100%);
                color: #fff;
                border: 2px solid #ff4040;
                box-shadow: 0 8px 24px 0 rgba(255, 107, 107, 0.22);
            }

            .error-icon {
                width: 70px;
                height: 70px;
                margin: 0 auto 18px auto;
                display: flex;
                align-items: center;
                justify-content: center;
            }
        </style>
    </head>

    <body>
        <div class="error-container">
            <div class="error-icon">
                <svg viewBox="0 0 64 64" fill="none">
                    <circle cx="32" cy="32" r="30" fill="#ff6b6b" opacity="0.18" />
                    <circle cx="32" cy="32" r="28" fill="#ff6b6b" opacity="0.25" />
                    <path d="M22 22L42 42M42 22L22 42" stroke="#ff6b6b" stroke-width="5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </div>
            <h2>پرداخت شما ناموفق بود</h2>
            <div class="transaction-details">
                <p><strong>مبلغ سفارش:</strong> {{ isset($amount) ? $amount : 0 }} تومان</p>
                <p><strong>زمان تراکنش:</strong> {{ $transaction_time ?? '-' }}</p>
                <p><strong>شماره پیگیری:</strong> {{ $transaction ?? '-' }}</p>
            </div>
            <a href="{{ route('frontend.home.all') }}" class="btn-retry"> بازگشت به صفحه اصلی</a>
        </div>
    </body>

</html>
