<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>商品登録・編集画面</title>


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
                width:45%;
                margin-top:30px;
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
            }
            .button{
                text-align:center;
            }
            .upload-button{
                background-color:white;
                color:#FF9900;
                font-size:12px;
                font-weight:bold;
                padding:5px 10px;
                border-color: #FF9900;
                border-radius: 5px;
                text-decoration: none;
            }
            .item{
                display: inline-block;
                width:180px;
            }
            .upload{
                display: inline-block;
                width:230px;
            }
            .error{
                color:red;
                margin-left:180px;
            }
            .buttons{
                text-align:center;
            }
            textarea{
                vertical-align:top;
            }
            .content{
                margin-left:180px;
            }


        </style>
    </head>


<body>
    <div class="header">
        <div class="header-left">
            @if( url()->previous() === url("/product_register"))
                <h3>商品登録確認</h3>
            @else
                <h3>商品編集確認</h3>
            @endif
        </div>
        <ul>
        <li><a href="{{ action('ManagementController@getproduct_list') }}">一覧に戻る</a></li>
       </ul>
    </div>

    <div class="container">
       
        <form method="post" action="{{ route('product_confirm.post') }}">
            @csrf
            <span class="item">商品ID</span>
            @if( url()->previous() === url("/product_register"))
                登録後に自動採番
            @else
                {{ $id }}
            @endif

            <br><br>
            
            <span class="item">商品名</span>
            {{ $input['name'] }}<br><br>
            
            <span class="item">製品カテゴリ</span>

            @foreach($category as $key => $value)
                @if($input['category'] == $key) {{ $value }} @endif 
            @endforeach
            >
            @foreach($subcategory as $key => $value)
                @if($input['subcategory'] == $key) {{ $value }} @endif 
            @endforeach

            <br><br>
            
            <span class="item">商品写真</span>

            @if(!empty($read_temp_path1))
                写真1<br><span class="item"></span>
                <img src="{{ $read_temp_path1 }}" width="200" height="130"><br><br>            
            @elseif(isset($items->file1))
                写真1<br><span class="item"></span>
                <img src="{{ asset($items->file1) }}" width="200" height="130"><br><br>
            @endif
            
            
            @if(!empty($read_temp_path2))
                <span class="item"></span>写真2<br><span class="item"></span>
                <img src="{{ $read_temp_path2 }}" width="200" height="130"><br><br>            
            @elseif(isset($items->file2))
                <span class="item"></span>写真2<br><span class="item"></span>
                <img src="{{ asset($items->file2) }}" width="200" height="130"><br><br>
            @endif
            
            
            @if(!empty($read_temp_path3))
                <span class="item"></span>写真3<br><span class="item"></span>
                <img src="{{ $read_temp_path3 }}" width="200" height="130"><br><br>            
            @elseif(isset($items->file3))
                <span class="item"></span>写真3<br><span class="item"></span>
                <img src="{{ asset($items->file3) }}" width="200" height="130"><br><br>
            @endif
            
            
            @if (!empty($read_temp_path4))
                <span class="item"></span>写真4<br><span class="item"></span>
                <img src="{{ $read_temp_path4 }}" width="200" height="130"><br><br>            
            @elseif(isset($items->file4))
                <span class="item"></span>写真4<br><span class="item"></span>
                <img src="{{ asset($items->file4) }}" width="200" height="130"><br><br>            
            @endif
            
            <br><br>
            
            <span class="item">商品説明</span>
            <div class="content">
            {{ $input['product_content'] }}
            </div>
            <br><br>
        </div>

        <div class="buttons">
            @if( url()->previous() === url("/product_register"))
                <input type="submit" class="white-button" value="登録完了">
            @else
                <input type="submit" class="white-button" value="編集完了">
            @endif
        </div>
        </form>
<br><br><br>


</body>
</html>
