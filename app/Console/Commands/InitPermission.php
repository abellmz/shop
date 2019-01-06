<?php

namespace App\Console\Commands;

use App\Models\Admin;
use App\Models\Module;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class InitPermission extends Command
{
//    命令标识（签名）
    protected $signature = 'init:permission';
//    命令描述（）
    protected $description = 'init permission';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //扫描出 app/Http/Controllers里面所有文件以及文件夹
        $modules=glob('app/Http/Controllers/*');
//        dd($modules);//值为路径（字符串）数组
        foreach ($modules as $module){
            if (is_dir($module . '/System')){
//                获取整个路径最后一部分       用dump打印，dd只能打印一次，不能循环
                $moduleName=basename($module);
//                dump($moduleName);
//                dd('1');
                $config =include $module . '/System/config.php';
                $permissions=include $module . '/System/permission.php';
//                填写模块表
                Module::firstOrNew(['name'=>$moduleName])->fill([
                    'title'=>$config['app'],
                    'permissions'=>$permissions
                ])->save();
//                填写权限表
                foreach ($permissions as $permission){
                    Permission::firstOrNew(['name'=>$moduleName . '-' . $permission['name']])->fill([
                        'title'     =>$permission[ 'title' ] ,
                        'module'    =>$moduleName ,
                        'guard_name'=>'admin'
                    ])->save();
                }
//                dd('2');
            }
        }
//        -------------------------------------------------
//        角色表中 找到站长这个角色对象 英文名=webmaster  需要运行seeder生成站长
        $role =Role::where('name','webmaster')->first();
//        dd($role);
        //获取所有权限
        $permissions=Permission::pluck( 'name' );
//        dd($permissions);
        //执行完成后 role_has_permissions表有数据 获得所有权限
        //     角色表name   同步到  要求的权限  即站长有了所有权限
        $role->syncPermissions( $permissions );
        //获得    设置成站长的那个用户
        $user=Admin::find( 1 );
        $user->assignRole( 'webmaster' );
        //清除权限缓存

        \Artisan::call( 'permission:cache-reset' );
        //命令执行成功提示信息
        $this->info( 'permission init successfully' );
//        dd(2);
    }
}
