<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="{{url('/brand/store')}}" method="post" enctype="multipart/form-data">
		@csrf
		品牌名称<input type="text" name="name"><br>
		品牌网址<input type="text" name="zhi"><br>
		描述<textarea name="shu" id="" cols="30" rows="10"></textarea><br>
		品牌logo  <input type="file" name="logo"><br>
		<input type="submit" value="添加">	
	</form>
</body>
</html>