<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="{{url('/people/update/'.$user->id)}}" method="post">
		@csrf
		<h1>学生编辑</h1>
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
		学生姓名<input type="text" name="name" value="{{$user->name}}" ><br>
		学生性别<input type="radio" name="sex" value="1"  @if($user->sex==1) checked @endif >男
				<input type="radio" name="sex" value="2" @if($user->sex==2) checked @endif >女<br>
		班级		<input type="text" name="banji" value="{{$user->banji}}" ><br>
		成绩		<input type="text" name="chengji" value="{{$user->chengji}}" ><br>
		<input type="submit" value="编辑">
	</form>
</body>
</html>