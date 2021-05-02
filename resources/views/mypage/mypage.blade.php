<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>マイページ</title>


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
                font-weight:bold;
                margin-top:30px;
                padding-left:50px;
                width:20%;
            }

            .container{
                text-align:left;
                font-size:20px;
                margin-top:60px;
                margin-left: auto;
                margin-right: auto;
                width:40%;
            }

            .item{
                margin-top:40px;
            }

            .name{
                display:inline-block;
                width:250px; 
            }
        </style>
    </head>


<body>
    <div class="header">
        <div class="header-left">
        マイページ
        </div>
        <ul>
          <li><a class="forgetpw" href="{{ route('top.post') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a></li>
          <form id="logout-form" action="{{ route('top.post') }}" method="POST" style="display: none;">
          @csrf
          </form>
          <li><a href="{{  route('top.show') }}">トップに戻る</a></li> 
       </ul>
    </div>

    <div class="container">
        <div class="item"><span class="name">氏名</span> {{ $items['name_sei'] }} {{ $items['name_mei'] }}</div>
        <div class="item"><span class="name">ニックネーム</span> {{ $items['nickname'] }}</div>
        <div class="item">
        <span class="name">性別</span>
        @foreach(config('master.gender') as $key => $value)
        @if($items['gender'] == $key) {{ $value }} @endif
        @endforeach
        </div>
        <div class="item"><span class="name">パスワード</span> セキュリティのため非表示</div>
        <div class="item"><span class="name">メールアドレス</span> {{ $items['email'] }}</div>
    </div>

</body>
</html>
