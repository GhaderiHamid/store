<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>ورود ادمین</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
       
            background: #d8dbe6;
            font-family: 'Vazirmatn', Tahoma, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .login-bg-art {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
        }
        .circle1, .circle2 {
            border-radius: 50%;
            position: absolute;
            opacity: 0.2;
        }
        .circle1 {
            left: -120px;
            top: -80px;
            width: 320px;
            height: 320px;
            background: radial-gradient(circle, #a18cd1, #fbc2eb);
        }
        .circle2 {
            right: -100px;
            bottom: -100px;
            width: 260px;
            height: 260px;
            background: radial-gradient(circle, #fbc2eb, #a6c1ee);
        }
        .login-container {
            background: #fff;
            border-radius: 24px;
            padding: 36px 24px;
            box-shadow: 0 12px 48px rgba(161,140,209,0.13), 0 2px 8px rgba(31,38,135,0.08);
            z-index: 1;
            position: relative;
            width: 100%;
            max-width: 400px;
        }
        .logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #765cb4, #fbc2eb);
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 24px rgba(161,140,209,0.13);
        }
        .logo svg {
            width: 44px;
            height: 44px;
            color: #fff;
        }
        .login-title {
            text-align: center;
            font-size: 1.6rem;
            font-weight: bold;
            color: #a18cd1;
            margin-bottom: 20px;
        }
        .form-box {
            background: linear-gradient(100deg, #f8cdec 60%, #fab1e5 100%);
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 4px 24px rgba(161,140,209,0.10);
        }
        .form-group label {
            color: #896ad1;
            font-weight: 500;
        }
        .form-control {
            border-radius: 16px;
            background: #f7f8fa;
            border: 1.5px solid #e3e6ee;
            padding: 0.75rem 1rem;
            font-size: 1.1rem;
        }
        .form-control:focus {
            border-color: #fbc2eb;
            box-shadow: 0 0 0 0.15rem rgba(251,194,235,0.1);
            background: #fff;
        }
        .btn-primary {
            background: linear-gradient(90deg, #5531a9, #ff3fc9);
            border: none;
            font-weight: bold;
            font-size: 1.1rem;
            border-radius: 16px;
            padding: 0.65rem 0;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(251,194,235,0.18);
        }
        .alert {
            font-size: 1.05em;
            border-radius: 12px;
        }
        .footer-text {
            text-align: center;
            color: #b0b3c2;
            font-size: 0.95em;
            margin-top: 16px;
        }

        /* Responsive tweaks */
        @media (max-width: 768px) {
            .login-container {
                padding: 24px 16px;
                border-radius: 18px;
                max-width: 95%;
            }
            .logo {
                width: 62px;
                height: 62px;
            }
            .logo svg {
                width: 32px;
                height: 32px;
            }
            .form-box {
                padding: 16px 12px;
            }
            .form-control, .btn-primary {
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body>
<div class="login-bg-art">
    <div class="circle1"></div>
    <div class="circle2"></div>
</div>
<div class="login-container">
    <div class="logo">
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="8" r="4"/>
            <path d="M4 20c0-4 4-7 8-7s8 3 8 7"/>
        </svg>
    </div>
    <div class="login-title">ورود ادمین</div>
    <div class="form-box">
        @if($errors->any())
            <div class="alert alert-danger text-center">
                {{ $errors->first() }}
            </div>
        @endif
        <form method="POST" action="{{ route('loginAdmin') }}">
            @csrf
            <div class="form-group text-right">
                <label for="email" class="d-block text-right">ایمیل</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="form-group text-right">
                <label for="password" class="d-block text-right">رمز عبور</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">ورود</button>
        </form>
    </div>
    <div class="footer-text">© {{ now()->year }} تمامی حقوق محفوظ است</div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>