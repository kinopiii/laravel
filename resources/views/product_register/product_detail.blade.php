<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>商品詳細</title>


        <style>
            body {
                background-color: #ffe4b5;
            }
            .container{
                text-align:center;
                width:60%;
                margin: auto;
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
            .button{
                display       : inline-block;
                border-radius : 5px;
                font-size     : 14pt;
                padding       : 5px 15px;
                background    : #0066FF;
                color         : white;   
                text-decoration:none;        
            }   
            .category{
                font-size:18px;
                text-align:left;
                margin-bottom:25px;
            }
            .productname{
                font-size:24px;
                text-align:left;
                font-weight:bold;
            }
            .update{
                font-size:16px;
                margin-left:100px;
            }
            .picture{
                padding-right:10px;
                margin-bottom:25px;
            }
            .content{
                font-size:18px;
                text-align:left;
                margin-bottom:60px;
            }
            .return{
                margin-left:400px;
            }
            .middle{
                text-align:left;
                margin-bottom:25px;
            }
        </style>
    </head>


<body>


<div class="header">
    <div class="header-left">
    商品詳細
    </div>

    <ul>
        <li><a href="{{ action('member_loginController@gettop') }}">トップに戻る</a></li>
    </ul>
</div>

<br>

<div class="container">
    <div class="category"> {{ $items->category_name }}  >　{{ $items->subcategory_name }} </div>
    <div class="middle">
        <span class="productname">{{ $items->product_name }}</span> 
        <span class="update">更新日時：{{ $items->update }} </span>
    </div>
    <div class="picture">
        @if(isset($items->file1))
        <img src="{{ asset($items->file1) }}" width="200" height="130">
        @else
        <img src="{{ asset('/storage/products/noimage.jpg') }}" width="200" height="130">
        @endif

        @if(isset($items->file2))
        <img src="{{ asset($items->file2) }}" width="200" height="130">
        @else
        <img src="{{ asset('/storage/products/noimage.jpg') }}" width="200" height="130">
        @endif

        @if(isset($items->file3))
        <img src="{{ asset($items->file3) }}" width="200" height="130">
        @else
        <img src="{{ asset('/storage/products/noimage.jpg') }}" width="200" height="130">
        @endif

        @if(isset($items->file4))
        <img src="{{ asset($items->file4) }}" width="200" height="130">
        @else
        <img src="{{ asset('/storage/products/noimage.jpg') }}" width="200" height="130">
        @endif
    </div>
    <div class="content">
        ■商品説明<br>
        {{ $items->content }}
    </div>

    <div class="return">
        <button class="button" onClick="history.back()">商品一覧に戻る</button>
    </div>
</div>

</body>
</html>

