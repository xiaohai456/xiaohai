<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
class LoginController extends Controller
{
    public function logindo(Request $requset){
    	$user = $requset->except('_token');

    	$user['password'] = md5(md5($user['password']));
    	$admin = Admin::where($user)->first();

    	if($admin){
    		session(['admin'=>$admin]);
    		$requset->session()->save();

    		return redirect('/people');
    	}
    	return redirect('/login')->with('msg','没有此用户');

    }
}
