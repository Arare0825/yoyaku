@extends('layouts.app')

<main style="margin-left:270px;">

<div style="padding-top:50px;">
<div class="modal-open">施設追加</div>
</div>
<div class="modal-container">
	<div class="modal-body">
		<!-- 閉じるボタン -->
		<div class="modal-close">×</div>
		<!-- モーダル内のコンテンツ -->
		<div class="modal-content">
		<form action="{{ route('facility.store')  }}" method="post" enctype="multipart/form-data">
			@csrf
  <div class="mb-3">
  <!--  カテゴリープルダウン -->
  <div class="form-group">
        <label for="category-id">{{ __('グループ名') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
        <select class="form-control" id="category-id" name="group_id">
            @foreach ($groups as $group)
                <option value="{{ $group->id }}">{{ $group->group_ja }}</option>
            @endforeach
        </select>
      </div> 
     </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">施設名(JP)</label>
    <input  name="facility_name_jp" type="text" class="form-control" id="exampleInputEmail1" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">施設名(EN)</label>
    <input  name="facility_name_en" type="text" class="form-control" id="exampleInputEmail1" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">画像を選択</label>
    <input  name="facility_images" type="file"  required>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">施設説明</label>
    <textarea  name="facility_introduction" type="text" class="form-control" id="exampleInputEmail1" required></textarea>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">営業時間</label>
    <input  name=" facility_busines_hours1" type="time" class="form-control" id="exampleInputEmail1" required>
	~
	<input  name=" facility_busines_hours2" type="time" class="form-control" id="exampleInputEmail1" required>

  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">場所(JP)</label>
    <input  name="facility_place_jp" type="text" class="form-control" id="exampleInputEmail1" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">場所(EN)</label>
    <input  name="facility_place_en" type="text" class="form-control" id="exampleInputEmail1" required>
  </div>
  <div class="mb-3">
  <label for="category-id">{{ __('予約枠') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
        <select class="form-control" id="category-id" name="category_id">
            @foreach ($times as $time)
                <option value="{{ $time->id }}">{{ $time->frame_name }}</option>
            @endforeach
        </select>
  </div>

  <div class="form-outline mb-3">
  <label for="exampleInputPassword1" class="form-label">並び順</label>
    <input name="facility_sort" type="number" id="typeNumber" class="form-control" value="0" required/>
</div>
<div class="form-outline mb-3">
<div class="form-check">
  <input name="facility_visible" value="1" type="radio" id="flexRadioDefault1" checked>
  <label class="form-check-label" for="flexRadioDefault1">
    表示
  </label>
  <input name="facility_visible" value="0"  type="radio" id="flexRadioDefault2" >
  <label class="form-check-label" for="flexRadioDefault2">
    非表示
  </label>
</div></div>

  <button type="submit" class="btn btn-primary">保存</button>
</form>		
</div>
	</div>
</div>

<div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">グループ名</th>
      <th scope="col">施設名</th>
      <th scope="col">最終更新日</th>
      <th scope="col">ソート優先度</th>
      <th scope="col">予約枠設定</th>
	  <th scope="col">削除</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      @foreach($facilities as $facility)
      <th scope="row">
		<a class="id" href="">{{ $facility->group_id }}</a>
	</th>
    <td>{{ $facility->facility_name_jp }}</td>
    <td>2024-03-14 11:00</td>
      <td>{{ $facility->facility_sort }}</td>
      <td>{{ $facility->frame_id }}</td>
      <td><button type="submit" class="btn btn-outline-warning">削除</button></td>
      @endforeach
    </tr>
    
  </tbody>
</table>
</div>
<!-- モーダル表示 -->
<style>
.modal-open{
	position: fixed;
	margin-top:50px;
	display: flex;
    align-items: center;
    justify-content: center;
    top: 5%;
    left: 50%;
	width: 300px;
	height: 50px;
	font-weight: bold;
	color: #fff;
	background: #000;
	margin: auto;
	cursor: pointer;
	transform: translate(-50%,-50%);
}
/*モーダル本体の指定 + モーダル外側の背景の指定*/
.modal-container{
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	text-align: center;
	background: rgba(0,0,0,50%);
	padding: 40px 20px;
	overflow: auto;
	opacity: 0;
	visibility: hidden;
	transition: .3s;
    box-sizing: border-box;
}
/*モーダル本体の擬似要素の指定*/
.modal-container:before{
	content: "";
	display: inline-block;
	vertical-align: middle;
	height: 100%;
}
/*モーダル本体に「active」クラス付与した時のスタイル*/
.modal-container.active{
	opacity: 1;
	visibility: visible;
}
/*モーダル枠の指定*/
.modal-body{
	position: relative;
	display: inline-block;
	vertical-align: middle;
	max-width: 500px;
	width: 90%;
}
/*モーダルを閉じるボタンの指定*/
.modal-close{
	position: absolute;
	display: flex;
    align-items: center;
    justify-content: center;
	top: -40px;
	right: -40px;
	width: 40px;
	height: 40px;
	font-size: 40px;
	color: #fff;
	cursor: pointer;
}
/*モーダル内のコンテンツの指定*/
.modal-content{
	background: #fff;
	text-align: left;
	padding: 30px;
}
.table{
	margin-top:120px;
}

</style>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script>
$(function(){
	// 変数に要素を入れる
	var open = $('.modal-open'),
		close = $('.modal-close'),
		container = $('.modal-container');

	//開くボタンをクリックしたらモーダルを表示する
	open.on('click',function(){	
		container.addClass('active');
		return false;
	});

	//閉じるボタンをクリックしたらモーダルを閉じる
	close.on('click',function(){	
		container.removeClass('active');
	});

	//モーダルの外側をクリックしたらモーダルを閉じる
	$(document).on('click',function(e) {
		if(!$(e.target).closest('.modal-body').length) {
			container.removeClass('active');
		}
	});
});

</script>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

</body>
</html>
