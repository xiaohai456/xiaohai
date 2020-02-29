<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use DB;
use App\People;
use App\Http\Requests\StorePeoplePost;
use Validator;
use Illuminate\Validation\Rule;
class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表页展示
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $username = request()->username??'';
        $where = [];
        if($username){
           $where[] = ['username','like',"%$username%"];
        }





       //$data = DB::table('people')->select('*')->get();

        //$data=People::all();
        //ORM操作
        $pageSize = config('app.pageSize');
        
        $data=People::where($where)->orderby('p_id','desc')->paginate($pageSize);
        //dd($data);


       return view('people.index',['data'=>$data,'username'=>$username]);

    }

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('people.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    //第二种验证 
      //public function store(StorePeoplePost $request)
    {
        //第一种验证 validate
        //$request->validate([
        //     'username' => 'required|unique:people|max:12|min:2',
        //     'age' => 'required|integer|min:1|max:3',
        //     'card' => 'required|integer|min:1|max:3',
        // ],[
        //     'username.required'=>'名字不能为空',
        //     'username.unique'=>'名字已存在',
        //     'username.max'=>'名字长度不超过12位',
        //     'username.min'=>'名字长度不少于2位',
        //     'age.required'=>'年龄不能为空',
        //     'age.integer'=>'年龄必须为数字',
        //     'age.min'=>'年龄数据不合法',
        //     'age.required'=>'年龄不能为空',
        //     'card.required'=>'身份证不能为空'

        // ]);


        $data = $request->except('_token');
        //dd($data);
        //第三种验证
        $validator = Validator::make($data,[
            // 'username' => 'required|unique:people|max:12|min:2',
           'username' => 'unique:people|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_-]{2,12}$/u',
            'age' => 'required|integer|between:1,130',
            //'card' => 'required|integer|min:1|max:3',
    ],[
            'username.unique'=>'名字已存在',
            'username.regex'=>'名字需由中文组成长度为2-12位',
            'age.required'=>'年龄不能为空',
            'age.integer'=>'年龄必须为数字',
            'age.between'=>'年龄数据不合法',
            //'card.required'=>'身份证不能为空'

        ]);
        if ($validator->fails()) {
        return redirect('people/create')
            ->withErrors($validator)
            ->withInput();
    }





        //文件上传
        if ($request->hasFile('head')) {
            $data['head'] = $this->upload('head');
            //dd($img);
        }


        $data['add_time'] = time();
        //DB
        //$res = DB::table('people')->insert($data);
        //ORM save
        // $people = new People;
        // $people->username = $data['username'];
        // $people->age = $data['age'];
        // $people->card = $data['card'];
        // $people->head = $data['head'];
        // $people->add_time = $data['add_time'];
        // $res = $people->save();
        // ORM create
        $res = People::create($data);
        //dd($res);
        if($res){
            return redirect('/people');
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
     *预览详情页
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *编辑页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$user = DB::table('people')->where('p_id',$id)->first();
        //ORM操作
       // $user = People::find($id);
        $user = People::where('p_id',$id)->first();


       return view('people.edit',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *执行编辑
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePeoplePost $request, $id)
    {
        //echo $id;
        $user = $request->except('_token');


        //第三种验证
    //      $validator = Validator::make($user,[
    //         // 'username' => 'required|unique:people|max:12|min:2',
    //        'username' => [
    //                 'regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_-]{2,12}$/u',
    //                 Rule::unique('people')->ignore($id,'p_id'),
    //             ],
    //         'age' => 'required|integer|between:1,130',
    //         //'card' => 'required|integer|min:1|max:3',
    // ],[
    //         'username.unique'=>'名字已存在',
    //         'username.regex'=>'名字需由中文组成长度为2-12位',
    //         'age.required'=>'年龄不能为空',
    //         'age.integer'=>'年龄必须为数字',
    //         'age.between'=>'年龄数据不合法',
    //         //'card.required'=>'身份证不能为空'

    //     ]);
    //     if ($validator->fails()) {
    //     return redirect('people/edit/'.$id)
    //         ->withErrors($validator)
    //         ->withInput();
    // }



        //dd($user);
        //判断文件上传是否有误
         if ($request->hasFile('head')) {
            $user['head'] = $this->upload('head');
            //dd($img);
        }



        //$res = DB::table('people')->where('p_id', $id)->update($user);
        //ORM操作
        // $people = People::find($id);
        //dd($people);
        // $people->username = $user['username'];
        // $people->age = $user['age'];
        // $people->card = $user['card'];
        // $people->head = $user['head']??'';
        // $res = $people->save();
        $res = People::where('p_id', $id)->update($user);


        if($res!==false){
            return redirect('/people');
        }
    }

    /**
     * Remove the specified resource from storage.
     *删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$res = DB::table('people')->where('p_id',$id)->delete();
        $res = People::destroy($id);
        if($res){
            return redirect('/people');
        }
    }


   


}
