<?php

//declare(strict_types=1);
class FiveD extends GamePlayFunctionFiveD
{
    public static function getGamePlayMethod(): array
    { //////////// THE INVOKE METHOD
        return parent::getGamePlayFunction(); ///////////////////////////////////////////
    } ///////////////////////////////////////////////////////////////////////////////////

    // Helper functions // ----------------------------------->
    public static function findPattern(array $pattern, array $drawNumbers, int $index, int $slice, bool $flag = false): bool
    { // find patterns in drawsNumbers
        $drawNumbers = !$flag ? array_count_values(array_slice($drawNumbers, $index, $slice)) :
            array_count_values(array_slice($drawNumbers, $slice));
        sort($drawNumbers);
        sort($pattern);
        return $drawNumbers === $pattern;
    }

    public static function DT(int $idx1, int $idx2, array $drawNumber): int
    { // dragon|tiger|tie pattern
        $drawNumber = explode(",", implode(",", $drawNumber));
        $v1 = $drawNumber[$idx1];
        $v2 = $drawNumber[$idx2];
        return ($v1 > $v2) ? 1 : (($v1 == $v2) ? 3 : 2);
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

    //check if is bull
    public static function bullChecker(array $drawnumber, array $targetSums): array
    {
        $n = count($drawnumber);

        for ($i = 0; $i < $n - 2; $i++) {
            for ($j = $i + 1; $j < $n - 1; $j++) {
                for ($k = $j + 1; $k < $n; $k++) {
                    $sum = $drawnumber[$i] + $drawnumber[$j] + $drawnumber[$k];
                    if (in_array($sum, $targetSums)) {
                        return [$drawnumber[$i], $drawnumber[$j], $drawnumber[$k]];
                    }
                }
            }
        }

        return []; // Return null if no combination is found
    }

    public static function getBullNumber(array $bullNumber, array $drawnumber)
    {
        $diff = array_diff($drawnumber, $bullNumber);
        return (int) (array_sum($diff) % 10);
    }


    public static function checkOddOrEven(array $drawNumbers, $index, $slice)
    {
        $drawNumber = array_slice($drawNumbers, $index, $slice);
        $tenThousand = $drawNumber[0] % 2 == 1 ? 'Odd' : 'Even';
        $Thousand = $drawNumber[1] % 2 == 1 ? 'Odd' : 'Even';

        return $tenThousand . ' ' . $Thousand;
    }

    function getHead($number) {
        return (int) ($number / 10);
    }

    function getTail($number) {
        return (int) ($number % 10);
    }


    // All_5 // ----------------------------------->

    public static function all5_straight_joint(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        if (
            in_array($drawnumber[0], $selection[0]) &&
            in_array($drawnumber[1], $selection[1]) &&
            in_array($drawnumber[2], $selection[2]) &&
            in_array($drawnumber[3], $selection[3]) &&
            in_array($drawnumber[4], $selection[4])
        ) {
            $count = 1;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function all5_straight_manual(array $selection, array $drawnumber, int $gameId = null): array
    {
        $gameIds = [];
        if (in_array($drawnumber, $selection)) {
            $gameIds[] = $gameId;
        }
        return [
            'numwins' => count($gameIds),
            'gameids' => $gameIds,
            'status' => $gameIds ? 2 : 3,
        ];
    }

    public static function all5_straight_combo(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = array_reduce(range(0, 4), fn($carry, $i) => $carry + (int) in_array($drawnumber[$i], $selection[$i]), 0);
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => [$count],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function all5_group_120(array $selection, array $drawnumber, int $gameId = null): array
    {
        //$selected = $selection[0];
        sort($selection);
        sort($drawnumber);
        $count = count(array_intersect($selection[0], $drawnumber)) == 5 ? 1 : 0;
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function all5_group_60(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        if (
            self::findPattern([2, 1, 1, 1], $drawnumber, 0, 5) &&
            in_array(max(array_count_values($drawnumber)), $selection[0]) &&
            count(array_intersect($selection[1], array_values(array_diff($drawnumber, [max(array_count_values($drawnumber))])))) == 3
        ) {
            $count = 1;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function all5_group_30(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $val = array_count_values($drawnumber);
        if (self::findPattern([2, 2, 1], $drawnumber, 0, 5)) {
            $arr = array_values(array_diff($drawnumber, [array_search(min($val), $val)]));
            if (
                in_array(array_search(min($val), $val), $selection[1]) &&
                count(array_intersect(array_unique($arr), $selection[0])) == 2
            ) {
                $count = 1;
            }
            ;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function all5_group_20(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $val = array_count_values($drawnumber);
        if (self::findPattern([3, 1, 1], $drawnumber, 0, 5)) {
            $arr = array_values(array_diff($drawnumber, [array_search(max($val), $val)]));
            if (
                in_array(array_search(max($val), $val), $selection[0]) &&
                count(array_intersect($arr, $selection[1])) == 2
            ) {
                $count = 1;
            }
            ;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function all5_group_10(array $selection, array $drawnumber, int $gameId = null)
    {
        $count = 0;
        $val = array_count_values($drawnumber);
        if (self::findPattern([3, 2], $drawnumber, 0, 5)) {
            //$arr = array_values(array_diff($drawnumber, [array_search(max($val), $val)]));
            if (
                in_array(array_search(max($val), $val), $selection[0]) &&
                in_array(array_search(min($val), $val), $selection[1])
            ) {
                $count = 1;
            }
            ;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function all5_group_5(array $selection, array $drawnumber, int $gameId = null)
    {
        $count = 0;
        $val = array_count_values($drawnumber);
        if (self::findPattern([4, 1], $drawnumber, 0, 5)) {
            //$arr = array_values(array_diff($drawnumber, [array_search(max($val), $val)]));
            if (
                in_array(array_search(max($val), $val), $selection[0]) &&
                in_array(array_search(min($val), $val), $selection[1])
            ) {
                $count = 1;
            }
            ;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    // All_4 // ---------------------------------------->

    public static function all4_first4_straight_joint(array $selection, array $drawnumber, int $gameId = null): array
    {
        $gameIds = [];
        if (
            in_array($drawnumber[0], $selection[0]) &&
            in_array($drawnumber[1], $selection[1]) &&
            in_array($drawnumber[2], $selection[2]) &&
            in_array($drawnumber[3], $selection[3])
        ) {
            $gameIds[] = $gameId;
        }
        return [
            'numwins' => count($gameIds),
            'gameids' => $gameIds,
            'status' => $gameIds ? 2 : 3,
        ];
    }

    public static function all4_first4_straight_manual(array $selection, array $drawnumber, int $gameId = null): array
    {
        $gameIds = [];
        if (in_array($drawnumber, $selection)) {
            $gameIds[] = $gameId;
        }
        return [
            'numwins' => count($gameIds),
            'gameids' => $gameIds,
            'status' => $gameIds ? 2 : 3,
        ];
    }

    public static function all4_first4_straight_combo(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = array_reduce(range(0, 3), fn($carry, $i) => $carry + (int) in_array($drawnumber[$i], $selection[$i]), 0);
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => [$count],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function all4_last4_straight_joint(array $selection, array $drawnumber, int $gameId = null): array
    {
        $gameIds = [];
        if (
            in_array($drawnumber[1], $selection[0]) &&
            in_array($drawnumber[2], $selection[1]) &&
            in_array($drawnumber[3], $selection[2]) &&
            in_array($drawnumber[4], $selection[3])
        ) {
            $gameIds[] = $gameId;
        }
        return [
            'numwins' => count($gameIds),
            'gameids' => $gameIds,
            'status' => $gameIds ? 2 : 3,
        ];
    }

    public static function all4_last4_straight_manual(array $selection, array $drawnumber, int $gameId = null): array
    {
        $gameIds = [];
        if (in_array($drawnumber, $selection)) {
            $gameIds[] = $gameId;
        }
        return [
            'numwins' => count($gameIds),
            'gameids' => $gameIds,
            'status' => $gameIds ? 2 : 3,
        ];
    }

    public static function all4_last4_straight_combo(array $selection, array $drawnumber, int $gameId = null): array
    {

        $drawNumbers = array_slice($drawnumber, 0, 4);
        $count = array_reduce(range(0, 3), fn($carry, $i) => $carry + (int) in_array($drawNumbers[$i], $selection[$i]), 0);
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => [$count],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function all4_first4_group_24(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        if (self::findPattern([1, 1, 1, 1], $drawnumber, 0, 4)) {
            if (count(array_intersect(array_slice($drawnumber, 0, 4), $selection[0])) == 4) {
                $count = 1;
            }
        }
        //return count(array_intersect(array_slice($drawnumber, 0, 4),$selection[0]));
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function all4_first4_group_12(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        if (self::findPattern([2, 1, 1], $drawnumber, 0, 4)) {
            $val = array_count_values(array_slice($drawnumber, 0, 4));
            $arr = array_values(array_diff(array_slice($drawnumber, 0, 4), [array_search(max($val), $val)]));
            if (in_array(array_search(min($val), $val), $selection[0]) && array_intersect(array_unique($arr), $selection[1])) {
                $count = 1;
            }
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function all4_first4_group_6(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        if (self::findPattern([2, 2], $drawnumber, 0, 4)) {
            if (array_intersect(array_unique(array_slice($drawnumber, 0, 4)), $selection[0])) {
                $count = 1;
            }
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function all4_first4_group_4(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        if (self::findPattern([3, 1], $drawnumber, 0, 4)) {
            $val = array_count_values(array_slice($drawnumber, 0, 4));
            $arr = array_values(array_diff(array_slice($drawnumber, 0, 4), [array_search(max($val), $val)]));
            if (in_array(array_search(max($val), $val), $selection[0]) && count(array_intersect($arr, $selection[1])) == 1) {
                $count = 1;
            }
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function all4_last4_group_24(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        unset($drawnumber[0]);
        if (self::findPattern([1, 1, 1, 1], $drawnumber, 0, 4)) {
            if (count(array_intersect(array_slice($drawnumber, 0, 4), $selection[0])) == 4) {
                $count = 1;
            }
        }
        //return count(array_intersect(array_slice($drawnumber, 0, 4),$selection[0]));
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function all4_last4_group_12(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        unset($drawnumber[0]);
        if (self::findPattern([2, 1, 1], $drawnumber, 0, 4)) {
            $val = array_count_values(array_slice($drawnumber, 0, 4));
            $arr = array_values(array_diff(array_slice($drawnumber, 0, 4), [array_search(max($val), $val)]));
            if (in_array(array_search(min($val), $val), $selection[0]) && array_intersect(array_unique($arr), $selection[1])) {
                $count = 1;
            }
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function all4_last4_group_6(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        unset($drawnumber[0]);
        if (self::findPattern([2, 2], $drawnumber, 0, 4)) {
            if (array_intersect(array_unique(array_slice($drawnumber, 0, 4)), $selection[0])) {
                $count = 1;
            }
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function all4_last4_group_4(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        unset($drawnumber[0]);
        if (self::findPattern([3, 1], $drawnumber, 0, 4)) {
            $val = array_count_values($drawnumber);
            $arr = array_values(array_diff($drawnumber, [array_search(max($val), $val)]));
            if (in_array(array_search(max($val), $val), $selection[0]) && count(array_intersect($arr, $selection[1])) == 1) {
                $count = 1;
            }
            //return $arr;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    // first3 // ---------------------------------------->

    public static function first3_first3_straight_joint(array $selection, array $drawnumber, int $gameId = null): array
    {
        $gameIds = [];
        if (
            in_array($drawnumber[0], $selection[0]) &&
            in_array($drawnumber[1], $selection[1]) &&
            in_array($drawnumber[2], $selection[2])
        ) {
            $gameIds[] = $gameId;
        }
        return [
            'numwins' => count($gameIds),
            'gameids' => $gameIds,
            'status' => $gameIds ? 2 : 3,
        ];
    }

    public static function first3_first3_straight_manual(array $selection, array $drawnumber, int $gameId = null): array
    {
        $gameIds = [];
        if (in_array($drawnumber, $selection)) {
            $gameIds[] = $gameId;
        }
        return [
            'numwins' => count($gameIds),
            'gameids' => $gameIds,
            'status' => $gameIds ? 2 : 3,
        ];
    }

    public static function first3_first3_straight_combo(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = array_reduce(range(0, 2), fn($carry, $i) => $carry + (int) in_array($drawnumber[$i], $selection[$i]), 0);
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function first3_sum_of_first3(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = in_array(array_sum(array_slice($drawnumber, 0, 3)), $selection[0]) ? 1 : 0;
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function first3_span_of_first3(array $selection, array $drawnumber, int $gameId = null)
    {
        $draws = array_slice($drawnumber, 0, 3);
        $counter = max($draws) - min($draws);
        $count = in_array($counter, $selection[0]) ? 1 : 0;
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function first3_first3_group_3(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        if (self::findPattern([2, 1], $drawnumber, 0, 3)) {
            $val = array_count_values(array_slice($drawnumber, 0, 3));
            $arr = array_values(array_diff(array_slice($drawnumber, 0, 3), [array_search(max($val), $val)]));
            if (in_array(array_search(max($val), $val), $selection[0]) && count(array_intersect($arr, $selection[0])) == 1) {
                $count = 1;
            }
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function first3_first3_group_6(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        if (self::findPattern([1, 1, 1], $drawnumber, 0, 3)) {
            if (count(array_intersect(array_slice($drawnumber, 0, 3), $selection[0])) == 3) {
                $count = 1;
            }
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    // needs touching
    public static function first3_first3_group_combo_manual(array $selection, array $drawnumber, int $gameId = null): array
    {
        $gameIds = [];
        if (in_array($drawnumber, $selection)) {
            $gameIds[] = $gameId;
        }
        return [
            'numwins' => count($gameIds),
            'gameids' => $gameIds,
            'status' => $gameIds ? 2 : 3,
        ];
    }

    public static function first3_first3_sum_of_group(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        if (self::findPattern([1, 1, 1], $drawnumber, 0, 3) && in_array(array_sum(array_slice($drawnumber, 0, 3)), $selection[0])) {
            $count = 30;
        } else if (self::findPattern([2, 1], $drawnumber, 0, 3) && in_array(array_sum(array_slice($drawnumber, 0, 3)), $selection[0])) {
            $count = 29;
        }

        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$count] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function first3_first3_group3_manual(array $selection, array $drawnumber, int $gameId = null): array
    {
        $gameIds = [];
        if (in_array($drawnumber, $selection)) {
            $gameIds[] = $gameId;
        }
        return [
            'numwins' => count($gameIds),
            'gameids' => $gameIds,
            'status' => $gameIds ? 2 : 3,
        ];
    }

    public static function first3_first3_group6_manual(array $selection, array $drawnumber, int $gameId = null): array
    {
        $gameIds = [];
        if (in_array($drawnumber, $selection)) {
            $gameIds[] = $gameId;
        }
        return [
            'numwins' => count($gameIds),
            'gameids' => $gameIds,
            'status' => $gameIds ? 2 : 3,
        ];
    }

    public static function first3_first3_fixed_digit(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $val = array_count_values(array_slice($drawnumber, 0, 3));
        if (self::findPattern([1, 1, 1], $drawnumber, 0, 3) && in_array($selection[0][0], array_slice($drawnumber, 0, 3))) {
            $count = 30;
        } else if (self::findPattern([2, 1], $drawnumber, 0, 3) && in_array(array_search(max($val), $val), $selection[0])) {
            $count = 29;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$count] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function first3_first3_sum_tail(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $val = array_count_values(array_slice($drawnumber, 0, 3));
        $drawnumber = array_slice($drawnumber, 0, 3);
        unset($drawnumber[0]);
        if (in_array(array_sum($drawnumber), $selection[0])) {
            $count = 1;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    // mid3 // ---------------------------------------->

    public static function mid3_straight_joint(array $selection, array $drawnumber, int $gameId = null): array
    {
        $gameIds = [];
        if (
            in_array($drawnumber[1], $selection[0]) &&
            in_array($drawnumber[2], $selection[1]) &&
            in_array($drawnumber[3], $selection[2])
        ) {
            $gameIds[] = $gameId;
        }
        return [
            'numwins' => count($gameIds),
            'gameids' => $gameIds,
            'status' => $gameIds ? 2 : 3,
        ];
    }

    public static function mid3_manual(array $selection, array $drawnumber, int $gameId = null): array
    {
        $gameIds = [];
        if (in_array($drawnumber, $selection)) {
            $gameIds[] = $gameId;
        }
        return [
            'numwins' => count($gameIds),
            'gameids' => $gameIds,
            'status' => $gameIds ? 2 : 3,
        ];
    }

    public static function mid3_combo(array $selection, array $drawnumber, int $gameId = null): array
    {
        $drawnumber = array_slice($drawnumber, 1, 3);
        $count = array_reduce(range(0, 2), fn($carry, $i) => $carry + (int) in_array($drawnumber[$i], $selection[$i]), 0);
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$count] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function mid3_sum(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = in_array(array_sum(array_slice($drawnumber, 1, 3)), $selection[0]) ? 1 : 0;
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function mid3_span(array $selection, array $drawnumber, int $gameId = null): array
    {
        $draws = array_slice($drawnumber, 1, 3);
        $counter = max($draws) - min($draws);
        $count = in_array($counter, $selection[0]) ? 1 : 0;
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function mid3_group_3(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        if (self::findPattern([2, 1], $drawnumber, 1, 3)) {
            $val = array_count_values(array_slice($drawnumber, 0, 3));
            $arr = array_values(array_diff(array_slice($drawnumber, 1, 3), [array_search(max($val), $val)]));
            if (in_array(array_search(max($val), $val), $selection[0]) && count(array_intersect($arr, $selection[0])) == 1) {
                $count = 1;
            }
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function mid3_group_6(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        if (self::findPattern([1, 1, 1], $drawnumber, 1, 3)) {
            if (count(array_intersect(array_slice($drawnumber, 1, 3), $selection[0])) == 3) {
                $count = 1;
            }
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function mid3_group_combo_manual(array $selection, array $drawnumber, int $gameId = null): array
    {
        $gameIds = [];
        if (in_array($drawnumber, $selection)) {
            $gameIds[] = $gameId;
        }
        return [
            'numwins' => count($gameIds),
            'gameids' => $gameIds,
            'status' => $gameIds ? 2 : 3,
        ];
    }

    public static function mid3_sum_of_group(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        if (self::findPattern([1, 1, 1], $drawnumber, 1, 3) && in_array(array_sum(array_slice($drawnumber, 1, 3)), $selection[0])) {
            $count = 30;
        } else if (self::findPattern([2, 1], $drawnumber, 1, 3) && in_array(array_sum(array_slice($drawnumber, 1, 3)), $selection[0])) {
            $count = 29;
        }

        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$count] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function mid3_group3_manual(array $selection, array $drawnumber, int $gameId = null): array
    {
        $gameIds = [];
        if (in_array($drawnumber, $selection)) {
            $gameIds[] = $gameId;
        }
        return [
            'numwins' => count($gameIds),
            'gameids' => $gameIds,
            'status' => $gameIds ? 2 : 3,
        ];
    }

    public static function mid3_group6_manual(array $selection, array $drawnumber, int $gameId = null): array
    {
        $gameIds = [];
        if (in_array($drawnumber, $selection)) {
            $gameIds[] = $gameId;
        }
        return [
            'numwins' => count($gameIds),
            'gameids' => $gameIds,
            'status' => $gameIds ? 2 : 3,
        ];
    }

    public static function mid_fixed_digit(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $val = array_count_values(array_slice($drawnumber, 0, 3));
        if (self::findPattern([1, 1, 1], $drawnumber, 1, 3) && in_array($selection[0][0], array_slice($drawnumber, 1, 3))) {
            $count = 30;
        } else if (self::findPattern([2, 1], $drawnumber, 1, 3) && in_array(array_search(max($val), $val), $selection[0])) {
            $count = 29;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$count] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function mid3_sum_tail(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $val = array_count_values(array_slice($drawnumber, 1, 3));
        $drawnumber = array_slice($drawnumber, 1, 3);
        unset($drawnumber[0]);
        if (in_array(array_sum($drawnumber), $selection[0])) {
            $count = 1;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    // last3 // ---------------------------------------->

    public static function last3_straight_joint(array $selection, array $drawnumber, int $gameId = null): array
    {
        $gameIds = [];
        if (
            in_array($drawnumber[2], $selection[0]) &&
            in_array($drawnumber[3], $selection[1]) &&
            in_array($drawnumber[4], $selection[2])
        ) {
            $gameIds[] = $gameId;
        }
        return [
            'numwins' => count($gameIds),
            'gameids' => $gameIds,
            'status' => $gameIds ? 2 : 3,
        ];
    }

    public static function last3_straight_manual(array $selection, array $drawnumber, int $gameId = null): array
    {
        $gameIds = [];
        if (in_array($drawnumber, $selection)) {
            $gameIds[] = $gameId;
        }
        return [
            'numwins' => count($gameIds),
            'gameids' => $gameIds,
            'status' => $gameIds ? 2 : 3,
        ];
    }

    public static function last3_straight_combo(array $selection, array $drawnumber, int $gameId = null): array
    {
        $drawnumber = array_slice($drawnumber, -3);
        $count = array_reduce(range(0, 2), fn($carry, $i) => $carry + (int) in_array($drawnumber[$i], $selection[$i]), 0);
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$count] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function last3_sum(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = in_array(array_sum(array_slice($drawnumber, -3)), $selection[0]) ? 1 : 0;
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function last3_span(array $selection, array $drawnumber, int $gameId = null): array
    {
        $draws = array_slice($drawnumber, -3);
        $counter = max($draws) - min($draws);
        $count = in_array($counter, $selection[0]) ? 1 : 0;
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function last3_group_3(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        if (self::findPattern([2, 1], $drawnumber, 0, 3, true)) {
            $val = array_count_values(array_slice($drawnumber, -3));
            $arr = array_values(array_diff(array_slice($drawnumber, -3), [array_search(max($val), $val)]));
            if (in_array(array_search(max($val), $val), $selection[0]) && count(array_intersect($arr, $selection[0])) == 1) {
                $count = 1;
            }
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function last3_group_6(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        if (self::findPattern([1, 1, 1], $drawnumber, 1, 3, true)) {
            if (count(array_intersect(array_slice($drawnumber, 1, -3), $selection[0])) == 3) {
                $count = 1;
            }
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function last3_group_combo_manual(array $selection, array $drawnumber, int $gameId = null): array
    {
        $gameIds = [];
        if (in_array($drawnumber, $selection)) {
            $gameIds[] = $gameId;
        }
        return [
            'numwins' => count($gameIds),
            'gameids' => $gameIds,
            'status' => $gameIds ? 2 : 3,
        ];
    }

    public static function last3_sum_of_group(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        if (self::findPattern([1, 1, 1], $drawnumber, 0, 3, true) && in_array(array_sum(array_slice($drawnumber, -3)), $selection[0])) {
            $count = 30;
        } else if (self::findPattern([2, 1], $drawnumber, 0, 3, true) && in_array(array_sum(array_slice($drawnumber, -3)), $selection[0])) {
            $count = 29;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$count] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function last3_group3_manual(array $selection, array $drawnumber, int $gameId = null): array
    {
        $gameIds = [];
        if (in_array($drawnumber, $selection)) {
            $gameIds[] = $gameId;
        }
        return [
            'numwins' => count($gameIds),
            'gameids' => $gameIds,
            'status' => $gameIds ? 2 : 3,
        ];
    }

    public static function last3_group6_manual(array $selection, array $drawnumber, int $gameId = null): array
    {
        $gameIds = [];
        if (in_array($drawnumber, $selection)) {
            $gameIds[] = $gameId;
        }
        return [
            'numwins' => count($gameIds),
            'gameids' => $gameIds,
            'status' => $gameIds ? 2 : 3,
        ];
    }


    public static function last3_fixed_digit(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $val = array_count_values(array_slice($drawnumber, -3));
        if (self::findPattern([1, 1, 1], $drawnumber, 1, 3, true) && in_array($selection[0][0], array_slice($drawnumber, -3))) {
            $count = 30;
        } else if (self::findPattern([2, 1], $drawnumber, 1, 3, true) && in_array(array_search(max($val), $val), $selection[0])) {
            $count = 29;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$count] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function last3_sum_tail(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $val = array_count_values(array_slice($drawnumber, -3));
        $drawnumber = array_slice($drawnumber, -3);
        unset($drawnumber[0]);
        if (in_array(array_sum($drawnumber), $selection[0])) {
            $count = 1;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    //first two // ---------------------------------------->

    public static function first2_straight_joint(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        if (
            in_array($drawnumber[0], $selection[0]) &&
            in_array($drawnumber[1], $selection[1])
        ) {
            $count = 1;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function first2_straight_manual(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        if (in_array($drawnumber, $selection[0])) {
            $count = 1;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function first2_sum_of_first2(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = in_array(array_sum(array_slice($drawnumber, 0, 2)), $selection[0]) ? 1 : 0;
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function first2_span_of_first2(array $selection, array $drawnumber, int $gameId = null): array
    {
        $draws = array_slice($drawnumber, 0, 2);
        $counter = max($draws) - min($draws);
        $count = in_array($counter, $selection[0]) ? 1 : 0;
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function first2_group_joint(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $drawnumber = array_slice($drawnumber, 0, 2);
        if (count(array_intersect($drawnumber, $selection[0])) == 2) {
            $count = 1;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function first2_group_manual(array $selection, array $drawnumber, int $gameId = null): array
    {
        $gameIds = [];
        if (in_array($drawnumber, $selection)) {
            $gameIds[] = $gameId;
        }
        return [
            'numwins' => count($gameIds),
            'gameids' => $gameIds,
            'status' => $gameIds ? 2 : 3,
        ];
    }

    public static function first2_sum_of_group(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = in_array(array_sum(array_slice($drawnumber, 0, 2)), $selection[0]) ? 1 : 0;
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function first2_fixed_digit(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        if (self::findPattern([1, 1], $drawnumber, 0, 2) && in_array(array_sum(array_slice($drawnumber, 0, 2)), $selection[0])) {
            $count = 1;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    //last2// ------------------------------>

    public static function last2_straight_joint(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        if (
            in_array($drawnumber[3], $selection[0]) &&
            in_array($drawnumber[4], $selection[1])
        ) {
            $count = 1;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function last2_straight_manual(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        if (in_array($drawnumber, $selection[0])) {
            $count = 1;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function last2_sum_of_last2(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = in_array(array_sum(array_slice($drawnumber, -2)), $selection[0]) ? 1 : 0;
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function last2_span_of_last2(array $selection, array $drawnumber, int $gameId = null): array
    {
        $draws = array_slice($drawnumber, -2);
        $counter = max($draws) - min($draws);
        $count = in_array($counter, $selection[0]) ? 1 : 0;
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function last2_group_joint(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $drawnumber = array_slice($drawnumber, -2);
        if (count(array_intersect($drawnumber, $selection[0])) == 2) {
            $count = 1;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function last2_group_manual(array $selection, array $drawnumber, int $gameId = null): array
    {
        $gameIds = [];
        if (in_array($drawnumber, $selection)) {
            $gameIds[] = $gameId;
        }
        return [
            'numwins' => count($gameIds),
            'gameids' => $gameIds,
            'status' => $gameIds ? 2 : 3,
        ];
    }

    public static function last2_sum_of_group(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = in_array(array_sum(array_slice($drawnumber, -2)), $selection[0]) ? 1 : 0;
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function last2_fixed_digit(array $selection, array $drawnumber, int $gameId = null)
    {
        $count = 0;
        if (self::findPattern([1, 1], $drawnumber, 0, 2, true) && in_array($selection[0][0], array_slice($drawnumber, -2))) {
            $count = 1;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    //fixed place// -------------------------> also supports many tables

    public static function fixed_place(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $count = array_reduce(range(0, 4), fn($carry, $i) => $carry + (int) in_array($drawnumber[$i], $selection[$i]), 0);
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? array_fill(0, $count, $gameId) : [],
            'status' => $count ? 2 : 3,
        ];
    }
    //any place// --------------------------->

    public static function any_place_1x3_first3(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $drawnumber = array_slice($drawnumber, 0, 3);
        $draws = array_unique($drawnumber);
        if (count(array_intersect($draws, $selection[0])) >= 1) {
            $count = 1;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function any_place_2x3_first3(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $drawnumber = array_slice($drawnumber, 0, 3);
        $draws = array_unique($drawnumber);
        if (count(array_intersect($draws, $selection[0])) >= 2) {
            $count = 1;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function any_place_1x3_mid3(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $drawnumber = array_slice($drawnumber, 1, 3);
        $draws = array_unique($drawnumber);
        if (count(array_intersect($draws, $selection[0])) >= 1) {
            $count = 1;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function any_place_2x3_mid3(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $drawnumber = array_slice($drawnumber, 1, 3);
        $draws = array_unique($drawnumber);
        if (count(array_intersect($draws, $selection[0])) >= 2) {
            $count = 1;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function any_place_1x3_last3(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $drawnumber = array_slice($drawnumber, -3);
        $draws = array_unique($drawnumber);
        if (count(array_intersect($draws, $selection[0])) >= 1) {
            $count = 1;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function any_place_2x3_last3(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $drawnumber = array_slice($drawnumber, -3);
        $draws = array_unique($drawnumber);
        if (count(array_intersect($draws, $selection[0])) >= 2) {
            $count = 1;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }


    public static function any_place_1x4_first4(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $drawnumber = array_slice($drawnumber, 0, 4);
        $draws = array_unique($drawnumber);
        if (count(array_intersect($draws, $selection[0])) >= 1) {
            $count = 1;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function any_place_2x4_first4(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $drawnumber = array_slice($drawnumber, 0, 4);
        $draws = array_unique($drawnumber);
        if (count(array_intersect($draws, $selection[0])) >= 2) {
            $count = 1;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }


    public static function any_place_3x4_first4(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $drawnumber = array_slice($drawnumber, 0, 4);
        $draws = array_unique($drawnumber);
        if (count(array_intersect($draws, $selection[0])) >= 3) {
            $count = 1;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function any_place_1x4_last4(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $drawnumber = array_slice($drawnumber, -4);
        $draws = array_unique($drawnumber);
        if (count(array_intersect($draws, $selection[0])) >= 1) {
            $count = 1;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function any_place_2x4_last4(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $drawnumber = array_slice($drawnumber, -4);
        $draws = array_unique($drawnumber);
        if (count(array_intersect($draws, $selection[0])) >= 2) {
            $count = 1;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function any_place_3x4_last4(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $drawnumber = array_slice($drawnumber, -4);
        $draws = array_unique($drawnumber);
        if (count(array_intersect($draws, $selection[0])) >= 3) {
            $count = 1;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function any_place_1x5_first5(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $drawnumber = array_slice($drawnumber, 0, 5);
        $draws = array_unique($drawnumber);
        if (count(array_intersect($draws, $selection[0])) >= 1) {
            $count = 1;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function any_place_2x5_first5(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $drawnumber = array_slice($drawnumber, 0, 5);
        $draws = array_unique($drawnumber);
        if (count(array_intersect($draws, $selection[0])) >= 2) {
            $count = 1;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function any_place_3x5_first5(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $drawnumber = array_slice($drawnumber, 0, 5);
        $draws = array_unique($drawnumber);
        if (count(array_intersect($draws, $selection[0])) >= 3) {
            $count = 1;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    //b s o e// --------------------------->

    public static function bsoe_first2(array $selection, array $drawnumber, int $gameId = null): array
    {
        $data = [
            '1' => range(5, 9), // big
            '2' => range(0, 4), // small
            '3' => range(1, 7, 2), // odd
            '4' => range(0, 8, 2), // even
        ];
        $count1 = count(array_filter($selection[0], fn($sel) => in_array($drawnumber[0], $data[$sel])));
        $count2 = count(array_filter($selection[1], fn($sel) => in_array($drawnumber[1], $data[$sel])));
        $count = $count1 * $count2;
        return [
            'numwins' => $count ?: 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function bsoe_first3(array $selection, array $drawnumber, int $gameId = null): array
    {
        $data = [
            '1' => range(5, 9), // big
            '2' => range(0, 4), // small
            '3' => range(1, 7, 2), // odd
            '4' => range(0, 8, 2), // even
        ];
        $count1 = count(array_filter($selection[0], fn($sel) => in_array($drawnumber[0], $data[$sel])));
        $count2 = count(array_filter($selection[1], fn($sel) => in_array($drawnumber[1], $data[$sel])));
        $count3 = count(array_filter($selection[2], fn($sel) => in_array($drawnumber[2], $data[$sel])));
        $count = $count1 * $count2 * $count3;
        return [
            'numwins' => $count ?: 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function bsoe_last2(array $selection, array $drawnumber, int $gameId = null): array
    {
        $data = [
            '1' => range(5, 9), // big
            '2' => range(0, 4), // small
            '3' => range(1, 7, 2), // odd
            '4' => range(0, 8, 2), // even
        ];
        $count1 = count(array_filter($selection[0], fn($sel) => in_array($drawnumber[3], $data[$sel])));
        $count2 = count(array_filter($selection[1], fn($sel) => in_array($drawnumber[4], $data[$sel])));
        $count = $count1 * $count2;
        return [
            'numwins' => $count ?: 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function bsoe_last3(array $selection, array $drawnumber, int $gameId = null): array
    {
        $data = [
            '1' => range(5, 9), // big
            '2' => range(0, 4), // small
            '3' => range(1, 7, 2), // odd
            '4' => range(0, 8, 2), // even
        ];
        $count1 = count(array_filter($selection[0], fn($sel) => in_array($drawnumber[2], $data[$sel])));
        $count2 = count(array_filter($selection[1], fn($sel) => in_array($drawnumber[3], $data[$sel])));
        $count3 = count(array_filter($selection[2], fn($sel) => in_array($drawnumber[4], $data[$sel])));
        $count = $count1 * $count2 * $count3;
        return [
            'numwins' => $count ?: 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function bsoe_sum_all5(array $selection, array $drawnumber, int $gameId = null): array
    {
        $data = [
            '1' => range(23, 45), // big
            '2' => range(0, 22), // small
            '3' => range(1, 7, 2), // odd
            '4' => range(0, 8, 2), // even
        ];
        $sum = array_sum($drawnumber);
        $count = count(array_filter($selection[0], fn($sel) => in_array($sum, $data[$sel])));
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function bsoe_sum_all3(array $selection, array $drawnumber, int $gameId = null): array
    {
        $data = [
            '1' => range(14, 27), // big
            '2' => range(0, 13), // small
            '3' => range(1, 7, 2), // odd
            '4' => range(0, 8, 2), // even
        ];
        $sum = array_sum(array_slice($drawnumber, 0, 3));
        $count = count(array_filter($selection[0], fn($sel) => in_array($sum, $data[$sel])));
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    //fun// -------------------------------->

    public static function fun_one_hit(array $selection, array $drawnumber, int $gameId = null): array
    {

        $draw = array_unique($drawnumber);
        $count = count(array_intersect($draw, $selection[0])) >= 1 ? 1 : 0;
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function fun_two_hit(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $val = array_count_values($drawnumber);
        if (in_array(array_search(max($val), $val), $selection[0]) && max($val) >= 2) { // review
            $count = 1;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function fun_three_hit(array $selection, array $drawnumber, int $gameId = null): array
    { // review
        $count = 0;
        $val = array_count_values($drawnumber);
        if (in_array(array_search(max($val), $val), $selection[0]) && max($val) >= 3) {
            $count = 1;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function fun_four_hit(array $selection, array $drawnumber, int $gameId = null): array
    { // review
        $count = 0;
        $val = array_count_values($drawnumber);
        if (in_array(array_search(max($val), $val), $selection[0]) && max($val) >= 4) {
            $count = 1;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    //pick 2// ---------------------------->

    public static function pick2_joint(array $selection, array $drawnumber, int $gameId = null): array
    {
        $counts = [0, 0, 0, 0, 0];

        for ($i = 0; $i < 5; $i++) {
            if (in_array($drawnumber[$i], $selection[$i])) {
                $counts[$i]++;
            }
        }
        $count = array_reduce($counts, function ($carry, $item) {
            return $carry + ($item > 0 ? 1 : 0);
        }, 0);

        return [
            'numwins' => $count >= 2 ? 1 : 0,
            'gameids' => $count >= 2 ? [$gameId] : [],
            'status' => $count >= 2 ? 2 : 3,
        ];
    }

    //helper

    public static function pick2_manual(array $selection, array $drawnumber, int $gameId = null): array
    {

        $data = [
            '1' => $drawnumber[0],
            '2' => $drawnumber[1],
            '3' => $drawnumber[2],
            '4' => $drawnumber[3],
            '5' => $drawnumber[4]
        ];

        $balls = $selection[0];
        $targetSequence = $selection[1][0];
        $selectedSequence = array_map(fn($ball) => $data[$ball], $balls);
        $matches = 0;
        for ($i = 0; $i < min(count($selectedSequence), count($targetSequence)); $i++) {
            if ($selectedSequence[$i] === $targetSequence[$i]) {
                $matches++;
            }
        }

        $count = ($matches >= 2) ? 1 : 0;
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
        //manual
    }

    public static function pick2_sum(array $selection, array $drawnumber, int $gameId = null): array
    {
        $result = array_map(fn($position) => $drawnumber[$position - 1] ?? null, $selection[0]);
        $count = in_array(array_sum($result), $selection[1][0]) ? 1 : 0;
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];


    }

    public static function pick2__group_joint(array $selection, array $drawnumber, int $gameId = null): array
    {
        $result = array_map(fn($position) => $drawnumber[$position - 1] ?? null, $selection[0]);
        $count = count(array_intersect($result, $selection[1][0])) >= count($selection[0]) ? 1 : 0;
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function pick2_group_manual(array $selection, array $drawnumber, int $gameId = null): array
    {

        $result = array_map(fn($position) => $drawnumber[$position - 1] ?? null, $selection[0]);
        $count = count(array_intersect($result, $selection[1][0])) >= count($selection[0]) ? 1 : 0;
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
        //manual
    }

    public static function pick2_group_sum(array $selection, array $drawnumber, int $gameId = null): array
    {
        $result = array_map(fn($position) => $drawnumber[$position - 1] ?? null, $selection[0]);
        $count = 0;
        if (max(array_count_values($result)) != count($selection[0])) {
            $count = in_array(array_sum($result), $selection[1][0]) ? 1 : 0;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function pick2_fixed_digit(array $selection, array $drawnumber, int $gameId = null): array
    {
        $result = array_map(fn($position) => $drawnumber[$position - 1] ?? null, $selection[0]);
        $count = 0;
        if (max(array_count_values($result)) != count($selection[0])) {
            $count = array_intersect($result, $selection[1][0]) ? 1 : 0;
        }

        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];


    }


    //pick 3// ---------------------------->

    public static function pick3_joint(array $selection, array $drawnumber, int $gameId = null): array
    {
        $counts = [0, 0, 0, 0, 0];

        for ($i = 0; $i < 5; $i++) {
            if (in_array($drawnumber[$i], $selection[$i])) {
                $counts[$i]++;
            }
        }
        $count = array_reduce($counts, function ($carry, $item) {
            return $carry + ($item > 0 ? 1 : 0);
        }, 0);

        return [
            'numwins' => $count >= 3 ? 1 : 0,
            'gameids' => $count >= 3 ? [$gameId] : [],
            'status' => $count >= 3 ? 2 : 3,
        ];
    }

    public static function pick3_manual(array $selection, array $drawnumber, int $gameId = null): array
    {

        $data = [
            '1' => $drawnumber[0],
            '2' => $drawnumber[1],
            '3' => $drawnumber[2],
            '4' => $drawnumber[3],
            '5' => $drawnumber[4]
        ];

        $balls = $selection[0];
        $targetSequence = $selection[1][0];
        $selectedSequence = array_map(fn($ball) => $data[$ball], $balls);
        $matches = 0;
        for ($i = 0; $i < min(count($selectedSequence), count($targetSequence)); $i++) {
            if ($selectedSequence[$i] === $targetSequence[$i]) {
                $matches++;
            }
        }

        $count = ($matches >= 3) ? 1 : 0;
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
        //manual
    }

    public static function pick3_sum(array $selection, array $drawnumber, int $gameId = null): array
    {
        $result = array_map(fn($position) => $drawnumber[$position - 1] ?? null, $selection[0]);
        $count = in_array(array_sum($result), $selection[1][0]) ? 1 : 0;
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];


    }

    public static function pick3_group3(array $selection, array $drawnumber, int $gameId = null): array
    { //review
        $count = 0;
        $result = array_map(fn($position) => $drawnumber[$position - 1] ?? null, $selection[0]);
        if (in_array(2, array_count_values($result)) || in_array(3, array_count_values($result))) {
            $val = array_count_values($result);
            $values = array_values(array_diff($result, [array_search(max($val), $val)]));
            if (in_array(array_search(max($val), $val), $selection[1][0]) && array_intersect($values, $selection[1][0])) {
                $count = 1;
            }
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function pick3_group6(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $result = array_map(fn($position) => $drawnumber[$position - 1] ?? null, $selection[0]);
        if (count(array_intersect($result, $selection[1][0])) >= 3) {
            $count = 1;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function pick3_group_combo_manual(array $selection, array $drawnumber, int $gameId = null): array
    {

        $data = [
            '1' => $drawnumber[0],
            '2' => $drawnumber[1],
            '3' => $drawnumber[2],
            '4' => $drawnumber[3],
            '5' => $drawnumber[4]
        ];

        $balls = $selection[0];
        $count = 0;
        foreach ($balls as $ball) {
            if (in_array($data[$ball], $selection[1][0])) {
                $count++;
            }
        }
        $count = ($count >= 3);
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];

        //manual
    }

    public static function pick3_group_sum(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $result = array_map(fn($position) => $drawnumber[$position - 1] ?? null, $selection[0]);
        if (in_array(2, array_count_values($result))) {
            $count = in_array(array_sum($result), $selection[1][0]) ? 1 : 0;
        } else if (in_array(3, array_count_values($result))) {
            $count = 0;
        } else {
            $count = in_array(array_sum($result), $selection[1][0]) ? 2 : 0;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    //pick 4// ---------------------------->

    public static function pick4_joint(array $selection, array $drawnumber, int $gameId = null): array
    {
        $counts = [0, 0, 0, 0, 0];

        for ($i = 0; $i < 5; $i++) {
            if (in_array($drawnumber[$i], $selection[$i])) {
                $counts[$i]++;
            }
        }
        $count = array_reduce($counts, function ($carry, $item) {
            return $carry + ($item > 0 ? 1 : 0);
        }, 0);

        return [
            'numwins' => $count >= 4 ? 1 : 0,
            'gameids' => $count >= 4 ? [$gameId] : [],
            'status' => $count >= 4 ? 2 : 3,
        ];
    }

    public static function pick4_manual(array $selection, array $drawnumber, int $gameId = null): array
    {

        $data = [
            '1' => $drawnumber[0],
            '2' => $drawnumber[1],
            '3' => $drawnumber[2],
            '4' => $drawnumber[3],
            '5' => $drawnumber[4]
        ];
        $balls = $selection[0];
        $targetSequence = $selection[1][0];
        $selectedSequence = array_map(fn($ball) => $data[$ball], $balls);
        $matches = 0;
        for ($i = 0; $i < min(count($selectedSequence), count($targetSequence)); $i++) {
            if ($selectedSequence[$i] === $targetSequence[$i]) {
                $matches++;
            }
        }

        $count = ($matches >= 4) ? 1 : 0;
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
        //manual
    }

    public static function pick4_group24(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $result = array_map(fn($position) => $drawnumber[$position - 1] ?? null, $selection[0]);
        if (count(array_intersect($result, $selection[1][0])) >= 4) {
            $count = 1;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function pick4_group12(array $selection, array $drawnumber, int $gameId = null): array
    {
        $count = 0;
        $result = array_map(fn($position) => $drawnumber[$position - 1] ?? null, $selection[0]);
        if (in_array(2, array_count_values($result))) {
            $val = array_count_values($result);
            $values = array_values(array_diff($result, [array_search(max($val), $val)]));
            if (in_array(array_search(max($val), $val), $selection[1][0]) && count(array_intersect($values, $selection[2][0])) >= 2) {
                $count = 1;
            }
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function pick4_group6(array $selection, array $drawnumber, int $gameId = null)
    {
        $count = 0;
        $result = array_map(fn($position) => $drawnumber[$position - 1] ?? null, $selection[0]);
        $val = array_count_values($result);
        $filteredValues = array_filter($val, fn($count) => $count === 2);
        if (count(array_intersect(array_keys($filteredValues), $selection[1][0])) == 2) {
            $count = 1;
        }
        ;
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function pick4_group4(array $selection, array $drawnumber, int $gameId = null)
    {
        $count = 0;
        $result = array_map(fn($position) => $drawnumber[$position - 1] ?? null, $selection[0]);
        if (in_array(3, array_count_values($result))) {
            $val = array_count_values($result);
            $values = array_values(array_diff($result, [array_search(max($val), $val)]));
            if (in_array(array_search(max($val), $val), $selection[1][0]) && count(array_intersect($values, $selection[2][0])) >= 1) {
                $count = 1;
            }
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    //Dragon Tiger Tie// ---------------------------->

    public static function DragonTiger(array $selection, array $drawNumber, int $gameId)
    {
        $count = 0;
        $data = [
            '1v2' => self::DT(0, 1, $drawNumber),
            '1v3' => self::DT(0, 2, $drawNumber),
            '1v4' => self::DT(0, 3, $drawNumber),
            '1v5' => self::DT(0, 4, $drawNumber),
            '2v3' => self::DT(1, 2, $drawNumber),
            '2v4' => self::DT(1, 3, $drawNumber),
            '2v5' => self::DT(1, 4, $drawNumber),
            '3v4' => self::DT(2, 3, $drawNumber),
            '3v5' => self::DT(2, 4, $drawNumber),
            '4v5' => self::DT(3, 4, $drawNumber),
        ];
        $gameIds = [];
        foreach ($selection[0] as $key => $item) {
            $keyWon = $data[$key];
            foreach ($item as $value) {
                if ($keyWon == $value) {
                    $count++;
                    $gameIds[] = $value;
                    break;
                }
            }
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? $gameIds : [],
            'status' => $count ? 2 : 3,
        ];
    }

    //stud// ---------------------------->

    public static function stud(array $selection, array $drawNumber, int $gameIds)
    {

        $data = [
            4 => self::findPattern([4, 1], $drawNumber, 0, 5),
            5 => self::findPattern([3, 2], $drawNumber, 0, 5),
            6 => self::findStreakPattern($drawNumber, 0, 5, 4),
            7 => self::findPattern([3, 1, 1], $drawNumber, 0, 5),
            8 => self::findPattern([2, 2, 1], $drawNumber, 0, 5),
            9 => self::findPattern([2, 1, 1, 1], $drawNumber, 0, 5),
            10 => !self::findStreakPattern($drawNumber, 0, 5, 4) ? self::findPattern([1, 1, 1, 1, 1], $drawNumber, 0, 5) : null,
        ];
        $count = 0;
        $gameIds = [];
        foreach ($selection[0] as $select) {
            if ($data[$select] == true) {
                $count++;
                $gameIds[] = $select;
            }
        }

        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? $gameIds : [],
            'status' => $count ? 2 : 3,
        ];
    }

    //three card// ---------------------------->

    public static function three_card(array $selection, array $drawNumber, int $gameId)
    {

        $data = [
            'First 3' => [
                '11' => self::findPattern([3], $drawNumber, 0, 3),
                '12' => self::findStreakPattern($drawNumber, 0, 3, 2),
                '13' => self::findPattern([2, 1], $drawNumber, 0, 3),
                '14' => self::findStreakPattern($drawNumber, 0, 3, 2) || self::findStreakPattern($drawNumber, 0, 3, 1) ? null : self::findPattern([1, 1, 1], $drawNumber, 0, 3),
                '15' => self::findStreakPattern($drawNumber, 0, 3, 1),
            ],
            'Middle 3' => [
                '11' => self::findPattern([1, 1, 1], $drawNumber, 1, 3),
                '12' => self::findStreakPattern($drawNumber, 1, 3, 2),
                '13' => self::findPattern([2, 1], $drawNumber, 1, 3),
                '14' => self::findStreakPattern($drawNumber, 0, 3, 2) || self::findStreakPattern($drawNumber, 0, 3, 1) ? null : self::findPattern([1, 1, 1], $drawNumber, 0, 3),
                '15' => self::findStreakPattern($drawNumber, 1, 3, 1),
            ],
            'Last 3' => [
                '11' => self::findPattern([1, 1, 1], $drawNumber, 0, -3, true),
                '12' => self::findStreakPattern($drawNumber, 0, -3, 2, true),
                '13' => self::findPattern([2, 1], $drawNumber, 0, -3, true),
                '14' => self::findStreakPattern($drawNumber, 0, 3, 2, true) || self::findStreakPattern($drawNumber, 0, 3, 1) ? null : self::findPattern([1, 1, 1], $drawNumber, 0, 3),
                '15' => self::findStreakPattern($drawNumber, 0, -3, 1, true),
            ],
        ];

        $count = 0;
        $won = [];
        //$selected = json_decode($selection[0], true);
        foreach ($selection as $key => $select) {
            if (array_search(1, $data[$key])) {
                $count++;
                $won[] = array_search(1, $data[$key]); //[$select,$odds[$select]];
            }
        }

        return [
            'numwin' => $count ? $count : 0,
            'gameids' => $count ? $won : [],
            'status' => $count ? 2 : 3,
        ];
    }

    //Bull bull// ---------------------------->

    public static function bull_bull(array $selection, array $drawNumber, int $gameIds)
    {

        $gameids = [];
        $count = 0;
        $data = [
            '16' => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) > 4 : null, // bull big
            '17' => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) < 5 : null, // bull small
            '18' => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) % 2 != 0 : null, // bull odd
            '19' => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) % 2 == 0 : null, // bull even
            '20' => empty(self::bullChecker($drawNumber, [0, 10, 20])) ? true : false, // no bull
            '21' => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) == 1 : null, // bull 1
            '22' => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) == 2 : null, // bull 2
            '23' => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) == 3 : null, // bull 3
            '24' => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) == 4 : null, // bull 4
            '25' => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) == 5 : null, // bull 5
            '26' => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) == 6 : null, // bull 6
            '27' => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) == 7 : null, // bull 7
            '28' => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) == 8 : null, // bull 8
            '29' => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) == 9 : null, // bull 9
            '30' => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) == 0 : null // bull bull
        ];

        foreach ($selection[0] as $selection) {
            if ($data[$selection] == true) {
                $count++;
                $gameids[] = $selection;
            }
        }

        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3,
        ];
    }


    // end of 5D 


    // ******************************** Long Dragon ***********************


    public static function DTX(int $idx1, int $idx2, array $drawNumber): string
    { // dragon|tiger|tie pattern
        $drawNumber = explode(",", implode(",", $drawNumber));
        $v1 = $drawNumber[$idx1];
        $v2 = $drawNumber[$idx2];
        return ($v1 > $v2) ? 'Dragon' : (($v1 == $v2) ? 'Tie' : 'Tiger');
    }


    public static function GetBalls($gameId): int
    {
        $data = [
            '133,138, 144' => 1,
            '134,139, 145' => 2,
            '135,140,146' => 3,
            '136,141, 147' => 4,
            '137,142, 148' => 5,
            '143' => 5,
            '21' => 5,
            '22' => 5
        ];

        $found = [];
        foreach (array_keys($data) as $key) {
            if (in_array($gameId, explode(',', (string) $key))) {
                $found[] = $data[$key];
            }
        }
        return count($found) == 0 ? 1 : implode('', $found);
    }


    public static function long_dragon(array $selection, array $drawNumber, int $gameId): array
    {
        $count = 0;
        $refund = 0;
        // $gameId = $selection[1];
        $ball = self::GetBalls($gameId) - 1;
        $data = [
            '133,134,135,136,137' => ($drawNumber[$ball] > 5 && $selection[0] == 'Big') ? true : (($drawNumber[$ball] < 6 && $selection[0] == 'Small') ? true : false),
            '138,139,140,141,142' => ($drawNumber[$ball] % 2 != 0 && $selection[0] == 'Odd') ? true : (($drawNumber[$ball] % 2 == 0 && $selection[0] == 'Even') ? true : false),
            '143' => self::DTX(0, 4, $drawNumber) == $selection[0] ? true : false,
            '21, 149' => (array_sum($drawNumber) >= 23 && $selection[0] == 'Big') ? true : ((array_sum($drawNumber) <= 22 && $selection[0] == 'Small') ? true : false),
            '22, 150' => (array_sum($drawNumber) % 2 != 0 && $selection[0] == 'Odd') ? true : ((array_sum($drawNumber) % 2 == 0 && $selection[0] == 'Even') ? true : false),
            '15,16,17,18,19,144, 145, 146, 147, 148' => (in_array($drawNumber[$ball], [1, 2, 3, 5, 7]) && $selection[0] == 'Prime') ? true : ((in_array($drawNumber[$ball], [0, 4, 6, 8, 9]) && $selection[0] == 'Composite') ? true : false)
        ];

        if ($selection[1] == 14 && $drawNumber[0] == $drawNumber[4]) {
            $refund = 6;
        } else {
            foreach (array_keys($data) as $key) {
                if (in_array($gameId, explode(',', (string) $key))) {
                    if ($data[$key] == true) {
                        $count++;
                    }
                }
            }
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => ($count == 0 && $refund == 6) ? 6 : (($count >= 1 && $refund == 0) ? 2 : 3)
        ];
    }


    // RoadBet********************** Long Dragon ***********************************

    public static function SumAllDrawNumber(array $selection, array $drawNumber, int $gameId = null): array
    {
        $data = [
            'Big' => array_sum($drawNumber) >= 23 ? true : false,
            'Small' => array_sum($drawNumber) <= 22 ? true : false,
            'Even' => array_sum($drawNumber) % 2 == 0 ? true : false,
            'Odd' => array_sum($drawNumber) % 2 != 0 ? true : false,
            'Dragon' => self::DTX(0, 4, $drawNumber) == "Dragon" ? true : false,
            'Tiger' => self::DTX(0, 4, $drawNumber) == "Tiger" ? true : false,
            'Tie' => self::DTX(0, 4, $drawNumber) == "Tie" ? true : false
        ];
        $count = 0;
        if ($data[$selection[0]] == true) {
            $count = 1;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }


    public static function FirstBall(array $selection, array $drawNumber, int $gameId = null)
    {
        $data = [
            'Big' => $drawNumber[0] >= 5 ? true : false,
            'Small' => $drawNumber[0] <= 4 ? true : false,
            'Even' => $drawNumber[0] % 2 == 0 ? true : false,
            'Odd' => $drawNumber[0] % 2 != 0 ? true : false,
            'Prime' => in_array($drawNumber[0], [1, 2, 3, 5, 7]) ? true : false,
            'Composite' => in_array($drawNumber[0], [0, 4, 6, 8, 9]) ? true : false,
        ];
        $count = 0;
        if ($data[$selection[0]] == true) {
            $count = 1;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function SecondBall(array $selection, array $drawNumber, int $gameId = null)
    {
        $data = [
            'Big' => $drawNumber[0] >= 5 ? true : false,
            'Small' => $drawNumber[0] <= 4 ? true : false,
            'Even' => $drawNumber[0] % 2 == 0 ? true : false,
            'Odd' => $drawNumber[0] % 2 != 0 ? true : false,
            'Prime' => in_array($drawNumber[0], [1, 2, 3, 5, 7]) ? true : false,
            'Composite' => in_array($drawNumber[0], [0, 4, 6, 8, 9]) ? true : false,
        ];
        $count = 0;
        if ($data[$selection[0]] == true) {
            $count = 1;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function ThirdBall(array $selection, array $drawNumber, int $gameId = null)
    {
        $data = [
            'Big' => $drawNumber[0] >= 5 ? true : false,
            'Small' => $drawNumber[0] <= 4 ? true : false,
            'Even' => $drawNumber[0] % 2 == 0 ? true : false,
            'Odd' => $drawNumber[0] % 2 != 0 ? true : false,
            'Prime' => in_array($drawNumber[0], [1, 2, 3, 5, 7]) ? true : false,
            'Composite' => in_array($drawNumber[0], [0, 4, 6, 8, 9]) ? true : false,
        ];
        $count = 0;
        if ($data[$selection[0]] == true) {
            $count = 1;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function FourthBall(array $selection, array $drawNumber, int $gameId = null)
    {
        $data = [
            'Big' => $drawNumber[0] >= 5 ? true : false,
            'Small' => $drawNumber[0] <= 4 ? true : false,
            'Even' => $drawNumber[0] % 2 == 0 ? true : false,
            'Odd' => $drawNumber[0] % 2 != 0 ? true : false,
            'Prime' => in_array($drawNumber[0], [1, 2, 3, 5, 7]) ? true : false,
            'Composite' => in_array($drawNumber[0], [0, 4, 6, 8, 9]) ? true : false,
        ];
        $count = 0;
        if ($data[$selection[0]] == true) {
            $count = 1;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function FifthBall(array $selection, array $drawNumber, int $gameId = null)
    {
        $data = [
            'Big' => $drawNumber[0] >= 5 ? true : false,
            'Small' => $drawNumber[0] <= 4 ? true : false,
            'Even' => $drawNumber[0] % 2 == 0 ? true : false,
            'Odd' => $drawNumber[0] % 2 != 0 ? true : false,
            'Prime' => in_array($drawNumber[0], [1, 2, 3, 5, 7]) ? true : false,
            'Composite' => in_array($drawNumber[0], [0, 4, 6, 8, 9]) ? true : false,
        ];
        $count = 0;
        if ($data[$selection[0]] == true) {
            $count = 1;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }



    // *******************Two sides ***********************************************


    public static function twoside_rapido(array $selection, array $drawNumber, string $gameId): array
    {
        $count = 0;
        $position = intval($selection['position']) - 1;
        $posVal = intval($drawNumber[$position]);
        $selected = $selection['selection'];
        $label_id = $selection['label_id'];
        $dummyKey = count(str_split($selected, 1)) > 1 ? 'dummy' : $selected;
        $data = [
            'Big' => $posVal >= 5,
            'Small' => $posVal <= 4,
            'Odd' => $posVal % 2 != 0,
            'Even' => $posVal % 2 == 0,
            'Prime' => in_array($posVal, [1, 2, 3, 5, 7]),
            'Composite' => in_array($posVal, [0, 4, 6, 8, 9]),
            $dummyKey => $posVal == $selected
        ];

        if ($data[$selected] == true) {
            $count = 1;
        }
        ;
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$label_id] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function twoside_allkinds(array $selection, array $drawNumber, string $gameId): array
    {
        $count = 0;
        $getPos = [
            '1st' => 1,
            '2nd' => 2,
            '3rd' => 3,
            '4th' => 4,
            '5th' => 5,
            'sum' => 'sum',
            'First3' => 'First3',
            'Middle3' => 'Middle3',
            'Last3' => 'Last3',
        ];
        $position = $getPos[$selection['position']];
        $selected = $selection['selection'];
        $label_id = $selection['label_id'];
        switch ($position) {
            case 'First3': {
                $data = [
                    'TOAK' => in_array(3, array_count_values(array_slice($drawNumber, 0, 3))) ? true : false,
                    'Streak' => self::findStreakPattern($drawNumber, 0, 3, 2) ? true : false,
                    'Pair' => in_array(2, array_count_values(array_slice($drawNumber, 0, 3))) ? true : false,
                    'Half Streak' => self::findStreakPattern($drawNumber, 0, 3, 1) ? true : false,
                    'Mixed 6' => !self::findStreakPattern($drawNumber, 0, 3, 3, true) && self::findPattern([1, 1, 1], $drawNumber, 0, 3, true) ? true : false
                ];
                if ($data[$selected] == true) {
                    $count = 1;
                }
                break;
            }
            case 'Middle3': {
                $data = [
                    'TOAK' => in_array(3, array_count_values(array_slice($drawNumber, 1, 3))) ? true : false,
                    'Streak' => self::findStreakPattern($drawNumber, 1, 3, 2) ? true : false,
                    'Pair' => in_array(2, array_count_values(array_slice($drawNumber, 1, 3))) ? true : false,
                    'Half Streak' => self::findStreakPattern($drawNumber, 1, 3, 1) ? true : false,
                    'Mixed 6' => !self::findStreakPattern($drawNumber, 0, 3, 3, true) && self::findPattern([1, 1, 1], $drawNumber, 0, 3, true) ? true : false
                ];
                if ($data[$selected] == true) {
                    $count = 1;
                }
                break;
            }
            case 'Last3': {
                $data = [
                    'TOAK' => in_array(3, array_count_values(array_slice($drawNumber, -3))) ? true : false,
                    'Streak' => self::findStreakPattern($drawNumber, 0, -3, 2, true) ? true : false,
                    'Pair' => in_array(2, array_count_values(array_slice($drawNumber, -3))) ? true : false,
                    'Half Streak' => self::findStreakPattern($drawNumber, 0, -3, 1, true) ? true : false,
                    'Mixed 6' => !self::findStreakPattern($drawNumber, 0, -3, 3, true) && self::findPattern([1, 1, 1], $drawNumber, 0, -3, true) ? true : false
                ];
                if ($data[$selected] == true) {
                    $count = 1;
                }
                break;
            }
            case 'sum': {
                $total = array_sum($drawNumber);
                $data = [
                    'Big' => $total >= 23 ? true : false,
                    'Small' => $total <= 22 ? true : false,
                    'Odd' => $total % 2 != 0 ? true : false,
                    'Even' => $total % 2 == 0 ? true : false,
                    'Dragon' => self::DT(0, 4, $drawNumber) == 1 ? true : false,
                    'Tiger' => self::DT(0, 4, $drawNumber) == 2 ? true : false,
                    'Tie' => self::DT(0, 4, $drawNumber) == 3 ? true : false,
                ];
                if ($data[$selected] == true) {
                    $count = 1;
                }
                break;
            }
            default: {
                $dummyKey = count(str_split($selected, 1)) > 1 ? 'dummy' : $selected;
                $posVal = $drawNumber[$position - 1];
                $data = [
                    'Big' => $posVal >= 5 ? true : false,
                    'Small' => $posVal <= 4,
                    'Odd' => $posVal % 2 != 0,
                    'Even' => $posVal % 2 == 0,
                    'Prime' => in_array($posVal, [1, 2, 3, 5, 7]),
                    'Composite' => in_array($posVal, [0, 4, 6, 8, 9]),
                    $dummyKey => $posVal == $selected
                ];
                if ($data[$selected] == true) {
                    $count = 1;
                }
                break;
            }
        }

        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$label_id] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    // ********************* Board Games bull bull****************************************

    public static function bull_bull_board(array $selection, array $drawNumber, int $gameIds): array
    {

        $gameid = [];
        $count = 0;
        $data = [
            194 => empty(self::bullChecker($drawNumber, [0, 10, 20])) ? true : false, // no bull
            184 => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) == 1 : null, // bull 1
            185 => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) == 2 : null, // bull 2
            186 => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) == 3 : null, // bull 3
            187 => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) == 4 : null, // bull 4
            188 => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) == 5 : null, // bull 5
            189 => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) == 6 : null, // bull 6
            190 => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) == 7 : null, // bull 7
            191 => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) == 8 : null, // bull 8
            192 => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) == 9 : null, // bull 9
            193 => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) == 0 : null // bull bull
        ];


        if ($data[$selection[0]] == true) {
            $count++;
            $gameid[] = $selection[0];
        }


        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? $gameid : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function bull_bull_bsoe(array $selection, array $drawNumber, int $gameId): array
    {

        $gameid = [];
        $count = 0;
        $data = [
            180 => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) > 4 : false, // bull big
            181 => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) < 5 : false, // bull small
            182 => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) % 2 != 0 : false, // bull odd
            183 => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) % 2 == 0 : false, // bull even
        ];


        if ($data[$selection[0]] == true) {
            $count++;
            $gameid[] = $selection[0];
        }


        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? $gameid : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function board_maximum(array $selection, array $drawnumber, int $gameId): array
    {

        $data = [5 => 195, 4 => 196, 3 => 197, 2 => 198, 1 => 199];
        $filtered_keys = array_filter(array_keys($data), function ($key) use ($data, $selection) {
            return in_array($data[$key], $selection);
        });

        $maxValue = max($drawnumber);
        $positions = array_keys(array_reverse($drawnumber), $maxValue);
        $poss = array_filter($positions, fn($position) => in_array($position + 1, $filtered_keys));
        $count = count($poss);
        $squaredNumbers = array_map(fn($num) => $data[$num + 1], $poss);

        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? $squaredNumbers : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function board_minimum(array $selection, array $drawnumber, int $gameId): array
    {

        $data = [5 => 200, 4 => 201, 3 => 202, 2 => 203, 1 => 204];
        $filtered_keys = array_filter(array_keys($data), function ($key) use ($data, $selection) {
            return in_array($data[$key], $selection);
        });
        $minValue = min($drawnumber);
        $positions = array_keys(array_reverse($drawnumber), $minValue);
        $poss = array_filter($positions, fn($position) => in_array($position + 1, $filtered_keys));
        $count = count($poss);
        $squaredNumbers = array_map(fn($num) => $data[$num + 1], $poss);

        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? $squaredNumbers : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function board_dragonTigerTie(array $selection, array $drawnumber, int $gameId): array
    {
        $gameids = [];
        $count = 0;
        $data = [
            205 => self::DT(0, 4, $drawnumber) == 1, // dragon
            206 => self::DT(0, 4, $drawnumber) == 2, // tiger
            207 => self::DT(0, 4, $drawnumber) == 3  // tie
        ];
        if ($data[$selection[0]] == true) {
            $count++;
            $gameids = $selection;
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function studGroup(array $selection, array $drawNumbers, int $gameId): array
    {
        $count = 0;
        $gameids = [];
        $data = [
            208 => self::findPattern([5], $drawNumbers, 0, 5),
            209 => self::findPattern([4, 1], $drawNumbers, 0, 5),
            212 => self::findPattern([3, 1, 1], $drawNumbers, 0, 5),
            210 => self::findPattern([2, 1, 1, 1], $drawNumbers, 0, 5),
            213 => self::findPattern([2, 2, 1], $drawNumbers, 0, 5),
            211 => self::findPattern([3, 2], $drawNumbers, 0, 5),
            240 => self::findStreakPattern($drawNumbers, 0, 5, 4),
            214 => !self::findStreakPattern($drawNumbers, 0, 5, 4) && self::findPattern([1, 1, 1, 1, 1], $drawNumbers, 0, 5),
        ];

        if ($data[$selection[0]]) {
            $count++;
            $gameids[] = $selection[0];
        }

        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function firstThreeForms(array $selection, array $drawNumbers, int $gameId): array
    {

        $count = 0;
        $gameids = [];
        $data = [
            215 => self::findPattern([3], $drawNumbers, 0, 3),
            216 => self::findStreakPattern($drawNumbers, 0, 3, 2),
            217 => self::findPattern([2, 1], $drawNumbers, 0, 3),
            218 => !self::findStreakPattern($drawNumbers, 0, 3, 2) && self::findPattern([1, 1, 1], $drawNumbers, 0, 3),
            219 => self::findStreakPattern($drawNumbers, 0, 3, 1),
        ];
        if ($data[$selection[0]]) {
            $count++;
            $gameids[] = $selection[0];
        }

        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function middleThreeForms(array $selection, array $drawNumbers, int $gameId): array
    {

        $count = 0;
        $gameids = [];
        $data = [
            220 => self::findPattern([3], $drawNumbers, 1, 3),
            221 => self::findStreakPattern($drawNumbers, 1, 3, 2),
            222 => self::findPattern([2, 1], $drawNumbers, 1, 3),
            223 => !self::findStreakPattern($drawNumbers, 1, 3, 2) && self::findPattern([1, 1, 1], $drawNumbers, 1, 3),
            224 => self::findStreakPattern($drawNumbers, 1, 3, 1),
        ];
        if ($data[$selection[0]]) {
            $count++;
            $gameids[] = $selection[0];
        }

        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function lastThreeForms(array $selection, array $drawNumbers, int $gameId): array
    {

        $count = 0;
        $gameids = [];
        $data = [
            225 => self::findPattern([3], $drawNumbers, 0, -3, true),
            226 => self::findStreakPattern($drawNumbers, 0, -3, 2, true),
            227 => self::findPattern([2, 1], $drawNumbers, 0, -3, true),
            228 => !self::findStreakPattern($drawNumbers, 0, -3, 2, true) && self::findPattern([1, 1, 1], $drawNumbers, 0, -3, true),
            229 => self::findStreakPattern($drawNumbers, 0, -3, 1, true),
        ];
        if ($data[$selection[0]]) {
            $count++;
            $gameids[] = $selection[0];
        }

        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function firstTwoForms(array $selection, array $drawNumbers, int $gameId): array
    {

        $count = 0;
        $gameids = [];
        $data = [
            230 => self::checkOddOrEven($drawNumbers, 0, 2) == 'Odd Odd',
            231 => self::checkOddOrEven($drawNumbers, 0, 2) == 'Odd Even',
            233 => self::checkOddOrEven($drawNumbers, 0, 2) == 'Even Odd',
            234 => self::checkOddOrEven($drawNumbers, 0, 2) == 'Even Even'
        ];

        if ($data[$selection[0]]) {
            $count++;
            $gameids[] = $selection[0];
        }

        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function baracat(array $selection, array $drawNumbers, int $gameId): array
    {

        $count = 0;
        $gameids = [];
        $data = [
            235 => self::findPattern([2], $drawNumbers, 0, 2),
            236 => self::findPattern([2], $drawNumbers, 0, -2, true),
            237 => array_sum(array_slice($drawNumbers, 0, 2)) > array_sum(array_slice($drawNumbers, 0, -2, true)),
            238 => array_sum(array_slice($drawNumbers, 0, 2)) == array_sum(array_slice($drawNumbers, 0, -2, true)),
            239 => array_sum(array_slice($drawNumbers, 0, 2)) < array_sum(array_slice($drawNumbers, 0, -2, true))
        ];

        if ($data[$selection[0]]) {
            $count++;
            $gameids[] = $selection[0];
        }

        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];
    }

    // ********************* Fantan Games *************************

    public static function fantan_main_bsoedtt(array $selection, array $drawnumber, int $gameId): array
    {
        $count = 0;
        $total = array_sum($drawnumber);
        $data = [
            241 => $total >= 23,
            242 => $total <= 22,
            243 => $total % 2 != 0,
            244 => $total % 2 == 0,
            250 => self::DT(0, 4, $drawnumber) == 1,
            251 => self::DT(0, 4, $drawnumber) == 2,
            252 => self::DT(0, 4, $drawnumber) == 3,
        ];
        if ($data[$selection[0]] == true) {
            $count = 1;
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? array_fill(0, $count, $gameId) : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function fantan_main_sweetroses(array $selection, array $drawnumber, int $gameId): array
    {

        $data = [5 => 245, 4 => 246, 3 => 247, 2 => 248, 1 => 249];
        $filtered_keys = array_filter(array_keys($data), function ($key) use ($data, $selection) {
            return in_array($data[$key], $selection);
        });

        $maxValue = max($drawnumber);
        $positions = array_keys(array_reverse($drawnumber), $maxValue);
        $poss = array_filter($positions, fn($position) => in_array($position + 1, $filtered_keys));
        $count = count($poss);
        $squaredNumbers = array_map(fn($num) => $data[$num + 1], $poss);

        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? $squaredNumbers : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function sPair(array $pattern, array $drawNumbers): bool
    { // find patterns in drawsNumbers
        $drawNumbers = array_count_values($drawNumbers);
        sort($drawNumbers);
        sort($pattern);
        return $drawNumbers === $pattern;
    }
    public static function oddEven($num)
    {
        if ($num % 2 === 0) { // Simplified because 0 % 2 is also 0, so it's even
            return 302;
        } else {
            return 301;
        }
    }
    public static function bigSmallOddEven($num, $bigMin, $bigMax, $smallMin, $smallMax)
    {
        $size = "";
        if ($num >= $bigMin && $num <= $bigMax) {
            $size = 299;
        } elseif ($num >= $smallMin && $num <= $smallMax) {
            $size = 300;
        } else {
            $size = "Invalid input";
        }

        $parity = self::oddEven($num);

        if ($size === "Invalid input") {
            return $size; // Early return if the input is invalid
        } else {
            return [$size, $parity]; // Combining the size and parity results
        }
    }

    public static function getWinCombinations($num1, $num2, $num3)
    {
        $isBig = function ($num) {
            return $num >= 5 && $num <= 9;
        };
        $isSmall = function ($num) {
            return $num >= 0 && $num <= 4;
        };
        $isEven = function ($num) {
            return $num % 2 === 0;
        };
        $isOdd = function ($num) {
            return $num !== 0 && $num % 2 !== 0;
        };

        $isAllBig = function ($num1, $num2, $num3) use ($isBig) {
            return $isBig($num1) && $isBig($num2) && $isBig($num3);
        };
        $isAllSmall = function ($num1, $num2, $num3) use ($isSmall) {
            return $isSmall($num1) && $isSmall($num2) && $isSmall($num3);
        };
        $isAllEven = function ($num1, $num2, $num3) use ($isEven) {
            return $isEven($num1) && $isEven($num2) && $isEven($num3);
        };
        $isAllOdd = function ($num1, $num2, $num3) use ($isOdd) {
            return $isOdd($num1) && $isOdd($num2) && $isOdd($num3);
        };

        $moreBig = ($isBig($num1) ? 1 : 0) + ($isBig($num2) ? 1 : 0) + ($isBig($num3) ? 1 : 0) > 1;
        $moreSmall = ($isSmall($num1) ? 1 : 0) + ($isSmall($num2) ? 1 : 0) + ($isSmall($num3) ? 1 : 0) > 1;
        $moreOdd = ($isOdd($num1) ? 1 : 0) + ($isOdd($num2) ? 1 : 0) + ($isOdd($num3) ? 1 : 0) > 1;
        $moreEven = ($isEven($num1) ? 1 : 0) + ($isEven($num2) ? 1 : 0) + ($isEven($num3) ? 1 : 0) > 1;

        $winCombinations = [];

        if (self::sPair([2, 1], [$num1, $num2, $num3])) {
            $winCombinations[] = 312;
        }
        if ($moreBig) {
            $winCombinations[] = 303;
        }
        if ($moreSmall) {
            $winCombinations[] = 308;
        }
        if ($moreOdd) {
            $winCombinations[] = 304;
        }
        if ($moreEven) {
            $winCombinations[] = 309;
        }
        if ($isAllBig($num1, $num2, $num3)) {
            $winCombinations[] = 305;
        }
        if ($isAllSmall($num1, $num2, $num3)) {
            $winCombinations[] = 310;
        }
        if ($isAllEven($num1, $num2, $num3)) {
            $winCombinations[] = 311;
        }
        if ($isAllOdd($num1, $num2, $num3)) {
            $winCombinations[] = 306;
        }
        if (!self::sPair([2, 1], [$num1, $num2, $num3])) {
            $winCombinations[] = 307;
        }

        return $winCombinations;
    }

    public static function fantan2(array $selection, array $drawnumber, int $gameId): array
    {
        $count = 0;
        $gameids = [];
        $remainder = array_sum(array_slice($drawnumber, -3)) % 4;
        $data = [
            0 => [288, 290, 276, 274, 283, 282, 284],
            1 => [291, 285, 289, 274, 273, 277, 278],
            2 => [286, 290, 273, 275, 348, 349, 680],
            3 => [287, 289, 275, 276, 279, 280, 281]
        ];

        if (in_array($selection[0], $data[$remainder])) {
            $count++;
            $gameids[] = $gameId;
        }
        ;

        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function fantan3Color(array $selection, array $drawnumber, int $gameId): array
    {
        $count = 0;
        $gameids = [];
        $data = [
            292 => in_array(array_sum(array_slice($drawnumber, -3)), range(0, 3)),
            293 => in_array(array_sum(array_slice($drawnumber, -3)), range(4, 7)),
            294 => in_array(array_sum(array_slice($drawnumber, -3)), range(8, 11)),
            295 => in_array(array_sum(array_slice($drawnumber, -3)), range(12, 15)),
            296 => in_array(array_sum(array_slice($drawnumber, -3)), range(16, 19)),
            297 => in_array(array_sum(array_slice($drawnumber, -3)), range(20, 23)),
            298 => in_array(array_sum(array_slice($drawnumber, -3)), range(24, 27))
        ];

        if ($selection[0] == $data[$selection[0]]) {
            $count++;
            $gameids[] = $gameId;
        }
        ;

        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function fantanWithCombo(array $selection, array $drawnumber, int $gameId): array
    {
        $count = 0;
        $gameids = [];
        $wonIds = self::getWinCombinations($drawnumber[2], $drawnumber[3], $drawnumber[4]);
        if (in_array($selection[0], $wonIds)) {
            $count++;
            $gameids[] = $selection[0];
        }
        ;

        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function fantanBSOE(array $selection, array $drawnumber, int $gameId): array
    {
        $count = 0;
        $gameids = [];
        $result = self::bigSmallOddEven(array_sum(array_slice($drawnumber, -3)), 14, 27, 0, 13);
        if (in_array($selection[0], $result)) {
            $count++;
            $gameids[] = $selection[0];
        }

        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function fantanOne(array $selection, array $drawNumber, int $gameId)
    {

        $remainder = array_sum(array_slice($drawNumber, -3)) % 4;
        $results = [
            0 => ["272", "259", "264", "258", "266", "264", "261", "253", "254", "255"],
            1 => ["269", "262", "263", "268", "261", "264", "254", "255", "256"],
            2 => ["270", "262", "257", "265", "258", "266", "253", "255", "256"],
            3 => ["271", "260", "263", "257", "265", "259", "267", "253", "254", "256"]
        ];
        $count = 0;
        $gameids = [];
        $possibleWins = $results[$remainder];
        if (in_array($selection[0], $possibleWins)) {
            $count++;
            $gameids[] = $gameId;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? '2' : '3'
        ];
    }

    public static function fantanAnd(array $selection, array $drawNumber, int $gameId)
    {
        $remainder = array_sum(array_slice($drawNumber, -3));
        $data = [
            "313" => in_array($remainder, range(0, 4)) ? 1 : 0,
            "331" => in_array($remainder, range(23, 27)) ? 1 : 0,
            "314" => $remainder == 5 ? 1 : 0,
            "332" => $remainder == 6 ? 1 : 0,
            "315" => $remainder == 7 ? 1 : 0,
            "316" => $remainder == 8 ? 1 : 0,
            "317" => $remainder == 9 ? 1 : 0,
            "318" => $remainder == 10 ? 1 : 0,
            "319" => $remainder == 11 ? 1 : 0,
            "320" => $remainder == 12 ? 1 : 0,
            "321" => $remainder == 13 ? 1 : 0,
            "322" => $remainder == 14 ? 1 : 0,
            "323" => $remainder == 15 ? 1 : 0,
            "324" => $remainder == 16 ? 1 : 0,
            "325" => $remainder == 17 ? 1 : 0,
            "326" => $remainder == 18 ? 1 : 0,
            "327" => $remainder == 19 ? 1 : 0,
            "328" => $remainder == 20 ? 1 : 0,
            "329" => $remainder == 21 ? 1 : 0,
            "330" => $remainder == 22 ? 1 : 0,

        ];
        $count = 0;
        $gameids = [];
        if ($data[$selection[0]] == 1) {
            $count++;
            $gameids[] = $gameId;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];

    }

    public static function fantanPosition(array $selection, array $drawNumber, int $gameId)
    {

        $position = $selection[0][0] -= 1;
        $posVal = intval($drawNumber[$position]);

        $selection = $selection[1][0];
        $data = [
            '333' => $posVal >= 5,
            '334' => $posVal <= 4,
            '335' => $posVal % 2 != 0,
            '336' => $posVal % 2 == 0,
            '337' => $posVal == 0,
            '338' => $posVal == 1,
            '339' => $posVal == 2,
            '340' => $posVal == 3,
            '341' => $posVal == 4,
            '342' => $posVal == 5,
            '343' => $posVal == 6,
            '344' => $posVal == 7,
            '345' => $posVal == 8,
            '346' => $posVal == 9
        ];
        $count = 0;
        $gameids = [];
        if ($data[$selection] == true) {
            $count++;
            $gameids[] = $selection;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? '2' : '3'
        ];
    }
}

//end of royal 5   