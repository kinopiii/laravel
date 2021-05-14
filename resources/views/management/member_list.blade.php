<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>トップページ</title>


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
            .blue-button{
                background-color:#0066FF;
                color:white;
                font-size:18px;
                font-weight:bold;
                padding:10px 60px;
                border-style: none;
                border-radius: 5px;
            }
            .tabledata{
                margin-top:20px;
            }
            table {
                border-collapse: collapse;
                table-layout: fixed;
                font-size:16px;
            }
            .page{
                margin-left:450px;
            }
            .clear-decoration{
                border: none;  
                outline: none; 
                background: transparent; 
            }
            .register{
                margin-top:20px;
                margin-right:410px;
            }

        </style>
    </head>


<body>
    <div class="header">
        <div class="header-left">
            <h3>会員一覧</h3>
        </div>
        <ul>
        <li><a href="{{ action('ManagementController@gettop') }}">トップに戻る</a></li>
       </ul>
    </div>

    <div class="container">
    <div Class="register">
    <a href="/manage_member_register" class="blue-button">会員登録</a>
    </div>
        <form method="get" action="{{ route('member_list.show') }}">
        @csrf
            <div class="tabledata">
                <table border="3" width="600px" align="center" height="150">
                    <tr height="40">
                        <td align="left" width="150" bgcolor="B0C4DE" style="font-weight:bold;"><label for="id">ID</label></td>
                        <td><input type="text" name="id" value="{{old('id')}}"></td>
                    </tr>
                    <tr height="40">
                        <td align="left" width="150" bgcolor="B0C4DE" style="font-weight:bold;"><label for="id">性別</label></td>
                        <td>
                            <input type="checkbox" name="gender1" value="1"{{ old('gender') == '1' ? 'checked' : '' }}>男性&emsp; 
                            <input type="checkbox" name="gender2" value="2"{{ old('gender') == '2' ? 'checked' : '' }}>女性
                        </td>
                    </tr>
                    <tr height="40">
                        <td align="left" width="150" bgcolor="B0C4DE" style="font-weight:bold;"><label for="id">フリーワード</label></td>
                        <td><input type="text" name="free" value="{{old('free')}}"></td>
                    </tr>
                </table>
            </div>
            <br>
            <input type="submit" name="search" class="white-button" value="検索する">
            <br>
    @if(isset($items))
        @if(!$items->isEmpty())
    　　<table border="3" width="800px" align="center">
            
            <th width="30" bgcolor="B0C4DE" style="border-style:dashed;">ID
                @sortablelink('id', '▼')
            </th>
            <th width="80" bgcolor="B0C4DE" style="border-style:dashed;">氏名</th>
            <th width="160" bgcolor="B0C4DE" style="border-style:dashed;">メールアドレス</th>
            <th width="50" bgcolor="B0C4DE" style="border-style:dashed;">性別</th>
            <th width="80" bgcolor="B0C4DE" style="border-style:dashed;">登録日時
                @sortablelink('created_at', '▼')
            </th>
            <th width="50" bgcolor="B0C4DE" style="border-style:dashed;">編集</th>
            <th width="50" bgcolor="B0C4DE" style="border-style:dashed;">詳細</th>
    </form>
            @foreach($items as $item) 
                <tr>
                    <td bgcolor="white" style="border-style:dashed;">{{$item->id}}</td>
                    <td bgcolor="white" style="border-style:dashed;">{{$item->name_sei}} {{$item->name_mei}}</td>
                    <td bgcolor="white" style="border-style:dashed;">{{$item->email}}</td>
                    <td bgcolor="white" style="border-style:dashed;">
                    @foreach(config('master.gender') as $key => $value)
                    @if($item->gender == $key) {{ $value }} @endif
                    @endforeach
                    </td>
                    <td bgcolor="white" style="border-style:dashed;">{{$item->created_at->format('Y/m/d')}}</td>
                    <td bgcolor="white" style="border-style:dashed;"><a href="/manage_member_edit/{{$item->id}}">編集</a></td>
                    <td bgcolor="white" style="border-style:dashed;"><a href="/manage_member_detail/{{$item->id}}">詳細</a></td>
                </tr>   
            @endforeach
        </table>
        <br>
        <div class = "page">
        {{ $items->appends(request()->query())->links('vendor.pagination.list') }}
        </div>
        @endif
    @endif

    </div>

</body>
</html>
