<?php 

use \Kicken\Gearman\Client;
class Gearman {

    private static $client;
    private static $job;

    public function __construct() {
        self::$client = new Client('127.0.0.1:4730');
    }

    public static function submitJobToWorker(String $workerName, String $workload) {
        self::$job = self::$client->submitBackgroundJob($workerName, $workload);
        echo "Job submitted!";
        return self::$job;
    }

    public static function getResult($jobHandle) {
        $status = self::$client->getJobStatus($jobHandle);
        self::$client->wait();
        return $status->isRunning();
    }

}