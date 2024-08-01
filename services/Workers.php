<?php
class Workers {
    public static function getWorkers(): array
    { // Gearman workers
        return [
            ['worker1x0', function ($workload) {GearmanWorker::JobExecutionProcess($workload);}],
            ['worker1x5', function ($workload) {GearmanWorker::JobExecutionProcess($workload);}],
            ['worker3x0', function ($workload) {GearmanWorker::JobExecutionProcess($workload);}],
            ['worker5x0', function ($workload) {GearmanWorker::JobExecutionProcess($workload);}]
        ];
    }
}
