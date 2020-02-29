<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>修改用户</h1>
	<form action="{{url('/kucun/update/'.$user->id)}}" method="post">
		@csrf
		用户昵称<input type="text" name="name" value="{{$user->name}}"><br>
		用户身份<input type="radio" name="fen" value="1" @if($user->fen==1) checked @endif >库管主管
		<input type="radio" name="fen" value="2" @if($user->fen==2) checked @endif >普通库管员<br>
		<input type="submit" value="修改用户">
	</form>
</body>
</html>