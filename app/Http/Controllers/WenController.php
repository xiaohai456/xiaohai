<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\Wenzhang;
class WenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $name = request()->name??'';
        $cate = request()->cate??'';
        $where = [];
        if($name){
           $where[] = ['name','like',"%$name%"];
        }

 
        $where = [];
        if($cate){
           $where[] = ['cate','like',"%$cate%"];
        }





        $data = DB::table('wenzhang')->select('*')->get();
        //dd($data);
        
         $pageSize = config('app.pageSize');

         $data=Wenzhang::where($where)->orderby('id','desc')->paginate($pageSize);
        return view('wen.index',['data'=>$data,'name'=>$name,'cate'=>$cate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('wen.jia');
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
       
    //     $validator = Validator::make($data,[
            
    //        'name' => 'required',
    //         'xing' => 'required|integer|between:1,130',
    //         'shi' => 'required|integer|min:1|max:3',
    // ],[
    //         'name.required'=>'标题必填',
    //         'name.unique'=>'文章标题已存在',
    //         //'name.regex'=>'文章标题必须是中文字母数字下划线组成',
    //          'xing.required'=>'文章重要性不能为空',
    //         'shi.required'=>'是否显示不能为空'

    //     ]);
    //     if ($validator->fails()) {
    //     return redirect('wen/create')
    //         ->withErrors($validator)
    //         ->withInput();
    // }



    //文件上传
    if($request->hasFile('logo')){
        $data['logo'] = $this->upload('logo');
        //dd($img);
    }

       $res = DB::table('wenzhang')->insert($data);
       //dd($res);
       if($res){
        return redirect('/wen');
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


    public function checkOnly(){
        $name = request()->name;
         $count = Wenzhang::where(['name'=>$name])->count();
         echo json_encode(['code'=>'00000','msg'=>'ok','count'=>$count]);
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
        $user = DB::table('wenzhang')->where('id',$id)->first();
        //dd($user);
        return view('wen.edit',['user'=>$user]);
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
        //echo $id;
        $user = $request->except('_token');


         if ($request->hasFile('logo')) {
            $user['logo'] = $this->upload('logo');
            //dd($img);
        }




       $res = DB::table('wenzhang')->where('id', $id)->update($user);
       //dd($res);
       if($res!==false){
        return redirect('wen');
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

        $res = DB::table('wenzhang')->where('id',$id)->delete();
        //$res = People::destroy($id);
        if($res){
            echo json_encode(['code'=>'000000','msg'=>'ok']);
        }
    }
}
