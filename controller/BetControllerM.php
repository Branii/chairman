<?php

class BetControllerM extends BetStakeController
{
    public static function getNewBalance(array $betData, string $userId): float
    {
        return (float) self::getUserInformation($userId)['balance'] - array_sum(array_column($betData, 'totalBetAmt'));
    }

    public static function updateUserBalance(array $betData, string $userId, array $userInformation, string $gameModel)
    {
        $newBal = self::getNewBalance($betData, $userId);
        $res = Model::updateUserBalance($userId, $newBal);
         return ($res == 1) ? ['result' => self::processBetData($betData, $userInformation, $gameModel), 'balance' => $newBal] : ['type' => 'error', 'message' => 'Could not balance'];
    }

    public static function revertBalance(array $betData, string $userId)
    {
        return (float) self::getUserInformation($userId)['balance'] + array_sum(array_column($betData, 'totalBetAmt'));
    }

    public static function validateBetPeriod(string $lotteryId)
    {
        return Model::getCurrentGameTimeInterval($lotteryId);
    }

    public static function validateFields(array $betData)
    {
        $missingFields = [];
        foreach ($betData as $record) {
            foreach (TableColumn::getColumns('fields') as $field) {
                if (!array_key_exists($field, $record)) {
                    $missingFields[] = $field;
                }
            }
        }
        return empty($missingFields);
    }

    public static function isUserLoggedIn(string $userId)
    {
        return isset($userId);
    }

    public static function getUserInformation(string $userId)
    {
        return Model::getUserInformations($userId);
    }

    public static function processBetData(array $betData, array $userInformation, string $gameModel)
    {
        $gameOdds = '';
        $newBalance = $userInformation['balance'] - array_sum(array_column($betData, 'totalBetAmt'));
        $betTable = GameTableMap::getTables()[$betData[0]['lottery_id']]["bet_table"];
        $arr = [];
        $transx = [];
        $betCode = strtoupper(bin2hex(random_bytes(6))) . date('Ymd');
        foreach ($betData as $betItem) {

            if ($betItem['isSpecial'] == 'true') {
                $gameOdds = parent::is_special_game($betItem['specialIds'], $betItem, $userInformation, $gameModel);
            } else {
                $gameOdds = parent::not_special_game($betItem, $userInformation, $gameModel);
            }

            $arr[] = "(" . implode(',', array_map(fn($param) => "'" . $param . "'", Utilities::gamesParams($betItem, $userInformation, $gameOdds, $newBalance, $gameModel,$betCode))) . ")";
            $transx[] = "(" . implode(',', array_map(fn($param) => "'" . $param . "'", Utilities::transactionParams($betItem, $userInformation, $newBalance,$betCode,2,5))) . ")";
        }
        
        return Utilities::executeParams($arr, $betTable) >= 1 ? Utilities::executeParams($transx, 'transaction') : null;
    }

    public static function userHasPendingBet(string $userId, string $lotteryId){
        $drawPeriod = TimerManagerM::getDrawPeriod(date("H:i:s"), $lotteryId);
        $isWonBets = count(Model::getUserPendingBetSlips($userId, $lotteryId, $drawPeriod)) > 0 ? true : false;
        return [
            'has_pending_bet' =>  false,
            'draw_period' => $isWonBets ? $drawPeriod : $drawPeriod ,
            'won_status' => $isWonBets ? true : false,
        ];

    }

}