<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>トップページ</title>


        <style>
            body {
                background-color: #ffe4b5;
            }

            .header{
                background-color: #FFCC99;
                height:90px;
                padding:0px;
                margin:0px;
                width:auto;
            }

            .header a{
                text-decoration: none;
                color:black;
            }

            .header li {
                list-style: none;
                text-decoration: none;
                border-style: solid;
                color:black;
                width:15%;
                float:right;
                padding-top:10px;
                font-size:24px;
                margin-right:20px;
                margin-top:20px;
                text-align:center;
            }

            .header-left{
                float:left;
                font-size:22px;
                margin-top:30px;
                padding-left:50px;
                width:15%;
            }
        </style>
    </head>


<body>
    <div class="header">

        @if (Auth::check())
        <div class="header-left">
        {{$user->name_sei}}&ensp;{{$user->name_mei}}様
        </div>
        <ul>
        <li><a href="{{ action('member_loginController@logout') }}" class="forgetpw">ログアウト</a></li><br><br>
        @else
        <li><a href="{{ action('member_registerController@getmember_register') }}">新規会員登録</a></li>
        <li><a href="{{ action('member_loginController@getlogin') }}">ログイン</a></li>
        @endif
        </ul>
    </div>

</body>
</html>
