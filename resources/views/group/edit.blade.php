@extends('layouts.app')

<main style="margin-left:270px;">


<div class="update-modal-container">
	<div class="update-modal-body">
		<!-- 閉じるボタン -->
		<!-- <div class="update-modal-close">×</div> -->
		<!-- モーダル内のコンテンツ -->
		<div class="update-modal-content">
		<form action="{{ route('group.update',['id'=>$group->id]) }}" method="post">
		@csrf
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">グループ名(JP)</label>
    <input  name="group_ja" type="text" class="form-control" id="exampleInputEmail1" value="{{ $group->group_ja }}">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">グループ名(EN)</label>
    <input name="group_en" type="text" class="form-control" id="exampleInputPassword1" value="{{ $group->group_en }}">
  </div>
  <div class="form-outline mb-3">
  <label for="exampleInputPassword1" class="form-label">並び順</label>
    <input name="sort" type="number" id="typeNumber" class="form-control"  value="{{ $group->visible }}"/>
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
</body>
</html>