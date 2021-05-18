<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>トップページ</title>


        <style>
            body {
                background-color: #ADD8E6;
            }
            .header{
                background-color: #B0C4DE;
                height:90px;
                padding:0px;
                margin:0px;
                width:auto;
            }
            .header li {
                list-style: none;
                text-decoration: none;
                color:black;
                width:20%;
                float:right;
                padding-top:10px;
                font-size:24px;
                margin-right:20px;
                margin-top:20px;
                text-align:center;
            }
            .header a{
                text-decoration: none;
                color:black;
            }
            .header-left{
                float:left;
                font-size:22px;
                padding-left:50px;
                width:40%;
            }
            .container{
                text-align:center;
            }
            .logout{
                background: transparent;
                padding:15px 30px 15px 30px;
                font-size:20px;
                margin-top:-25px
            }
            .white-button{
                background-color:white;
                color:#0066FF;
                font-size:20px;
                font-weight:bold;
                padding:10px 70px;
                border-color: #0066FF;
                border-radius: 5px;
                text-decoration:none;
                border-style: solid;
            }
            .white-button2{
                background-color:white;
                color:#0066FF;
                font-size:20px;
                font-weight:bold;
                padding:10px 30px;
                border-color: #0066FF;
                border-radius: 5px;
                text-decoration:none;
                border-style: solid;
            }
            .button{
                margin-right:1000px;
                margin-top:90px;
            }
        </style>
    </head>


<body>
    <div class="header">
        <div class="header-left">
        <h3>管理画面メインメニュー</h3>
        </div>
        <ul>
        <form method="post" action="{{ route('manage_top.post') }}">
		@csrf
		<li><input type="submit" class="logout" value="ログアウト"></li>
        </form>
        <li>ようこそ {{$member['name']}} さん</li>
       </ul>
    </div>

    <div class="container">
        <div class="button">
            <a href="{{ action('ManagementController@getmember_list') }}" class="white-button">会員一覧</a>
        </div>
        <div class="button">
            <a href="{{ action('ManagementController@getproduct_cate_list') }}" class="white-button2">商品カテゴリ一覧</a>
        </div>
        <div class="button">
            <a href="{{ action('ManagementController@getproduct_list') }}" class="white-button">商品一覧</a>
        </div>
    </div>
</body>
</html>
