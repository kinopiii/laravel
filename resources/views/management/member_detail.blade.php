<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>会員登録・編集ページ</title>


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
                margin-top:30px;
                width:35%;
                font-size:20px;
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
                margin-right:20px;
                border-style: solid;
            }
            .items{
                margin-bottom:20px;
                text-align:left;
                
            }
            .item{
                display:inline-block;
                width:200px;
                
            }

        </style>
    </head>


<body>
    <div class="header">
        <div class="header-left">
            <h3>会員詳細</h3>
        </div>
        <ul>
        <li><a href="{{ action('ManagementController@getmember_list') }}">一覧に戻る</a></li>
       </ul>
    </div>

    <div class="container">
    <form method="post" action="{{ route('manage_member_detail.post') }}">
    @csrf
        <div class="items">
            <span class="item">ID</span>
            {{ $id }}
        </div>

        <div class="items">
            <span class="item">氏名</span>
            {{ $items['name_sei'] }}
            {{ $items['name_mei'] }}
        </div>

        <div class="items">
            <span class="item">ニックネーム</span>
            {{ $items['nickname'] }}
        </div>

        <div class="items">
            <span class="item">性別</span>
            @foreach(config('master.gender') as $key => $value)
            @if($items['gender'] == $key) {{ $value }} @endif
            @endforeach
        </div>

        <div class="items">
            <span class="item">パスワード</span>
            セキュリティのため非表示
        </div>

        <div class="items">
            <span class="item">メールアドレス</span>
            {{ $items['email'] }}
        </div>
        
        <br><br>
        <a href="/manage_member_edit/{{$id}}" class="white-button">編集</a>
        <input type="submit" class="white-button" value="削除">
        
    </div>
    </form>
</body>
</html>
