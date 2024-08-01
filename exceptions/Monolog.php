<?php 

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Monolog {
    public static function log(Throwable $th) : void {
        $log = new Logger('Checkers');
        $log->pushHandler(new StreamHandler('./log.log', Logger::WARNING));
        $log->warning($th->getMessage());
    }

    public static function dd(...$vars) {
        foreach ($vars as $var) {
            var_dump($var);
        }
        die(1);
    }
}
// simple logger