<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>会員登録確認画面</title>

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
                padding:10px 80px;
                border-style: none;
                border-radius: 5px;
            }

            .white-button{
                background-color:white;
                color:#FF9900;
                font-size:18px;
                font-weight:bold;
                padding:10px 80px;
                border-color: #FF9900;
                border-radius: 5px;
            }

        </style>
    </head>
    <body>
    <div class="container">
        <br>
        <h1>会員情報登録</h1>

        <form method="post" action="{{ route('form.register') }}">
        @csrf
            氏名&emsp;
            {{ $input['name_sei'] }}&emsp;
            {{ $input['name_mei'] }}&emsp;

            <br><br>

            ニックネーム&emsp;&emsp;&emsp;
            {{ $input['nickname'] }}&emsp;

            <br><br>

            性別&emsp;&emsp;&emsp;&emsp;
            @foreach(config('master.gender') as $key => $value)
            @if($input['gender'] == $key) {{ $value }} @endif &emsp;&ensp;
            @endforeach

            <br><br>

            パスワード&emsp;&emsp;
            セキュリティのため非表示

            <br><br>

            メールアドレス&emsp;&emsp;&emsp;
            {{ $input['email'] }}

            <br><br><br>


            <input type="submit" class="orange-button" value="登録完了">
            <br><br>

            <input type="submit" class="white-button" name="back" value="前に戻る">

        </form>



    </div>
    </body>
</html>
