<?php

namespace WeWork\Bridge;

use Psr\Log\AbstractLogger;

class Log extends AbstractLogger
{
    public function log($level, $message, array $context = []): void
    {
        \think\facade\Log::log($level, $message, $context);
    }
}

