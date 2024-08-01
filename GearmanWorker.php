<?php
require_once 'vendor/autoload.php';
require_once 'autoload.php';

use \Kicken\Gearman\Worker;
use \Kicken\Gearman\Job\WorkerJob;

class GearmanWorker
{
    private $worker;

    public function __construct($serverAddress)
    { // serverAddress is the address of the gearman server
        $this->worker = new Worker($serverAddress);
    }

    public static function createWorker($server, $workerName, $executeJob)
    { // Create a worker for a job
        $worker = new Worker($server);
        $worker->registerFunction($workerName, function ($job) use ($executeJob) {
            $workload = $job->getWorkload();
            return $executeJob($workload);
        });
        return $worker;
    }

    public static function JobExecutionProcess($workload)
    { // Job execution process
        if ($workload) {

            extract(json_decode($workload, true));
            Console::log($draw_period);
            $TotalPendingBetSlips = LotteryBetSlipProcessor::getPendingBetSlips($bettable, $draw_period);
            LotteryBetSlipProcessor::processPendingBetSlips($TotalPendingBetSlips, $drawtable,  $bettable, explode(',', $drawNumber)) == true ? Console::log('success') : Console::error('failed');
        }
    }

    public function startWorker($server, $workerName, $executeJob)
    { // Start a worker for a job on a separate process
        $pid = pcntl_fork();
        if ($pid == -1) {
            exit("Failed to fork process.");
        } elseif ($pid) {
            return;
        } else {
            $worker = self::createWorker($server, $workerName, $executeJob);
            $worker->work();
            exit(); // Exit after work done
        }
    }
}

// Start a worker for each job in a separate process
foreach (Workers::getWorkers() as [$workerName, $executeJob]) {
    (new GearmanWorker('127.0.0.1:4730'))->startWorker('127.0.0.1:4730', $workerName, $executeJob);
}
echo "Workers ready .." . PHP_EOL;
while (pcntl_waitpid(0, $status) != -1);
