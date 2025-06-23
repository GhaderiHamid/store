<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ثبت نام مامور ارسال | سامانه حمل و نقل</title>
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
            padding: 10px;
        }
        
        .register-container {
            width: 100%;
            max-width: 400px;
            background: white;
            border-radius: 14px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            position: relative;
            z-index: 1;
        }
        
        .register-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 15px;
            text-align: center;
        }
        
        .logo {
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 50%;
            margin: 0 auto 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }
        
        .logo .material-symbols-outlined {
            font-size: 28px;
            color: var(--primary-color);
        }
        
        .register-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .register-subtitle {
            font-size: 0.8rem;
            opacity: 0.9;
        }
        
        .register-body {
            padding: 15px;
        }
        
        .form-group {
            margin-bottom: 12px;
        }
        
        .form-row {
            display: flex;
            gap: 10px;
            margin-bottom: 12px;
        }
        
        .form-col {
            flex: 1;
        }
        
        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: var(--text-color);
            font-size: 0.85rem;
        }
        
        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1.5px solid #a3a3a3;
            border-radius: 8px;
            font-size: 0.85rem;
            background-color: #f8f9fa;
        }
        
        .form-control:focus {
            border-color: var(--accent-color);
            outline: none;
        }
        
        .btn-register {
            width: 100%;
            padding: 10px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-top: 8px;
            cursor: pointer;
        }
        
        .register-footer {
            text-align: center;
            margin-top: 12px;
            color: #6c757d;
            font-size: 0.8rem;
        }
        
        .register-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }
        
        .error-message {
            color: var(--error-color);
            font-size: 0.75rem;
            margin-top: 3px;
        }
        
        @media (max-width: 576px) {
            .register-container {
                max-width: 340px;
            }
            
            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <div class="logo">
                <span class="material-symbols-outlined">local_shipping</span>
            </div>
            <h1 class="register-title">ثبت نام مامور ارسال</h1>
            <p class="register-subtitle">لطفا اطلاعات مورد نیاز را وارد نمایید</p>
        </div>
        
        <div class="register-body">
            @include('errors.message')
            
            <form method="POST" action="{{ route('storeShipper') }}">
                @csrf
                
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="first_name" class="form-label">نام</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required autofocus>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="last_name" class="form-label">نام خانوادگی</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required >
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="phone" class="form-label">شماره همراه</label>
                    <input type="tel" class="form-control" id="phone" name="phone" required >
                </div>
                
                <div class="form-group">
                    <label for="email" class="form-label">آدرس ایمیل</label>
                    <input type="email" class="form-control" id="email" name="email" required >
                </div>
                
                <div class="form-group">
                    <label for="city" class="form-label">شهر</label>
                    <input type="text" class="form-control" id="city" name="city" required >
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">رمز عبور</label>
                    <input type="password" class="form-control" id="password" name="password" required >
                </div>
                
                <button type="submit" class="btn-register">ثبت نام</button>
                
                <div class="register-footer">
                    قبلاً ثبت نام کرده‌اید؟ 
                    <a href="{{ route('loginShipper') }}">وارد شوید</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>