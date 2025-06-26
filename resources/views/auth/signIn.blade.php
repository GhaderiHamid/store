<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ورود کاربر</title>

        <link rel="stylesheet" href="/css/style1.css">
    </head>

    <body>
        @include('errors.message')
        <div class="container-signIn">
          
      
            <form action="{{ route('login') }}" method="post">
                @csrf
                <h3>فرم ورود </h3>
                <div class="input-field">
                    <input type="text" name="email" id="email" required />
                    <label>لطفا ایمیل خود را وارد کنید </label>
                </div>
                <div class="input-field">
                    <input type="password" name="password" id="password" required />
                    <label>لطفا پسورد خود را وارد کنید </label>
                </div>
                <button type="submit" name="" class="button-signIn"> ورود</button>
                <div class="Create-account ">
                    <p>حساب کاربری ندارید؟ <a href="{{ route('signUp') }}">ایجاد حساب </a></p>
                </div>
            </form>
        </div>
 






    </body>

</html>