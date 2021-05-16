<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>商品大カテゴリ登録・編集ページ</title>


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
        @if( url()->previous() === url("/manage_member_register"))
            <h3>商品カテゴリ登録確認</h3>
        @else
            <h3>商品カテゴリ編集確認</h3>
        @endif
        </div>
        <ul>
        <li><a href="{{ action('ManagementController@getproduct_cate_list') }}">一覧に戻る</a></li>
       </ul>
    </div>

    <div class="container">
    <form method="post" action="{{ route('product_cate_confirm.post') }}">
    @csrf
        <div class="items">
            <span class="item">ID</span>
            @if( url()->previous() === url("/product_cate_register"))
                登録後に自動採番
            @else
                {{ $id }}
            @endif
        </div>

        <div class="items">
            <span class="item">商品大カテゴリ</span>
            {{ $input['category'] }}
        </div>

        <div class="items">
            <span class="item">商品小カテゴリ</span>
            @if(isset($input['subcategory1']))
            {{ $input['subcategory1'] }}
            @endif
        </div>

        @if(isset($input['subcategory2']))
        <div class="items">
            <span class="item"></span>
            {{ $input['subcategory2'] }}
        </div>
        @endif

        @if(isset($input['subcategory3']))
        <div class="items">
            <span class="item"></span>
            {{ $input['subcategory3'] }}
        </div>
        @endif

        @if(isset($input['subcategory4']))
        <div class="items">
            <span class="item"></span>
            {{ $input['subcategory4'] }}
        </div>
        @endif

        @if(isset($input['subcategory5']))
        <div class="items">
            <span class="item"></span>
            {{ $input['subcategory5'] }}
        </div>
        @endif

        @if(isset($input['subcategory6']))
        <div class="items">
            <span class="item"></span>
            {{ $input['subcategory6'] }}
        </div>
        @endif

        @if(isset($input['subcategory7']))
        <div class="items">
            <span class="item"></span>
            {{ $input['subcategory7'] }}
        </div>
        @endif

        @if(isset($input['subcategory8']))
        <div class="items">
            <span class="item"></span>
            {{ $input['subcategory8'] }}
        </div>
        @endif

        @if(isset($input['subcategory9']))
        <div class="items">
            <span class="item"></span>
            {{ $input['subcategory9'] }}
        </div>
        @endif

        @if(isset($input['subcategory10']))
        <div class="items">
            <span class="item"></span>
            {{ $input['subcategory10'] }}
        </div>
        @endif

        <br>
        @if( url()->previous() === url("/product_cate_register"))
            <input type="submit" class="white-button" value="登録完了">
        @else
            <input type="submit" class="white-button" value="編集完了">
        @endif
        
        </form>
    </div>

</body>
</html>
