<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="/static/js/jquery.min.js"></script>
</head>

<body>
	<form>
		<input type="text" name="cate_name" placeholder="请输入商品名称" value="{{$cate_name}}">
		<input type="submit" value="搜索">
	</form>
	<table border="1">
		<tr>
			<td>商品id</td>
			<td>商品名称</td>
			<td>商品货号</td>
			<td>商品价格</td>
			<td>商品缩略图</td>
			<td>商品库存</td>
			<td>是否精品</td>
			<td>是否热卖</td>
			<td>商品相册</td>
			<td>操作</td>
		</tr>
		@foreach($data as $v)
		<tr>
			<td>{{$v->cate_id}}</td>
			<td>{{$v->cate_name}}</td>
			<td>{{$v->hao}}</td>
			<td>{{$v->ge}}</td>
			<td><img src="{{env('UPLOAD_URL')}}{{$v->logo}}" width="50" height="50"></td>
			<td>{{$v->cun}}</td>
			<td>{{$v->pin==1?'是':'否'}}</td>
			<td>{{$v->xiao==1?'是':'否'}}</td>
			<td><img src="{{env('UPLOAD_URL')}}{{$v->shop_file}}" width="50" height="50"></td>			
			<td>
				<a href="{{url('category/destroy/'.$v->cate_id)}}">删除</a>
				<a href="{{url('category/edit/'.$v->cate_id)}}">修改</a>
			</td>
		</tr>
		@endforeach
		<tr><td colspan="9">{{$data->links()}}</td></tr>
	</table>
</body>
</html>
<script>
	//ajax分页
	$('.pagination a ').click(function(){
		var url = $(this).attr('href');
		if(!url){
			return;
		}

		$.get(url,function(result){
			alert(result);
		});
		return false;
	});
</script>