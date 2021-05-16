<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>商品カテゴリ登録ページ</title>


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
                width:45%;
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
                margin-right:400px;
            }
            .error{
                color:red;
                display:inline-block;
                margin-left:180px;
            }
            .item{
                display:inline-block;
                width:180px;
            }
            .buttons{
                text-align:center;
            }

        </style>
    </head>


<body>
    <div class="header">
        <div class="header-left">
            <h3>商品カテゴリ登録</h3>
        </div>
        <ul>
        <li><a href="{{ action('ManagementController@getproduct_cate_list') }}">一覧に戻る</a></li>
       </ul>
    </div>
<br>
    <div class="container">
    <form method="post" action="{{ route('product_cate_register.post') }}">
            @csrf
            <span class="item">商品大カテゴリID</span>登録後に自動採番
            <br><br>

            <span class="item">商品大カテゴリ</span>
            <input type=text name="category" style="width:400px;" value="{{old('category')}}">

            @error('category')
            <br><span class ="error">{{$message}}</span>
            @enderror

            <br><br>

            <span class="item">商品小カテゴリ</span>
            <input type=text name="subcategory1" style="width:400px;" value="{{old('subcategory1')}}">
            @error('subcategory1')
            <br><span class ="error">{{$message}}</span>
            @enderror

            <br><br>

            <span class="item"></span>
            <input type=text name="subcategory2" style="width:400px;" value="{{old('subcategory2')}}">
            @error('subcategory2')
            <br><span class ="error">{{$message}}</span>
            @enderror

            <br><br>

            <span class="item"></span>
            <input type=text name="subcategory3" style="width:400px;" value="{{old('subcategory3')}}">
            @error('subcategory3')
            <br><span class ="error">{{$message}}</span>
            @enderror

            <br><br>

            <span class="item"></span>
            <input type=text name="subcategory4" style="width:400px;" value="{{old('subcategory4')}}">
            @error('subcategory4')
            <br><span class ="error">{{$message}}</span>
            @enderror

            <br><br>

            <span class="item"></span>
            <input type=text name="subcategory5" style="width:400px;" value="{{old('subcategory5')}}">
            @error('subcategory5')
            <br><span class ="error">{{$message}}</span>
            @enderror

            <br><br>

            <span class="item"></span>
            <input type=text name="subcategory6" style="width:400px;" value="{{old('subcategory6')}}">
            @error('subcategory6')
            <br><span class ="error">{{$message}}</span>
            @enderror

            <br><br>

            <span class="item"></span>
            <input type=text name="subcategory7" style="width:400px;" value="{{old('subcategory7')}}">
            @error('subcategory7')
            <br><span class ="error">{{$message}}</span>
            @enderror

            <br><br>

            <span class="item"></span>
            <input type=text name="subcategory8" style="width:400px;" value="{{old('subcategory8')}}">
            @error('subcategory8')
            <br><span class ="error">{{$message}}</span>
            @enderror

            <br><br>

            <span class="item"></span>
            <input type=text name="subcategory9" style="width:400px;" value="{{old('subcategory9')}}">
            @error('subcategory9')
            <br><span class ="error">{{$message}}</span>
            @enderror

            <br><br>

            <span class="item"></span>
            <input type=text name="subcategory10" style="width:400px;" value="{{old('subcategory10')}}">
            @error('subcategory10')
            <br><span class ="error">{{$message}}</span>
            @enderror


            @error('subcategory_dummy')
            <br><span class ="error">{{$message}}</span>
            @enderror
            <br><br><br>
            </div>

            <div class="buttons">
            <input type="submit" class="white-button" value="確認画面へ"><br><br>
            </div>

        </form>


    

</body>
</html>
