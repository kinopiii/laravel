<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>会員情報変更ページ</title>


        <style>
            body {
                background-color: #ffe4b5;
            }
            h1{
                margin-top:40px;
                text-align:center;
            }
            .container{
                text-align:center;
                font-size:20px;
                margin-top:60px;
                margin-left: auto;
                margin-right: auto;
                width:60%;
            }
            .orange-button{
                display       : inline-block;
                border-radius : 5px;
                border-color  :#FF8C00;
                font-size     : 14pt;
                padding       : 5px 50px;
                background    : #FF8C00;
                color         : white;    
                margin-top:10px;       
            } 
            .white-button{
                border-radius : 5px;
                font-size     : 14pt;
                padding       : 5px 50px;
                background    : white;
                color         : #FF8C00;   
                border-color  : #FF8C00;    
                text-decoration:none;    
            } 
            .nickname{
                margin-top:40px;
            }
            .gender{
                margin-top:40px;
                margin-bottom:40px;
            }
            .error{
                color:red;
            }
        </style>
    </head>


<body>
    
<h1>会員情報変更確認画面</h1>
    <div class="container">
    
    <form action="{{  route('confirminfo.post') }}" method="post">
    @csrf
    <div>
        <div class="name">
            氏名&emsp;
            {{ $input['name_sei'] }}&emsp;
            {{ $input['name_mei'] }}&emsp;
        </div>

        <div class="nickname">
            ニックネーム&emsp;&emsp;&emsp;
            {{ $input['nickname'] }}&emsp;
        </div>

        <div class="gender">
            性別&emsp;&emsp;&emsp;&emsp;
            @foreach(config('master.gender') as $key => $value)
            @if($input['gender'] == $key) {{ $value }} @endif 
            @endforeach    
        </div>
    </div>
    
    <button class="orange-button" name="confirm" type="submit">変更完了</button><br><br>
    <button class="white-button" name="return" type="submit">前に戻る</button>
    </form>
    
            
        
    </div>
</body>
</html>
