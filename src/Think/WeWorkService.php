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
        foreach ($agents as $agentName => $agentConfig) {
            $this->app->bind('wework'.ucfirst($agentName),new App($config + $agentConfig));
        }

    }

    public function boot()
    {
        // 服务启动
    }

}



