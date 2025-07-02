<!DOCTYPE html>
<html lang="fa">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>تأیید پرداخت</title>
        <style>
            body {
                font-family: 'Vazirmatn', Arial, sans-serif;
                background: linear-gradient(135deg, #e0ffe6 0%, #43e97b 100%);
                min-height: 100vh;
                margin: 0;
                padding: 0;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .confirmation-container {
                background: #fff;
                border-radius: 22px;
                box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.13), 0 0 0 4px #ffe066;
                border: 2px solid #ffe066;
                max-width: 420px;
                width: 80vw;
                margin: 40px auto;
                padding: 38px 32px 32px 32px;
                text-align: center;
                position: relative;
            }

            .confirmation-container h2 {
                color: #43e97b;
                font-size: 2rem;
                margin-bottom: 28px;
                font-weight: bold;
                letter-spacing: 1px;
                text-shadow: 0 2px 8px #0002;
            }

            .transaction-details {
                background: linear-gradient(90deg, #ffe065 60%, #ffd940 100%);
                border-radius: 14px;
                padding: 18px 10px 14px 10px;
                margin-bottom: 28px;
                color: #222;
                font-size: 1.13rem;
                box-shadow: 0 2px 8px 0 #ffe06633;
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

            .btn-back {
                display: inline-block;
                background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%);
                color: #111;
                border: 2px solid #43e97b;
                border-radius: 8px;
                padding: 12px 38px;
                font-size: 1.15rem;
                font-weight: bold;
                text-decoration: none;
                letter-spacing: 1px;
                box-shadow: 0 4px 16px 0 rgba(67, 233, 123, 0.13);
                transition: background 0.2s, box-shadow 0.2s, color 0.2s, border 0.2s;
            }

            .btn-back:hover {
                background: linear-gradient(90deg, #38f9d7 0%, #43e97b 100%);
                color: #fff;
                border: 2px solid #38f9d7;
                box-shadow: 0 8px 24px 0 rgba(67, 233, 123, 0.22);
            }

            @media (max-width: 500px) {
                .confirmation-container {
                    padding: 16px 4vw 18px 4vw;
                }

                .confirmation-container h2 {
                    font-size: 1.2rem;
                }

                .btn-back {
                    font-size: 1rem;
                    padding: 10px 18px;
                }
            }

            /* آیکون موفقیت */
            .success-icon {
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
        <div class="confirmation-container">
            <div class="success-icon">
                <svg viewBox="0 0 64 64" fill="none">
                    <circle cx="32" cy="32" r="30" fill="#43e97b" opacity="0.18" />
                    <circle cx="32" cy="32" r="28" fill="#43e97b" opacity="0.25" />
                    <path d="M20 34L29 43L45 25" stroke="#43e97b" stroke-width="5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </div>
            <h2>پرداخت شما با موفقیت انجام شد</h2>
            <div class="transaction-details">
                <p><strong>مبلغ سفارش:</strong> {{number_format($amount) }} تومان</p>
                <p><strong>زمان تراکنش:</strong> {{ $transaction_time }}</p>
                <p><strong>شماره پیگیری:</strong> {{ $transaction }}</p>
            </div>
            <a href="{{ route('frontend.home.all') }}" class="btn-back">بازگشت به صفحه اصلی</a>
        </div>
    </body>

</html>
