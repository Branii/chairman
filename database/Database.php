<?php 

class Database extends Config { // singleton 

    private static $connection;
    private static $instance;

    private function __construct() {
        self::$connection = new PDO(
            parent::getConfig()['->'],
            parent::getConfig()['-->'],
            parent::getConfig()['--->']
        );
    }

    public static function getInstance() { 
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function openLink() {
        self::getInstance();
        return self::$connection;
    }

    public static function closeLink() {
        self::$connection = null;
        self::$instance = null;
    }

    // Prevent cloning
    private function __clone() {}

    // Prevent unserializing
    public function __wakeup() {}

}

?>

