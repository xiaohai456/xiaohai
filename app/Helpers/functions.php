<?php
    //上传文件
     function upload($filename){
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



        //多文件上传
     function Moreupload($filename){
    	$photo = request()->file($filename);
    	if(!is_array($photo)){
    		return;
    	}
    	dd($photo);

        //判断上传过程有没有错误
        // if(request()->file($filename)->isValid()){
        //     //接受值
        //     $photo = request()->file($filename);
        //     //上传
        //     $store_result = $photo->store('uploads');
        //     return $store_result;
        // }
        // exit('未获取到上传文件或上传过程出错');
    }


function showMsg($status,$message = '',$data = array()){
    $result = array(
        'status' => $status,
        'message' =>$message,
        'data' =>$data
    );
    exit(json_encode($result));
}





