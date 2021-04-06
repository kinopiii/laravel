<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>商品登録確認画面</title>


        <style>
            body {
                background-color: #ffe4b5;
            }
            .container{
                text-align:center;
            }
            .koumoku{
              position: absolute;
              left: 500px;
            }
            .box{
              position: absolute;
              left: 650px;            
            }
            .orange-button{
                background-color:#FF9900;
                color:white;
                font-size:18px;
                font-weight:bold;
                padding:10px 40px;
                border-style: none;
                border-radius: 5px;
            }
            .white-button{
                background-color:white;
                color:#FF9900;
                font-size:18px;
                font-weight:bold;
                padding:10px 70px;
                border-color: #FF9900;
                border-radius: 5px;
                text-decoration: none;
            }

        </style>
    </head>


<body>

<div class="container">

<h1>商品登録確認画面</h1>
<br><br>


<form method="post" action="{{ route('productconfirm.post') }}">
    @csrf
    <div class="koumoku">商品名&emsp;</div>
    {{ $input['name'] }}<br><br>
    
    <div class="koumoku">製品カテゴリ</div>

    @foreach($category as $key => $value)
        @if($input['category'] == $key) {{ $value }} @endif 
    @endforeach
    &ensp;
    @foreach($subcategory as $key => $value)
        @if($input['subcategory'] == $key) {{ $value }} @endif 
    @endforeach

    <br><br>
    
    <div class="koumoku">商品写真</div>

 
    @if (!empty($read_temp_path1))
    写真1<br>
    <img src="{{ $read_temp_path1 }}" width="200" height="130">
    @endif
    <br>
    
    @if (!empty($read_temp_path2))
    写真2<br>
    <img src="{{ $read_temp_path2 }}" width="200" height="130">
    <br><br>
    @endif
    
    @if (!empty($read_temp_path3))
    写真3<br>
    <img src="{{ $read_temp_path3 }}" width="200" height="130">
    <br><br>
    @endif
        
    @if (!empty($read_temp_path4))
    写真4<br>
    <img src="{{ $read_temp_path4 }}" width="200" height="130">
    <br><br>
    @endif

    <br>
    <div class="koumoku">商品説明&emsp;</div>
    {{ $input['product_content'] }}
    <br><br>

    <input type="submit" class="orange-button" value="商品を登録する"><br><br>
    <input type="submit" class="white-button" name="back" value="前に戻る">
</form>


</div>


</body>
</html>

