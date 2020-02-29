<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<form action="{{url('/yuan/store')}}" method="post" enctype="multipart/form-data">
	@csrf
<body>
	账户<input type="text" name="name"><br>
	密码<input type="password" name="pwd"><br>
	手机号<input type="text" name="tel"><br>
	邮箱<input type="text" name="email"><br>
	管理员头像<input type="file" name="logo"><br>
	<input type="submit" value="添加管理员">
</body>
</form>
</html>