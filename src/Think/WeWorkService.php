<?php

namespace WeWork\Think;

use WeWork\App;
use think\Service;

class WeWorkService extends Service
{
    public function register()
    {
        $config = config('wework');
        if(empty($config)) {
            $config = require __DIR__.'/config.php';
        }
        $this->app->bind('wework',new App($config));
    }

    public function boot()
    {
        // 服务启动
    }

}



