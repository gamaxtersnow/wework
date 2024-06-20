<?php

namespace WeWork\Think;

use WeWork\App;
use think\Service;

class WeWorkService extends Service
{
    public function register(): void
    {
        $config = config('wework');
        $agents = $config['agents']??[];
        $defaultAgentName = $config['default']??"";
        $defaultConfig = $agents[$defaultAgentName]??[];
        unset($agents[$defaultAgentName]);
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



