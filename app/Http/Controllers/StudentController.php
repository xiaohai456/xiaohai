<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Student;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $name = request()->name??'';
        $banji = request()->banji??'';
        $where = [];
        if($name){
            $where[] = ['name','like',"%$name%"];
        }

        if($banji){
            $where[] = ['banji','like',"%$banji%"];
        }


         //DB操作
         //$data = DB::table('student')->select('*')->get();
         //dd($data);
         //ORM操作
        $pageSize = config('app.pageSize');

         $data=Student::where($where)->orderby('id','desc')->paginate($pageSize);
        return view('people.list',['data'=>$data,'name'=>$name,'banji'=>$banji]);
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jia()
    {
        return view('people.jia');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function kk(Request $request)
    {
        $request->validate([
            'name' => 'required','unique:student',
            'chengji'=>'required|numeric|between:0,100',
            'sex'=>'required',
        ],[
            'name.required'=>'名称必填',
             'name.unique'=>'名称已存在',
            // 'name.regex'=>'必须是中文，字母，下划线，数字组成且2,12位',
            'sex.required'=>'性别必选',
            'chengji.required'=>'成绩必填',
            'chengji.numeric'=>'成绩必须是数值',
            'chengji.between'=>'成绩不能超过100',


        ]);

        $data = $request->except('_token');
        //dd($data);exit;
        $res = DB::table('student')->insert($data);
        //dd($res);
         if($res){
             return redirect('/people');
         }
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

        $user = DB::table('student')->where('id',$id)->first();
        //dd($user);
        return view('people.gai',['user'=>$user]);
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
         $request->validate([
            'name' => 'required','unique:student',
            'chengji'=>'required|numeric|between:0,100',
            'sex'=>'required',
        ],[
            'name.required'=>'名称必填',
             'name.unique'=>'名称已存在',
            // 'name.regex'=>'必须是中文，字母，下划线，数字组成且2,12位',
            'sex.required'=>'性别必选',
            'chengji.required'=>'成绩必填',
            'chengji.numeric'=>'成绩必须是数值',
            'chengji.between'=>'成绩不能超过100',


        ]);


         $user = $request->except('_token');
        $res = DB::table('student')->where('id', $id)->update($user);
        
        if($res!==false){
            return redirect('/people');
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
        $res = DB::table('student')->where('id',$id)->delete();
        if($res){
            return redirect('/people');
        }
    }
}
