<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<h3>修改管理员</h3>
<form action="{{url('/yuan/update/'.$user->id)}}" method="post" enctype="multipart/form-data">
	@csrf
<body>
	账户<input type="text" name="name" value="{{$user->name}}"><br>
	手机号<input type="text" name="tel" value="{{$user->tel}}"><br>
	邮箱<input type="text" name="email" value="{{$user->email}}"><br>
	管理员头像<img src="{{env('UPLOAD_URL')}}{{$user->logo}}" width="50" height="50">
	<input type="file" name="logo"><br>
	<input type="submit" value="修改管理员">
</body>
</form>
</html>