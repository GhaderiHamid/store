<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>ورود ادمین</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            
            background: #d8dbe6;
            min-height: 100vh;
            direction: rtl;
            text-align: right;
            font-family: 'Vazirmatn', Tahoma, Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-bg-art {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
        }
        .login-bg-art .circle1 {
            position: absolute;
            left: -120px;
            top: -80px;
            width: 320px;
            height: 320px;
            background: radial-gradient(circle, #a18cd1 0%, #fbc2eb 100%);
            opacity: 0.25;
            border-radius: 50%;
        }
        .login-bg-art .circle2 {
            position: absolute;
            right: -100px;
            bottom: -100px;
            width: 260px;
            height: 260px;
            background: radial-gradient(circle, #fbc2eb 0%, #a6c1ee 100%);
            opacity: 0.18;
            border-radius: 50%;
        }
        .login-container {
            max-width: 410px;
            width: 100%;
            margin: 0 auto;
            border: none;
            background: #fff;
            border-radius: 30px;
            box-shadow: 0 12px 48px 0 rgba(161,140,209,0.13), 0 2px 8px rgba(31,38,135,0.08);
            padding: 44px 36px 32px 36px;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }
        /* کادر زیبای فرم */
        .form-box {
            background: linear-gradient(100deg, #f8cdec 60%, #fab1e5 100%);
            border-radius: 22px;
            box-shadow: 0 4px 24px 0 rgba(161,140,209,0.10);
            padding: 32px 24px 24px 24px;
            margin-bottom: 0;
            margin-top: 10px;
            position: relative;
        }
        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px auto;
            width: 86px;
            height: 86px;
            border-radius: 50%;
            background: linear-gradient(135deg, #765cb4 0%, #fbc2eb 100%);
            box-shadow: 0 8px 24px rgba(161,140,209,0.13);
            position: relative;
            z-index: 1;
        }
        .logo svg {
            width: 50px;
            height: 50px;
            color: #fff;
        }
        .login-title {
            text-align: center;
            font-size: 1.6rem;
            font-weight: bold;
            color: #a18cd1;
            margin-bottom: 18px;
            letter-spacing: 1px;
            position: relative;
            z-index: 1;
            text-shadow: 0 2px 8px #f9fafc;
        }
        .form-group label {
            font-weight: 500;
            color: #896ad1;
            font-size: 1.08em;
        }
        .form-control {
            border-radius: 16px;
            font-size: 1.13em;
            background: #f7f8fa;
            border: 1.5px solid #e3e6ee;
            transition: border-color 0.2s, box-shadow 0.2s;
            padding: 0.85rem 1rem;
        }
        .form-control:focus {
            border-color: #fbc2eb;
            box-shadow: 0 0 0 0.15rem rgba(251,194,235,.10);
            background: #fff;
        }
        .btn-primary {
            background: linear-gradient(90deg, #5531a9 0%, #ff3fc9 100%);
            border: none;
            transition: box-shadow 0.2s, transform 0.2s;
            font-weight: bold;
            border-radius: 16px;
            font-size: 1.18em;
            letter-spacing: 1px;
            margin-top: 16px;
            box-shadow: 0 2px 8px rgba(161,140,209,0.13);
            padding: 0.7rem 0;
        }
        .btn-primary:hover, .btn-primary:focus {
            box-shadow: 0 8px 28px rgba(251,194,235,0.18);
            transform: translateY(-2px) scale(1.04);
        }
        .text-danger.small {
            display: block;
            margin-top: 4px;
            font-size: 1em;
        }
        .alert {
            font-size: 1.05em;
            margin-bottom: 18px;
            border-radius: 12px;
        }
        .footer-text {
            text-align: center;
            color: #b0b3c2;
            font-size: 1em;
            margin-top: 22px;
            letter-spacing: 0.5px;
        }
        @media (max-width: 600px) {
            .login-container {
                padding: 18px 4px 12px 4px;
                border-radius: 18px;
            }
            .logo {
                width: 62px;
                height: 62px;
            }
            .logo svg {
                width: 34px;
                height: 34px;
            }
            .form-box {
                padding: 14px 4px 10px 4px;
                border-radius: 14px;
            }
        }
        .login-container, .form-group, label, input, .login-title, .alert, .footer-text {
            direction: rtl;
            text-align: right;
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
    <div class="login-title" style="text-align:center;">ورود ادمین</div>
    <div class="form-box">
        @if($errors->any())
            <div class="alert alert-danger text-center">
                {{ $errors->first() }}
            </div>
        @endif
        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="form-group">
                <label for="email">ایمیل</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">رمز عبور</label>
                <input type="password" class="form-control" id="password" name="password" required>
                @error('password')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-block">ورود</button>
        </form>
    </div>
</div>
<!-- Bootstrap JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
