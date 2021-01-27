<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>パスワード再設定（メール送信完了）</title>


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
            .white-button{
                background-color:white;
                color:#FF9900;
                font-size:18px;
                font-weight:bold;
                padding:10px 70px;
                border-color: #FF9900;
                border-radius: 5px;
            }
        </style>
    </head>


<body>

    <div class="header">
    </div>

    <div class="container">
        <br><br>
        パスワード再設定の案内メールを送信しました。<br>
        （まだパスワード再設定は完了しておりません）<br>
        届きましたらメールに記載されている<br>
        『パスワード再設定URL』をクリックし、<br>
        パスワードの再設定を完了させてください。<br><br><br><br>

        <form method="post" action="{{ route('resetpw_sent.post') }}">
            @csrf
            <input type="submit" class="white-button" name="back" value="トップに戻る">
        </form>

    </div>

</body>
</html>
