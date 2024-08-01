<?php 

class LotteryBetSlipProcessor extends RebateController  {

    public static function getPendingBetSlips(string $betTable, string $drawPeriod): array {
        return Model::getPendingBetSlips($betTable, $drawPeriod);
    }

    public static function processPendingBetSlips(array $TotalBetSlips, string $drawTable, string $betTable, array $drawNumber): bool {
        
        foreach ($TotalBetSlips as $betSlip) {
            $userDetails = Model::getAgentByUserId($betSlip['uid'] ?? null);
            $betSlipDetails = self::betSlipChecker($betSlip, $drawNumber);
            if($betSlipDetails['status'] == 2) self::handleWonSlips($betSlip, $betSlipDetails, $drawTable, $betTable, $userDetails,$drawNumber);
            if($betSlipDetails['status'] == 3) self::handleLostSlips($betSlip, $betSlipDetails, $drawTable, $betTable, $userDetails,$drawNumber);
            if($betSlipDetails['status'] == 6) self::handleRefundSlips($betSlip, $betSlipDetails, $drawTable, $betTable, $userDetails,$drawNumber);
        } 
        Console::info('done!!!!!!!!');
        return true;

    }

    public static function betSlipChecker(array $betSlip, array $drawNumber): array { #THE MAIN BETSLIP CHECKER#
        $selection = unserialize($betSlip['selection_group']);
        $CLASSFILE = Utilities::findGameClass(GameClassFile::getGameClassFile(), $betSlip['game_type']);
        $CLASSMETHOD = Utilities::findGameClass($CLASSFILE::getGamePlayMethod(), $betSlip['game_id']);
        return $CLASSFILE::$CLASSMETHOD($selection, $drawNumber, $betSlip['game_id']);
    }

    public static function calculateBetOdds(array $betSlipDetails, array $betSlip): array {
        $betOdds = json_decode($betSlip['bet_odds'], true);
        $oddsData = array_intersect_key($betOdds, array_flip($betSlipDetails['gameids']));
        return $oddsData;
    }

    public static function calculatePrize(array $betSlip, array $betOddsArray) : float {
        return array_sum(array_map(function($odds) use ($betSlip) {
            return $betSlip['unit_stake'] * $betSlip['multiplier'] * $odds;
        }, $betOddsArray));
    }

    public static function getTrackRefundAmount(string $betTable, array $betSlip) {
        return array_sum(Model::getTrackRefundAmount($betTable, $betSlip));
    }

    public static function updateBetTable(string $betTable, string $status, array $betSlipDetails, string $drawNumber,array $betSlip, string $winAmount) : int {
       return Model::updateBetTable($betTable,$status, $betSlipDetails, $drawNumber, $betSlip, $winAmount);
    }

    public static function updateBetTableForTrackRules(string $betTable, array $betSlip){
        return Model::updateBetTableForTrackRule($betTable, $betSlip);
    }

    public static function shareRebateProfit(array $userDetails, string $rebateAmount, array $betSlip){
        if($betSlip['selfRebate'] == 'true') RebateController::applyRebate($userDetails['agent'],$userDetails['uid'], $rebateAmount, $betSlip, 8);
        if(!empty($userDetails['agent'])) RebateController::distributeRebate($userDetails, $betSlip);
    }

    public static function updateUserBalanceAndTransactions(array $betSlip, array $userDetails, string $newBalance, string $transactionType){
      $res = Utilities::transactionParams($betSlip, $userDetails, $newBalance, $betSlip['bet_code'], 1, $transactionType);
      return $res == 1 ? Model::updateUserBalance($userDetails['uid'], $newBalance) : 0;
    }

    public static function handleWonSlips(array $betSlip, array $betSlipDetails, string $drawTable, string $betTable, array $userDetails, array $drawNumber) : bool {
        $drawNumber = implode(",",$drawNumber);
        $betOddsArray = self::calculateBetOdds($betSlip, $betSlipDetails);
        $prizeWon = self::calculatePrize($betSlip, $betSlipDetails, $betOddsArray);
        $rebateAmount = self::calculateRebate($betSlip['totalBetAmt'], $userDetails['rebate']);
        self::shareRebateProfit($userDetails, $rebateAmount, $betSlip);
        self::updateBetTable($betTable, 2, $betSlipDetails, $drawNumber, $betSlip, $prizeWon);
        self::updateUserBalanceAndTransactions($betSlip, $userDetails, $userDetails['balance'] + $prizeWon , 3);
        if($betSlip['stop_if_won'] == 1) self::handleTrackBetSlipRule($betTable,$betSlip,$userDetails);
        return true;
    }

    public static function handleLostSlips(array $betSlip, array $betSlipDetails, string $drawTable, string $betTable, array $userDetails, array $drawNumber) : bool {
        $drawNumber = implode(",",$drawNumber);
        if($betSlip['selfRebate'] == 'true') RebateController::applyRebate($userDetails['agent'],$userDetails['uid'], 0, $betSlip, 8);
        if($userDetails['agent'] != '') RebateController::distributeRebate($userDetails, $betSlip);
        self::updateBetTable($betTable, 3, $betSlipDetails, $drawNumber, $betSlip, 0);
        if($betSlip['stop_if_lost'] == 1) self::handleTrackBetSlipRule($betTable,$betSlip,$userDetails);
        return true;
    }

    public static function handleRefundSlips(array $betSlip, array $betSlipDetails, string $drawTable, string $betTable, array $userDetails, array $drawNumber) : bool {
        $drawNumber = implode(",",$drawNumber);
        if($betSlip['selfRebate'] == 'true') RebateController::applyRebate($userDetails['agent'],$userDetails['uid'], 0, $betSlip,8);
        if($userDetails['agent'] != '') RebateController::distributeRebate($userDetails, $betSlip);
        self::updateBetTable($betTable, 6, $betSlipDetails, $drawNumber, $betSlip, 0);
        self::updateUserBalanceAndTransactions($betSlip, $userDetails, $userDetails['balance'] + $betSlip['bet_amount'], 6);
        if($betSlip['stop_if_won'] == 1) self::handleTrackBetSlipRule($betTable,$betSlip,$userDetails);
        if($betSlip['stop_if_lost'] == 1) self::handleTrackBetSlipRule($betTable,$betSlip,$userDetails);
        return true;
    }

    public static function handleTrackBetSlipRule(string $betTable, array $betSlip, array $userDetails) : bool{
        $res = self::updateBetTableForTrackRules($betTable,$betSlip);
        $refundAmt = ($res == 1) ? self::getTrackRefundAmount($betTable,$betSlip) : 0;
        $newbalance = $userDetails['balance'] + $refundAmt;
        return Model::updateUserBalance($userDetails['uid'], $newbalance) == 1 ? true : false;
    }

    // ...

}
