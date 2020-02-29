<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Yuan;
class YuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $name = request()->name??'';
        $where = [];
        if($name){
           $where[] = ['name','like',"%$name%"];
        }

        $pageSize = config('app.pageSize');
        $data=Yuan::where($where)->orderby('id','desc')->paginate($pageSize);


        return view('yuan.index',['data'=>$data,'name'=>$name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

            return view('yuan.create');

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
                 $data['logo'] = upload('logo');
                 //dd($img);
                  }

                $res = Yuan::create($data);
                 if($res){
                    return redirect('/yuan');
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
        $user = Yuan::where('id',$id)->first();

        return view('yuan.edit',['user'=>$user]);
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
            $user['logo'] = upload('logo');
            //dd($img);
        }


        $res = Yuan::where('id', $id)->update($user);


        if($res!==false){
            return redirect('/yuan');
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
         $res = Yuan::destroy($id);
        if($res){
            return redirect('/yuan');
        }
    }
}
