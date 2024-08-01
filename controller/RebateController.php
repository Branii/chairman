<?php 

class RebateController {

    public static function applyRebate(string $agentId, string $userId, string $rebateAmount, array $betItem, string $transactionType) {
        $agentDetails = Model::getUserInformations($agentId);
        $company = $agentDetails['company'];
        $newBalance = $agentDetails['balance'] + $rebateAmount;
        $res = Model::updateUserBalance($agentId, $newBalance);
        $res == 1 ? Utilities::executeParams(Utilities::insertRebateParams($agentId,$userId,$rebateAmount,$betItem),'user_rebate') : 'null';
        $trx = Utilities::executeParams(Utilities::transactionParams($betItem, $agentDetails, $newBalance, $betItem['bet_code'], 1, $transactionType),'transaction');
        return $trx == 1 ?? false;
    }

    public static function applyMultiLevelRebate(array $userDetails, array $betSlip) {
        $rebateLevelArray = $userDetails['agent_level'] == 0 ? [] : json_decode($userDetails['agent_level'], true);
        $rebateLevel = $rebateLevelArray[$userDetails['agent']] ?? 15;
        $rebateProfit = self::getSuperiorRebate($rebateLevel, $userDetails['rebate'], $betSlip['totalBetAmt']);
        if (count($rebateLevelArray) == 1) return [$userDetails['agent'] => $rebateProfit];
        $rebateLevelArray[$userDetails['uid']] = $userDetails['rebate'];
        return self::calculateDifferencesWithRebate($rebateLevelArray, $rebateProfit);
    }

    public static function distributeRebate(array $userDetails, array $betSlip) {
        $profitlist = self::applyMultiLevelRebate($userDetails['uid'], $userDetails['agent'], $betSlip['totalBetAmt']);
        foreach ($profitlist as $key => $rebateAmount) {
            self::applyRebate($userDetails['agent'],$userDetails['uid'], $rebateAmount, $betSlip, 7);
        }
    }

    public static function getSuperiorRebate(string $agentRebate, string $userRebate, string $betAmount) {
        return (($agentRebate - $userRebate) / 100 )  * $betAmount;
    }

    public static function calculateRebate($originalAmount, $rebatePercentage) {
        $rebateAmount = $originalAmount * ($rebatePercentage / 100);
        return $rebateAmount;
    }

    public static function calculateDifferencesWithRebate($array, $totalRebate)
    {
        $result = [];
        $keys = array_keys($array);
        for ($i = 0; $i < count($keys) - 1; $i++) {
            $currentKey = $keys[$i];
            $nextKey = $keys[$i + 1];
            $difference = $array[$currentKey] - $array[$nextKey];
            $result[$currentKey] = $difference * $totalRebate;
        }
        return $result;
    }
    
}