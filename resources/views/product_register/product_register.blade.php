<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>商品登録フォーム</title>


        <style>
            body {
                background-color: #ffe4b5;
            }
            .container{
                text-align:center;
            }
            .koumoku{
              position: absolute;
              left: 500px;
            }
            .inputbox{
              position: absolute;
              left: 650px;            
            }
            .orange-button{
                background-color:#FF9900;
                color:white;
                font-size:18px;
                font-weight:bold;
                padding:10px 75px;
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
                text-decoration: none;
            }
            .upload-button{
                background-color:white;
                color:#FF9900;
                font-size:12px;
                font-weight:bold;
                padding:5px 5px;
                border-color: #FF9900;
                border-radius: 5px;
                text-decoration: none;
            }
            .error{
                color:red;
            }

        </style>
    </head>


<body>

<div class="container">

<h1>商品登録</h1>
<br>

{{Form::open(['route' => 'products.post', 'files' => true, "enctype"=>"multipart/form-data" ])}}
<div class="koumoku">商品名</div>

<div class="inputbox">
<input type="text" name="name" value="{{old('name')}}">
@error('name')
  <br><span class ="error">{{$message}}</span>
@enderror
</div>

<br><br>
<div class="koumoku">商品カテゴリ</div>
<div class="inputbox">
{{Form::select('category', $category, NULL, ['id' => 'category'] )}}

<select id="subcategory" name="subcategory" >
  @foreach($subcategory as $index=>$value)
      <?php             
      $id = explode(',',$index);
      $oldsubcategory = $input['subcategory'];
      if($oldsubcategory == $id[0]){
        echo sprintf("<option value=%d data-parent=%d selected>%s</option>", $id[0], $id[1], $value);
      }else{
        echo sprintf("<option value=%d data-parent=%d>%s</option>", $id[0], $id[1], $value);
      }
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

</div>  
@error('category')
  <br><span class ="error">{{$message}}</span>
@enderror

@error('subcategory')
  <br><span class ="error">{{$message}}</span>
@enderror


<br><br>
<div class="koumoku">商品写真</div>
<br>
<div class="inputbox">写真1
<br>
@if (!empty($file))
  <img class="preview-cover1" src="data:image/{{$mimeType}};base64,{{$file}}" >  
@else
  @if (!empty($read_temp_path1))
    <img src="{{ $read_temp_path1 }}" width="250" height="150">
  @else
  <img class="preview-cover1" style="width:250px; height:150px">
  @endif
@endif

<br>
<input type="file" enctype="multipart/form-data" name="image_1" id="imageUpload1" class="form-control" style="display:none" accept="image/jpg,image/jpeg,image/png,image/gif">

<button class="upload-button" id="imageUploadButton1"><span class="ed-btn-text">アップロード</span></button>

<script>
$('#imageUploadButton1').click(function(){
    $('#imageUpload1').click();
    return false;
});


$('#imageUpload1').on('change', function (e) {    
    const file = event.target.files[0],
          reader = new FileReader(),
          $preview1 = $('.preview-cover1'); 

    // 画像ファイル以外はエラー
    if(file.type.indexOf("image") < 0){
      alert('画像ファイルをご指定ください');
      $(this).val('');
      return false;
    }
    //　ファイルサイズが10MB以上のものはエラー
    if(file.size >= 10 * 1024 * 1024){
      alert('ファイルサイズは10MBのものをご指定ください');
      $(this).val('');
      return false;
    }
    //　ファイルの拡張子が指定のもの以外はエラー
    var allow_exts = new Array('jpg', 'jpeg', 'png', 'gif');
    function checkExt(filename){
      var ext = getExt(filename).toLowerCase();
      if (allow_exts.indexOf(ext) === -1) {
        alert('ファイルの拡張子は「jpg｣「jpeg｣「png｣「gif｣のいずれかのものを選択してください');
        $(this).val('');
        return false;
      }
    }

    // ファイル読み込みが完了した際に発火するイベントを登録
    reader.onload = function() {
        // .prevewの領域の中にロードした画像を表示
        $preview1.attr('src',event.target.result);
    };

    reader.readAsDataURL(file);
});
</script> 

<br><br>

写真2
<br>
@if (!empty($file))
  <img class="preview-cover2" src="data:image/{{$mimeType}};base64,{{$file}}" >  
@else
  @if (!empty($read_temp_path2))
    <img src="{{ $read_temp_path2 }}" width="250" height="150">
  @else
  <img class="preview-cover2" style="width:250px; height:150px">
  @endif
@endif
<br>
<input type="file" enctype="multipart/form-data" name="image_2" id="imageUpload2" class="form-control" style="display:none" accept="image/jpg,image/jpeg,image/png,image/gif">
<button class="upload-button" id="imageUploadButton2"><span class="ed-btn-text">アップロード</span></button>

