<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Category;
use Illuminate\Support\Facades\Cache;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cate_name = request()->cate_name??'';
        $where = [];
        if($cate_name){
           $where[] = ['cate_name','like',"%$cate_name%"];
        }

        $pageSize = config('app.pageSize');
        $data=Category::where($where)->orderby('cate_id','desc')->paginate($pageSize);

        dd(request()->ajax());
        if(request()->ajax()){

        }

        return view('category.index',['data'=>$data,'cate_name'=>$cate_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        //dd($data);
        
        
        

        


    //文件上传
    if($request->hasFile('logo')){
        $data['logo'] = $this->upload('logo');
        //dd($img);
    }

    //多文件上传
    // if($data['shop_file']){
    //     Moreupload('');
    // }





        $res = Category::create($data);
         if($res){
            return redirect('/category');
        }


    }









    //上传文件
    public function upload($filename){
        //判断上传过程有没有错误
        if(request()->file($filename)->isValid()){
            //接受值
            $photo = request()->file($filename);
            //上传
            $store_result = $photo->store('uploads');
            return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');
    }









    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Category::where('cate_id',$id)->first();

        return view('category.edit',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            $user = $request->except('_token');

            if ($request->hasFile('logo')) {
            $user['logo'] = $this->upload('logo');
            //dd($img);
        }


        $res = Category::where('cate_id', $id)->update($user);


        if($res!==false){
            return redirect('/category');
        }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $res = Category::destroy($id);
        if($res){
            return redirect('/category');
        }
    }
}
