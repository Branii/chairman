<?php

class Fast3 extends GamePlayFunctionF3
{

    public static function getGamePlayMethod(): array
    {
        return parent::getGamePlayFunction();
    }

    public static function findPattern(array $pattern, array $drawNumbers): bool
    { // find patterns in drawsNumbers
        $drawNumbers = array_count_values($drawNumbers);
        sort($drawNumbers);
        sort($pattern);
        return $drawNumbers === $pattern;
    }

    public static function findStreakPattern(array $drawNumber, int $index, int $slice, int $streakCount, bool $flag = false): bool
    { // streak pattern
        $drawNumber = !$flag ? array_slice($drawNumber, $index, $slice) : array_slice($drawNumber, $slice);
        $count = 0;
        $n = count($drawNumber);
        sort($drawNumber);
        if (($drawNumber[0] == 0 && $drawNumber[$n - 1] == 9) || ($drawNumber[0] == 9 && $drawNumber[$n - 1] == 0)) {
            $count++;
        }
        for ($i = 0; $i < $n - 1; $i++) {
            if ($drawNumber[$i] == $drawNumber[$i + 1] - 1) {
                $count++;
            }
        }
        return $count == $streakCount;
    }

    public static function Bsoe(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        $data = ['1' => range(11, 18), '2' => range(3, 10), '3' => range(1, 9, 2), '4' => range(0, 8, 2)];
        foreach ($selection[0] as $selectedArray) {
            if (in_array(1, $selection[0]) || in_array(2, $selection[0])) {
                if (in_array(array_sum($drawNumber), $data[$selectedArray])) {
                    $count++;
                }
                ;
            }
            if (in_array(array_sum($drawNumber) % 10, $data[$selectedArray])) {
                $count++;
            }
        }

        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? array_fill(0, $count, $gameId) : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function Sum(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        $gameOddsId = [
          3 => 379,
          4 => 380,
          5 => 381,
          6 => 382,
          7 => 383,
          8 => 384,
          9 => 385,
          10 => 386,
          11 => 387,
          12 => 388,
          13 => 389,
          14 => 390,
          15 => 391,
          16 => 392,
          17 => 393,
          18 => 394,
        ];
        // Convert selection to integers
        $selection = array_map('intval', $selection);
        $gameIds = [];
        
        // Sum of draw numbers
        $drawSum = array_sum($drawNumber);
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

    public static function Toak(array $selection, array $drawNumber, int $gameId)
    {
        $count = 0;
        if (count(array_count_values($drawNumber)) == 1 && count(array_intersect($drawNumber, array_map('intval', $selection[0]))) == 3) {
            $count++;
        }

        if (isset($selection[1]) && count(array_count_values($drawNumber)) == 1) {
            $count++;
        }

        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function ThreeNoStandard(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        if (in_array($drawNumber, $selection[0])) {
            $count++;
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function ThreeNoGroup(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        if (count(array_intersect($drawNumber, $selection[0])) == 3) {
            $count++;
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function ThreeRow(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        if (isset($selection[1]) && in_array(implode(',', $drawNumber), $selection[1])) {
            $count++;
        }
        if (in_array(implode(',', $drawNumber), $selection[0])) {
            $count++;
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function HalfStreak(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        if (isset($selection[1]) && in_array(implode(',', $drawNumber), $selection[1])) {
            $count++;
        }
        if (in_array(implode(',', $drawNumber), $selection[0])) {
            $count++;
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function Mixed(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        if (isset($selection[1]) && in_array(implode(',', $drawNumber), $selection[1])) {
            $count++;
        }
        if (in_array(implode(',', $drawNumber), $selection[0])) {
            $count++;
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function OnePairStandardManual(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        if (in_array(implode(',', $drawNumber), $selection[0])) {
            $count++;
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function OnePairStandardJoint(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        $drawNumbers = array_slice($drawNumber, 0, 2);
        if (in_array(implode(',', $drawNumbers), $selection[0]) && in_array($drawNumber[2], $selection[1])) {
            $count++;
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function OnePairGroup(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        foreach ($selection[0] as $value) {
            if (self::findDuplicate(explode(',', $value)) == self::findDuplicate($drawNumber)) {
                $count++;
            }
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? array_fill(0, $count, $gameId) : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function TwoNoGroup(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        $count = (in_array($drawNumber[0], $selection[0]) ? 1 : 0) +
            (in_array($drawNumber[1], $selection[0]) ? 1 : 0) +
            (in_array($drawNumber[2], $selection[0]) ? 1 : 0);
        if ($count == 2) {
            $count++;
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function TwoNoStandard(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        foreach ($selection[0] as $value) {
            if (count(array_intersect(explode(',', $value), $drawNumber)) == 2) {
                $count++;
            }
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? array_fill(0, $count, $gameId) : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function GuessANumber(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        foreach ($selection[0] as $value) {
            if (in_array($value, $drawNumber)) {
                $count++;
            }
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? array_fill(0, $count, $gameId) : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function findDuplicate($array1)
    { # HELPER FUNCTION #
        foreach (array_count_values($array1) as $value => $count) {
            if ($count > 1)
                return $value;
        }
        return false;
    }

    ####################### fast 3 board games ############################

    public static function SumNumbers(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        $data = [
            'Big' => in_array(array_sum($drawNumber), range(1, 17)),
            'Small' => in_array(array_sum($drawNumber), range(4, 10)),
            'Odd' => in_array(array_sum($drawNumber), range(5, 15, 2)),
            'Even' => in_array(array_sum($drawNumber), range(4, 16, 2))
        ];
        if ($data[$selection[0]]) {
            $count++;
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function SumDice(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        if (in_array(array_sum($drawNumber), $selection)) {
            $count++;
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function TwoDice(array $selection, array $drawNumber, int $gameId): array
    {
        sort($drawNumber);
        $Text = implode('', $drawNumber);
        $count = 0;
        $data = [
            'Six Six' => strstr($Text, '66'),
            'Five Five' => strstr($Text, '55'),
            'Four Four' => strstr($Text, '44'),
            'Three Three' => strstr($Text, '33'),
            'Two Two' => strstr($Text, '22'),
            'One One' => strstr($Text, '11'),
        ];
        if ($data[$selection[0]]) {
            $count++;
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function ThreeDice(array $selection, array $drawNumber, int $gameId): array
    {
        sort($drawNumber);
        $Text = implode('', $drawNumber);
        $count = 0;
        $data = [
            'Six Six Six' => strstr($Text, '666'),
            'Five Five Five' => strstr($Text, '555'),
            'Four Four Four' => strstr($Text, '444'),
            'Three Three Three' => strstr($Text, '333'),
            'Two Two Two' => strstr($Text, '222'),
            'One One One' => strstr($Text, '111'),
        ];

        if ($data[$selection[0]]) {
            $count++;
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? array_fill(0, $count, $gameId) : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function ComboDice(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        $gameData = [
            '666',
            '555',
            '444',
            '333',
            '222',
            '111',
        ];

        sort($drawNumber);
        $draw = implode("", $drawNumber);
        foreach ($gameData as $betSelect) {
            if (strstr($draw, $betSelect) !== false) {
                $count++;
            }
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? array_fill(0, $count, $gameId) : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function AnyTwoDice(array $selection, array $drawNumber, int $gameId): array
    {
        sort($drawNumber);
        $Text = implode('', $drawNumber);
        $count = 0;
        $data = [
            'Five Six' => strstr($Text, '56'),
            'Four Six' => strstr($Text, '46'),
            'Four Five' => strstr($Text, '45'),
            'Three Six' => strstr($Text, '36'),
            'Three Five' => strstr($Text, '35'),
            'Three Four' => strstr($Text, '34'),
            'Two Six' => strstr($Text, '26'),
            'Two Five' => strstr($Text, '25'),
            'Two Four' => strstr($Text, '24'),
            'Two Three' => strstr($Text, '23'),
            'One Six' => strstr($Text, '16'),
            'One Five' => strstr($Text, '15'),
            'One Four' => strstr($Text, '14'),
            'One Three' => strstr($Text, '13'),
            'One Two' => strstr($Text, '12')
        ];
        if ($data[$selection[0]] == true) {
            $count++;
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function FullDice(array $selection, array $drawNumber, int $gameId): array
    { // 
        $count = 0;
        $data = [
            'Six' => in_array(6, $drawNumber) ? 1 : 0,
            'Five' => in_array(5, $drawNumber) ? 1 : 0,
            'Four' => in_array(4, $drawNumber) ? 1 : 0,
            'Three' => in_array(3, $drawNumber) ? 1 : 0,
            'Two' => in_array(2, $drawNumber) ? 1 : 0,
            'One' => in_array(1, $drawNumber) ? 1 : 0
        ];
        if ($data[$selection[0]] == 1) {
            $count++;
        }
        ;
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    ######################### Fast 3  Road Bet Games ##########################

    public static function SumBigSmall(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        $data = [
            'Big' => array_sum($drawNumber) > 10,
            'Small' => array_sum($drawNumber) < 11
        ];
        if (!in_array(3, array_count_values($drawNumber)) && $data[$selection[0]] == true) {
            $count++;
        }
        ;
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }



    ############################ 2 Sides Standard Games #######################################

    public static function GuessNumber(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        $selection = $selection['selection'];
        if (in_array($selection, $drawNumber)) {
            $count++;
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function AnyTriple(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        $selection = $selection['selection'];
        if (in_array(3, array_count_values($drawNumber)) && implode(',', $drawNumber) == $selection) {
            $count++;
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function Point(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        $selection = $selection['selection'];
        if (array_sum($drawNumber) == $selection) {
            $count++;
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function AnyTwo(array $selection, array $drawNumber, int $gameId): array
    {
        sort($drawNumber);
        $count = 0;
        $Text = implode('', $drawNumber);
        $data = [
            '5,6' => strstr($Text, '56'),
            '4,6' => strstr($Text, '46'),
            '4,5' => strstr($Text, '45'),
            '3,6' => strstr($Text, '36'),
            '3,5' => strstr($Text, '35'),
            '3,4' => strstr($Text, '34'),
            '2,6' => strstr($Text, '26'),
            '2,5' => strstr($Text, '25'),
            '2,4' => strstr($Text, '24'),
            '2,3' => strstr($Text, '23'),
            '1,6' => strstr($Text, '16'),
            '1,5' => strstr($Text, '15'),
            '1,4' => strstr($Text, '14'),
            '1,3' => strstr($Text, '13'),
            '1,2' => strstr($Text, '12')
        ];
        $selection = $selection['selection'];
        if ($data[$selection] == true) {
            $count++;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function OnePair(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        sort($drawNumber);
        $selection = $selection['selection'];
        if (in_array(2, array_count_values($drawNumber)) && strstr(implode(',', $drawNumber), $selection[0])) {
            $count++;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function FishPrawnCrab(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        $data = [
            'Fish' => 1,
            'Prawn' => 2,
            'Gourd' => 3,
            'Cash' => 4,
            'Crab' => 5,
            'Cock' => 6,
        ];
        $selection = $selection['selection'];
        if (in_array($data[$selection], $drawNumber)) {
            $count++;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    ######################## Long dragon ####################################

    public static function LongDragon(array $selection, array $drawNumber, int $gameId): array
    { // big or small
        $count = 0;
        $data = [
            '46' => (array_sum($drawNumber) > 10 && $selection[0] == 'Big') ? true : ((array_sum($drawNumber) < 11 && $selection[0] == 'Small') ? true : false)
        ];
        if ($data[$selection[1]]) {
            $count++;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    #-----------------------fast 3 fantan games ------------------------------------>$_COOKIE
    public static function fast3FantanMain1(array $selection, array $drawnumber, int $gameId): array
    {
        $count = 0;
        $data = [
            618 => array_sum($drawnumber) >= 11 && array_sum($drawnumber) <= 17,
            619 => array_sum($drawnumber) >= 4 && array_sum($drawnumber) <= 10,
            620 => array_sum($drawnumber) % 2 != 0,
            621 => array_sum($drawnumber) % 2 == 0,
            622 => array_sum($drawnumber) >= 3 && array_sum($drawnumber) <= 7,
            623 => array_sum($drawnumber) >= 8 && array_sum($drawnumber) <= 10,
            624 => array_sum($drawnumber) >= 11 && array_sum($drawnumber) <= 13,
            625 => array_sum($drawnumber) >= 14 && array_sum($drawnumber) <= 18,
        ];

        if ($data[$selection[0]] == true) {
            $count++;
        }

        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function fast3FantanMain2(array $selection, array $drawnumber, int $gameId): array
    {
        $count = 0;
        $data = [
            626 => 1,
            627 => 2,
            628 => 3,
            629 => 4,
            630 => 5,
            631 => 6
        ];
        if (in_array($data[$selection[0]], $drawnumber)) {
            $count++;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function fast3FantanMisc1(array $selection, array $drawnumber, int $gameId): array
    {
        $count = 0;
        $data = [
            660 => in_array(3, array_count_values($drawnumber)),
            661 => self::findStreakPattern($drawnumber, 0, 3, 2, false),
            662 => in_array(2, array_count_values($drawnumber)),
            663 => self::findStreakPattern($drawnumber, 0, 3, 1, false),
            664 => !self::findStreakPattern($drawnumber, 0, 3, 2, false) && self::findPattern([1, 1, 1], $drawnumber, 0, 3, true)
        ];
        if ($data[$selection[0]] == true) {
            $count++;
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function fast3FantanMisc2(array $selection, array $drawnumber, int $gameId): array
    {

        $count = 0;
        $data = [
            632 => [1, 2],
            633 => [1, 3],
            634 => [1, 4],
            635 => [1, 5],
            636 => [1, 6],
            637 => [2, 3],
            638 => [2, 4],
            639 => [2, 5],
            640 => [2, 6],
            641 => [3, 4],
            642 => [3, 5],
            643 => [3, 6],
            644 => [4, 5],
            645 => [4, 6],
            646 => [5, 6]
        ];

        if (count(array_intersect($data[$selection[0]], $drawnumber)) >= 2) {
            $count++;
        }

        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function fast3FantanShowDeck1(array $selection, array $drawnumber, int $gameId): array
    {

        $count = 0;
        $sum = array_sum($drawnumber);
        if ($selection[0] == $sum) {
            $count++;
        }

        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function fast3FantanShowDeck2(array $selection, array $drawnumber, int $gameId): array
    {

        $count = 0;
        $gameids = [];
        $data = [
            647 => [1, 1],
            653 => [1, 1, 1],
            648 => [2, 2],
            654 => [2, 2, 2],
            649 => [3, 3],
            655 => [3, 3, 3],
            650 => [4, 4],
            656 => [4, 4, 4],
            651 => [5, 5],
            657 => [5, 5, 5],
            652 => [6, 6],
            658 => [6, 6, 6]
        ];

        if (self::findPattern([2, 1], $drawnumber) && count(array_intersect($data[$selection[0]], $drawnumber)) == 2) {
            $count++;
            $gameids[] = $selection[0];
        } else if (self::findPattern([3], $drawnumber) && count(array_intersect($data[$selection[0]], $drawnumber)) == 3) {
            $count++;
            $gameids[] = $selection[0];
        }

        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    //----------------------------------------------------------------

}
