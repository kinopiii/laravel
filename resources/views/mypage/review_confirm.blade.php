<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>商品レビュー編集確認</title>


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
            .white-button{
                background-color:white;
                color:#0099FF;
                font-size:18px;
                font-weight:bold;
                padding:10px 70px;
                border-color: #0099FF;
                border-radius: 5px;
                text-decoration: none;
                margin-left:200px;  
                
            }
            .blue-button{
                display       : inline-block;
                border-radius : 5px;
                font-size     : 14pt;
                padding       : 10px 70px;
                background    : #0066FF;
                color         : white; 
                margin-left:200px;          
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
        商品レビュー編集確認
        </div>
        <ul>
          <li><a href="{{  route('top.show') }}">トップに戻る</a></li> 
       </ul>
    </div>

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
    {{Form::open(['method'=>'POST','route' => ['reviews_confirm.post',$items->review_id]])}}
    <span class="bold">商品評価</span> 
    <span class="value value2">{{ $input['evaluation'] }}</span> 
    <input type="hidden" name="evaluation" value="{{ $input['evaluation']}}">
    <br><br>
    <span class="bold">商品コメント</span>
    <span class="value">{{ $input['comment'] }}</span>
    <input type="hidden" name="comment" value="{{ $input['comment'] }}">
    <br><br><br>
    {{Form::submit('更新する', ['class'=>'blue-button'])}}<br><br>

    {{Form::close()}}

    <button class="white-button" onClick="history.back()">前に戻る</button>
    </div>
</body>
</html>
