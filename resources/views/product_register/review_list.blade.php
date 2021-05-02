<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>商品レビュー一覧</title>


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
                padding       : 10px 50px;
                background    : #0066FF;
                color         : white;
                text-decoration: none; 
                margin-left:250px;          
            }         
            tr {
                border-color: black;
                border-style: solid;
                border-width: 1px 0;
                
            }
            table {
                width: 100%;
                text-align:left;
            }
            td, th {
                padding: 15px 0px 15px 0px;
            }
            .tabledata{
                clear: both;
            }
            .upper2{
                float:left;
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
            .page{
                float:right;
            } 
            .left{
                width:200px;
                margin-left:80px;
            }
            .right{
                text-align:left;
            }
            .top{
                
            }
            .bottom{
                padding-top:10px;
            }
            .star{
                width:100px;
                display: inline-block; 
            }

        </style>
    </head>


<body>


<div class="header">
    <div class="header-left">
    商品レビュー一覧
    </div>

    <ul>
        <li><a href="{{ action('member_loginController@gettop') }}">トップに戻る</a></li>
    </ul
    >
</div>

<br>

<div class="container">

@if(isset($items) && isset($productitems))


<div class="upper">
    <div class="upper2">
    <p class="picture">
    @if(isset($productitems->image_1))
    <img src="{{ asset($productitems->image_1) }}" width="200" height="130">
    @else
    <img src="{{ asset('/storage/products/noimage.jpg') }}" width="200" height="130">
    @endif
    </p>
    </div>

    <div class="upper2">
        <br>
        <p class="product">{{$productitems->name}}</p>

        <p class="evalu">
        総合評価
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

        {{$totalevaluation}}
        <br>
        </p>
    </div>
</div>

    @if(!$items->isEmpty())
　　<table>
        @foreach($items as $item) 
            <tr>
                <td>
                <div class="left">
                    <div class="top">{{$item->nickname}}さん</div>
                    <div class="bottom">商品コメント</div>
                </div>
                </td>
                <td>
                <div class="right">
                    <div class="top">
                        <div class="star">
                        @if($item->evaluation == 1)
                        ★
                        @elseif($item->evaluation == 2)
                        ★★
                        @elseif($item->evaluation == 3)
                        ★★★
                        @elseif($item->evaluation == 4)
                        ★★★★
                        @elseif($item->evaluation == 5)
                        ★★★★★
                        @endif
                        </div>
                    {{$item->evaluation}}          
                    </div>
                    <div class="bottom">{{$item->comment}}</div>
                </div>
               </td> 
            </tr>   
        @endforeach
    </table>
    <br>
    <div class = "page">
    {{ $items->appends(request()->query())->links('vendor.pagination.list') }}
    </div>
    @endif
@endif

<br><br>
<a href="/products_detail/{{$id}}" class="blue-button">商品詳細に戻る</a>
</div>



</body>
</html>

