<?php

namespace App\Observers;

use App\Models\Config;

class ConfigOberver
{
    /**
     * Handle the config "created" event.
     *
     * @param  \App\Models\Config  $config
     * @return void
     */
    public function created(Config $config)
    {
        //
    }

    /**
     * Handle the config "updated" event.
     *
     * @param  \App\Models\Config  $config
     * @return void
     */
    public function updated(Config $config)
    {
        $this->saveConfigToCache();
    }

    /**
     * Handle the config "deleted" event.
     *
     * @param  \App\Models\Config  $config
     * @return void
     */
    public function deleted(Config $config)
    {
        //
    }

    /**
     * Handle the config "restored" event.
     *
     * @param  \App\Models\Config  $config
     * @return void
     */
    public function restored(Config $config)
    {
        //
    }

    /**
     * Handle the config "force deleted" event.
     *
     * @param  \App\Models\Config  $config
     * @return void
     */
    public function forceDeleted(Config $config)
    {

    }
    private function saveConfigToCache(){
//        dd(Config::pluck('data','name'));
//     存在服务的文件          键         值    检索     值     键（固定的设置）
        \Cache::forever('config_cache',Config::pluck('value','name'));
    }
}
