<?php 

class DButils {
    private static $con;
    public static function openLink() : PDO {
       return self::$con = new PDO('mysql:host=127.0.0.1;dbname=lottery;charset=utf8','root','root');
    }
    
    public static function closeLink(){
        self::$con = null;
    }
}