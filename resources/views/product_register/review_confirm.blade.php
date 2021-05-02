<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>商品レビュー登録確認</title>


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
            .search{
                font-size:18px;
                padding:5px 50px;
                background-color:white;
            }
            .white-button{
                background-color:white;
                color:#0099FF;
                font-size:18px;
                font-weight:bold;
                padding:10px 70px;
                border-color: #0099FF;
                border-radius: 5px;
                text-decoration: none;
            }
            .blue-button{
                display       : inline-block;
                border-radius : 5px;
                font-size     : 14pt;
                padding       : 5px 50px;
                background    : #0066FF;
                color         : white;           
            }
            .button{
                display       : inline-block;
                border-radius : 5px;
                font-size     : 14pt;
                padding       : 5px 50px;
                background    : white;
                color         : #0066FF;   
                border-color  : #0066FF;        
            }    
            .upper2{
                float:left;
            }
            hr{
                clear: both;
            }
            .picture{
                padding-left:60px;
            }
            .product{
                text-align:left;
                padding-left:40px;
            }
            .evalu{
                text-align:left;
                padding-left:40px;
            }
            .evaluations{
                float:left;
                padding-left:80px;
            }   
            .bold{
                float:left;
                padding-left:80px;
                font-weight:bold;
            }  
            .value{
                float:left;
                padding-left:80px;
            }  
            .value2{
                padding-left:115px;
            }

        </style>
    </head>


<body>


<div class="header">
    <div class="header-left">
    商品レビュー登録確認
    </div>

    <ul>
       <li><a href="{{ action('member_loginController@gettop') }}">トップに戻る</a></li>
    </ul>
</div>

<br>

<div class="container">
<div class="upper">
    <div class="upper2">
    <p class="picture">
        @if(isset($items->file1))
            <img src="{{ asset($items->file1) }}" width="200" height="130">
        @else
            <img src="{{ asset('/storage/products/noimage.jpg') }}" width="200" height="130">
        @endif
    </p>
    </div>

    <div class="upper2">
            <br>
            <p class="product">{{ $items->product_name }}</p>

            <p class="evalu">
            @if(isset($items->evaluations))
                総合評価&emsp;
                @if($totalevaluation == 1)
                　★
                @elseif($totalevaluation == 2)
                　★★
                @elseif($totalevaluation == 3)
                　★★★
                @elseif($totalevaluation == 4)
                　★★★★
                @elseif($totalevaluation == 5)
                　★★★★★
                @endif
                &emsp; 
                {{$totalevaluation}} 
            @else
                総合評価　0
            @endif
            </p>
        </div>
</div>

<hr color="black">
<br>
{{Form::open(['method'=>'POST','route' => ['reviewconfirm.post',$items->product_id]])}}
<span class="bold">商品評価</span> 
<span class="value value2">{{ $input['evaluation'] }}</span> 
<br><br>
<span class="bold">商品コメント</span>
<span class="value">{{ $input['comment'] }}</span>
<br><br><br>
{{Form::submit('登録する', ['class'=>'blue-button'])}}<br><br>

{{Form::close()}}

<button class="button" onClick="history.back()">前に戻る</button>

</div>
<br><br>
</body>
</html>

