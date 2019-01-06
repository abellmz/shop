<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        注册种子库
            $this->call(AdminTableSeeder::class);
            $this->call(RoleTableSeeder::class);
    }
}
