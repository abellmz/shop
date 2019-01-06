<?php

namespace App\Http\Controllers\Util;

use App\Exceptions\UploadException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
//    一旦上传图片，就会被调用  上传接口!!!
    public function upload(Request $request)
    {
//dd($request->all());
//dd($request->file('file'));
//        dd('1');
        $file = $request->file('file');
//        dd($file);
        $this->checkSize($file);
        $this->checkType($file);
        if ($file) {
//        return [
//            'code'=>1,
//            'msg'=>'上传失败',
//        ];
            //$path = $file->store('上传文件存储目录','磁盘:filesystems 文件里面看disks');
//            存储            根下存储目录名   磁盘名,其中指定 根目录下的目录
            $path = $file->store('upload', 'upload');
//            dd($path);//"upload/qM9OEOURpTiPNKJEVWRuWeqgEpRHZuuxyUPbFCBh.png"
            return [
                'code' => 0,
                'mag' => '',
                'data' => [
                    'src' => '/' . $path
                ],
            ];

        }
    }

//    验证上传大小
    private function checkSize($file)
    {
//        if ($file->getSize() > 10000000) {
        if ($file->getSize() > hd_config('upload.upload_size')) {
//            throw new UploadException('上传文件过大');
        }
    }
//验证类型
    public function checkType($file)
    {
//        dd( explode('|','jpg|png|jpeg'));
//        dd(explode('|', hd_config('upload.upload_type'));
//        dd(in_array(strtolower($file->getClientOriginalExtension()), explode('|', hd_config('upload.upload_type'))));
        if (!in_array(strtolower($file->getClientOriginalExtension()), explode('|',hd_config('upload.upload_type')))) {
            throw new UploadException('类型不允许');
        }
    }
}
