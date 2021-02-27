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
            }
        </style>
    </head>


<body>
    <div class="header">
    </div>

    <div class="container">
        <br><br>

        <form method="post" action="{{ route('resettingpw.post') }}">
            @csrf

            パスワード&emsp;&emsp;&emsp;&ensp;<input type=password name="password" style="width:300px;"><br><br>
            パスワード確認&ensp;&ensp;<input type=password name="confirmpassword" style="width:300px;"><br><br><br>


            <input type="submit" class="orange-button" value="パスワードリセット"><br><br>
            <input type="submit" class="white-button" name="back" value="トップに戻る">

        </form>

    </div>

</body>
</html>
