<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>会員編集ページ</title>


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
                text-align:left;
                width:40%;
                font-size: 16px;
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
            .button{
                text-align:center;
            }
            .item{
                display: inline-block;
                margin-right:30px;
            }
            .error{
                color:red;
                margin-left:100px;
            }

        </style>
    </head>


<body>
    <div class="header">
        <div class="header-left">
            <h3>会員編集</h3>
        </div>
        <ul>
        <li><a href="{{ action('ManagementController@getmember_list') }}">一覧に戻る</a></li>
       </ul>
    </div>

    <div class="container">
        <br>
        {{Form::open(['method'=>'POST','route' => ['manage_member_edit.post']])}}
        <span class="item">ID</span>　{{$items['id']}}
        <br><br>
            <span class="item">氏名</span>
            姓&emsp; 
            {{Form::text('name_sei', old('name_sei' , $items['name_sei'] ), ['style' => 'width:200px;'])}}
            &emsp;

            名&emsp; 
            {{Form::text('name_mei', old('name_mei' , $items['name_mei'] ), ['style' => 'width:200px;'])}}
            @error('name_sei')
            <span class ="error">{{$message}}</span>
            @enderror
            @error('name_mei')
            <br><span class ="error">{{$message}}</span>
            @enderror
            
            <br><br>
            <span class="item">ニックネーム</span>&emsp; &emsp; 
            {{Form::text('nickname', old('nickname' , $items['nickname'] ), ['style' => 'width:400px;'])}}
            @error('nickname')
            <span class ="error">{{$message}}</span>
            @enderror
            <br><br>

            
            <span class="item">性別</span>&emsp;&emsp;&emsp;&emsp;
            {{Form::radio('gender', '1', old(old('gender') == '1' ? 'checked' : '' , $items['gender'] ))}}&ensp;
            男性&emsp;&emsp;
            {{Form::radio('gender', '2', old(old('gender') == '2' ? 'checked' : '' , $items['gender'] ))}}&ensp;
            女性
            @error('gender')
            <br><span class ="error">{{$message}}</span>
            @enderror
            <br><br>


            <span class="item">パスワード</span>&emsp; &emsp; &emsp; 
            <input type="password" name="password" value="{{old('password' , $items['password'] )}}" style="width:400px;">
            @error('password')
            <br><span class ="error">{{$message}}</span>
            @enderror
            <br><br>

            <span class="item">パスワード確認</span>&emsp; 
            <input type="password" name="password_confirmation" value="{{old('password_confirmation' , $items['password'] )}}" style="width:400px;">
            @error('password_confirmation')
            <br><span class ="error">{{$message}}</span>
            @enderror
            <br><br>

            <span class="item">メールアドレス</span>&emsp; 
            {{Form::text('email', old('email' , $items['email'] ), ['style' => 'width:400px;'])}}
            @error('email')
            <br><span class ="error">{{$message}}</span>
            @enderror
            <br><br>
    

     <br><br>

     </div>

    <div class="button">
       {{Form::submit('確認画面へ', ['class'=>'white-button'])}}
    </div>
     {{Form::close()}}




</body>
</html>
