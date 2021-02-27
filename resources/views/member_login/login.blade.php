<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ログインフォーム</title>


        <style>
            body {
                background-color: #ffe4b5;
            }
            .container{
                text-align:center;
            }
            .orange-button{
                background-color:#FF9900;
                color:white;
                font-size:18px;
                font-weight:bold;
                padding:10px 90px;
                border-style: none;
                border-radius: 5px;
            }
            .white-button{
                background-color:white;
                color:#FF9900;
                font-size:18px;
                font-weight:bold;
                padding:10px 70px;
                border-color: #FF9900;
                border-radius: 5px;
                text-decoration: none;
            }
            .forgetpw{
                text-decoration: none;
                color:mediumblue;
            }
            .error{
                color:red;
            }

        </style>
    </head>


<body>

<div class="container">

<h1>ログイン</h1>
<br><br>


<form method="post" action="{{ route('login.post') }}">
    @csrf
    メールアドレス(ID)&emsp;<input type=text name="email" style="width:300px;" value="{{ old('email') }}"><br><br><br>
    パスワード&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;<input type=password name="password" style="width:300px;"><br><br><br>


    <a href="{{ action('member_loginController@getresetpw_send') }}" class="forgetpw">パスワードを忘れた方はこちら</a><br><br>

   @if(session()->has('message'))
   <span class ="error">{{ session()->get('message') }}</span><br><br>
   @endif


    <input type="submit" class="orange-button" value="ログイン"><br><br>

</form>

<a href="/top" class="white-button">トップに戻る</a><br><br>

</div>
</body>
</html>
