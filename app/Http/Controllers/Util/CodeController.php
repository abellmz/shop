<?php

namespace App\Http\Controllers\Util;

use App\Notifications\RegisterNotify;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Qcloud\Sms\SmsSingleSender;

class CodeController extends Controller
{
    public function send(Request $request){
//        dd($request->email);
        $account=$request->account;
//        dd($account);
        $code=$this->random();
//        检测账号是否为邮箱
        if(filter_var($account,FILTER_VALIDATE_EMAIL)){
            $user=User::firstOrNew(['email'=>$account]);
            $user->notify(new RegisterNotify($code));
        }else{
//            手机短信验证码
            $appid= 1400171434;
            $appkey = "47ccddb863ae7791e186cd2a011a06fb";
            $phoneNumbers = $account;
            $templateId = 251738;
            $smsSign = "李敏樟阅读分享";
            $time=3;
        try {
            $ssender = new SmsSingleSender($appid, $appkey);
            $result = $ssender->send(0, "86", $phoneNumbers,
                "【李敏樟阅读分享】您好！您的验证码为".$code."，请在".$time."分钟内填写，如非本人操作，请忽略本短信","","");
            $rsp = json_decode($result);
//            dd($rsp);
        } catch(\Exception $e) {
            echo var_dump($e);
            return ['code'=>0,'message'=>'短信发送失败，请联系管理员'];
        }
//            dd(12);
    }
//        ----------------------------------------------------------
//        $user=User::firstOrNew(['email'=>$request->email]);
//        dd($user);
//        $user->notify(new RegisterNotify($code));
        //将验证码存入到session中
        session()->put('code',$code);
        return ['code'=>1,'message'=>'验证码发送成功'];
    }
    public function random($len=4){
        $str='';
        for($i=0;$i<$len;$i++){
            $str.=mt_rand(0,9);
        }
        return $str;
    }
}
