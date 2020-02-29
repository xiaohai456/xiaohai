<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form>
		<input type="text" name="name" placeholder="请输入账户" value="{{$name}}">
		<input type="submit" value="搜索">
	</form>
	<table border="1">
		<tr>
			<td>id</td>
			<td>账户</td>
			<td>手机号</td>
			<td>管理员头像</td>
			<td>操作</td>
		</tr>
		@foreach($data as $v)		
		<tr>
			<td>{{$v->id}}</td>
			<td>{{$v->name}}</td>
			<td>{{$v->tel}}</td>
			<td><img src="{{env('UPLOAD_URL')}}{{$v->logo}}" width="50" height="50"></td>
			<td>
				<a href="{{url('yuan/destroy/'.$v->id)}}">删除</a>
				<a href="{{url('yuan/edit/'.$v->id)}}">修改</a>
			</td>
		</tr>
		@endforeach
	</table>
	<tr><td colspan="6">{{$data->appends(['name'=>$name])->links()}}</td></tr>
</body>
</html>