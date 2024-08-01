<?php 
ini_set('display_errors',1);
class GameChecker {
    public static function check(array $gameIds, string $workerName, string $drawPeriod) : bool {
        try {
            $jobHandle = [];
            foreach ($gameIds as $gameId) { // find game draw data

                $DrawInfo = self::getCurrentDraws($gameId, $drawPeriod);
                $workload = [
                    'drawNumber' => $DrawInfo['draw_number'],
                    'draw_period' => $DrawInfo['period'],
                    'gameId' => $gameId,
                    'drawtable' => GameTableMap::getTables()[$gameId]['draw_table'],
                    'bettable' =>  GameTableMap::getTables()[$gameId]['bet_table']
                ];

                $jobHandle[] = (new Gearman())::submitJobToWorker($workerName, json_encode($workload));                
            }

            return count($jobHandle) == count($gameIds) ? true : false;
           
        } catch (throwable $th) {
            echo $th->getMessage();
        }
    }

    public static function getCurrentDraws(int $gameId, string $drawPeriod): array { // fetch current draws
        return Model::getCurrentDrawFromDrawInfo($gameId, $drawPeriod);
    }

}
