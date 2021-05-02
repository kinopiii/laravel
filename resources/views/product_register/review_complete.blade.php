<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>商品レビュー登録</title>


        <style>
            body {
                background-color: #ffe4b5;
            }
            .container{
                text-align:center;
                width:60%;
                margin: auto;
            }
            .box{
                height:180px;
                border:2px solid #000000;
                background-color:white;
            }
            .header{
                background-color: #FFCC99;
                height:90px;
                padding:0px;
                margin:0px;
                width:auto;
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
            .header a{
                text-decoration: none;
                color:black;
            }
            .header-left{
                float:left;
                font-size:30px;
                font-weight:bold;
                margin-top:30px;
                padding-left:50px;
                width:20%;
            }
            .blue-button{
                display       : inline-block;
                border-radius : 5px;
                font-size     : 14pt;
                padding       : 5px 50px;
                background    : #0066FF;
                color         : white;
                text-decoration: none;           
            }
            .button{
                display       : inline-block;
                border-radius : 5px;
                font-size     : 14pt;
                padding       : 5px 30px;
                background    : white;
                color         : #0066FF;   
                border-color  : #0066FF;
                text-decoration: none;        
            }    
            .complete{
                font-size:20px;
            }
            

        </style>
    </head>


<body>


<div class="header">
    <div class="header-left">
    商品レビュー登録完了
    </div>

    <ul>
        <li><a href="{{ action('member_loginController@gettop') }}">トップに戻る</a></li>
    </ul>
</div>

<br>

<div class="container">
<br><br>
<p class="complete">商品レビューの登録が完了しました。</p>
<br><br>


<a href="/review_list/{{$id}}" class="button">商品レビュー一覧へ</a>
<br><br><br>

<a href="/products_detail/{{$id}}" class="blue-button">商品詳細に戻る</a>
</div>
<br><br>
</body>
</html>

