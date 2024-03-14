@extends('layouts.app')

<main style="margin-left:290px;">

<div class="modal-open">グループ追加</div>


<!-- モーダル本体 -->
<div class="modal-container">
	<div class="modal-body">
		<!-- 閉じるボタン -->
		<div class="modal-close">×</div>
		<!-- モーダル内のコンテンツ -->
		<div class="modal-content">
		<form action="{{ route('group.store') }}" method="post">
			@csrf
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">グループ名(JP)</label>
    <input  name="group_ja" type="text" class="form-control" id="exampleInputEmail1" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">グループ名(EN)</label>
    <input name="group_en" type="text" class="form-control" id="exampleInputPassword1" required>
  </div>
  <div class="form-outline mb-3">
  <label for="exampleInputPassword1" class="form-label">並び順</label>
    <input name="sort" type="number" id="typeNumber" class="form-control" required/>
</div>
<div class="form-outline mb-3">
<div class="form-check">
  <input name="visible" value="1" type="radio" id="flexRadioDefault1" checked>
  <label class="form-check-label" for="flexRadioDefault1">
    表示
  </label>
  <input name="visible" value="0"  type="radio" id="flexRadioDefault2" >
  <label class="form-check-label" for="flexRadioDefault2">
    非表示
  </label>
</div></div>

  <button type="submit" class="btn btn-primary">保存</button>
</form>		
</div>
	</div>
</div>


<!-- updateここから -->
<!-- モーダル本体 -->
<div class="update-modal-container">
	<div class="update-modal-body">
		<!-- 閉じるボタン -->
		<div class="update-modal-close">×</div>
		<!-- モーダル内のコンテンツ -->
		<div class="update-modal-content">
		<!-- <form action="{{ route('group.store') }}" method="post"> -->
			<!-- @csrf -->
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">グループ名(JP)</label>
    <input  name="group_ja" type="text" class="form-control" id="exampleInputEmail1"
	>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">グループ名(EN)</label>
    <input name="group_en" type="text" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="form-outline mb-3">
  <label for="exampleInputPassword1" class="form-label">並び順</label>
    <input name="sort" type="number" id="typeNumber" class="form-control" />
</div>
<div class="form-outline mb-3">
<div class="form-check">
  <input name="visible" value="1" type="radio" id="flexRadioDefault1" checked>
  <label class="form-check-label" for="flexRadioDefault1">
    表示
  </label>
  <input name="visible" value="0"  type="radio" id="flexRadioDefault2" >
  <label class="form-check-label" for="flexRadioDefault2">
    非表示
  </label>
</div></div>

  <button type="submit" class="btn btn-primary">変更を保存</button>
<!-- </form>		 -->
</div>
	</div>
</div>



<!-- テーブル表示 -->
<div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">グループ名</th>
      <th scope="col">ソート優先度</th>
      <th scope="col">表示・非表示</th>
	  <th scope="col">削除</th>

    </tr>
  </thead>
  <tbody>
	@foreach($groups as $group)
	<!-- <input type="hidden" name="id" value="{{ $group->id }}"> -->
    <tr>
      <th scope="row">
		<a class="id" href="{{ route('group.edit',['id'=>$group->id]) }}">
			{{ $group->group_ja }} 
		</a>
	</th>
      <td>{{ $group->sort }}</td>
	  <td>
	  @if ( $group->visible == 1 )
	   表示 
	  @else
	   非表示 
	</td>
	  @endif
	  <form action="{{ route('group.destroy',['id'=> $group->id]) }}" method="post">
		@csrf
      <td><button type="submit" class="btn btn-outline-warning">削除</button></td>
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

<!-- // updateここから -->
<!-- モーダル表示 -->
<style>
.update-modal-open{
	/* position: fixed;
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
	transform: translate(-50%,-50%); */
}
/*モーダル本体の指定 + モーダル外側の背景の指定*/
.update-modal-container{
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
.update-modal-container:before{
	content: "";
	display: inline-block;
	vertical-align: middle;
	height: 100%;
}
/*モーダル本体に「active」クラス付与した時のスタイル*/
.update-modal-container.active{
	opacity: 1;
	visibility: visible;
}
/*モーダル枠の指定*/
.update-modal-body{
	position: relative;
	display: inline-block;
	vertical-align: middle;
	max-width: 500px;
	width: 90%;
}
/*モーダルを閉じるボタンの指定*/
.update-modal-close{
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
.update-modal-content{
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
// $(function(){
// 	// 変数に要素を入れる
// 	var open = $('.update-modal-open'),
// 		close = $('.update-modal-close'),
// 		container = $('.update-modal-container');

// 	//開くボタンをクリックしたらモーダルを表示する
// 	open.on('click',function(){	
// 		container.addClass('active');
// 		return false;
// 	});

// 	//閉じるボタンをクリックしたらモーダルを閉じる
// 	close.on('click',function(){	
// 		container.removeClass('active');
// 	});

// 	//モーダルの外側をクリックしたらモーダルを閉じる
// 	$(document).on('click',function(e) {
// 		if(!$(e.target).closest('.update-modal-body').length) {
// 			container.removeClass('active');
// 		}
// 	});
// });



//ajax

    </script>

</script>

</body>
</html>