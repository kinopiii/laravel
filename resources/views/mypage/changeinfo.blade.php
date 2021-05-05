<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>会員情報変更ページ</title>


        <style>
            body {
                background-color: #ffe4b5;
            }
            h1{
                margin-top:40px;
                text-align:center;
            }
            .container{
                text-align:center;
                font-size:20px;
                margin-top:60px;
                margin-left: auto;
                margin-right: auto;
                width:60%;
            }
            .orange-button{
                display       : inline-block;
                border-radius : 5px;
                border-color  :#FF8C00;
                font-size     : 14pt;
                padding       : 5px 50px;
                background    : #FF8C00;
                color         : white;    
                margin-top:10px;       
            } 
            .white-button{
                border-radius : 5px;
                font-size     : 14pt;
                padding       : 5px 20px;
                background    : white;
                color         : #FF8C00;   
                border-color  : #FF8C00;    
                text-decoration:none;    
            } 
            .nickname{
                margin-top:40px;
            }
            .gender{
                margin-top:40px;
                margin-bottom:40px;
                margin-right:255px;
            }
            .error{
                color:red;
            }
        </style>
    </head>


<body>
    
<h1>会員情報登録</h1>
    <div class="container">
    
    <form action="{{  route('changeinfo.post') }}" method="post">
    @csrf
    <div>
        <div class="name">
            氏名&emsp;

            姓&emsp;<input type="text" name="name_sei" value="{{ old('name_sei' , $items['name_sei'] ) }}">&emsp;
            名&emsp;<input type="text" name="name_mei" value="{{ old('name_mei' , $items['name_mei'] ) }}">
            
            @error('name_sei')
            <br><span class ="error">{{$message}}</span>
            @enderror

            @error('name_mei')
            <br><span class ="error">{{$message}}</span>
            @enderror
        </div>

        <div class="nickname">
            ニックネーム&emsp;&emsp;&emsp;&emsp;
            <input type="text" name="nickname" style="width:300px;" value="{{ old('nickname' , $items['nickname'] ) }}">
        
            @error('nickname')
            <br><span class ="error">{{$message}}</span>
            @enderror
        
        </div>

        <div class="gender">
            性別&emsp;&emsp;&emsp;
            男性<input type="radio" name="gender" value="1" {{ old('gender' , $items['gender'] ) == '1' ? 'checked' : ''  }}>&emsp;
            女性<input type="radio" name="gender" value="2" {{ old('gender' , $items['gender'] ) == '2' ? 'checked' : ''  }}>
       
            @error('gender')
            <br><span class ="error">{{$message}}</span>
            @enderror       
        </div>
    </div>
    
    <button class="orange-button" name="confirm" type="submit">確認画面へ</button><br><br>
    </form>
    <a href="{{  route('mypage.show') }}" class="white-button">マイページに戻る</a>
            
        
    </div>
</body>
</html>
