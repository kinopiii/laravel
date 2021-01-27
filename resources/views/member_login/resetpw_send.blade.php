<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>パスワード再設定（メール送信）</title>


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
                padding:10px 90px;
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

<div class="header">
</div>

<div class="container">
    <br><br>
    パスワード再設定用のURLを記載したメールを送信します。<br>
    ご登録されたメールアドレスを入力してください。<br><br><br><br>

    <form method="post" action="{{ route('resetpw_send.post') }}">
        @csrf
        メールアドレス&emsp;<input type=text name="email" style="width:300px;"><br><br><br><br>
        <input type="submit" class="orange-button" value="送信する"><br><br><br>
    </form>

    <a href="/top" class="white-button">トップに戻る</a><br><br>

</div>


</body>
</html>
