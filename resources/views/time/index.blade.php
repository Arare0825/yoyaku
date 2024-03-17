@extends('layouts.app')

<main style="margin-left:270px;">

<div style="padding-top:50px;">
<div class="modal-open">予約枠追加</div>
</div>
<div class="modal-container">
	<div class="modal-body">
		<!-- 閉じるボタン -->
		<div class="modal-close">×</div>
		<!-- モーダル内のコンテンツ -->
		<div class="modal-content">
		<form action="{{ route('time.store') }}" method="post">
			@csrf
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">枠パターン名</label>
    <input  name="framename" type="text" class="form-control" id="exampleInputEmail1" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">予約可能時間１</label>
    <input  name="from1" type="time" class="form-control" id="exampleInputEmail1" required>
	~
	<input  name="to1" type="time" class="form-control" id="exampleInputEmail1" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">予約可能時間２</label>
    <input  name="from2" type="time" class="form-control" id="exampleInputEmail1" >
	~
	<input  name="to2" type="time" class="form-control" id="exampleInputEmail1" >
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">予約可能時間３</label>
    <input  name="from3" type="time" class="form-control" id="exampleInputEmail1" >
	~
	<input  name="to3" type="time" class="form-control" id="exampleInputEmail1" >
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">一枠あたりの時間単位</label>
    <input  name="timeunit" type="number" class="form-control" id="exampleInputEmail1" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">予約締切時間</label>
    <input  name="deadtime" type="number" class="form-control" id="exampleInputEmail1" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">予約キャンセル可能時間</label>
    <input  name="cancellimit" type="number" class="form-control" id="exampleInputEmail1" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">予約上限数</label>
    <input  name="framelimit" type="number" class="form-control" id="exampleInputEmail1" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">一席当たりの最大人数</label>
    <input  name="maxlimit" type="number" class="form-control" id="exampleInputEmail1" required>
  </div>


  <button type="submit" class="btn btn-primary">保存</button>
</form>		
</div>
	</div>
</div>

<div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">枠パターン名</th>
      <th scope="col">予約可能時間</th>
      <th scope="col">1枠の時間単位</th>
      <th scope="col">予約〆切時間</th>
      <th scope="col">キャンセル可能時間</th>
	  <th scope="col">予約上限数</th>
      <th scope="col">1席の最大人数</th>
	  <th scope="col">削除</th>
    </tr>
  </thead>
  <tbody>
    @foreach($times as $time)
    <tr>
      <th scope="row">
		<a class="id" href="{{ route('time.edit',['id'=> $time->id]) }}">{{ $time->frame_name }}</a>
	</th>
    <td>
    {{ $time->frame_activefrom_1 }} ~ {{ $time->frame_activeto_1 }}<br>

    @if($time->frame_activefrom_3)
    {{ $time->frame_activefrom_2 }} ~ {{ $time->frame_activeto_2 }}<br>
    @endif

    @if($time->frame_activefrom_3)
    {{ $time->frame_activefrom_3 }} ~ {{ $time->frame_activeto_3 }}<br>
    @endif

    </td>
    <td>
    {{ $time->frame_timeunit }}
    </td>
      <td>{{ $time->frame_deadtime }}</td>
      <td>{{ $time->frame_cancellimit }}</td>
      <td>{{ $time->frame_limit }}</td>
      <td>{{ $time->frame_max_per_set }}</td>
	  <form action="{{ route('time.destory',['id' => $time->id]) }}" method="post">
		@csrf
      <td><button type="submit" onclick="deleteMessage(event);return false;" class="btn btn-outline-warning">削除</button></td>
	  </form>
    </tr>
    @endforeach
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
function deleteMessage(){
	if(!window.confirm('本当に削除しますか？')){
		return false;
	}
	document.deleteform.submit();
}


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
