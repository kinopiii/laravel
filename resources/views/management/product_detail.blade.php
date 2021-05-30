<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>商品詳細画面</title>


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

            .re{
                list-style: none;
                text-decoration: none;
                border-style:solid;
                border-width:1px;
                color:black;
                width:20%;
                padding-top:5px;
                padding-bottom:5px;
                text-align:center; 
            }
            .goreview{
                text-decoration: none;
                color:black;
            }
            a.goreview{
                color:black;
                text-decoration:none;
                padding:5px;
                border:1px solid black;
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
                margin-top:30px;
                width:50%;
                margin-right:auto;
                margin-left:auto;
            }
            .white-button{
                background-color:white;
                color:#0066FF;
                font-size:20px;
                font-weight:bold;
                padding:5px 60px;
                border-color: #0066FF;
                border-radius: 5px;
                text-decoration:none;
                margin-right:20px;
                border-style: solid;
                border-width:1px;
            }
            .items{
                margin-bottom:20px;
                text-align:left;
            }
            .item{
                display:inline-block;
                width:200px;
                margin-left:150px;
            }
            .revi{
                display:inline-block;
                float: right;
            }
            .total{
                text-align:center;
                background-color: #B0C4DE;
                height:60px;
                line-height:60px;
                width: 100%;
                font-weight:bold;
                border:1px solid;
                border-color:black;
            }
            .review{
                text-align:left;
                width:70%;
                margin-right:auto;
                margin-left:auto;
            }
            tr {
                border-color: black;
                border-style: solid;
                border-width: 1px 0;
                
            }
            table {
                width: 80%;
                margin-right:auto;
                margin-left:auto;
                
            }
            td, th {
                padding: 15px 0px 15px 0px;
            }
            .tabledata{
                clear: both;
            }
            .page{
                margin-left:600px;
            }

            .buttom{
                text-align:center;
            }

        </style>
    </head>


<body>
    <div class="header">
        <div class="header-left">
            <h3>商品詳細詳細</h3>
        </div>
        <ul>
        <li><a href="{{ action('ManagementController@getproduct_list') }}">一覧に戻る</a></li>
       </ul>
    </div>

<div class="container">
    <form method="post" action="{{ route('product_detail.post') }}">
    @csrf
    <span class="item">ID</span>{{$id}} <br><br>
    <span class="item">商品名</span>{{$items->name}}<br><br>
    <span class="item">商品カテゴリ</span>{{$items->category_name}}>{{$items->subcategory_name}}<br><br>
    <span class="item">商品写真</span>

    写真1<br><span class="item"></span>
    @if(!empty($items->file1))
    <img src="{{ asset($items->file1) }}" width="200" height="130"><br><br>
    @else
    <img src="{{ asset('/storage/products/noimage.jpg') }}" width="200" height="130"><br><br>
    @endif

    
    <span class="item"></span>写真2<br><span class="item"></span>    
    @if(isset($items->file2))
    <img src="{{ asset($items->file2) }}" width="200" height="130"><br><br>
    @else
    <img src="{{ asset('/storage/products/noimage.jpg') }}" width="200" height="130"><br><br>
    @endif

    <span class="item"></span>写真3<br><span class="item"></span>
    @if(isset($items->file3))
    <img src="{{ asset($items->file3) }}" width="200" height="130"><br><br>
    @else
    <img src="{{ asset('/storage/products/noimage.jpg') }}" width="200" height="130"><br><br>
    @endif

    <span class="item"></span>写真4<br><span class="item"></span>
    @if(isset($items->file4))
    <img src="{{ asset($items->file4) }}" width="200" height="130"><br><br>
    @else
    <img src="{{ asset('/storage/products/noimage.jpg') }}" width="200" height="130"><br><br>
    @endif

    <br>
    <span class="item">商品説明</span>{{$items->content}}
    <br><br><br>
</div>

    <div class="total">
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
    &emsp; 
    {{$totalevaluation}} 
    </div>


    
    <div class="review">
        @if(!$reviews->isEmpty())
    　　<table>
            @foreach($reviews as $review) 
                <tr>
                    <td>
                    <div>
                    <span class="item">商品レビューID</span>{{$review->reviewid}}
                    </div>

                    <div>
                    <span class="item"><a href="/manage_member_detail/{{$review->memberid}}">{{$review->nickname}}さん</a></span>
                    @if($review->evaluation == 1)
                    ★
                    @elseif($review->evaluation == 2)
                    ★★
                    @elseif($review->evaluation == 3)
                    ★★★
                    @elseif($review->evaluation == 4)
                    ★★★★
                    @elseif($review->evaluation == 5)
                    ★★★★★
                    @endif
                            
                    {{$review->evaluation}}          
                    </div>
                    
                    <div>
                    <span class="item">商品コメント</span>{{$review->comment}}
                    <span class="revi"><a class="goreview" href="/manage_review_detail/{{$review->reviewid}}">商品レビュー詳細</a></span>
                    </div>
                    </td>
                </tr>   
            @endforeach
        </table>
        <br>
        
        <div class = "page">
        {{ $reviews->appends(request()->query())->links('vendor.pagination.list') }}
        </div>
        @else
        <div class="buttom">
        <br>
        レビューはありません
        @endif
        </div>

        <br>
    <div class="buttom">
        <a href="/product_edit/{{$id}}" class="white-button">編集</a>
        <input type="submit" class="white-button" value="削除">
        <br><br>
    </div>
    </form>
</body>
</html>
