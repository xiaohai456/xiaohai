<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<h1>品牌列表</h1>
<body>
	<table border="1">
		<tr>
			<td>品牌id</td>
			<td>品牌名称</td>
			<td>品牌网址</td>
			<td>描述</td>
			<td>品牌logo</td>
			<td>操作</td>
		</tr>
		@foreach($data as $v)
		<tr>
			<td>{{$v->id}}</td>
			<td>{{$v->name}}</td>
			<td>{{$v->zhi}}</td>
			<td>{{$v->shu}}</td>
			<td>@if($v->logo)<img src="{{env('UPLOAD_URL')}}{{$v->logo}}" width="100" height="100">
			@endif</td>
			<td></td>
		</tr>
		@endforeach
	</table>
</body>
</html>