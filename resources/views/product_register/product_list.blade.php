<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>商品一覧</title>


        <style>
            body {
                background-color: #ffe4b5;
            }
            .container{
                text-align:center;
                width:60%;
                margin: auto;
            }
            .box{
                height:180px;
                border:2px solid #000000;
                background-color:white;
            }
            .header{
                background-color: #FFCC99;
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
            .header a{
                text-decoration: none;
                color:black;
            }
            .header-left{
                float:left;
                font-size:30px;
                font-weight:bold;
                margin-top:30px;
                padding-left:50px;
                width:20%;
            }
            .search{
                font-size:18px;
                padding:5px 50px;
                background-color:white;
            }
            .white-button{
                background-color:white;
                color:#0099FF;
                font-size:18px;
                font-weight:bold;
                padding:10px 70px;
                border-color: #0099FF;
                border-radius: 5px;
                text-decoration: none;
            }
            .black{
                display: block;
                width: 100%;
                height: 1px;
                background-color: black;
                border: 0; 
            }
            tr {
                border-color: black;
                border-style: solid;
                border-width: 1px 0;
            }
            table {
                width: 100%;
            }
            td, th {
                padding: 10px 0px;
            }

            .page{
                position:relative;
                left:300px;
            }
            .category{
                border: solid 1px;
                background-color:white;
            }
            .middle{
                float: left;
                margin-left:50px;
            }
            .category{
                margin-left:150px;
                margin-top:30px;
            }
            .productname{
                margin-left:150px;
                margin-top:20px;
            }
            .detail{
                padding-top:95px;
            }
            .detailbutton{
                display       : inline-block;
                border-radius : 5px;
                font-size     : 16pt;
                padding       : 5px 50px;
                background    : #0066FF;
                color         : white;           
            }            

        </style>
    </head>


<body>


<div class="header">
    <div class="header-left">
    商品一覧
    </div>

    <ul>
    @if(Auth::check())
        <li><a href="{{ action('products_registerController@getproduct_register') }}">新規商品登録</a></li>
    @endif
    </ul>
</div>

<br>

<div class="container">
    <div class="box"><br>
    {{Form::open(['method'=>'GET', 'route' => 'productslist.show'])}}
    <input type="hidden" name="search" value="{{ rand() }}">
        カテゴリ&nbsp;&nbsp;&nbsp;&nbsp;
        {{Form::select('category', $category, NULL, ['id' => 'category'] )}}

        <select id="subcategory" name="subcategory" >
        @foreach($subcategory as $index=>$value)
            <?php             
            $id = explode(',',$index);
            echo sprintf("<option value=%d data-parent=%d>%s</option>", $id[0], $id[1], $value);
            ?>                
        @endforeach   
        </select>

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script>
        $(function() {
        
            // 親子連動セレクトボックス(親セレクトボックス、子セレクトボックス)
            function parent_selectbox(ele_name_parent, ele_name_child){
                var $children = $(ele_name_child); //子の要素を変数に入れます。
                var original = $children.html(); //子のコピーを取っておく
                var selected = $(this).data('selected');
        
                //親のselect要素が変更になるとイベントが発生
                $(ele_name_parent).change(function() {
        
                //親のselect要素が未選択の場合、子を初期化 & disabledにして終了！
                if ($(this).val() == "") {
                    $children.attr('disabled', 'disabled');
                    $children.val("");
                    return;
                }       
        
                //選択された親のvalueを取得
                var parent_val = $(this).val();
        
                // 子をコピーから、全選択肢を復活させる
                $children.html(original).find('option').each(function() {
                    // 親の値(data-parent)を取得
                    var child_val = $(this).data('parent'); 
        
                    // 違う親の値(data-parent)だったら、選択肢を削除する
                    if (parent_val != child_val) {
                    $(this).not(':first-child').remove();
                    }
                    // 結果、選択された親の子しか残されない
                });
        
                // 子を有効化して選択できるようにする
                $children.removeAttr('disabled');
                
                // 編集画面用に、最初に１回だけ選択した状態にする
                }).trigger('change');
                
            }    
            // カテゴリー・サブカテゴリー連動セレクトボックス
            parent_selectbox('#category', '#subcategory');
        
        })  
        </script>

        <br><br>
            フリーワード&nbsp;&nbsp;
            <input type="text" style="width: 220px;" name="free">
        <br><br>
        <input type="submit" class="search" value="商品検索">
        {{Form::close()}}
    </div>
    <br>
@if(isset($items))
    @if(!$items->isEmpty())
　　<table>
        @foreach($items as $item) 
            <tr>
                <td>
                    <div class="tabledata">
                        <div class="middle">
                            @if(isset($item->file))
                            <img src="{{ asset($item->file) }}" width="200" height="130">
                            @else
                            <img src="{{ asset('/storage/products/noimage.jpg') }}" width="200" height="130">
                            @endif
                        </div>
                        
                        <div class="middle">            
                            <div class="category">{{$item->category_name}}  >　{{$item->subcategory_name}}</div>
                            <div class="productname"><a href="/products_detail/{{$item->productid}}">{{$item->product_name}}</a></div>
                        </div>
                        <div class="detail"><a href="/products_detail/{{$item->productid}}" class="detailbutton">詳細</a></div>

                    </div> 
                </td>
            </tr>   
        @endforeach
    </table>
    <br>
    <div class = "page">
    {{ $items->appends(request()->query())->links('vendor.pagination.list') }}
    </div>
    @endif
@endif
<br><br>
    <a href="/top" class="white-button">トップに戻る</a>
</div>
<br><br>
</body>
</html>

