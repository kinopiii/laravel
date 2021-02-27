<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>会員登録完了</title>

        <style>
            body {
                background-color: #ffe4b5;
            }

            .container{
                text-align:center;
            }

            .complete{
                font-size:21px;
            }
            .orange-button{
                background-color:#FF9900;
                color:white;
                font-size:18px;
                font-weight:bold;
                padding:10px 50px;
                border-style: none;
                border-radius: 5px;
                text-decoration: none;            
            }



        </style>
    </head>
    <body>
    <div class="container">
        <br><br><br>
        <h1>会員登録完了</h1>
        
        <br>
        <p class="complete">
        会員登録が完了しました。
        </p>

            <br><br><br><br><a href="/top" class="orange-button">トップに戻る</a>

    </div>
    </body>
</html>
