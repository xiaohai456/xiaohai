<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
		<h1>学生列表</h1>

		<form>
			<input type="text" name="name" placeholder="请输入学生姓名" value="{{$name}}">
			<input type="text" name="banji" placeholder="请输入班级" value="{{$banji}}">
			<input type="submit" value="搜索">
		</form>
		<table border="1">
			<tr>
				<td>id</td>
				<td>学生姓名</td>
				<td>学生性别</td>
				<td>班级</td>
				<td>成绩</td>
				<td>操作</td>
			</tr>
			@foreach($data as $v)
			<tr>
				<td>{{$v->id}}</td>
				<td>{{$v->name}}</td>
				<td>{{$v->sex==1?'男':'女'}}</td>
				<td>{{$v->banji}}</td>
				<td>{{$v->chengji}}</td>
				<td>
					<a href="{{url('people/edit/'.$v->id)}}">编辑</a>
					<a href="{{url('people/destroy/'.$v->id)}}">删除</a>
				</td>
			</tr>
			@endforeach

		</table>
		<tr><td colspan="5">{{$data->appends(['name'=>$name,'banji'=>$banji])->links()}}</td></tr>
</body>
</html>