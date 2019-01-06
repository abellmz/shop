<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //填充初始站长数据
        \Spatie\Permission\Models\Role::firstOrNew( [
            'name'=>'webmaster' ,
        ] )->fill( [ 'guard_name'=>'admin' ,'title'=>'站长',] )->save();
    }
}
