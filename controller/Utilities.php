<?php

final class Utilities
{

    public static function bookBetSlip()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $token = self::tokenValidator();
            $userId = is_string($token) ? $token : $token->uid;
            App::_($userId, json_decode(file_get_contents('php://input'), true));

        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $token = self::tokenValidator();
            $userId = is_string($token) ? $token : $token->uid;
            App::_(null, []);

        }
    }

    public static function tokenValidator(): stdClass|string
    {
        $header = apache_request_headers();
        if (!empty($header['Authorization'])) {
            $token = trim(str_replace('Bearer', '', $header['Authorization']));
            //$key = TokenGenerator::GetPrivateKey();
            $result = TokenGenerator::TokenDecoder($token, 'iamtherealdude');
            if ($result && !TokenGenerator::isTokenexpired($result)) {
                return $result;
            } else {
                return json_encode(array('message' => 'Invalid token or token Expired', 'type' => 'error'));
            }
            return $result;
        } else {
            return json_encode(array('message' => 'Token required', 'type' => 'error'));
        }
    }

    public static function isValidApiKey(string $apiKey): bool
    {
        $validApiKeys = ['->d1027fe51dd715eb9f716d560a7b8841<-', '->1a3cd796483b29e40451d26f19ed3412<-']; // keys
        return in_array($apiKey, $validApiKeys);
    }

    public static function isBrowserAndFromDomain(string $userAgent, string $referer): bool
    {
        $knownBrowsers = ['Mozilla', 'Opera', 'Edge', 'Chrome', 'Safari', 'Firefox', 'Trident', 'MSIE'];
        $regex = '/(' . implode('|', $knownBrowsers) . ')/i';
        $isBrowser = preg_match($regex, $userAgent);
        $allowedReferer = 'https://enzerweb-final.vercel.app/'; //accept requests only from our platform
        $isAllowedReferer = !empty($referer) && strpos($referer, $allowedReferer) !== false;
        return $isBrowser && $isAllowedReferer;
    }

    public static function gamesParams(array $betItem, array $userInformation, string $newOdds, string $newBalance, string $gameModel, $betCode): array
    {
   
        return [
            (string) $betItem['lottery_id'],
            (string) self::getGameGroupById($betItem, $gameModel),
            (string) $betItem['gameId'],
            (string) $betItem['game_label'],
            (string) $gameModel,
            (string) $betItem['gameId'],
            (string) $betItem['userSelections'],
            (string) serialize($betItem['allSelections']),
            (string) $userInformation['uid'],
            (string) $userInformation['balance'],
            (string) $newBalance,
            (string) $betItem['totalBetAmt'],
            (string) 0,
            (string) $newOdds,
            (string) $betItem['unitStaked'],
            (string) $betItem['totalBets'],
            (string) 5,
            (string) $betCode,
            (string) $betItem['bet_date'],
            (string) $betItem['bet_time'],
            (string) $betItem['betId'],
            (string) 2,
            (string) 1,
            (string) $betItem['multiplier'],
            (string) 0,
            (string) $userInformation['rebate'],
            (string) (isset($betItem['selfRebate'])) ? $betItem['selfRebate'] : 'false',
            (string) $betItem['betId'],
            (string) $_SERVER['REMOTE_ADDR']
        ];
    }

    public static function transactionParams(array $betItem, array $userInformation, string $newBalance, string $betCode, string $tranxType, string $orderType): array
    {
        return [
            (string) $userInformation['uid'],
            (string) $userInformation['company'],
            (string) $betItem['totalBetAmt'],
            (string) $tranxType,
            (string) 'Bet deduct',
            (string) date('Y-m-d'),
            (string) date('Y-m-d H:i:s'),
            (string) $_SERVER['REMOTE_ADDR'],
            (string) 1,
            (string) $newBalance,
            (string) $userInformation['balance'],
            (string) $betItem['lottery_id'],
            (string) $orderType,
            (string) 'Bet deduct',
            (string) $betCode
        ];
    }

    
    public static function rebateTransactionParams(array $agentDetails, string $rebateAmount, string $newBalance, string $orderType, array $betData): array
    {
    
        return [
            (string) $agentDetails['uid'],
            (string) $agentDetails['company'],
            (string) $rebateAmount,
            (string) 1,
            (string) 'description',
            (string) 1,
            (string) $newBalance,
            (string) $agentDetails['balance'],
            (string) $orderType,
            (string) $betData['bet_id'],
            (string) $betData['lotter_id']
        ];
    }

    public static function drawTableParamsNew(string $gameId, string $drawPeriod, string $drawCount, string $drawTime): array
    {
        $drawNumber = DrawNumberGenerator::generate($gameId);
        $dateCreated = date("Y-m-d");
        $drawTimes = $dateCreated . " " . $drawTime;
        return [
            (string) json_encode(explode(',', $drawNumber)),
            (string) $dateCreated,
            (string) date('jS F, Y', strtotime(DATE($drawTimes))),
            (string) date("Y-m-d") .' ' . $drawTime,
            (string) 'waiting',
            (string) $drawPeriod,
            (string) $gameId,
            (string) date("Y-m-d") .' ' . $drawTime,
            (string) (new DateTime($drawTimes))->sub(new DateInterval('PT1M'))->format('H:i') . ":58",
            (string) $drawCount
        ];
    }

    public static function drawTableParamsExist(string $gameId, string $drawCount, $params): array
    {
        $dateCreated = date("Y-m-d");
        return [
            (string) json_encode(explode(',',  $params['draw_number'])),
            (string) $dateCreated,
            (string) date('jS F, Y', strtotime(DATE($params['draw_time']))),
            (string) $params['draw_time'],
            (string) 'waiting',
            (string) $params['draw_date'],
            (string) $gameId,
            (string) $params['draw_time'],
            (string) (new DateTime($params['draw_time']))->sub(new DateInterval('PT1M'))->format('H:i') . ":58",
            (string) $drawCount
        ];
    }

    public static function drawStorageParams(string $gameId, string $drawPeriod, string $drawCount, string $drawTime): array
    {
        $drawNumber = DrawNumberGenerator::generate($gameId);
        $drawTimes = date("Y-m-d") . " " . $drawTime;
        return [
            (string) $drawCount,
            (string) $drawPeriod,
            (string) $drawNumber,
            (string) $drawTimes,
            (string) $drawTimes
        ];
    }

    public static function insertRebateParams(string $agentId, string $userId, $rebateAmount, array $betData): array
    {
        return [
            (string) $agentId,
            (string) $userId,
            (string) $rebateAmount,
            (string) $betData['bet_code'],
            (string) $betData['lottery_id'],
            (string) date('Y-m-d'),
            (string) date('H:i:s')
        ];
    }

    public static function executeParams(array $arrayValues, string $tableName)
    {
        return Model::executeParams($arrayValues, TableColumn::getColumns($tableName), $tableName);
    }


    public static function truncate($number)
    { // new and simple
        $numberString = number_format($number, 4, '.', '');
        return $numberString;
    }

    public static function truncateToFourDecimals($number)
    {
        $numberStr = (string) $number;
        $dotPos = strpos($numberStr, '.');
        if ($dotPos === false) {
            return $numberStr;
        }
        return substr($numberStr, 0, $dotPos + 5);
    }

    public static function truncateNumber($number, $decimals = 4)
    {
        $numberStr = (string) $number;
        if ($number == 0) {
            return '0.' . str_repeat('0', $decimals);
        }
        $dotPos = strpos($numberStr, '.');
        if ($dotPos === false) {
            return $numberStr . '.' . str_repeat('0', $decimals);
        }
        if (strlen($numberStr) - $dotPos - 1 < $decimals) {
            return $numberStr . str_repeat('0', $decimals - (strlen($numberStr) - $dotPos - 1));
        }
        $substrLength = $dotPos + 1 + $decimals;
        return substr($numberStr, 0, $substrLength);
    }

    public static function getGameGroupById(array $betItem, $model) {
        return [
            '1' => Model::getGameGroupNumber($betItem['gameId'], 'game_name')['game_group'] ?? null,
            '2' => Model::getGameGroupNumber_X($betItem['gameId'], 'twosides')['game_group'] ?? null,
            '3' => Model::getGameGroupNumber_X($betItem['gameId'], 'roadbet')['game_group'] ?? null,
            '4' => Model::getGameGroupNumber_X($betItem['gameId'], 'longdragon')['game_group'] ?? null,
            '5' => Model::getGameGroupNumber($betItem['gameId'], 'game_name')['game_group'] ?? null,
            '6' => Model::getGameGroupNumber($betItem['gameId'], 'boardgames')['game_group'] ?? null,
            '7' => Model::getGameGroupNumber($betItem['gameId'], 'fantan')['game_group'] ?? null,
            '8' => Model::getGameGroupNumber_X($betItem['gameId'], 'roadbet')['game_group'] ?? null
        ][$model];
    }

    public static function findGameClass(array $ClassIdGroups, string $ClassId): string {
        foreach ($ClassIdGroups as $group => $value) {
            if (in_array($ClassId, explode(",", $group))) {
                return $value;
            }
        }
        return null; 
    }

}

