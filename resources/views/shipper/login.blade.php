<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>ورود مامور ارسال | سامانه حمل و نقل</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- فونت‌ها و آیکون‌ها -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --text-color: #2b2d42;
            --light-color: #f8f9fa;
            --error-color: #ef233c;
            --success-color: #4cc9f0;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Vazirmatn', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px;
        }
        
        .login-container {
            width: 100%;
            max-width: 400px; /* کاهش عرض */
            background: white;
            border-radius: 16px; /* کاهش شعاع گوشه */
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
            z-index: 1;
            
        }
        
        .login-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 20px; /* کاهش padding */
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .login-header::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            transform: rotate(30deg);
        }
        
        .logo {
            width: 60px; /* کاهش سایز */
            height: 60px;
            background: white;
            border-radius: 50%;
            margin: 0 auto 15px; /* کاهش margin */
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .logo .material-symbols-outlined {
            font-size: 32px; /* کاهش سایز آیکون */
            color: var(--primary-color);
        }
        
        .login-title {
            font-size: 1.4rem; /* کاهش سایز فونت */
            font-weight: 700;
            margin-bottom: 8px; /* کاهش margin */
        }
        
        .login-subtitle {
            font-size: 0.9rem; /* کاهش سایز فونت */
            opacity: 0.9;
        }
        
        .login-body {
            padding: 20px; /* کاهش padding */
        }
        
        .form-group {
            margin-bottom: 18px; /* کاهش margin */
            position: relative;
        }
        
        .form-label {
            display: block;
            margin-bottom: 6px; /* کاهش margin */
            font-weight: 500;
            color: var(--text-color);
            font-size: 0.9rem; /* کاهش سایز فونت */
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px; /* کاهش padding */
            border: 2px solid #e9ecef;
            border-radius: 10px; /* کاهش شعاع گوشه */
            font-size: 0.9rem; /* کاهش سایز فونت */
            transition: all 0.3s ease;
            background-color: #f8f9fa;
        }
        
        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
            background-color: white;
            outline: none;
        }
        
        .btn-login {
            width: 100%;
            padding: 12px; /* کاهش padding */
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            border-radius: 10px; /* کاهش شعاع گوشه */
            font-size: 1rem; /* کاهش سایز فونت */
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
            margin-top: 10px; /* کاهش margin */
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(67, 97, 238, 0.4);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .login-footer {
            text-align: center;
            margin-top: 18px; /* کاهش margin */
            color: #6c757d;
            font-size: 0.85rem; /* کاهش سایز فونت */
        }
        
        .login-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .login-footer a:hover {
            text-decoration: underline;
        }
        
        .error-message {
            color: var(--error-color);
            font-size: 0.8rem; /* کاهش سایز فونت */
            margin-top: 4px; /* کاهش margin */
            display: block;
        }
        
        .alert {
            padding: 12px; /* کاهش padding */
            border-radius: 10px; /* کاهش شعاع گوشه */
            margin-bottom: 18px; /* کاهش margin */
            font-size: 0.85rem; /* کاهش سایز فونت */
        }
        
        @media (max-width: 576px) {
            .login-container {
                max-width: 320px; /* کاهش بیشتر در موبایل */
            }
            
            .login-header {
                padding: 18px 15px;
            }
            
            .login-body {
                padding: 18px 15px;
            }
            
            .logo {
                width: 50px;
                height: 50px;
            }
            
            .login-title {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="logo">
                <span class="material-symbols-outlined">local_shipping</span>
            </div>
            <h1 class="login-title">ورود مامور ارسال</h1>
            <p class="login-subtitle">لطفا اطلاعات حساب خود را وارد نمایید</p>
        </div>
        
        <div class="login-body">
            @include('errors.message')
            
            <form method="POST" action="{{ route('authshipper') }}">
                @csrf
                
                <div class="form-group">
                    <label for="email" class="form-label"> ایمیل</label>
                    <input type="email" class="form-control" id="email" name="email" required autofocus placeholder="example@example.com">
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">رمز عبور</label>
                    <input type="password" class="form-control" id="password" name="password" required placeholder="••••••••">
                </div>
                
                <button type="submit" class="btn-login">ورود به سیستم</button>
                
                <div class="login-footer">
                    حساب کاربری ندارید؟ 
                    <a href="{{ route('registerShipper') }}">ثبت نام کنید</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>