<?php
ini_set('display_errors',1);
require_once 'vendor/autoload.php';
require_once 'autoload.php';

use React\EventLoop\Factory;
$loop = Factory::create();

$Time =  TimeSet::getAllGameTimes();
$Game =  TimeSet::getAllGameIds();

$loop->addPeriodicTimer(1,function() use ($Time, $Game) {

    $currentTime = date('H:i:s');

    if(isset($Time['time1x0'][$currentTime])){ 
        $drawPeriod = date("Ymd") . $Time['time1x0'][$currentTime];
        $drawCount  = $Time['time1x0'][$currentTime];
        echo GameDrawInserter::insert([1], $drawPeriod, $drawCount, $currentTime);
        GameChecker::check([1], 'worker1x0', $drawPeriod);
    }

    // if(isset($Time['time1x0'][$currentTime])){ 
    //     $drawPeriod = date("Ymd") . $Time['time1x0'][$currentTime];
    //     echo GameDrawInserter::insert($Game['ids1x0'], $drawPeriod, $currentTime);
    //     GameChecker::check($Game['ids1x0'], 'worker1x0', $drawPeriod);
    // }

    // if(isset($Time['time1x5'][$currentTime])){ 
    //     $drawPeriod = date("Ymd") . $Time['time1x5'][$currentTime];
    //     GameDrawInserter::insert($Game['ids1x5'], $drawPeriod, $currentTime);
    //     GameChecker::check($Game['ids1x5'], 'worker1x5', $drawPeriod);
    // }

    // if(isset($Time['time3x0'][$currentTime])){ 
    //     $drawPeriod = date("Ymd") . $Time['time3x0'][$currentTime];
    //     GameDrawInserter::insert($Game['ids3x0'], $drawPeriod, $currentTime);
    //     GameChecker::check($Game['ids3x0'], 'worker3x0', $drawPeriod);
    // }

    // if(isset($Time['time5x0'][$currentTime])){ 
    //     $drawPeriod = date("Ymd") . $Time['time5x0'][$currentTime];
    //     GameDrawInserter::insert($Game['ids5x0'], $drawPeriod, $currentTime);
    //     GameChecker::check($Game['ids5x0'], 'worker5x0', $drawPeriod);
    // }

     echo Date("H:i:s") . PHP_EOL;

});
 
echo "Game started";
$loop->run();