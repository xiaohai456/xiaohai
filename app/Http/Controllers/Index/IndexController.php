<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
class IndexController extends Controller
{

	public function setCookie(){
		//第一种
		//return response('测试产生cookie')->cookie('name','jkjkjkj',2);
		//第二种cookie全局辅助函数
		//$cookie = cookie('name','hhuhuhuhu',2);

		//return response('测试产生cookie')->cookie($cookie);
			
		//第三种队列形式设置cookie
		//Cookie::queue(Cookie::make('age', '18', 2))
		//第四种
		Cookie::queue('number', '100', 2);
	}


	//前台首页
    public function index(){
    	//获取cookie第一种
    	//echo request()->cookie('name');
    	//获取cookie第二种
		$value = Cookie::get('number');
		echo $value;
    	return view('index.index');
    }


    public function  ajaxsend(){
    	//接收注册页面的手机号
    	//$moblie = '15033015345';
    	$moblie = request()->moblie;
    	$code = rand(1000,9999);
    	$res = $this->sendSms($moblie,$code);
    	if($res['Code']=='ok'){
    		session(['code'=>$code]);
    		request()->session()->save();

    		echo "发送成功";
    	}
    }




    public function sendSms($moblie,$code){

AlibabaCloud::accessKeyClient('LTAI4FfeH1ZG3DSQJuogqvjU', 'j4QpdQZYBiOLaOQNLPJvCPcpfNv5Ff')
                        ->regionId('cn-hangzhou')
                        ->asDefaultClient();

				try {
				    $result = AlibabaCloud::rpc()
				                          ->product('Dysmsapi')
				                          // ->scheme('https') // https | http
				                          ->version('2017-05-25')
				                          ->action('SendSms')
				                          ->method('POST')
				                          ->host('dysmsapi.aliyuncs.com')
				                          ->options([
				                                        'query' => [
				                                          'RegionId' => "cn-hangzhou",
				                                          'PhoneNumbers' => $moblie,
				                                          'SignName' => "小辣",
				                                          'TemplateCode' => "SMS_184120212",
				                                          'TemplateParam' => "{code:$code}",
				                                        ],
				                                    ])
				                          ->request();
				    return $result->toArray();
				} catch (ClientException $e) {
				    return $e->getErrorMessage();
				} catch (ServerException $e) {
				    return $e->getErrorMessage();
				}

				    }


}
