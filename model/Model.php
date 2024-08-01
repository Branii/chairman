<?php

class Model extends Helper
{

    public static function getUserInformations(string $userId): array {
        $sql = "SELECT uid,rebate,balance,company FROM users WHERE uid = ?";
        return self::selectOne($sql, [$userId]);
    }

    public static function getCurrentGameTimeInterval(string $lotteryId): array {
        $sql = "SELECT seconds_per_issue FROM  game_type WHERE gt_id = ? ";
        return self::selectOne($sql, [$lotteryId]);
    }

    public static function getSpecialOdds(string $specialId): array {
        $sql = "SELECT odds_group_id, odds, rebate FROM odds_group WHERE odds_group_id = ?";
        return self::selectAll($sql, [$specialId]);
    }

    public static function getDefualtGameData(string $gameId, string $gameTable) : array  {
        $sql = "SELECT * FROM $gameTable WHERE  gn_id = ?";
        return self::selectAll($sql, [$gameId]);
    }

    public static function getDefualtGameGroup(string $gameId, string $gameTable) : array {
        $gameData = self::getDefualtGameData($gameId, $gameTable);
        $sql = "SELECT * FROM game_group WHERE  gp_id = ? ";
        return self::selectAll($sql, [$gameData[0]['game_group']]);
    }

    public static function getBetTable(string $lotteryId) : array {
        $sql = "SELECT bet_table FROM gamestable_map WHERE  game_type = ?";
        return self::selectOne($sql, [$lotteryId]);
    }

    public static function updateUserBalance(string $userId, string $balance) : int {
        $sql = "UPDATE users SET balance = ? WHERE uid = ?";
        return self::update($sql, [$balance, $userId]);
    }

    public static function getCurrentDrawNumber(string $gameId, string $drawPeriod) : array {
        $drawTable = TimeSet::getGameTableMap()[$gameId]['draw_table'];
        $sql = "SELECT draw_number,period FROM $drawTable WHERE period = ?";
        return self::selectOne($sql, [$drawPeriod]);
    }

    public static function checkCurrentDrawPeriodStorage($gameId,$drawPeriod) {
        $drawStorage = TimeSet::getGameTableMap()[$gameId]['draw_storage'];
        $sql = "SELECT * FROM $drawStorage WHERE draw_date = ?";
        return self::selectOne($sql, [$drawPeriod]) ?? [];
    }

    public static function checkCurrentDrawPeriodTable($gameId,$drawPeriod) : array {
        $drawTable = TimeSet::getGameTableMap()[$gameId]['draw_table'];
        $sql = "SELECT * FROM $drawTable WHERE period = ?";
        return self::selectAll($sql, [$drawPeriod]) ?? [];
    }

    public static function insertDrawNumberStorage(string $gameId, array $params) : int {
        $drawStorage = TimeSet::getGameTableMap()[$gameId]['draw_storage'];
        $sql = "INSERT INTO $drawStorage ( ". implode(',', $params['columns']) . ") VALUES 
        (". implode(',', array_fill(0, count($params['columns']), '?')).")";
        return self::insert($sql, array_values($params['values']));
    }

    public static function insertDrawNumberTables(string $gameId, array $params) : int {
        $drawTable = TimeSet::getGameTableMap()[$gameId]['draw_table'];
        $sql = "INSERT INTO $drawTable(". implode(',', $params['columns']). ") VALUES 
        (". implode(',', array_fill(0, count($params['columns']), '?')).")";
        return self::insert($sql, array_values($params['values']));
    }

    public static function getCurrentDrawFromDrawInfo(string $gameId, string $drawPeriod) : array {
        $drawTable = TimeSet::getGameTableMap()[$gameId]['draw_table'];
        $sql = "SELECT * FROM $drawTable WHERE period = ?";
        return self::selectOne($sql, [$drawPeriod]);
    }

    public static function getGamesLastDrawInfos(string $gameId) : array {
        $drawTable = TimeSet::getGameTableMap()[$gameId]['draw_table'];
        $sql = "SELECT * FROM $drawTable ORDER BY draw_id DESC LIMIT 1";
        return self::selectOne($sql);
    }

    public static function getGameGroupNumber_X(string $gameId, string $tableName)  {
        $sql = "SELECT $tableName.game_group FROM $tableName INNER JOIN game_group ON 
        $tableName.gn_id = game_group.gp_id WHERE game_group.gp_id = ?";
        return self::selectOne($sql,[$gameId]);//['game_group'];
    }

    public static function getGameGroupNumber(string $gameId, string $tableName) {
        $sql = "SELECT game_group FROM $tableName WHERE gn_id = ?";
        return self::selectOne($sql,[$gameId]);//['game_group'];
    }

    public static function getPendingBetSlips(string $gameTable, string $drawPeriod) : array{
        $sql = "SELECT * FROM $gameTable WHERE draw_period = ? AND bet_status = ? ";
        return self::selectAll($sql,[$drawPeriod,5]);
    }
    
    public static function executeParams(array $value, array $column, string $tableName) : string {
        $tablename = trim($tableName);
        $sql = "INSERT INTO `$tablename` (" . implode(',', $column) . ") VALUES " . implode(',', $value);
        return self::insert($sql);
    }

    public static function getAgentByUserId(string $userId) : array {
        $sql = "SELECT * FROM users WHERE uid = ?";
        return self::selectOne($sql, [$userId]);
    }

    public static function getUserPendingBetSlips(string $userId, string $gameId, string $drawPeriod) : array {
        $betTable = TimeSet::getGameTableMap()[$gameId]['bet_table'];
        $sql = "SELECT * FROM $betTable WHERE uid = ? AND state = 1 AND bet_status = 2 AND draw_period = ?";
        return self::selectAll($sql, [$userId, $drawPeriod]);
    }

    public static function updateBetTable(string $betTable, string $status, array $betSlipDetails, string $drawNumber, array $betSlip, string $winAmount){
        $sql = "UPDATE $betTable SET bet_status = ?, num_wins = ?, state = ?, draw_number = ?, draw_time = ?, new_period = ?, win_amount =? WHERE bid = ?";
        return self::update($sql, [$status,$betSlipDetails['numwins'],1,$drawNumber,$betSlip['new_period'],$betSlip['betId'],$winAmount,$betSlip['bid']]);
    }

    public static function updateBetTableForTrackRule(string $betTable, array $betSlip){
        $sql = "UPDATE $betTable SET state = ?, bet_status = ? WHERE state = ? AND token = ? AND bettype = ?";
        $res =  self::update($sql, [4,6,2,$betSlip['token'],2]);
        return $res == 1 ? self::updateTrackTable($betSlip) : 0;
    }

    public static function updateTrackTable(array $betSlip){ // helper ^ ^
        $sql = "UPDATE track SET status = ? WHERE token = ?";
        return self::update($sql, [4,$betSlip['token']]);
    }

    public static function getTrackRefundAmount(string $betTable, array $betSlip){
        $sql = "SELECT bet_amount FROM $betTable WHERE state = ? AND token = ? AND bettype = ?";
        return self::selectAll($sql,[2,$betSlip['token'],2]);
    }
}