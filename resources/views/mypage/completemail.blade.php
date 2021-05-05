<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>メールアドレス変更認証メール送信フォーム</title>


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
                width:65%;
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
            .code{
                margin-top:50px;
                margin-bottom:60px;
            }
            .character{
                width:250px;
                display: inline-block;
            }
            .error{
                color:red;
            }

        </style>
    </head>


<body>
    
<h1>メールアドレス変更 認証コード入力</h1>
    <div class="container">
    （※メールアドレスの変更はまだ完了していません）<br>
    変更後のメールアドレスにお送りしましたメールに記載されている「認証コード｣を入力してください。
    <form action="{{  route('completemail.post') }}" method="post">
    @csrf

        <div class="code">
            <span class="character">認証コード</span>
            <input type="text" name="auth_code" style="width:300px;"><br>
            @if(isset($error))
            <span class="error">{{$error}}</span>
            @endif
        </div>
    <button class="orange-button" name="complete" type="submit">認証コードを送信してメールアドレスの変更を完了する</button><br><br>
    </form>

    </div>
</body>
</html>
