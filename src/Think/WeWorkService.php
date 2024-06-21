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
        unset($config['agents']);
        foreach ($agents as $agentName => $agentConfig) {
            if($agentName == $config['default']){
                $this->app->bind('wework',new App($config + $agentConfig));
            }
            $this->app->bind('wework_'.$agentName,new App($config + $agentConfig));
        }
    }

    public function boot()
    {
        // 服务启动
    }

}



