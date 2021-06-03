<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>商品レビュー登録・編集ページ</title>


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
            h3{
                font-weight:bold;
            }
            .header a{
                text-decoration: none;
                color:black;
            }
            .header-left{
                float:left;
                font-size:22px;
                padding-left:50px;
                padding-top:25px;
                width:40%;
                font-weight:bold;
            }
            .container{
                text-align:left;
                width:40%;
                font-size: 16px;
            }
            .blue-button{
                background-color:#0066FF;
                color:white;
                font-size:18px;
                font-weight:bold;
                padding:10px 50px;
                border-style: none;
                border-radius: 5px;
            }
            .white-button{
                background-color:white;
                color:#0066FF;
                font-size:18px;
                font-weight:bold;
                padding:10px 50px;
                border-style: none;
                border-radius: 5px;
            }
            .button{
                text-align:center;
                margin-top:40px;
            }
            .item{
                display: inline-block;
                width:140px;
            }
            .error{
                color:red;
                margin-left:100px;
            }
            hr{
                clear: both;
            }
            .upper{
                margin-top:30px;
                margin-bottom:30px;
            }
            .side{
                float:left;
                margin-left:40px;
                margin-bottom:30px;
            }
            .product{
                margin-bottom:15px;
            }
            .bottom{
                margin-bottom: 20px;
                margin-left:60px;
            }
            textarea{
                vertical-align:top;
            }

        </style>
    </head>


<body>
    <div class="header">
        <div class="header-left">
        @if( url()->previous() === url("/reviews_register"))
            <h3>商品レビュー登録確認</h3>
        @else
            <h3>商品レビュー編集確認</h3>
        @endif
        </div>
        <ul>
        <li><a href="{{ action('ManagementController@gettop') }}">トップに戻る</a></li>
       </ul>
    </div>

    <div class="container">

        <div class="upper">
            <div class="side">
            @if(isset($items->file1))
                <img src="{{ asset($items->file1) }}" width="200" height="130">
            @else
                <img src="{{ asset('/storage/products/noimage.jpg') }}" width="200" height="130">
            @endif
            </div>

            <div class="side">
                <div class="product">
                商品ID　{{ $items->product_id }}
                </div>

                <div class="product">
                {{ $items->product_name }}
                </div>
                
                <div class="product">
                @if(isset($totalevaluation))
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
                </div>
            </div>
        </div>


        <hr color="black">
        {{Form::open(['method'=>'POST','route' => ['reviews_confirm.post',$items->review_id]])}}

        <div class="bottom"> 
            <span class="item">ID</span>
            @if( url()->previous() === url("/reviews_register"))
            登録後に自動採番
            @else
            {{ $id}}
            @endif
        </div>

        <div class="bottom"> 
            <span class="item">商品評価</span>
            {{ $input['evaluation'] }}
        </div>
        
        <div class="bottom"> 
            <span class="item">商品コメント</span>
            {{ $input['comment'] }}
        </div>

    </div>

    <div class="button">
        {{Form::submit('編集完了', ['class'=>'blue-button'])}}
        
        {{Form::close()}}

        <br><br>
        
        <button class="white-button" onClick="history.back()">前に戻る</button>
    </div>



</body>
</html>
