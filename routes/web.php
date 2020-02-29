<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//闭包路由
// Route::get('/', function () {
//     //echo '123';
//     $name = '成果成果成狗';
//     return view('welcome',['name'=>$name]);
// });


Route::get('/','Index\IndexController@index');
Route::view('/login','index.login');
Route::get('/setcookie','Index\IndexController@setCookie');
Route::get('/send','Index\IndexController@ajaxsend');




Route::get('show', function () {
   	echo '这里是商品详情页';
});


Route::get('/show/{id}', function ($id) {
   	echo '商品id是:'.$id;
});


Route::get('/show/{id}/{name}', function ($id,$name) {
   	echo '商品id是:'.$id;
   	echo '商品是:'.$name;
});






// Route::get('user','UserController@index');

// Route::get('/brand/add','UserController@add');//添加第一种
// Route::get('/brand/adds','UserController@add');//第二种

// Route::get('/cartgory/add','UserController@cartgory');


// //Route::get('adduser','UserController@add');

// Route::post('/adddo','UserController@adddo');
//正则约束
Route::get('/show/{id}', function ($show_id) {
   	echo "商品id：";
   	echo $show_id;
})->where('id','\d+');




//外来务工人员统计
 // Route::prefix('people')->middleware('checklogin')->group(function(){
 //     Route::get('create','PeopleController@create');
	//  Route::post('store','PeopleController@store');
	//  Route::get('/','PeopleController@index');
	//  Route::get('edit/{id}','PeopleController@edit');
	//  Route::post('update/{id}','PeopleController@update');
	//  Route::get('destroy/{id}','PeopleController@destroy');
 // });
 // Route::view('/login','login');
 // Route::post('logindo','LoginController@logindo');
	


//学生统计
 Route::get('/people/jia','StudentController@jia');
 Route::post('/people/kk','StudentController@kk');
 Route::get('/people','StudentController@index'); 
 Route::get('/people/edit/{id}','StudentController@edit');
 Route::post('/people/update/{id}','StudentController@update');
 Route::get('/people/destroy/{id}','StudentController@destroy');

//品牌表
 Route::get('/brand/add','Brand@add');
 Route::post('/brand/store','Brand@store');
 Route::get('/brand','Brand@index');


//文章
Route::get('/wen/create','WenController@create');
Route::post('/wen/store','WenController@store');
Route::get('/wen','WenController@index');
Route::get('/wen/edit/{id}','WenController@edit');
Route::post('/wen/update/{id}','WenController@update');
Route::get('/wen/destroy/{id}','WenController@destroy');
Route::post('/wen/checkOnly','WenController@checkOnly');



//商品
Route::get('/category/create','CategoryController@create');
Route::post('/category/store','CategoryController@store');
Route::get('/category','CategoryController@index');
Route::get('/category/destroy/{id}','CategoryController@destroy');
Route::get('/category/edit/{id}','categoryController@edit');
Route::post('/category/update/{id}','categoryController@update');



//管理员
Route::get('/yuan/create','YuanController@create');
Route::post('/yuan/store','YuanController@store');
Route::get('/yuan','YuanController@index');
Route::get('/yuan/destroy/{id}','YuanController@destroy');
Route::get('/yuan/edit/{id}','YuanController@edit');
Route::post('/yuan/update/{id}','YuanController@update');



//用户
Route::get('/kucun/create','KucunController@create');
Route::post('/kucun/store','KucunController@store');
Route::get('/kucun','KucunController@index');
Route::get('/kucun/edit/{id}','KucunController@edit');
Route::post('/kucun/update/{id}','KucunController@update');
Route::get('/kucun/destroy/{id}','KucunController@destroy');
