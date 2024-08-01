<?php

class Redis { 

    private static $client;

    public function __construct() {
        try {
            self::$client = new Predis\Client([
                'scheme' => 'tcp',
                'host'   => '127.0.0.1',
                'port'   => 6379,
            ]);
            return self::$client;
        } catch (\Throwable $e) {
            Console::error("Redis connection failed: ". $e->getMessage());
            echo $e->getMessage();
            
        }
    }

    public static function set($key, $value) {
        self::RedisClient()->set($key, $value);
    }

    public static function get($key) {
        return self::RedisClient()->get($key);
    }

    public static function keyExist($key) {
        return self::RedisClient()->exists($key);
    }

    public static function del($key) {
        self::RedisClient()->del($key);
    }

    // you can add more redis methods

}


?>
