<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>修改商品</h1>

	<form action="{{url('/category/update/'.$user->cate_id)}}" method="post" enctype="multipart/form-data">
		@csrf
		商品名称<input type="text" name="cate_name" value="{{$user->cate_name}}"><br>
		商品货号<input type="text" name="hao" value="{{$user->hao}}"><br>
		商品价格<input type="text" name="ge" value="{{$user->ge}}"><br>
		商品缩略图<img src="{{env('UPLOAD_URL')}}{{$user->logo}}" width="50" height="50">
		<input type="file" name="logo"><br>
		商品库存	<input type="text" name="cun" value="{{$user->cun}}"><br>
		是否精品
		<input type="radio" name="pin" value="1"  @if($user->pin==1) checked @endif>是
		<input type="radio" name="pin" value="2" @if($user->pin==2) checked @endif>否<br>
		是否热销
		<input type="radio" name="xiao" value="1" @if($user->xiao==1) checked @endif>是
		<input type="radio" name="xiao" value="2" @if($user->xiao==2) checked @endif>否<br>
		<input type="submit" value="商品修改">
	</form>
</body>
</html>