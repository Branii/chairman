public static function insert($gameIds, string $drawPeriod, string $drawCount, string $drawTime) { //test 1

$accumulator = [];
foreach($gameIds as $gameId){

    $ExistingVals = self::checkIfDrawPeriodExistInDrawStorage($gameId,$drawPeriod);

    if(!empty($ExistingVals)){
        $params = [
            'columns' => Utilities::prepareBetQuery('drawTable'),
            'values'  => Utilities::drawTableParamsExist($gameId, $drawCount, $ExistingVals),
        ];
       
        $insertD = self::insertIntoDrawTables($gameId, $params);
        if($insertD == 1){
            $Next = TimerManagerM::getNextPeriodAndNextTime($drawTime, $gameId);
            $paramsx = [
                'columns' => Utilities::prepareBetQuery('drawStorage'),
                'values'  => Utilities::drawStorageParams($gameId, $Next['nexPeriod'], $drawCount, $Next['nexTime'])
            ];
            $success = self::insertIntoDrawStorage($gameId, $drawTime, $paramsx); // next draw period
            $accumulator[] = $success;
        }
    }else{
       // $paramsi = [
        //     'columns' => Utilities::prepareBetQuery('drawStorage'),
        //     'values'  => Utilities::drawStorageParams($gameId, $drawPeriod, $drawCount, $drawTime)
        // ];
        // $res = self::insertIntoDrawStorage($gameId, $drawTime, $paramsi); // curr draw period
        // if($res == 1){
            $paramsk = [
                'columns' => Utilities::prepareBetQuery('drawTable'),
                'values'  => Utilities::drawTableParamsNew($gameId, $drawPeriod, $drawCount, $drawTime)
            ];
            $insertD = self::insertIntoDrawTables($gameId, $paramsk); //curr draw period
            if($insertD == 1){
                $Next = TimerManagerM::getNextPeriodAndNextTime($drawTime, $gameId);
                $paramsl = [
                    'columns' => Utilities::prepareBetQuery('drawStorage'),
                    'values'  => Utilities::drawStorageParams($gameId, $Next['nexPeriod'], $drawCount, $Next['nexTime'])
                ];
                $success = self::insertIntoDrawStorage($gameId,$drawPeriod, $paramsl); // next draw period
                $accumulator[] = $success;
            }
       // }
    }

    //leep(1);
}
return count($accumulator) == count($gameIds) ? 'done' : 'failed';
}

// public static function insert(array $gameIds, string $drawPeriod, string $drawCount, string $drawTime) { //test 2
//     $ExistWithData = self::checkIfDrawPeriodExistInDrawStorage($gameIds[0], $drawPeriod);//this has something

//     // var_dump($drawPeriod,$ExistWithData);exit;
//     // $acc = [];
//     if(!empty($ExistWithData)){
    
//         foreach($gameIds as $gameId){
//             $ExistedData = self::checkIfDrawPeriodExistInDrawStorage($gameId, $drawPeriod);
//             $params = [
//                 'columns' => Utilities::prepareBetQuery('drawTable'),
//                 'values'  => Utilities::drawTableParamsExist($gameId, $drawCount, $ExistedData),
//             ];
//            return $res = self::insertIntoDrawTables($gameId,$params);
//             if($res){
//                 $Next = TimerManagerM::getNextPeriodAndNextTime($drawTime, $gameId);
//                 $params = [
//                     'columns' => Utilities::prepareDrawTableQuery('drawStorage'),
//                     'values'  => Utilities::drawStorageParams($gameId, $Next['nexPeriod'], $drawCount, $Next['nexTime'])
//                 ];
//                 $insertD = self::insertIntoDrawStorage($gameId,$drawPeriod, $params);
//                 $acc[] = $insertD;
//             }
//         }
//         return count($acc) == count($gameIds) ? 'done111' : 'failed';

//     }else{

//         foreach($gameIds as $gameId){
//                 $params = [
//                     'columns' => Utilities::prepareBetQuery('drawTable'),
//                     'values'  => Utilities::drawTableParamsNew($gameId, $drawPeriod, $drawCount, $drawTime)
//                 ];
//                 $res =  self::insertIntoDrawTables($gameId,$params); //correct
//                 if($res == 1){
//                     $Next = TimerManagerM::getNextPeriodAndNextTime($drawTime, $gameId);
//                     $params = [
//                         'columns' => Utilities::prepareBetQuery('drawStorage'),
//                         'values'  => Utilities::drawStorageParams($gameId, $Next['nexPeriod'], $drawCount, $Next['nexTime'])
//                     ];
//                     $insertD = self::insertIntoDrawStorage($gameId,$drawPeriod, $params);
//                     $acc[] = $insertD;
//                 }
    
//         }
//         return count($acc) == count($gameIds) ? 'done222' : 'failed';
//     }
// }
