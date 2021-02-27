<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>パスワード再設定（パスワード設定）</title>


        <style>
            body {
                background-color: #ffe4b5;
            }
            .container{
                text-align:center;
            }
            .header{
                background-color: #FFCC99;
                height:90px;
                padding:0px;
                margin:0px;
                width:auto;
            }
            .orange-button{
                background-color:#FF9900;
                color:white;
                font-size:18px;
                font-weight:bold;
                padding:10px 45px;
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
            .error{
                color:red;
            }

        </style>
    </head>

    <div class="header">
    </div>

<body>
<div class="container">
<br><br>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
	<input id="email" type="hidden" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}"  autocomplete="email" autofocus>
            @error('email')
            <span class="error" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
 		<label for="password" class="col-md-4 col-form-label text-md-right" style="width:300px;">パスワード</label>&ensp;&ensp;&ensp;
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" style="width:300px;">
                <br>
                    @error('password')
                        <span class="error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <br>
		<label for="password-confirm" class="col-md-4 col-form-label text-md-right" style="width:300px;">パスワード確認</label>&ensp;          
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password" style="width:300px;">
            <br><br><br>
            <button type="submit" class="orange-button" value="パスワードリセット">パスワードリセット</button>
            <br><br>
    </form>
    <a href="/top" class="white-button">トップに戻る</a><br><br>
</div>
</body>
</html>

