<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="{{url('/people/kk')}}" method="post">
		@csrf
		<h1>学生添加</h1>
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
		学生姓名<input type="text" name="name"><br>
		学生性别<input type="radio" name="sex" value="1">男
				<input type="radio" name="sex" value="2">女<br>
		班级		<input type="text" name="banji"><br>
		成绩		<input type="text" name="chengji"><br>
		<input type="submit" value="添加">
	</form>
</body>
</html>
<script src="/static/js/jquery.min.js"></script>
<script>
	
</script>