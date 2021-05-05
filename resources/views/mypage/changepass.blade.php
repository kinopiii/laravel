<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>パスワード変更ページ</title>


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
                width:40%;
            }
            .orange-button{
                display       : inline-block;
                border-radius : 5px;
                border-color  :#FF8C00;
                font-size     : 14pt;
                padding       : 5px 20px;
                background    : #FF8C00;
                color         : white;    
                margin-top:10px;       
            } 
            .white-button{
                border-radius : 5px;
                font-size     : 14pt;
                padding       : 5px 20px;
                background    : white;
                color         : #FF8C00;   
                border-color  : #FF8C00;    
                text-decoration:none;    
            } 
            .character{
                width:150px;
                display: inline-block;
            }
            .pass{
                text-align:left;
                margin-bottom:30px;
            }
            .error{
                color:red;
                margin-left:100px;
            }
        </style>
    </head>


<body>
    
<h1>パスワード変更</h1>
    <div class="container">
    
    <form action="{{  route('changepass.post') }}" method="post">
    @csrf
    <div>
        <div class="pass">
            <span class="character">パスワード</span>
            <input type="text" name="password" style="width:300px;">
            @error('password')
            <br><span class ="error">{{$message}}</span>
            @enderror
        </div>


        <div class="pass">
            <span class="character">パスワード確認</span>
            <input type="text" name="password_confirmation" style="width:300px;">
            @error('password_confirmation')
            <br><span class ="error">{{$message}}</span>
            @enderror
        </div>

    </div>
    
    <button class="orange-button" name="confirm" type="submit">パスワードを変更</button><br><br>
    </form>
    <a href="{{  route('mypage.show') }}" class="white-button">マイページに戻る</a>
            
        
    </div>
</body>
</html>
