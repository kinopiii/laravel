<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>商品レビュー編集</title>


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
                margin-top:30px;
                margin-left: auto;
                margin-right: auto;
                width:50%;
            }

            .white-button{
                border-radius : 5px;
                font-size     : 14pt;
                padding       : 5px 20px;
                background    : white;
                color         : #0066FF;   
                border-color  : #0066FF;    
                text-decoration:none;    
            } 
            .blue-button{
                display       : inline-block;
                border-radius : 5px;
                font-size     : 14pt;
                padding       : 5px 10px;
                background    : #0066FF;
                color         : white;      
            } 
            .buttons{
                margin-left:300px;
            }
            .clear{
                clear: both;  
                padding-top:20px; 
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
            .comments{
                float:left;
                margin-left:80px;
            }
            .evaluation{
                padding-left:110px;
            }
            .error{
                color:red;
            }
        </style>
    </head>


<body>
    <div class="header">
        <div class="header-left">
        商品レビュー編集
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
    <br>
    <hr color="black">
    <br>
    
    <div>
        <div class="evaluations">商品評価</div>
        <div class="evaluations evaluation">
        {{Form::open(['method'=>'POST','route' => ['reviews_edit.post',$id]])}}
            {{Form::selectRange('evaluation', 1, 5, old('evaluation' , $items['evaluations'] ), ['style' => 'width:100px; text-indent:45%;'])}}
            @error('evaluation')
            <br><span class ="error">{{$message}}</span>
            @enderror
        </div>
    </div>

    <br><br>

    <div>    
        <div class="comments">商品コメント</div>
        <div class="comments">
            {{Form::textarea('comment', old('comment' , $items['comments'] ), ['rows' => '10','cols' => '50'])}}<br>
            @error('comment')
            <span class ="error">{{$message}}</span><br>
            @enderror
        </div>
    </div>
    

    <div class="buttons"><p class="clear">{{Form::submit('商品レビュー編集確認', ['class'=>'blue-button'])}}</p></div>

    {{Form::close()}}
    

    <div class="buttons"><a href="/review_manage" class="white-button">レビュー管理に戻る</a></div>

    </div>
</body>
</html>
