<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>用户添加</h1>
	<form action="{{url('/kucun/store')}}" method="post">
		@csrf
		用户昵称<input type="text" name="name"><br>
		用户身份<input type="radio" name="fen" value="1">库管主管
		<input type="radio" name="fen" value="2">普通库管员<br>
		<input type="submit" value="添加用户">
	</form>
</body>
</html>