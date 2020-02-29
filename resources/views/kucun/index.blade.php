<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>列表展示</h1>
	<table border="1">
		<tr>
			<td>id</td>
			<td>用户名称</td>
			<td>用户身份</td>
			<td>操作</td>
		</tr>
		@foreach($data as $v)
		<tr>
			<td>{{$v->id}}</td>
			<td>{{$v->name}}</td>
			<td>{{$v->fen==1?'库管主管':'普通库管员'}}</td>
			<td>
				<a href="{{url('kucun/destroy/'.$v->id)}}">删除</a>
				<a href="{{url('kucun/edit/'.$v->id)}}">修改</a>
			</td>
		</tr>
		@endforeach
		<tr><td colspan="4">{{$data->links()}}</td></tr>
	</table>
</body>
</html>