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
                margin-top:30px;
            }

            .name{
                display:inline-block;
                width:250px; 
            }

            .button{
                border-radius : 5px;
                font-size     : 14pt;
                padding       : 5px 50px;
                background    : white;
                color         : #0066FF;   
                border-color  : #0066FF;        
            } 
            .blue-button1{
                display       : inline-block;
                border-radius : 5px;
                font-size     : 14pt;
                padding       : 5px 40px;
                background    : #0066FF;
                color         : white;    
                margin-top:10px;       
            }  
            .blue-button2{
                display       : inline-block;
                border-radius : 5px;
                font-size     : 14pt;
                padding       : 5px 30px;
                background    : #0066FF;
                color         : white;   
                margin-top:10px;         
            } 
            .blue-button3{
                display       : inline-block;
                border-radius : 5px;
                font-size     : 14pt;
                padding       : 5px 10px;
                background    : #0066FF;
                color         : white;  
                margin-top:10px;          
            } 
            .blue-button4{
                display       : inline-block;
                border-radius : 5px;
                font-size     : 14pt;
                padding       : 5px 25px;
                background    : #0066FF;
                color         : white;  
                margin-top:10px;  
                text-decoration: none;        
            } 
            .buttons{
                display:inline-block;
                margin-left:250px;
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
    <form action="{{  route('mypage.post') }}" method="post">
    @csrf
        <div class="item"><span class="name">氏名</span> {{ $items['name_sei'] }} {{ $items['name_mei'] }}</div>
        <div class="item"><span class="name">ニックネーム</span> {{ $items['nickname'] }}</div>
        <div class="item">
        <span class="name">性別</span>
        @foreach(config('master.gender') as $key => $value)
        @if($items['gender'] == $key) {{ $value }} @endif
        @endforeach
        </div>
        <span class="buttons">
            <button class="blue-button1" name="changeinfo" type="submit">会員情報変更</button>
        </span>
        <div class="item"><span class="name">パスワード</span> セキュリティのため非表示</div>
        <span class="buttons">
            <button class="blue-button2" name="changepass" type="submit">パスワード変更</button>
        </span>
        <div class="item"><span class="name">メールアドレス</span> {{ $items['email'] }}</div>
        <span class="buttons">
            <button class="blue-button3" name="changemail" type="submit">メールアドレス変更</button>
        </span>
        <div class="item">
            <span class="buttons">
            <a href="/review_manage" class="blue-button4">商品レビュー管理</a>
            </span>
        </div>
        <div class="item">
            <span class="buttons">
                <button class="button" name="withdrawal" type="submit">退会</button>
            </span>
        </div>
    </form>
            
        
    </div>
</body>
</html>
