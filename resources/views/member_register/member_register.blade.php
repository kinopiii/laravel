<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>会員登録フォーム</title>

        <style>
            body {
                background-color: #ffe4b5;
            }

            .container{
                text-align:center;
            }

            .orange-button{
                background-color:#FF9900;
                color:white;
                font-size:18px;
                font-weight:bold;
                padding:10px 70px;
                border-style: none;
                border-radius: 5px;
            }

            .white-button{
                background-color:white;
                color:#FF9900;
                font-size:18px;
                font-weight:bold;
                padding:10px 64px;
                border-color: #FF9900;
                border-radius: 5px;
                text-decoration: none;
            }

            .error{
                color:red;
            }
        </style>
    </head>
    <body>

    <div class="container">
        <br>
        <h1>会員情報登録</h1>

        <form method="post" action="{{ route('form.post') }}">
            @csrf
            氏名&emsp;
            姓&ensp;
            <input type=text name="name_sei" value="{{old('name_sei')}}">&emsp;
            名&ensp;
            <input type=text name="name_mei" value="{{old('name_mei')}}">

            @error('name_sei')
            <br><span class ="error">{{$message}}</span>
            @enderror

            @error('name_mei')
            <br><span class ="error">{{$message}}</span>
            @enderror

            <br><br>

            ニックネーム&emsp;&emsp;&emsp;&emsp;
            <input type=text name="nickname" style="width:300px;" value="{{old('nickname')}}">
            @error('nickname')
            <br><span class ="error">{{$message}}</span>
            @enderror

            <br><br>

            性別&emsp;&emsp;&emsp;&emsp;
            男性&ensp;
            <input type="radio" name="gender" value="1" {{ old('gender') == '1' ? 'checked' : '' }}>&emsp;&ensp;
            女性&ensp;
            <input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;

            @error('gender')
            <br><span class ="error">{{$message}}</span>
            @enderror



            <br><br>

            パスワード&emsp;&emsp;&emsp;&emsp;&emsp;
            <input type=password name="password" style="width:300px;" value="{{old('password')}}">
            @error('password')
            <br><span class ="error">{{$message}}</span>
            @enderror
            <br><br>

            パスワード確認&emsp;&emsp;&emsp;
            <input type=password name="password_confirmation" style="width:300px;" value="{{old('password_confirmation')}}">
            @error('password_confirmation')
            <br><span class ="error">{{$message}}</span>
            @enderror
            <br><br>

            メールアドレス&emsp;&emsp;&emsp;
            <input type=text name="email" style="width:300px;" value="{{old('email')}}">
            @error('email')
            <br><span class ="error">{{$message}}</span>
            @enderror
            <br><br><br>

            <input type="submit" class="orange-button" value="確認画面へ"><br><br>
            <a href="/top" class="white-button">トップに戻る</a><br><br>

        </form>



    </div>
    </body>
</html>
