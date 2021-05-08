<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ログインフォーム</title>


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
            .container{
                text-align:center;
            }
            .blue-button{
                background-color:#0066FF;
                color:white;
                font-size:18px;
                font-weight:bold;
                padding:10px 60px;
                border-style: none;
                border-radius: 5px;
            }
            .forgetpw{
                text-decoration: none;
                color:mediumblue;
            }
            .error{
                color:red;
            }
            .item{
                width:150px;
                display:inline-block;
            }
            .id{

            }
            .pass{
                margin-top:20px;
                margin-bottom:80px;
            }

        </style>
    </head>


<body>
<div class="header">
</div>
<div class="container">

<h1>管理画面</h1>
<br><br>


<form method="post" action="{{ route('manage_login.post') }}">
    @csrf
    <div class = "id">
    <span class="item">ログインID</span><input type=text name="login_id" style="width:300px;" value="{{ old('login_id') }}">
    @error('login_id')
        <br><span class ="error">{{$message}}</span>
    @enderror
    </div>

    <div class = "pass">
    <span class="item">パスワード</span><input type=password name="password" style="width:300px;" value="{{ old('password')}}">
    @error('password')
        <br><span class ="error">{{$message}}</span>
    @enderror
    
    @error('login')
        <br><span class ="error">{{$message}}</span>
    @enderror
    </div>
    <input type="submit" class="blue-button" value="ログイン"><br><br>

</form>

</div>
</body>
</html>
