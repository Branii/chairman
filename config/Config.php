<?php 

class Config {

    private static $config;

    public static function getConfig() {
        return self::$config ?: self::$config = [
            '->' => 'mysql:host=' . getenv('HOST') .';dbname=' . getenv('BASE'),
            '-->' => getenv('USER'),
            '--->' => getenv('PASS'),
        ];
    }
 
}