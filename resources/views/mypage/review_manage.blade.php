<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>商品レビュー管理</title>


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
                font-size:16px;
                margin-top:60px;
                margin-left: auto;
                margin-right: auto;
                width:60%;
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
            tr {
                border-color: black;
                border-style: solid;
                border-width: 1px 0;
            }
            table {
                width: 100%;
            }
            td, th {
                padding: 10px 0px;
            }

            .page{
                position:relative;
                left:300px;
            }
            .category{
                border: solid 1px;
                background-color:white;
            }
            .middle{
                float: left;
                margin-left:80px;
            }
            .category{
                margin-left:100px;
                margin-top:5px;
                text-align:left;
                width:160px;
            }
            .productname{
                margin-left:100px;
                margin-top:15px;
                text-align:left;
            }
            .evaluation{
                margin-left:100px;
                margin-top:15px;
                text-align:left;
            }
            .comment{
                margin-left:100px;
                text-align:left;
            }
            .review{
                margin-left:100px;
                margin-right:10px;
            }
            .blue-button{
                display       : inline-block;
                border-radius : 5px;
                font-size     : 10pt;
                padding       : 5px 40px;
                background    : #0066FF;
                color         : white;    
                margin-top:10px;       
            }  
        </style>
    </head>


<body>
    <div class="header">
        <div class="header-left">
        商品レビュー管理
        </div>
        <ul>
          <li><a href="{{  route('top.show') }}">トップに戻る</a></li> 
       </ul>
    </div>

    <div class="container">

    @if(isset($items))
        @if(!$items->isEmpty())
    　　<table>
            @foreach($items as $item) 
                <tr>
                    <td>
                        <div class="tabledata">
                            <div class="middle">
                                @if(isset($item->file1))
                                <img src="{{ asset($item->file1) }}" width="200" height="130">
                                @else
                                <img src="{{ asset('/storage/products/noimage.jpg') }}" width="200" height="130">
                                @endif
                            </div>
                            
                            <div class="middle">            
                                <div class="category">{{$item->category_name}}  >　{{$item->subcategory_name}}</div>
                                <div class="productname">{{$item->product_name}}</div>
                                <div class="evaluation">
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
                                {{$item->evaluation}}
                                </div>
                                <div class="comment">{!! nl2br(e(Str::limit($item->comment, 30))) !!}</div>
                                
                                <div class="review">
                                    <a href="/review_edit/{{$item->reviewid}}" class="blue-button">レビュー編集</a>
                                    <a href="/review_delete/{{$item->reviewid}}" class="blue-button">レビュー削除</a>
                                </div>
                            </div>
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
    <a href="/mypage" class="white-button">マイページに戻る</a>
    </div>
</body>
</html>