<script>
$('#imageUploadButton2').click(function(){
    $('#imageUpload2').click();
    return false;
});


$('#imageUpload2').on('change', function (e) {    
    const file = event.target.files[0],
          reader = new FileReader(),
          $preview2 = $('.preview-cover2'); 

    // 画像ファイル以外はエラー
    if(file.type.indexOf("image") < 0){
      alert('ご指定のファイル拡張子は対応しておりません。');
      $(this).val('');
      return false;
    }
    //　ファイルサイズが10MB以上のものはエラー
    if(file.size >= 10 * 1024 * 1024){
      alert('ファイルサイズは10MBのものをご指定ください');
      $(this).val('');
      return false;
    }


    // ファイル読み込みが完了した際に発火するイベントを登録
    reader.onload = function() {
        // .prevewの領域の中にロードした画像を表示
        $preview2.attr('src',event.target.result);
    };

    reader.readAsDataURL(file);
});
</script> 

<br><br>

写真3
<br>
@if (!empty($file))
  <img class="preview-cover3" src="data:image/{{$mimeType}};base64,{{$file}}" >  
@else
  @if (!empty($read_temp_path3))
    <img src="{{ $read_temp_path3 }}" width="250" height="150">
  @else
  <img class="preview-cover3" style="width:250px; height:150px">
  @endif
@endif
<br>
<input type="file" enctype="multipart/form-data" name="image_3" id="imageUpload3" class="form-control" style="display:none" accept="image/jpg,image/jpeg,image/png,image/gif">
<button class="upload-button" id="imageUploadButton3"><span class="ed-btn-text">アップロード</span></button>

<script>
$('#imageUploadButton3').click(function(){
    $('#imageUpload3').click();
    return false;
});


$('#imageUpload3').on('change', function (e) {    
    const file = event.target.files[0],
          reader = new FileReader(),
          $preview3 = $('.preview-cover3'); 

    // 画像ファイル以外はエラー
    if(file.type.indexOf("image") < 0){
      alert('ご指定のファイル拡張子は対応しておりません。');
      $(this).val('');
      return false;
    }
    //　ファイルサイズが10MB以上のものはエラー
    if(file.size >= 10 * 1024 * 1024){
      alert('ファイルサイズは10MBのものをご指定ください');
      $(this).val('');
      return false;
    }
    // ファイル読み込みが完了した際に発火するイベントを登録
    reader.onload = function() {
        // .prevewの領域の中にロードした画像を表示
        $preview3.attr('src',event.target.result);
    };

    reader.readAsDataURL(file);
});
</script> 

<br><br>

写真4
<br>
@if (!empty($file))
  <img class="preview-cover4" src="data:image/{{$mimeType}};base64,{{$file}}" >  
@else
  @if (!empty($read_temp_path4))
    <img src="{{ $read_temp_path4 }}" width="250" height="150">
  @else
  <img class="preview-cover4" style="width:250px; height:150px">
  @endif
@endif
<br>
<input type="file" enctype="multipart/form-data" name="image_4" id="imageUpload4" class="form-control" style="display:none" accept="image/jpg,image/jpeg,image/png,image/gif">
<button class="upload-button" id="imageUploadButton4"><span class="ed-btn-text">アップロード</span></button>

<script>
$('#imageUploadButton4').click(function(){
    $('#imageUpload4').click();
    return false;
});


$('#imageUpload4').on('change', function (e) {    
    const file = event.target.files[0],
          reader = new FileReader(),
          $preview4 = $('.preview-cover4'); 

    // 画像ファイル以外はエラー
    if(file.type.indexOf("image") < 0){
      alert('ご指定のファイル拡張子は対応しておりません。');
      $(this).val('');
      return false;
    }
    //　ファイルサイズが10MB以上のものはエラー
    if(file.size >= 10 * 1024 * 1024){
      alert('ファイルサイズは10MBのものをご指定ください');
      $(this).val('');
      return false;
    }
    // ファイル読み込みが完了した際に発火するイベントを登録
    reader.onload = function() {
        // .prevewの領域の中にロードした画像を表示
        $preview4.attr('src',event.target.result);
    };

    reader.readAsDataURL(file);
});
</script> 
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div class="koumoku">
    商品説明
</div>
<div class="inputbox">
    <textarea name="product_content" rows="10" cols="50" >{{old('product_content')}}</textarea><br>

    @error('product_content')
      <span class ="error">{{$message}}</span><br><br>
    @enderror
</div>
    <br><br><br><br><br><br><br>
    <input type="submit" class="orange-button" value="確認画面へ"><br>

{{Form::close()}}

<br>
<a href="/top" class="white-button">トップに戻る</a>

</div>


</body>
</html>

