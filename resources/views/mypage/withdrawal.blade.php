<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>退会ページ</title>


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
                text-align:center;
                font-size:20px;
                margin-top:80px;
                margin-left: auto;
                margin-right: auto;
                width:40%;
            }

            .white-button{
                display       : inline-block;
                border-radius : 5px;
                font-size     : 14pt;
                padding       : 5px 15px;
                background    : white;
                color         : #0066FF;   
                border-color  : #0066FF; 
                text-decoration:none;       
            }   

            .blue-button{
                display       : inline-block;
                border-radius : 5px;
                font-size     : 14pt;
                padding       : 5px 50px;
                background    : #0066FF;
                color         : white;           
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
        退会します。よろしいですか？<br><br><br>

        <a href="{{  route('mypage.show') }}" class="white-button">マイページに戻る</a><br><br>

        <form action="{{  route('withdrawal.post') }}" method="post">
        @csrf
        <button class="blue-button" name="withdrawal" type="submit">退会する</button>
        </form>
    </div>

</body>
</html>
