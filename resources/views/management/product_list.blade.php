<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>商品一覧ページ</title>


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
                padding:10px 50px 10px 50px;
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
                margin-right:420px;
            }

        </style>
    </head>


<body>
    <div class="header">
        <div class="header-left">
            <h3>商品一覧</h3>
        </div>
        <ul>
        <li><a href="{{ action('ManagementController@gettop') }}">トップに戻る</a></li>
       </ul>
    </div>

    <div class="container">
    <div Class="register">
    <a href="/product_register" class="blue-button">商品登録</a>
    </div>
        <form method="get" action="{{ route('product_list.show') }}">
        @csrf
            <div class="tabledata">
                <table border="3" width="600px" align="center" height="100">
                    <tr height="20">
                        <td align="left" width="150" bgcolor="B0C4DE" style="font-weight:bold;"><label for="id">ID</label></td>
                        <td><input type="text" name="id" style="width:300px" value="{{old('id')}}"></td>
                    </tr>
                    <tr height="20">
                        <td align="left" width="150" bgcolor="B0C4DE" style="font-weight:bold;"><label for="id">フリーワード</label></td>
                        <td><input type="text" name="free" style="width:300px" value="{{old('free')}}"></td>
                    </tr>
                </table>
            </div>
            <br>
            <input type="submit" name="search" class="white-button" value="検索する">
            <br>
    @if(isset($items))
        @if(!$items->isEmpty())
    　　<table border="3" width="600px" align="center">
            
            <th width="20" bgcolor="B0C4DE" style="border-style:dashed;">ID
                @sortablelink('id', '▼')
            </th>
            <th width="60" bgcolor="B0C4DE" style="border-style:dashed;">商品名</th>
            <th width="60" bgcolor="B0C4DE" style="border-style:dashed;">登録日時
                @sortablelink('created_at', '▼')
            </th>
            <th width="30" bgcolor="B0C4DE" style="border-style:dashed;">編集</th>
    </form>
            @foreach($items as $item) 
                <tr>
                    <td bgcolor="white" style="border-style:dashed;">{{$item->id}}</td>
                    <td bgcolor="white" style="border-style:dashed;">{{$item->name}}</td>
                    <td bgcolor="white" style="border-style:dashed;">{{$item->created_at->format('Y/m/d')}}</td>
                    <td bgcolor="white" style="border-style:dashed;"><a href="/product_edit/{{$item->id}}">編集</a></td>
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
