<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Kucun;
class KucunController extends Controller
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
            $data=Kucun::orderby('id','desc')->paginate($pageSize);

            return view('kucun.index',['data'=>$data]);
    

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            return view('kucun.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //接受值
        $data = $request->except('_token');
        //dd($data);
        
        $res = Kucun::create($data);
        if($res){
            return redirect('/kucun');
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
        $user = Kucun::where('id',$id)->first();

        return view('kucun.edit',['user'=>$user]);
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

            


        $res = Kucun::where('id', $id)->update($user);


        if($res!==false){
            return redirect('/kucun');
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
          $res = Kucun::destroy($id);
        if($res){
            return redirect('/kucun');
        }
    }
}
