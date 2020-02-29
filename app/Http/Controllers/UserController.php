<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
    	echo 'feool';
    }

    public function add(){
    	return view('user.add');
    }

    public function adddo(Request $request){
    	$data = $request->all();
    	dd($data);
    }

    public function cartgory(){
    	$fid = '服装添加';
    	return view('user.cartgory',['fid'=>$fid]);
    }



}
