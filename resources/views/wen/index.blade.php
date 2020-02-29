<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
		
</head>
<body>
	<h1>文章列表</h1>
	<form>
		<select name="cate">
			<option value="">全部分类</option>
				<option value="手机促销">手机促销</option>
				<option value="3G咨询">3G咨询</option>
				<option value="站内快讯">站内快讯</option>
		</select>
		<input type="text" name="name" placeholder="请输入标题" >
		<input type="submit" value="搜索">
	</form>
	<table border="1">
		<tr>
			<td>编号</td>
			<td>文章标题</td>
			<td>文章分类</td>
			<td>文章重要性</td>
			<td>是否显示</td>
			<td>文章作者</td>
			<td>作者email</td>
			<td>关键字</td>
			<td>网页描述</td>
			<td>图片</td>
			<td>添加时间</td>
			<td>操作</td>
		</tr>
		@foreach($data as $v)
		<tr>
			<td>{{$v->id}}</td>
			<td>{{$v->name}}</td>
			<td>{{$v->cate}}</td>
			<td>{{$v->xing==1?'普通':'置顶'}}</td>
			<td>{{$v->shi==1?'√':'×'}}</td>
			<td>{{$v->zhe}}</td>
			<td>{{$v->email}}</td>
			<td>{{$v->zi}}</td>
			<td>{{$v->shu}}</td>
			<td>@if($v->logo)<img src="{{env('UPLOAD_URL')}}{{$v->logo}}" width="50" height="50">
			@endif
		   </td>
			<td>{{date('Y-m-d H:i:s')}}</td>
			<td>
				<a href="{{url('wen/edit/'.$v->id)}}">修改</a>
				<a href="javascript:void(0)" onclick="del({{$v->id}})">删除</a>
			</td>
		</tr>
		@endforeach
		<tr><td colspan="11">{{$data->appends(['name'=>$name,'cate'=>$cate])->links()}}</td></tr>
	</table>
</body>
</html>
	<script src="/static/js/jquery.min.js"></script>
<script>
	function del(id){
		if(!id){
			return;
		}
		if(confirm('是否要删除此条记录')){
			//ajax删除
			$.get('/wen/destroy/'+id,function(result){
				if(result.code=='00000'){
					location.reload();
				}
			},'json')
		}

	}
</script>	