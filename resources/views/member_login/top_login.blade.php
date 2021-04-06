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
                width:20%;
            }
        </style>
    </head>


<body>
    <div class="header">
        <div class="header-left">
        ようこそ&ensp;{{Auth::user()->name_sei}}&ensp;{{Auth::user()->name_mei}}様
        </div>
        <ul>
          <li><a class="forgetpw" href="{{ route('top.post') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a></li>
          <form id="logout-form" action="{{ route('top.post') }}" method="POST" style="display: none;">
          @csrf
          </form>
          <li><a href="{{  route('products.show') }}">新規商品登録</a></li> 
       </ul>
    </div>

</body>
</html>
