<?php 

class BetStakeController { 

    public static function is_special_game(array $specialIds, array $betItem, array $userInformation, string $gameModel) : string  {
        $gameTable = self::getSpecialOddsTable($gameModel);
        $idswithOdds = [];
        foreach ($specialIds as $specialId) {
            $response = Model::getSpecialOdds($specialId,$gameTable)[0];
            $Odds = $response['odds'];
            $idswithOdds[$specialId] = self::oddsFormulae($betItem['selfRebate'],$userInformation,$response,$Odds);
        }
        return json_encode($idswithOdds);
    }

    public static function not_special_game(array $betItem, array $userInformation, string $gameModel) : string  {
        $idswithOdds = [];
        $gameTable = self::getOddsTable($gameModel);
        $response = Model::getDefualtGameData($betItem['gameId'],$gameTable)[0];
        $Odds = json_decode($response['odds'])[0];
        $idswithOdds[$betItem['gameId']] = self::oddsFormulae($betItem['selfRebate'],$userInformation,$response,$Odds);
        return json_encode($idswithOdds);
    }

    public static function oddsFormulae(string $rebate, array $userInformation, array $response, string $odds) : string {
        $currentodds = ((85 + doubleval($response['rebate'])) / 100) * doubleval($odds);
        $newodd = $rebate == 'true' ? ((85 + 0) / 100) * doubleval($currentodds) : 
        ((85 + doubleval($userInformation['rebate'])) / 100) * doubleval($currentodds);
        return  Utilities::truncate($newodd);
    }

    public static function getOddsTable(string $gameModel){
        return match ($gameModel) {
            '1' => 'game_name',
            '2' => 'twosides',
            '3' => 'roadbet',
            '4' => 'longdragon',
            '5' => 'manytable',
            '6' => 'boardgames',
            '7' => 'fantan',
            '8' => 'trend',
            default => null,
        };
    }

    public static function getSpecialOddsTable(string $gameModel){
        return match ($gameModel) {
            '1' => 'odds_group',
            '2' => 'twosides_group',
            '3' => 'roadbet_odds',
            '4' => 'longdragon_group',
            '5' => 'manytables_odds',
            default => null,
        };
    }
      
}