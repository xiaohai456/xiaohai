<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>添加商品</h1>

	<form action="{{url('/category/store')}}" method="post" enctype="multipart/form-data">
		@csrf
		商品名称<input type="text" name="cate_name"><br>
		商品货号<input type="text" name="hao"><br>
		商品价格<input type="text" name="ge"><br>
		商品缩略图<input type="file" name="logo"><br>
		商品库存	<input type="text" name="cun"><br>
		是否精品
		<input type="radio" name="pin" value="1">是
		<input type="radio" name="pin" value="2">否<br>
		是否热销
		<input type="radio" name="xiao" value="1">是
		<input type="radio" name="xiao" value="2">否<br>
		商品相册<input type="file" name="shop_file[]" multiple="multiple"><br>
		<input type="submit" value="添加商品">
	</form>
</body>
</html>