<?php 

class Console {

    public static function log($message) : void {
       file_put_contents(__DIR__ . '/log.txt', $message. PHP_EOL, FILE_APPEND);
    }

    public static function info(string $th) : void {
        self::log('[INFO] '. $th);
    }

    public static function error(string $th) : void {
        self::log('[ERROR] '. $th);
    }

    public static function warn(string $th) : void {
        self::log('[WARNING] '. $th);
    }

    public static function debug(string $th) : void {
        self::log('[DEBUG] '. $th);
    }

    public static function dd(...$vars) { // dump and die
        foreach ($vars as $var) {
            var_dump($var);
        }
        die(1);
    }
}
// simple logger