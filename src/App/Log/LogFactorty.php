<?php

namespace App\Log;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LogFactorty
{
    public static function getLoger(string $canal = "App"): Logger
    {
        $log = new Logger("MiLogger");
        $log->pushHandler(new StreamHandler("logs/milog.log", Logger::DEBUG));
        return $log;
    }
}