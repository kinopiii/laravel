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
            .button{
                text-align:center;
                margin-top:40px;
            }
            .item{
                display: inline-block;
                width:140px;
            }
            .error1{
                color:red;
            }
            .error2{
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
            .center{
                text-align:center;
            }

        </style>
    </head>


<body>
    <div class="header">
        <div class="header-left">
        @if(Route::is('reviews_register.show'))
            <h3>商品レビュー登録</h3>
        @elseif(Route::is('reviews_edit.show'))
            <h3>商品レビュー編集</h3>
        @endif
        </div>
        <ul>
        <li><a href="{{ action('ManagementController@getreview_list') }}">一覧に戻る</a></li>
       </ul>
    </div>

    <div class="container">

        <div class="upper">
        @if(Route::is('reviews_edit.show'))
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
        @else
            <div class = "center">
            {{Form::open(['method'=>'POST','route' => ['reviews_register.post']])}}
            レビューを登録したい商品IDを下記に入力してください。<br><br>
            <input type="text" name="product_id" value = "{{ old('product_id') }}"> 
            <br>
            @error('product_id')
            <span class ="error1">{{$message}}</span><br>
            @enderror
            </div>

        @endif
        </div>


        <hr color="black">
            @if(Route::is('reviews_edit.show'))
            {{Form::open(['method'=>'POST','route' => ['reviews_edit.post',$items->review_id]])}}

            <div class="bottom"> 
                <span class="item">ID</span>
                {{ $items->review_id }}
            </div>

            <div class="bottom"> 
                <span class="item">商品評価</span>
                {{Form::selectRange('evaluation', 1, 5, old('evaluation',$items->evaluation), ['style' => 'width:100px; text-indent:45%;'])}}
                <br>
                @error('evaluation')
                <span class ="error2">{{$message}}</span><br>
                @enderror
            </div>
            
            <div class="bottom"> 
                <span class="item">商品コメント</span>
                <textarea name="comment" rows="5" cols="40">{{old('comment', $items->comment) }}</textarea>
                <br>
                @error('comment')
                <span class ="error2">{{$message}}</span><br>
                @enderror
            </div>

    </div>

            <div class="button">
                {{Form::submit('確認画面へ', ['class'=>'blue-button'])}}
            </div>
                {{Form::close()}}

            @else
            <div class="bottom"> 
                <span class="item">ID</span>
                登録後に自動採番
            </div>

            <div class="bottom"> 
                <span class="item">商品評価</span>
                {{Form::selectRange('evaluation', 1, 5, old('evaluation'), ['style' => 'width:100px; text-indent:45%;','placeholder'=>''])}}
                <br>
                @error('evaluation')
                <span class ="error2">{{$message}}</span><br>
                @enderror
            </div>
            
            <div class="bottom"> 
                <span class="item">商品コメント</span>
                <textarea name="comment" rows="5" cols="40">{{old('comment') }}</textarea>
                <br>
                @error('comment')
                <span class ="error2">{{$message}}</span><br>
                @enderror
            </div>

            <div class="button">
                {{Form::submit('確認画面へ', ['class'=>'blue-button'])}}
            </div>

            {{Form::close()}}

            @endif
</body>
</html>
