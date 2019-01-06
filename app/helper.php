<?php
//助手函数  判断是否存在hd_config 不存在则建一个  这个函数用于判断有无缓存，最后返回缓存值
if (!function_exists('hd_config')){
//帮助读取后台配置项数据
    function hd_config($var){
        static $cache = [];
        //		字符串转数组          分隔符   字符串
        $info =explode('.',$var);
//  判断是否存在缓存 不存在运行
        if(!$cache){
            //清空所有缓存
            Cache::flush();
            //获取缓存中config_cache数据,如果数据不存在,那么会以第二个参数作为默认值
            $cache = Cache::get('config_cache',function (){
//                第一个作为键值，第二个作为键名   pluck（拉拽摘/检索）
                return \App\Models\Config::pluck('value','name');
            });
        }
        //isset($cache[$info[0]][$info[1]])?$cache[$info[0]][$info[1]]:''
        return $cache[$info[0]][$info[1]]??'';
    }
}

if (!function_exists('admin_has_permission')){
    function admin_has_permission($permission){
        if (is_array($permission)){
            if (!auth('admin')->user()->hasAnyPermission($permission)){
                throw new \App\Exceptions\PermissionException('不能进哦亲~');
            }
        }
        if (is_string($permission)){
            if (!auth('admin')->user()->hasPermissionTo($permission)){
                throw new \App\Exceptions\PermissionException('不能进哦亲~');
            }
        }
    }
}
