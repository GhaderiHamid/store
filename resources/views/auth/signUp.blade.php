<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="/css/style1.css">
    </head>

    <body>
               
                @include('errors.message')

        <div class="container">
            <form action="{{ route('register') }}" method="post">
                @csrf
                <h3> فرم ثبت نام </h3>
               
                <div class="input-field ">
                    <input type="text" name="first_name" id="userName" required />
                    <label> لطفا نام خود را وارد کنید </label>
                </div>
                <div class="input-field">
                    <input type="text" name="last_name" id="userName" required />
                    <label> لطفا نام خانوادگی خود را وارد کنید </label>
                </div>
<div class="input-field">
    <input type="text" name="email" id="email" required />
    <label>لطفا ایمیل خود را وارد کنید </label>
</div>
                <div class="input-field">
                    <input type="password" name="password" id="password" required />
                    <label>لطفا پسورد خود را وارد کنید </label>
                </div>
                <div class="input-field">
                    <input type="text" name="phone" id="phone" required />
                    <label>لطفا شماره تلفن خود را وارد کنید </label>
                </div>
                <button type="submit" name="" class="">ثبت نام </button>
                <div class="signIn-account">
                    <p>حساب کاربری دارید؟ <a href="{{ route('sigIn') }}"> ورود </a></p>
                </div>
            </form>
        </div>

    
    </body>

</html>