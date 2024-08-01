<?php

class Pk10 extends GamePlayFunctionPK10
{

    public static function getGamePlayMethod(): array
    { //////////// THE INVOKE METHOD
        return parent::getGamePlayFunction(); ///////////////////////////////////////////
    } ///////////////////////////////////////////////////////////////////////////////////

    public static function FirstOneStraightJoint(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        if (in_array($drawNumber[0], $selection[0])) {
            $count++;
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function FirstTwoStraightJoint(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        if (in_array($drawNumber[0], $selection[0]) && in_array($drawNumber[1], $selection[1])) {
            $count++;
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function FirstThreeStraightJoint(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        if (in_array($drawNumber[0], $selection[0]) && in_array($drawNumber[1], $selection[1]) && in_array($drawNumber[2], $selection[2])) {
            $count++;
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function FirstFourStraightJoint(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        if (in_array($drawNumber[0], $selection[0]) && in_array($drawNumber[1], $selection[1]) && in_array($drawNumber[2], $selection[2]) && in_array($drawNumber[3], $selection[3])) {
            $count++;
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function FirstFiveStraightJoint(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        if (in_array($drawNumber[0], $selection[0]) && in_array($drawNumber[1], $selection[1]) && in_array($drawNumber[2], $selection[2]) && in_array($drawNumber[3], $selection[3]) && in_array($drawNumber[4], $selection[4])) {
            $count++;
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function FirstTwoStraightManual(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        $gameids = [];
        $winningNumbers = array_slice($drawNumber, 0, 2);
        foreach ($selection[0] as $value) {
            $splited = explode(',', $value);
            if (in_array($winningNumbers[0], $splited) && in_array($winningNumbers[1], $splited)) {
                $count++;
                $gameids[] = $gameId;
            }
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function FirstThreeStraightManual(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        $gameids = [];
        $winningNumbers = array_slice($drawNumber, 0, 3);
        foreach ($selection[0] as $value) {
            $splited = explode(',', $value);
            if (in_array($winningNumbers[0], $splited) && in_array($winningNumbers[1], $splited) && in_array($winningNumbers[2], $splited)) {
                $count++;
                $gameids[] = $gameId;
            }
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function FirstFourStraightManual(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        $gameids = [];
        $winningNumbers = array_slice($drawNumber, 0, 4);
        foreach ($selection[0] as $value) {
            $splited = explode(',', $value);
            if (in_array($winningNumbers[0], $splited) && in_array($winningNumbers[1], $splited) && in_array($winningNumbers[2], $splited) && in_array($winningNumbers[3], $splited)) {
                $count++;
                $gameids[] = $gameId;
            }
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function FirstFiveStraightManual(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        $gameids = [];
        $winningNumbers = array_slice($drawNumber, 0, 5);
        foreach ($selection[0] as $value) {
            $splited = explode(',', $value);
            if (in_array($winningNumbers[0], $splited) && in_array($winningNumbers[1], $splited) && in_array($winningNumbers[2], $splited) && in_array($winningNumbers[3], $splited) && in_array($winningNumbers[4], $splited)) {
                $count++;
                $gameids[] = $gameId;
            }
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function FirstFiveFixedPlace(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        $gameids = [];
        $winningNumbers = array_slice($drawNumber, 0, 5);
        foreach ($selection as $index => $selectedNumbers) {
            if (in_array($winningNumbers[$index], $selectedNumbers)) {
                $count++;
                $gameids[] = $gameId;
            }
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function LastFiveFixedPlace(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        $gameids = [];
        $winningNumbers = array_slice($drawNumber, -5);
        foreach ($selection as $index => $selectedNumbers) {
            if (in_array($winningNumbers[$index], $selectedNumbers)) {
                $count++;
                $gameids[] = $gameId;
            }
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function DragonTiger(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        $gameids = [];
        $datas = [
            '1v10' => self::DT(0, 9, $drawNumber),
            '2v9' => self::DT(1, 8, $drawNumber),
            '3v8' => self::DT(2, 7, $drawNumber),
            '4v7' => self::DT(3, 6, $drawNumber),
            '5v6' => self::DT(5, 7, $drawNumber),
        ];
        foreach ($selection[0] as $key => $value) {
            if (in_array(intval($datas[$key]), $value)) {
                $count++;
                $gameids[] = intval($datas[$key]);
                break;
            }
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];
    }


    //Dragon Tiger Function
    // NOTE - dragontiger function to be implemented by stir
    //please implement the dragon timer function below

    public static function PickJoint(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        $gameids = [];
        $matches = 0;
        for ($i = 0; $i < count($drawNumber); $i++) {
            if (in_array($drawNumber[$i], $selection[$i])) {
                $matches++;
                if ($matches >= 2) {
                    $count++;
                    $gameids[] = $gameId;
                }
            }
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function Pick2Manual(array $selection, array $drawNumber, int $gameId): array
    {
        $ball = array_map(function ($value) use ($drawNumber) {
            return $drawNumber[$value - 1];
        }, $selection[0]);

        $count = 0;
        $gameids = [];
        foreach ($selection[1] as $sel) {
            if (count(array_intersect($ball, array_map('intval', $sel))) >= 2) {
                $count++;
                $gameids[] = $gameId;
                // break;
            }
        }

        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];
    }




    public static function DT(int $idx1, int $idx2, array $drawNumber): string
    { // dragon|tiger|tie pattern
        $drawNumber = explode(",", implode(",", $drawNumber));
        $v1 = $drawNumber[$idx1];
        $v2 = $drawNumber[$idx2];
        return ($v1 > $v2) ? 303 : (($v1 == $v2) ? 200 : 304);
    }

    public static function Pick2Joint(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        $gameids = [];
        for ($i = 0; $i <= 9; $i++) {
            if (in_array($drawNumber[$i], $selection[$i])) {
                $count++;
                $gameids[] = $gameId;
                // break;
            }
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count >= 2 ? $gameids : [],
            'status' => $count >= 2 ? 2 : 3
        ];
    }


    public static function Pick3Joint(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        $gameids = [];
        for ($i = 0; $i <= 9; $i++) {
            if (in_array($drawNumber[$i], $selection[$i])) {
                $count++;
                $gameids[] = $gameId;
            }
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count >= 3 ? $gameids : [],
            'status' => $count >= 3 ? 2 : 3
        ];
    }


    public static function Pick3Manual(array $selection, array $drawNumber, int $gameId): array
    {
        $ball = array_map(function ($value) use ($drawNumber) {
            return $drawNumber[$value - 1];
        }, $selection[0]);

        $count = 0;
        $gameids = [];
        foreach ($selection[1] as $sel) {
            if (count(array_intersect($ball, array_map('intval', $sel))) >= 3) {
                $count++;
                $gameids[] = $gameId;
                // break;
            }
        }

        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];
    }


    public static function BseoFirst5(array $selection, array $drawNumber, int $gameId = null): array //NOTE returns 1 or more, must submit single
    {
        $winningNumbers = array_slice($drawNumber, 0, 5);
        $data = [
            '1' => range(6, 10),
            '2' => range(1, 5),
            '3' => range(1, 9, 2),
            '4' => range(0, 8, 2)
        ];
        $count = 0;

        foreach ($selection as $key => $value) {
            foreach ($value as $number) {
                if (in_array($winningNumbers[$key], $data[$number])) {
                    $count++;
                }
            }
        }

        return [
            'numwins' => $count,
            'gameids' => $count ? array_fill(0, $count, $gameId) : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function BsoeTopTwo(array $selection, array $drawNumber, int $gameId = null): array  //NOTE returns 1 or more, must submit single
    {
        $winningNumbers = array_sum(array_slice($drawNumber, 0, 2));
        $data = [
            '1' => range(12, 19),
            '2' => range(3, 11),
            '3' => range(1, 20, 2),
            '4' => range(0, 20, 2)
        ];
        $count = 0;
        foreach ($selection as $key => $value) {
            foreach ($value as $number) {
                if (in_array($winningNumbers, $data[$number])) {
                    $count++;
                }
            }
        }

        return [
            'numwins' => $count,
            'gameids' => $count ? array_fill(0, $count, $gameId) : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function pk10SumOfTwo(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        $gameOddsId = [
          3 => 340,
          4 => 341,
          5 => 342,
          6 => 343,
          7 => 344,
          8 => 345,
          9 => 346,
          10 => 347,
          11 => 348,
          12 => 349,
          13 => 350,
          14 => 351,
          15 => 352,
          16 => 353,
          17 => 354,
          18 => 355,
          19 => 356,
        ];
        // Convert selection to integers
        $selection = array_map('intval', $selection);
        $gameIds = [];
        
        // Sum of draw numbers
        // return array_slice($drawNumber, 0, 2);
        $drawSum = array_sum(array_slice($drawNumber, 0, 2));
        foreach($selection as $selected){
          if ($drawSum == $selected) {
            $count++;
            $gameIds[] = $gameOddsId[$selected];
            break;
          }
        }
    
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? $gameIds : [],
            'status'  => $count ? 2 : 3
        ];
    
    }

    public static function Royal10SumOfFirst3(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        $gameOddsId = [
        6 => 357,
        7 => 358,
        8 => 359,
        9 => 360,
        10 => 361,
        11 => 362,
        12 => 363,
        13 => 364,
        14 => 365,
        15 => 366,
        16 => 367,
        17 => 368,
        18 => 369,
        19 => 370,
        20 => 371,
        21 => 372,
        22 => 373,
        23 => 374,
        24 => 375,
        25 => 376,
        26 => 377,
        27 => 378,
        ];
        // Convert selection to integers
        $selection = array_map('intval', $selection);
        $gameIds = [];
        
        // Sum of draw numbers
        // return array_slice($drawNumber, 0, 3);
        $drawSum = array_sum(array_slice($drawNumber, 0, 3));
        foreach($selection as $selected){
        if ($drawSum == $selected) {
            $count++;
            $gameIds[] = $gameOddsId[$selected];
            break;
        }
        }

        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? $gameIds : [],
            'status'  => $count ? 2 : 3
        ];
    }



    ######################  PK 10 Board Game  ######################

    public static function FarwardAndBack(array $selection, array $drawNumber, int $gameId = null): array
    {
        $count = 0;
        $gameids = [];

        $topFiveValues = array_slice($drawNumber, 0, count($drawNumber) / 2);
        $LastFiveValues = array_slice($drawNumber, count($drawNumber) / 2);
        $sumTopValues = array_sum($topFiveValues);
        $sumLastValues = array_sum($LastFiveValues);
        $results = ($sumTopValues > $sumLastValues) ? 1148 : 1149;
        if ($results == $selection[0]) {
            $count++;
            $gameids[] = $gameId;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function GuessTheWinner(array $selection, array $drawNumber, int $gameId = null): array
    {
        $count = 0;
        $gameids = [];

        $data = [
            1150 => 1,
            1151 => 2,
            1152 => 3,
            1153 => 4,
            1154 => 5,
            1155 => 6,
            1156 => 7,
            1157 => 8,
            1158 => 9,
            1159 => 10
        ];

        if ($drawNumber[0] == $data[$selection[0]]) {
            $count++;
            $gameids[] = $gameId;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function MaximumValue(array $selection, array $drawNumber, int $gameId = null): array
    {
        $count = 0;
        $gameids = [];
        $topFiveValues = array_slice($drawNumber, 0, count($drawNumber) / 2);
        $maxNumber = $topFiveValues[0]; // Initialize with the first number
        $maxPosition = 0; // Initialize with the position of the first number
        for ($i = 1; $i < count($topFiveValues); $i++) {
            if ($topFiveValues[$i] > $maxNumber) {
                $maxNumber = $topFiveValues[$i];
                $maxPosition = $i;
            }
        }

        // $positions = ["First Place", "Second Place", "Third Place", "Fourth Place", "Fiveth Place"];
        $positions = [1160, 1161, 1162, 1163, 1164];
        $result = $positions[$maxPosition];
        if ($result == $selection[0]) {
            $count++;
            $gameids[] = $gameId;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function MinimumValue(array $selection, array $drawNumber, int $gameId = null): array
    {
        $count = 0;
        $gameids = [];
        $LastFiveValues = array_slice($drawNumber, count($drawNumber) / 2);
        $maxNumber = $LastFiveValues[0]; // Initialize with the first number
        $maxPosition = 0; // Initialize with the position of the first number
        for ($i = 1; $i < count($LastFiveValues); $i++) {
            if ($LastFiveValues[$i] < $maxNumber) {
                $maxNumber = $LastFiveValues[$i];
                $maxPosition = $i;
            }
        }

        //$positions = ["Sixth Place", "Seventh Place", "Eigth Place", "Ninth Place", "Tenth Place"];
        $positions = [1165, 1166, 1167, 1168, 1169];
        $result = $positions[$maxPosition];
        if ($result == $selection[0]) {
            $count++;
            $gameids[] = $gameId;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function QuickOrSlow(array $selection, array $drawNumber, int $gameId = null): array
    {
        $count = 0;
        $gameids = [];
        $topFiveValues = array_slice($drawNumber, 0, count($drawNumber) / 2);
        $result = (in_array(1, $topFiveValues)) ? 1170 : 1171;
        if ($result == $selection[0]) {
            $count++;
            $gameids[] = $gameId;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];
    }


    ######################  PK 10 ROAD BET Game  ######################

    public static function DTT(int $idx1, int $idx2, array $drawNumber): string
    { // dragon|tiger|tie pattern
        $drawNumber = explode(",", implode(",", $drawNumber));
        $v1 = $drawNumber[$idx1];
        $v2 = $drawNumber[$idx2];
        return ($v1 > $v2) ? "Dragon" : (($v1 == $v2) ? "Tie" : "Tiger");
    }

    public static function SumOfFirstTwo(array $selection, array $drawNumber, int $gameId = null): array
    { // SumOfFirstTwo
        $count = 0;
        $data = [
            'Big' => array_sum(array_slice($drawNumber, 0, 2)) > 5 ? true : false,
            'Small' => array_sum(array_slice($drawNumber, 0, 2)) < 6 ? true : false,
            'Even' => array_sum(array_slice($drawNumber, 0, 2)) % 2 == 0 ? true : false,
            'Odd' => array_sum(array_slice($drawNumber, 0, 2)) % 2 != 0 ? true : false
        ];
        if ($data[$selection[0]] == true) {
            $count++;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function BigSmallFirstBall(array $selection, array $drawNumber, int $gameId = null): array
    { // first ball
        $count = 0;
        $data = [
            'Big' => $drawNumber[0] > 5 ? true : false,
            'Small' => $drawNumber[0] < 6 ? true : false,
            'Even' => $drawNumber[0] % 2 == 0 ? true : false,
            'Odd' => $drawNumber[0] % 2 != 0 ? true : false,
            'Dragon' => self::DTT(0, 9, $drawNumber) == "Dragon" ? true : false,
            'Tiger' => self::DTT(0, 9, $drawNumber) == "Tiger" ? true : false
        ];
        if ($data[$selection[0]] == true) {
            $count++;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function BigSmallSecondBall(array $selection, array $drawNumber, int $gameId = null): array
    { // second ball
        $count = 0;
        $data = [
            'Big' => $drawNumber[1] > 5 ? true : false,
            'Small' => $drawNumber[1] < 6 ? true : false,
            'Even' => $drawNumber[1] % 2 == 0 ? true : false,
            'Odd' => $drawNumber[1] % 2 != 0 ? true : false,
            'Dragon' => self::DTT(1, 8, $drawNumber) == "Dragon" ? true : false,
            'Tiger' => self::DTT(1, 8, $drawNumber) == "Tiger" ? true : false

        ];
        if ($data[$selection[0]] == true) {
            $count++;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function BigSmallThirdBall(array $selection, array $drawNumber, int $gameId = null): array
    { // third ball
        $count = 0;
        $data = [
            'Big' => $drawNumber[2] > 5 ? true : false,
            'Small' => $drawNumber[2] < 6 ? true : false,
            'Even' => $drawNumber[2] % 2 == 0 ? true : false,
            'Odd' => $drawNumber[2] % 2 != 0 ? true : false,
            'Dragon' => self::DTT(2, 7, $drawNumber) == "Dragon" ? true : false,
            'Tiger' => self::DTT(2, 7, $drawNumber) == "Tiger" ? true : false
        ];
        if ($data[$selection[0]] == true) {
            $count++;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function BigSmallFourthBall(array $selection, array $drawNumber, int $gameId = null): array
    { // fourth ball
        $count = 0;
        $data = [
            'Big' => $drawNumber[3] > 5 ? true : false,
            'Small' => $drawNumber[3] < 6 ? true : false,
            'Even' => $drawNumber[3] % 2 == 0 ? true : false,
            'Odd' => $drawNumber[3] % 2 != 0 ? true : false,
            'Dragon' => self::DTT(3, 6, $drawNumber) == "Dragon" ? true : false,
            'Tiger' => self::DTT(3, 6, $drawNumber) == "Tiger" ? true : false
        ];
        if ($data[$selection[0]] == true) {
            $count++;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function BigSmallFifthBall(array $selection, array $drawNumber, int $gameId = null): array
    { // fifth ball
        $count = 0;
        $data = [
            'Big' => $drawNumber[4] > 5 ? true : false,
            'Small' => $drawNumber[4] < 6 ? true : false,
            'Even' => $drawNumber[4] % 2 == 0 ? true : false,
            'Odd' => $drawNumber[4] % 2 != 0 ? true : false,
            'Dragon' => self::DTT(5, 7, $drawNumber) == "Dragon" ? true : false,
            'Tiger' => self::DTT(5, 79, $drawNumber) == "Tiger" ? true : false
        ];
        if ($data[$selection[0]] == true) {
            $count++;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function BigSmallSixBall(array $selection, array $drawNumber, int $gameId = null): array
    { // sixth ball
        $count = 0;
        $data = [
            'Big' => $drawNumber[5] > 5 ? true : false,
            'Small' => $drawNumber[5] <= 6 ? true : false,
            'Even' => $drawNumber[5] % 2 == 0 ? true : false,
            'Odd' => $drawNumber[5] % 2 != 0 ? true : false
        ];
        if ($data[$selection[0]] == true) {
            $count++;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function BigSmallSevenBall(array $selection, array $drawNumber, int $gameId = null): array
    { // seventh ball
        $count = 0;
        $data = [
            'Big' => $drawNumber[6] > 5 ? true : false,
            'Small' => $drawNumber[6] < 6 ? true : false,
            'Even' => $drawNumber[6] % 2 == 0 ? true : false,
            'Odd' => $drawNumber[6] % 2 != 0 ? true : false
        ];
        if ($data[$selection[0]] == true) {
            $count++;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function BigSmallEightBall(array $selection, array $drawNumber, int $gameId = null): array
    { // eight ball
        $count = 0;
        $data = [
            'Big' => $drawNumber[7] > 5 ? true : false,
            'Small' => $drawNumber[7] < 6 ? true : false,
            'Even' => $drawNumber[7] % 2 == 0 ? true : false,
            'Odd' => $drawNumber[7] % 2 != 0 ? true : false
        ];
        if ($data[$selection[0]] == true) {
            $count++;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function BigSmallNineBall(array $selection, array $drawNumber, int $gameId = null): array
    { // ninth ball
        $count = 0;
        $data = [
            'Big' => $drawNumber[8] > 5 ? true : false,
            'Small' => $drawNumber[8] < 6 ? true : false,
            'Even' => $drawNumber[8] % 2 == 0 ? true : false,
            'Odd' => $drawNumber[8] % 2 != 0 ? true : false
        ];
        if ($data[$selection[0]] == true) {
            $count++;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function BigSmallTenBall(array $selection, array $drawNumber, int $gameId = null): array
    { // tenth ball
        $count = 0;
        $data = [
            'Big' => $drawNumber[9] > 5 ? true : false,
            'Small' => $drawNumber[9] < 6 ? true : false,
            'Even' => $drawNumber[9] % 2 == 0 ? true : false,
            'Odd' => $drawNumber[9] % 2 != 0 ? true : false
        ];
        if ($data[$selection[0]] == true) {
            $count++;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }


    // PK10 2 Sides Game *****************************************

    public static function DTF(int $index1, int $index2, array $drawNumber): string
    { // dragon|tiger|tie pattern
        $drawNumber = explode(",", implode(",", $drawNumber));
        $v1 = $drawNumber[$index1];
        $v2 = $drawNumber[$index2];
        return ($v1 > $v2) ? "Dragon" : "Tiger";
    }

    public static function RapidoTwoSideFixedPlaceMaster(array $selection, array $drawNumber, int $gameId = null): array
    {
        $count = 0;
        $position = $selection['position'] == 'Sum of Top Two' ? 1 : intval($selection['position']) - 1;
        $posVal = intval($drawNumber[$position]);
        $selected = trim($selection['selection']);
        $gameId = $selection['label_id'];
        $dummyKey = count(str_split($selected, 1)) == 1 ? $selected : 'dummyKey';
        $key = $selection['position'];

        $data = [
            '1st' => self::DTF(0, 9, $drawNumber),
            '2nd' => self::DTF(1, 8, $drawNumber),
            '3rd' => self::DTF(2, 7, $drawNumber),
            '4th' => self::DTF(3, 6, $drawNumber),
            '5th' => self::DTF(4, 5, $drawNumber)
        ];
        switch ($key) {
            case 'Sum of Top Two':
                $sumTwo = array_slice($drawNumber, 0, 2);
                $sum = array_sum($sumTwo);
                $data = [
                    'Big' => $sum > 11,
                    'Small' => $sum < 11,
                    'Odd' => $sum % 2 != 0,
                    'Even' => $sum % 2 == 0,
                ];
                if ($data[$selected] == true) {
                    $count++;
                }
            default:
                $data = [
                    'Big' => $posVal > 5,
                    'Small' => $posVal < 6,
                    'Odd' => $posVal % 2 != 0,
                    'Even' => $posVal % 2 == 0,
                    'Dragon' => $data[$key] == 'Dragon',
                    'Tiger' => $data[$key] == 'Tiger',
                    $dummyKey => $posVal == intval($selected)
                ];
                if ($data[$selected] == true) {
                    $count++;
                }
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];

    }

    public static function Rapido(array $selection, array $drawNumber, int $gameId = null): array
    { // id 156
        $count = 0;
        $position = intval($selection['position']) - 1;
        $posVal = intval($drawNumber[$position]);
        $selected = trim($selection['selection']);
        $gameId = $selection['label_id'];
        $dummyKey = count(str_split($selected, 1)) <= 2 ? $selected : 'dummyKey';
        $key = $selection['position'];
        $data = [
            '1st' => self::DTF(0, 9, $drawNumber),
            '2nd' => self::DTF(1, 8, $drawNumber),
            '3rd' => self::DTF(2, 7, $drawNumber),
            '4th' => self::DTF(3, 6, $drawNumber),
            '5th' => self::DTF(4, 5, $drawNumber),
            // '6th' => self::DTF(4, 5, $drawNumber),
            // '7th' => self::DTF(4, 5, $drawNumber),
            // '8th' => self::DTF(4, 5, $drawNumber),
            // '9th' => self::DTF(4, 5, $drawNumber)
            // '10th' => self::DTF(4, 5, $drawNumber)
        ];
        $exception = ['6th', '7th', '8th', '9th', '10th'];
        $data = [
            'Big' => $posVal > 5,
            'Small' => $posVal < 6,
            'Odd' => $posVal % 2 != 0,
            'Even' => $posVal % 2 == 0,
            'Dragon' => !in_array($key, $exception) ? $data[$key] == 'Dragon' : false,
            'Tiger' => !in_array($key, $exception) ? $data[$key] == 'Tiger' : false,
            $dummyKey => $posVal == intval($selected)
        ];
        if ($data[$selected] == true) {
            $count++;
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function Two2sidesSumofTopTwo(array $selection, array $drawNumber, int $gameId = null): array
    { // id 165
        $count = 0;
        $selected = trim($selection['selection']);
        $gameId = $selection['label_id'];
        $sumTwo = array_slice($drawNumber, 0, 2);
        $sum = array_sum($sumTwo);
        $data = [
            'Big' => $sum > 11,
            'Small' => $sum < 11,
            'Odd' => $sum % 2 != 0,
            'Even' => $sum % 2 == 0,
        ];
        if ($data[$selected] == true) {
            $count++;
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];


    }

    public static function Ball1To10(array $selection, array $drawNumber, int $gameId = null): array
    { // id 167
        $count = 0;
        $position = intval($selection['position']) - 1;
        $posVal = intval($drawNumber[$position]);
        $selected = trim($selection['selection']);
        $gameId = $selection['label_id'];
        $key = $selection['position'];
        $data = [
            '1st' => self::DTF(0, 9, $drawNumber),
            '2nd' => self::DTF(1, 8, $drawNumber),
            '3rd' => self::DTF(2, 7, $drawNumber),
            '4th' => self::DTF(3, 6, $drawNumber),
            '5th' => self::DTF(4, 5, $drawNumber),
            // '6th' => self::DTF(4, 5, $drawNumber),
            // '7th' => self::DTF(4, 5, $drawNumber),
            // '8th' => self::DTF(4, 5, $drawNumber),
            // '9th' => self::DTF(4, 5, $drawNumber)
        ];
        $exception = ['6th', '7th', '8th', '9th', '10th'];
        $data = [
            'Big' => $posVal > 5,
            'Small' => $posVal < 6,
            'Odd' => $posVal % 2 != 0,
            'Even' => $posVal % 2 == 0,
            'Dragon' => !in_array($key, $exception) ? $data[$key] == 'Dragon' : false,
            'Tiger' => !in_array($key, $exception) ? $data[$key] == 'Tiger' : false
        ];
        if ($data[$selected] == true) {
            $count++;
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function FixedPlaceDummy(array $selection, array $drawNumber, int $gameId = null): array
    { // id 166
        $count = 0;
        $position = intval($selection['position']) - 1;
        $posVal = intval($drawNumber[$position]);
        $selected = trim($selection['selection']);
        $gameId = $selection['label_id'];
        if ($posVal == intval($selected)) {
            $count++;
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function SumofTwo(array $selection, array $drawNumber, int $gameId = null): array
    {
        $count = 0;
        $selected = $selection['selection'];
        $gameId = $selection['label_id'];
        $sumTwo = array_slice($drawNumber, 0, 2);
        if (array_sum($sumTwo) == intval($selected)) {
            $count++;
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }


    //######################## DRAGON TIGER ############################

    public static function GetBalls(string $gameId): string
    {
        $data = [
            '1,6,23,33,47,50,53,69,74,82' => 1,
            '2,7,24,34,48,51,54,70,75,83' => 2,
            '3,8,25,35,49,52,55,71,76,84' => 3,
            '4,9,26,36,72,77,85' => 4,
            '5,10,27,37,73,78,86' => 5,
            '28,38' => 6,
            '29,39' => 7,
            '30,40' => 8,
            '31,41' => 9,
            '32,42' => 10
        ];
        $found = [];
        foreach (array_keys($data) as $key) {
            if (in_array($gameId, explode(',', $key))) {
                $found[] = $data[$key];
            }
        }

        return count($found) == 0 ? '' : implode('', $found);
    }

    public static function LongDragon(array $selection, array $drawNumber, int $gameId = null): array
    { // first ball

        $count = 0;
        $gameId = $selection[1];
        $ball = self::GetBalls($gameId) == '' ? 2 : intval(self::GetBalls($gameId)) - 1;
        $data = [
            '82' => self::DTF(0, 9, $drawNumber) == $selection[0],
            '83' => self::DTF(1, 8, $drawNumber) == $selection[0],
            '84' => self::DTF(2, 7, $drawNumber) == $selection[0],
            '85' => self::DTF(3, 6, $drawNumber) == $selection[0],
            '86' => self::DTF(4, 5, $drawNumber) == $selection[0],
            '23,24,25,26,27,28,29,30,31,32' => ($drawNumber[$ball] > 5 && $selection[0] == 'Big') ? true : (($drawNumber[$ball] < 6 && $selection[0] == 'Small') ? true : false),
            '33,34,35,36,37,38,39,40,41,42' => ($drawNumber[$ball] % 2 != 0 && $selection[0] == 'Odd') ? true : (($drawNumber[$ball] % 2 == 0 && $selection[0] == 'Even') ? true : false),
            '43' => (array_sum(array_slice($drawNumber, 0, 2)) > 10 && $selection[0] == 'Big') ? true : ((array_sum(array_slice($drawNumber, 0, 2)) < 11 && $selection[0] == 'Small') ? true : false),
            '44' => (array_sum(array_slice($drawNumber, 0, 2)) % 2 != 0 && $selection[0] == 'Odd') ? true : ((array_sum(array_slice($drawNumber, 0, 2)) % 2 == 0 && $selection[0] == 'Even') ? true : false),

        ];

        foreach (array_keys($data) as $key) {
            if (in_array($gameId, explode(',', $key))) {
                if ($data[$key] == true) {
                    $count++;
                }
            }
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? array_fill(0, $count, $gameId) : [],
            'status' => $count ? 2 : 3,
        ];
    }


    //######################## fantan ############################
    public static function FantanMain(array $selection, array $drawNumber, int $gameId): array
    {

        $remainder = array_sum(array_slice($drawNumber, 0, 3));
        $data = [
            '379' => $drawNumber[0] >= 6,
            '380' => $drawNumber[0] <= 5,
            '381' => $drawNumber[0] % 2 != 0,
            '382' => $drawNumber[0] % 2 == 0,
            '383' => 1 == $drawNumber[0],
            '384' => 2 == $drawNumber[0],
            '385' => 3 == $drawNumber[0],
            '386' => 4 == $drawNumber[0],
            '387' => 5 == $drawNumber[0],
            '388' => 6 == $drawNumber[0],
            '389' => 7 == $drawNumber[0],
            '390' => 8 == $drawNumber[0],
            '391' => 9 == $drawNumber[0],
            '392' => 10 == $drawNumber[0],
            '393' => $remainder >= 17,
            '394' => $remainder <= 16,
            '395' => $remainder % 2 != 0,
            '396' => $remainder % 2 == 0,
        ];
        $count = 0;
        if ($selection == $data[$selection[0]]) {
            $count++;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? '2' : '3'
        ];
    }

    public static function fantanOne(array $selection, array $drawNumber, int $gameId): array
    {

        $remainder = array_sum(array_slice($drawNumber, 0, 3)) % 4;
        $results = [
            0 => ["416", "408", "409", "404", "405", "406", "407", "397", "398", "399"],
            1 => ["413", "410", "402", "403", "412", "406", "407", "398", "399", "400"],
            2 => ["414", "410", "401", "404", "411", "405", "397", "399", "400"],
            3 => ["415", "402", "403", "412", "401", "411", "408", "409", "397", "398", "400"]
        ];
        $count = 0;
        if (in_array($selection[0], $results[$remainder])) {
            $count++;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? '2' : '3'
        ];

    }

    public static function fantanTwo(array $selection, array $drawnumber, int $gameId): array
    {
        $count = 0;
        $remainder = array_sum(array_slice($drawnumber, 0, 3)) % 4;
        $data = [
            0 => ["435", "553", "421", "431", "426", "425", "427"],
            1 => ["432", "552", "431", "350", "428", "429", "430"],
            2 => ["433", "553", "350", "417", "424", "422", "423"],
            3 => ["434", "552", "417", "421", "418", "419", "420"]
        ];

        if (in_array($selection[0], $data[$remainder])) {
            $count++;
        }
        ;

        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function fantanPosition(array $selection, array $drawNumber, int $gameId): array
    {

        $position = $selection[0][0] -= 1;
        $posVal = intval($drawNumber[$position]);
        $selection = $selection[1][0];
        $data = [
            '351' => $posVal >= 5,
            '436' => $posVal <= 4,
            '437' => $posVal % 2 != 0,
            '438' => $posVal % 2 == 0,
            '439' => $posVal == 0,
            '440' => $posVal == 1,
            '441' => $posVal == 2,
            '443' => $posVal == 3,
            '444' => $posVal == 4,
            '445' => $posVal == 5,
            '446' => $posVal == 6,
            '447' => $posVal == 7,
            '448' => $posVal == 8,
            '449' => $posVal == 9
        ];
        $count = 0;
        if ($selection == $data[$selection]) {
            $count++;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? '2' : '3'
        ];

    }


}
