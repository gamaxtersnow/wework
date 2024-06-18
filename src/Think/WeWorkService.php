<?php

namespace WeWork\Think;

use WeWork\App;
use think\Service;

class WeWorkService extends Service
{
    public function register(): void
    {
        $config = config('wework');
        if(empty($config)) {
            $config = require __DIR__.'/config.php';
        }
        $agents = $config['agents'];
        //初始化默认服务
        $defaultConfig = $agents[$config['default']]??[];
        unset($agents[$config['default']]);
        if(!empty($defaultConfig)) {
            $this->app->bind('wework',new App($config + $defaultConfig));
        }
        foreach ($agents as $agentName => $agentConfig) {
            $this->app->bind('wework_'.$agentName,new App($config + $agentConfig));
        }
    }

    public function boot()
    {
        // 服务启动
    }

}



