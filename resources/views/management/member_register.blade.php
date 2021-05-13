<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>会員登録ページ</title>


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
            .header li {
                list-style: none;
                text-decoration: none;
                border-style: solid;
                color:black;
                width:15%;
                float:right;
                padding-top:10px;
                font-size:24px;
                margin-right:20px;
                margin-top:20px;
                text-align:center;
            }
            h3{
                font-weight:bold;
            }
            .header a{
                text-decoration: none;
                color:black;
            }
            .header-left{
                float:left;
                font-size:22px;
                padding-left:50px;
                padding-top:25px;
                width:40%;
                font-weight:bold;
            }
            .container{
                text-align:center;
            }
            .white-button{
                background-color:white;
                color:#0066FF;
                font-size:20px;
                font-weight:bold;
                padding:5px 60px;
                border-color: #0066FF;
                border-radius: 5px;
                text-decoration:none;
            }
            .id{
                margin-right:300px;
            }
            .error{
                color:red;
            }

        </style>
    </head>


<body>
    <div class="header">
        <div class="header-left">
            <h3>会員登録</h3>
        </div>
        <ul>
        <li><a href="{{ action('ManagementController@getmember_list') }}">一覧に戻る</a></li>
       </ul>
    </div>
<br>
    <div class="container">
    <form method="post" action="{{ route('manage_member_register.post') }}">
            @csrf
            <div class="id">
            ID 　   　登録後に自動採番</div><br>
            氏名&emsp;
            姓&ensp;
            <input type=text name="name_sei" style="width:170px;" value="{{old('name_sei')}}">&emsp;
            名&ensp;
            <input type=text name="name_mei" style="width:170px;" value="{{old('name_mei')}}">

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
            <input type=password name="password" style="width:300px;">
            @error('password')
            <br><span class ="error">{{$message}}</span>
            @enderror
            <br><br>

            パスワード確認&emsp;&emsp;&emsp;
            <input type=password name="password_confirmation" style="width:300px;">
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

            <input type="submit" class="white-button" value="確認画面へ"><br><br>
        

        </form>


    </div>

</body>
</html>
