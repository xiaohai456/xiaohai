<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="/static/js/jquery.min.js"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

	@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

	<form action="{{url('/wen/store')}}" method="post" enctype="multipart/form-data">
		<h1>添加文章</h1>
		@csrf
	文章标题<input type="text" name="name">
			<b style="color:red"></b>
	<br>
	文章分类 <select name="cate">
				<option value="手机促销">手机促销</option>
				<option value="3G咨询">3G咨询</option>
				<option value="站内快讯">站内快讯</option>
			</select><br>
	文章重要性<input type="radio" name="xing" value="1">普通
			 <input type="radio" name="xing" value="2">置顶<br>
	是否显示  <input type="radio" name="shi" value="1">显示
			 <input type="radio" name="shi" value="2">不显示<br>
	文章作者<input type="text" name="zhe">
			<b style="color:red"></b>
	<br>
	作者email <input type="text" name="email"><br>
	关键字<input type="text" name="zi"><br>
	网页描述<textarea name="shu" id="" cols="30" rows="10" name=""></textarea><br>
	上传文件<input type="file" name="logo"><br>
	<input type="button" value="添加">
	<input type="reset" value="重置">
	</form>
</body>
</html>
<script>
		//表单令牌
		$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

	$('input[type="button"]').click(function(){
		var titeflag = true;
		$('input[name="name"]').next().html('');
		//标题验证
		var name = $('input[name="name"]').val();
		var reg = /^[\u4e00-\u9fa50-9A-Za-z_]+$/;
        if(!reg.test(name)){
        	$('input[name="name"]').next().html('文章标题由中文字母数字组成且不能为空');
        	return;
        }

		//验证唯一性
		$.ajax({
			type:'post',
			url:"/wen/checkOnly",
			data:{name:name},
			async:false,
			dataType:'json',
			success:function(result){
				if(result.count>0){
				$('input[name="name"]').next().html('标题已存在');
				titeflag = false;
				}
			  
			}});
			if(!titeflag){
				return;
			}
			
			//作者验证
			var zhe = $('input[name="zhe"]').val();
			var reg = /^[\u4e00-\u9fa50-9A-Za-z_]{2,8}$/;
			if(!reg.test(zhe)){
			$('input[name="zhe"]').next().html('文章作者由中文字母数字组成且不能为空长度为2-8位');
			return;
		}
	//form 提交
	$('form').submit();


})


	$('input[name="zhe"]').blur(function(){
	$(this).next().html('');
	var zhe = $(this).val();
	var reg = /^[\u4e00-\u9fa50-9A-Za-z_]{2,8}$/;
	if(!reg.test(zhe)){
		$(this).next().html('文章作者由中文字母数字组成且不能为空长度为2-8位');
		return;
		}
	})



	$('input[name="name"]').blur(function(){
		$(this).next().html('');
		var name = $(this).val();
        var reg = /^[\u4e00-\u9fa50-9A-Za-z_]+$/;
        //alert(reg.test(name));
        if(!reg.test(name)){
        	$(this).next().html('文章标题由中文字母数字组成且不能为空');
        	return;
        }
		

		//验证唯一性
		$.ajax({
			type:'post',
			url:"/wen/checkOnly",
			data:{name:name},
			dataType:'json',
			success:function(result){
				if(result.count>0){
				$('input[name="name"]').next().html('标题已存在');
				}
			  
			}});




	});
</script>