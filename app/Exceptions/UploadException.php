<?php

namespace App\Exceptions;

use Exception;

class UploadException extends Exception
{
//    这个函数在UploadController中调用   json用于返回前端ajx
    public function render(){
//        hdjs只识别403，不用hdjs就可以谁便写，比如1；200接收成功 ；msg与前台名字统一，弹出信息，hdjs用的是message
        return response()->json(['msg' =>$this->getMessage(), 'code' => 1],200);
    }
}
