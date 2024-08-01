<?php 

class GameDrawInserter {

    public static function insert($gameIds, string $drawPeriod, string $drawCount, string $drawTime) { 
        $accumulator = [];
        foreach($gameIds as $gameId){
            $ExistingVals = self::checkIfDrawPeriodExistInDrawStorage($gameId, $drawPeriod);
            $isValidData = !empty($ExistingVals);
            
            $params = [
                'columns' => TableColumn::getColumns('drawTable'),
                'values'  => $isValidData ? Utilities::drawTableParamsExist($gameId, $drawCount, $ExistingVals) :
                Utilities::drawTableParamsNew($gameId, $drawPeriod, $drawCount, $drawTime),
            ];

            if(self::insertIntoDrawTables($gameId, $params) == 1)
            $Next = TimerManagerM::getNextPeriodAndNextTime($drawTime, $gameId);
            $paramsx = [
                'columns' => TableColumn::getColumns('drawStorage'),
                'values'  => Utilities::drawStorageParams($gameId, $Next['nexPeriod'], $drawCount, $Next['nexTime']),
            ];
            $success = self::insertIntoDrawStorage($gameId, $Next['nexPeriod'], $paramsx);
            $accumulator[] = $success;
        }
        
        return count($accumulator) == count($gameIds) ? 'done' : 'failed';
    }

    public static function checkIfDrawPeriodExistInDrawStorage(string $gameId, string $drawPeriod){
        return Model::checkCurrentDrawPeriodStorage($gameId,$drawPeriod) ?? [];
    }

    public static function checkIfDrawPeriodExistInDrawTable(string $gameId, string $drawPeriod) : bool {
        return Model::checkCurrentDrawPeriodTable($gameId,$drawPeriod) == 1;
    }

    public static function insertIntoDrawStorage(string $gameId, string $drawPeriod, array $params) : bool {
        return Model::insertDrawNumberStorage($gameId,$params) == 1;
    }

    public static function insertIntoDrawTables(string $gameId, array $params) {
        return Model::insertDrawNumberTables($gameId,$params);
    } 

}