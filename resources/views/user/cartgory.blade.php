<form action="{{url('adddo')}}" method="post">
	{{$fid}}
	<h5>服装添加页面</h5>
	@csrf
	<input type="text" name="name">
	<input type="text" name="age">
	<input type="submit" value="提交">
</form>