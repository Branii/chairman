<?php

class ThreeD extends GamePlayFunctionThreeD
{


    public static function getGamePlayMethod(): array
    { //////////// THE INVOKE METHOD
        return parent::getGamePlayFunction(); ///////////////////////////////////////////
    } ///////////////////////////////////////////////////////////////////////////////////


    // Helper functions // ------------------------------>

    public static function findPattern(array $pattern, array $drawNumbers, Int $index, Int $slice, bool $flag = false): bool
    { // find patterns in drawsNumbers
        $drawNumbers = !$flag ? array_count_values(array_slice($drawNumbers, $index, $slice)) :
            array_count_values(array_slice($drawNumbers, $slice));
        sort($drawNumbers);
        sort($pattern);
        return $drawNumbers === $pattern;
    }

    public static function DT(Int $idx1, Int $idx2, array $drawNumber): int
    { // dragon|tiger|tie pattern
        $drawNumber = explode(",", implode(",", $drawNumber));
        $v1 = $drawNumber[$idx1];
        $v2 = $drawNumber[$idx2];
        return ($v1 > $v2) ? 1 : (($v1 == $v2) ? 3 : 2);
    }

    public static function DTX(Int $idx1, Int $idx2, array $drawNumber): int
    { // dragon|tiger|tie pattern
        $drawNumber = explode(",", implode(",", $drawNumber));
        $v1 = $drawNumber[$idx1];
        $v2 = $drawNumber[$idx2];
        return ($v1 > $v2) ? 59 : (($v1 == $v2) ? 61 : 60);
    }

    public static function findStreakPattern(array $drawNumber, Int $index, Int $slice, Int $streakCount, bool $flag = false): Bool
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

    public static function areArraysSimilarOrdered($array1, $array2)
    {
        return count($array1) === count($array2) && empty(array_diff_assoc(array_map('strval', $array1), array_map('strval', $array2)));
    }

    public static function areArraysSimilarUnordered($array1, $array2)
    {
        if (count($array1) !== count($array2)) {
            return false;
        }

        sort($array1);
        sort($array2);

        return $array1 === $array2;
    }

    public static function isPairFound(array $drawnumber){
        $counts = array_count_values($drawnumber);
        $duplicates = array_filter($counts, function($count) {
            return $count > 1;
        });
        $duplicate_value = key($duplicates);
        $drawnumber = array_diff($drawnumber, [$duplicate_value]);
        $drawnumber = array_values($drawnumber); 
        return $drawnumber;
    }


    // All_3 // ---------------------------------------->

    public static function all3_straight_joint(array $selection, array $drawnumber, Int $gameId = null): array
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

    // public static function all3_straight_manual(array $selection, array $drawnumber, Int $gameId = null): array
    // {
    //     $gameIds = [];
    //     if ($drawnumber == $selection) {
    //         $gameIds[] = $gameId;
    //     }
    //     return [
    //         'numwins' => count($gameIds),
    //         'gameids' => $gameIds,
    //         'status' => $gameIds ? 2 : 3,
    //     ];
    // }

    public static function all3_straight_manual(array $selection, array $drawnumber, int $gameId = null)
    {
        $count = 0;

        foreach ($selection as $sel) {
            if (self::areArraysSimilarOrdered($drawnumber, $sel)) {
                $count++;
                break;
            }
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function all3__sum(array $selection, array $drawnumber, Int $gameId = null): array
    {
        $count = 0;
        $sum = array_sum($drawnumber);
        if (in_array($sum,$selection[0])) {
            $count++;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => [$count],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function all3_span(array $selection, array $drawnumber, Int $gameId = null): array
    {
        $count = 0;
        $result = max($drawnumber) - min($drawnumber);
        if (in_array($result,$selection[0])) {
            $count++;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function all3_group3(array $selection, array $drawnumber, Int $gameId = null): array
    {
        $count = 0;

        if (!empty(self::isPairFound($drawnumber)) && in_array(self::isPairFound($drawnumber)[0],$selection[0])) {
            $count = 1;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function all3_group6(array $selection, array $drawnumber, Int $gameId = null): array
    {
        $count = 0;
        sort($drawnumber);
        sort($selection[0]);
        if (self::findPattern([2, 1], $drawnumber, 0, 3) == false && count(array_intersect($selection[0],$drawnumber))  == 3){
            $count++;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }


    public static function all3_combo_manual(array $selection, array $drawnumber, int $gameId = null)
    {
        $count = 0;
        $maxCount = max(array_count_values($drawnumber));
        foreach ($selection as $sel) {
            if(count(array_intersect($sel,$drawnumber)) == 3){
                $count++;
                $maxCount == 2 ? 333 : 334; 
                $gameId = $maxCount;
                break;
            }
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function all3_sum_group(array $selection, array $drawnumber, Int $gameId = null): array
    {
        $count = 0;
        $sum = array_sum($drawnumber);
        if (in_array($sum,$selection[0]) && self::findPattern([3], $drawnumber, 0, 3) == false) {
            $count++;;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function fixed_digit(array $selection, array $drawnumber, Int $gameId = null): array
    {
        $count = 0;
        //$sum = array_sum($drawnumber);
        if (in_array($selection[0], $drawnumber) && self::findPattern([3], $drawnumber, 0, 3) == false) {
            $count++;;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    // first 2 // -----------------------------------> 

    public static function first2_straight_joint(array $selection, array $drawnumber, Int $gameId = null): array
    {
        $gameIds = [];
        if (
            in_array($drawnumber[0], $selection[0]) &&
            in_array($drawnumber[1], $selection[1])
        ) {
            $gameIds[] = $gameId;
        }
        return [
            'numwins' => count($gameIds),
            'gameids' => $gameIds,
            'status' => $gameIds ? 2 : 3,
        ];
    }

    public static function first2_straight_manual(array $selection, array $drawnumber, Int $gameId = null): array
    {
        $count = 0;
        foreach ($selection as $value) {
            if (array_slice($drawnumber, 0, 2) == $value) {
                $count++;
                break;
            }
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function first2_sum(array $selection, array $drawnumber, Int $gameId = null): array
    {
        $count = 0;
        $sum = array_sum(array_slice($drawnumber, 0, 2));
        if (in_array($sum,$selection[0])) {
            $count++;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function first2_span(array $selection, array $drawnumber, Int $gameId = null): array
    {
        $count = 0;
        $drawnumbers = array_slice($drawnumber, 0, 2);
        $result = max($drawnumbers) - min($drawnumbers);
        if (in_array($result,$selection[0])) {
            $count++;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function first2_group_joint(array $selection, array $drawnumber, Int $gameId = null): array
    {
        $count = 0;
        $drawnumbers = array_slice($drawnumber, 0, 2);
 
        if (!in_array(2,array_count_values(($drawnumbers))) && 
         in_array($drawnumber[0],$selection[0]) && 
         in_array($drawnumber[1],$selection[0]))
        {
            $count++;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function first2_group_manual(array $selection, array $drawnumber, Int $gameId = null): array
    {
        $count = 0;
        $drawnumbers = array_slice($drawnumber, 0, 2);
        sort($drawnumbers);
        foreach ($selection as $value) {
            if ($value == $drawnumbers) {
                $count++;
            }
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function first2_sum_group(array $selection, array $drawnumber, Int $gameId = null): array
    {
        $count = 0;
        $sum = array_sum(array_slice($drawnumber, 0, 2));
        if (in_array($sum,$selection[0]) && self::findPattern([2], $drawnumber, 0, 2) == false) {
            $count++;;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function first2_fixed_digit(array $selection, array $drawnumber, Int $gameId = null): array
    {
        $count = 0;
        $drawnumbers = array_slice($drawnumber, 0, 2);
        if (in_array($selection[0][0], $drawnumbers) && !in_array(2,array_count_values($drawnumbers))) {
            $count++;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    // last 2 // -----------------------------------> 

    public static function last2_straight_joint(array $selection, array $drawnumber, Int $gameId = null): array
    {
        $gameIds = [];
        if (
            in_array($drawnumber[1], $selection[0]) &&
            in_array($drawnumber[2], $selection[1])
        ) {
            $gameIds[] = $gameId;
        }
        return [
            'numwins' => count($gameIds),
            'gameids' => $gameIds,
            'status' => $gameIds ? 2 : 3,
        ];
    }

    public static function last2_straight_manual(array $selection, array $drawnumber, Int $gameId = null): array
    {
        $count = 0;
        foreach ($selection as $value) {
            if (array_slice($drawnumber, -2) == $value) {
                $count++;
            }
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function last2_sum(array $selection, array $drawnumber, Int $gameId = null): array
    {
        $count = 0;
        $sum = array_sum(array_slice($drawnumber, -2));
        if (in_array($sum,$selection[0])) {
            $count++;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function last2_span(array $selection, array $drawnumber, Int $gameId = null): array
    {
        $count = 0;
        $drawnumbers = array_slice($drawnumber, -2);
        $result = max($drawnumbers) - min($drawnumbers);
        if (in_array($result,$selection[0])) {
            $count++;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function last2_group_joint(array $selection, array $drawnumber, Int $gameId = null): array
    {
        $count = 0;
        $drawnumbers = array_slice($drawnumber, -2);
 
        if (!in_array(2,array_count_values(($drawnumbers))) && 
         in_array($drawnumber[1],$selection[0]) && 
         in_array($drawnumber[2],$selection[0]))
        {
            $count++;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function last2_group_manual(array $selection, array $drawnumber, Int $gameId = null): array
    {
        $count = 0;
        $drawnumbers = array_slice($drawnumber, -2);
        sort($drawnumbers);
        foreach ($selection as $value) {
            if ($value == $drawnumbers) {
                $count++;
            }
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function last2_sum_group(array $selection, array $drawnumber, Int $gameId = null): array
    {
        $count = 0;
        $sum = array_sum(array_slice($drawnumber, -2));
        if (in_array($sum,$selection[0]) && !array(2,array_count_values(array_slice($drawnumber, -2)))) {
            $count++;;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    public static function last2_fixed_digit(array $selection, array $drawnumber, Int $gameId = null): array
    {
        $count = 0;
        $drawnumbers = array_slice($drawnumber, -2);
        if (in_array($selection[0][0], $drawnumbers) && !in_array(2,array_count_values($drawnumbers))) {
            $count++;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3,
        ];
    }

    // fixed place // -------------------------------> 

    public static function fixed_place(array $selection, array $drawnumber, Int $gameId = null): array
    {
        $count = 0;
        if (in_array($drawnumber[0],$selection[0])) {
            $count++;
        }
        if (in_array($drawnumber[1],$selection[1])) {
            $count++;
        }
        if (in_array($drawnumber[2],$selection[2])) {
            $count++;
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? array_fill(0, $count, $gameId) : [],
            'status' => $count ? 2 : 3,
        ];
    }

    // any place // -------------------------------> 

    public static function any_place1x3(array $selection, array $drawnumber, Int $gameId = null): array
    {
        $count = 0;
        if (count(array_intersect($selection[0], $drawnumber)) > 0) {
            $count = count(array_intersect($selection[0], $drawnumber));
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? array_fill(0, $count, $gameId) : [],
            'status' => $count ? 2 : 3,
        ];
    }


    public static function any_place2x3(array $selection, array $drawnumber, Int $gameId = null): array
    {
        $count = 0;
        if (count(array_intersect($selection[0], $drawnumber)) >=2 ) {
            $count = count(array_intersect($selection[0], $drawnumber));
        }
        return [
            'numwins' => $count ? 1 : 0,
            'gameids' => $count ? array_fill(0, $count, $gameId) : [],
            'status' => $count ? 2 : 3,
        ];
    }

    // dragon tiger tie // -------------------------------> 

    public static function DragonTiger(array $selection, array $drawNumber, int $gameId)
    {
      $count = 0;
        $data = [
            '1v2' => self::DTX(0, 1, $drawNumber),
            '1v3' => self::DTX(0, 2, $drawNumber),
            '2v3' => self::DTX(1, 2, $drawNumber),
        ];
        $gameIds= [];
        foreach($selection[0] as $key => $item){
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

    //--------end of threeD standard --------------//

    //##################### 2 sides ###########################---> 

    public static function conv($selection,$drawnumber,$gameId) {
       
        $count = 0;
        $selected = $selection['selection'];
        $label_id = $selection['label_id'];
        $position = intval ($selection['position']) - 1;
        $key =  is_numeric($selected) ? $selected : null;
        $data = [
          'Big' => $drawnumber[$position] >= 5,
          'Small' => $drawnumber[$position] <= 4,
          'Odd' => $drawnumber[$position] % 2 != 0,
          'Even' => $drawnumber[$position] % 2 == 0,
          'Prime' => in_array($drawnumber[$position],[1, 2, 3, 5, 7]),
          'Composite' => in_array($drawnumber[$position],[0, 4, 6, 8, 9]),
          $key => $drawnumber[$position] == $key,
          ];
          if($data[$selected] == true){
            $count++;
          }
          return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$label_id] : [],
            'status'  => $count ? 2 : 3
          ];
        
      }
      
      public static function twoside($selection,$drawnumber,$gameId) {
        $count = 0;
        $selected = $selection['selection'];
        $position = $selection['position'];
        $label_id = $selection['label_id'];
        switch($position){
          case '1st/2nd' : {
            $data = [
            'Tail Sum Big' => substr((string) array_sum([$drawnumber[0],$drawnumber[1]]), -1) >= 5,
            'Tail Sum Small' => substr((string) array_sum([$drawnumber[0],$drawnumber[1]]), -1) <= 4,
            'Sum Odd' => substr((string) array_sum([$drawnumber[0],$drawnumber[1]]), -1) % 2 != 0,
            'Sum Even' => substr((string) array_sum([$drawnumber[0],$drawnumber[1]]), -1) % 2 == 0,
            'Tail Sum Prime' => in_array(substr((string) array_sum([$drawnumber[0],$drawnumber[1]]), -1),[1, 2, 3, 5, 7]),
            'Tail Sum Composite' => in_array(substr((string) array_sum([$drawnumber[0],$drawnumber[1]]), -1),[0, 4, 6, 8, 9]),
            ];
            if($data[$selected] == true){
              $count++;
            }
            break;
          }
          case '1st/3rd' : {
            $data = [
            'Tail Sum Big' => substr((string) array_sum([$drawnumber[0],$drawnumber[2]]), -1) >= 5,
            'Tail Sum Small' => substr((string) array_sum([$drawnumber[0],$drawnumber[2]]), -1) <= 4,
            'Sum Odd' => substr((string) array_sum([$drawnumber[0],$drawnumber[2]]), -1) % 2 != 0,
            'Sum Even' => substr((string) array_sum([$drawnumber[0],$drawnumber[2]]), -1) % 2 == 0,
            'Tail Sum Prime' => in_array(substr((string) array_sum([$drawnumber[0],$drawnumber[2]]), -1),[1, 2, 3, 5, 7]),
            'Tail Sum Composite' => in_array(substr((string) array_sum([$drawnumber[0],$drawnumber[2]]), -1),[0, 4, 6, 8, 9]),
            ];
          if($data[$selected] == true){
            $count++;
          }
          break;
          }
          case '2nd/3rd' : {
            $data = [
            'Tail Sum Big' => substr((string) array_sum([$drawnumber[1],$drawnumber[2]]), -1) >= 5,
            'Tail Sum Small' => substr((string) array_sum([$drawnumber[1],$drawnumber[2]]), -1) <= 4,
            'Sum Odd' => substr((string) array_sum([$drawnumber[1],$drawnumber[2]]), -1) % 2 != 0,
            'Sum Even' => substr((string) array_sum([$drawnumber[1],$drawnumber[2]]), -1) % 2 == 0,
            'Tail Sum Prime' => in_array(substr((string) array_sum([$drawnumber[1],$drawnumber[2]]), -1),[1, 2, 3, 5, 7]),
            'Tail Sum Composite' => in_array(substr((string) array_sum([$drawnumber[1],$drawnumber[2]]), -1),[0, 4, 6, 8, 9]),
            ];
          if($data[$selected] == true){
            $count++;
          }
            break;
          }
          case '1st/2nd/3rd' : {
            $data = [
            'Tail Sum Big' => substr((string) array_sum([$drawnumber[0],$drawnumber[1],$drawnumber[2]]), -1) >= 5,
            'Tail Sum Small' => substr((string) array_sum([$drawnumber[0],$drawnumber[1],$drawnumber[2]]), -1) <= 4,
            'Sum Odd' => substr((string) array_sum([$drawnumber[0],$drawnumber[1],$drawnumber[2]]), -1) % 2 != 0,
            'Sum Even' => substr((string) array_sum([$drawnumber[0],$drawnumber[1],$drawnumber[2]]), -1) % 2 == 0,
            'Sum Big' => substr((string) array_sum([$drawnumber[0],$drawnumber[1],$drawnumber[2]]), -1) >= 5,
            'Sum Small' => substr((string) array_sum([$drawnumber[0],$drawnumber[1],$drawnumber[2]]), -1) <= 4,
            'Tail Sum Prime' => in_array(substr((string) array_sum([$drawnumber[0],$drawnumber[1],$drawnumber[2]]), -1),[1, 2, 3, 5, 7]),
            'Tail Sum Composite' => in_array(substr((string) array_sum([$drawnumber[0],$drawnumber[1],$drawnumber[2]]), -1),[0, 4, 6, 8, 9]),
            ];
          if($data[$selected] == true){
            $count++;
          }
            break;
          }
        }
        return [
          'numwins' => $count ? $count : 0,
          'gameids' => $count ? [$label_id] : [],
          'status'  => $count ? 2 : 3
        ];
          
      }
      
      public static function combo($selection,$drawnumber,$gameId) {
        $count = 0;
        $selected = (string)$selection['selection'];
        $position = $selection['position'];
        $label_id = $selection['label_id'];
        switch($position){
          case '1 No. Combo': {
            if(in_array($selected,$drawnumber)){
              $count++;
            }
            break;
          }
          case '2 No. Combo': {
            sort($drawnumber);
            $string = implode('', $drawnumber);
            if (strpos($string, $selected) !== false) {
                $count++;
            }
            break;
          }
          case '3 No. Combo': {
            sort($drawnumber);
            $string = implode('', $drawnumber);
            if (strpos($string, $selected) !== false) {
                $count++;
            }
            break;
          }
        }
        return [
          'numwins' => $count ? $count : 0,
          'gameids' => $count ? [$label_id] : [],
          'status'  => $count ? 2 : 3
        ];
      }
      
      public static function fixed_place_two_side($selection,$drawnumber,$gameId){
        $count = 0;
        $position = $selection['position'];
        $label_id = 0;
        $selected = $selection['selection'];
        switch($position){
          case '1st/2nd':{

            if($selected[0][0] == $drawnumber[0] && $selected[1][0] == $drawnumber[1]){
                $label_id = $gameId;
              $count++;
            }
            break;
          }
          case '1st/3rd':{
            if($selected[0][0] == $drawnumber[0] && $selected[1][0] == $drawnumber[2]){
                $label_id = $gameId;
              $count++;
            }
            break;
            break;
          }
          case '2nd/3rd':{
            if($selected[0][0] == $drawnumber[1] && $selected[1][0] == $drawnumber[2]){
                $label_id = $gameId;
              $count++;
            }
            break;
          }
          case '1st/2nd/3rd':{
            if($selected[0][0] == $drawnumber[0] && $selected[1][0] == $drawnumber[1] && $selected[2][0] == $drawnumber[2]){
                $label_id = $gameId;
              $count++;
            }
            break;
          }
          default:{
            $selected = $selection['selection'];
           $position = intval ($selection['position']) - 1;
           $key =  is_numeric($selected) ? $selected : 1;
           $data = [
              $key => $drawnumber[$position] == $key,
            ];
            if($data[$selected] == true){
              $count++;
            }
          }
        }
    
        return [
          'numwins' => $count ? $count : 0,
          'gameids' => $count ? [$label_id] : [],
          'status'  => $count ? 2 : 3
        ];
      }
      
      public static function sum($selection,$drawnumber,$gameId){
        $count = 0;
        $position = $selection['position'];
        $selected = $selection['selection'];
        $label_id = $selection['label_id'];
        switch($position){

          case 'Sum of 1st/2nd':{
             if($selected == '0-4'){
                if(in_array(array_sum(array_slice($drawnumber,0,2)),range(0,4))){
                  $count++;
                }
              }else if($selected == '14-18'){
                if(in_array(array_sum(array_slice($drawnumber,0,2)),range(14,18))){
                  $count++;
                }  
              }else{
                if(array_sum(array_slice($drawnumber,0,2)) == $selected){
                  $count++;
                }
              }
            break;
          }
          case 'Sum of 1st/3rd':{
            if($selected == '0-4'){
               if(in_array(array_sum([$drawnumber[0],$drawnumber[2]]),range(0,4))){
                 $count++;
               }
             }else if($selected == '14-18'){
               if(in_array(array_sum([$drawnumber[0],$drawnumber[2]]),range(14,18))){
                 $count++;
               }  
             }else{
               if(array_sum([$drawnumber[0],$drawnumber[2]]) == $selected){
                 $count++;
               }
             }
           break;
          }
          case 'Sum of 2nd/3rd':{
            if($selected == '0-4'){
               if(in_array(array_sum([$drawnumber[1],$drawnumber[2]]),range(0,4))){
                 $count++;
               }
             }else if($selected == '14-18'){
               if(in_array(array_sum([$drawnumber[1],$drawnumber[2]]),range(14,18))){
                 $count++;
               }  
             }else{
               if(array_sum([$drawnumber[1],$drawnumber[2]]) == $selected){
                 $count++;
               }
             }
           break;
          }

          case 'Tail Sum of 1st/2nd':{
            if(substr((string) array_sum(array_slice($drawnumber,0,2)), -1) == $selected){
              $count++;
            }
            break;
          }
          case 'Tail Sum of 1st/3rd':{
            if(substr((string) array_sum([$drawnumber[0],$drawnumber[2]]), -1) == $selected){
              $count++;
            }
            break;
          }
          case 'Tail Sum of 2nd/3rd':{
            if(substr((string) array_sum([$drawnumber[1],$drawnumber[2]]), -1) == $selected){
              $count++;
            }
            break;
          }
          case 'Sum of 3 No.':{
            if($selected == '0-6'){
               if(in_array(array_sum($drawnumber),range(0,4))){
                 $count++;
               }
             }else if($selected == '21-27'){
               if(in_array(array_sum($drawnumber),range(14,18))){
                 $count++;
               }  
             }else{
               if(array_sum($drawnumber) == $selected){
                 $count++;
               }
             }
           break;
         }
          case 'Tail Sum of 3 No.':{
            if(substr((string) array_sum($drawnumber), -1) == $selected){
              $count++;
            }
            break;
          }

        }
        return [
          'numwins' => $count ? $count : 0,
          'gameids' => $count ? [$label_id] : [],
          'status'  => $count ? 2 : 3
        ];
        
      }
      
      public static function group(array $selection, array $drawnumber, int $gameId){
        $count = 0;
        $position = $selection['position'];
        $selected = $selection['selection'];
        switch($position){
          case 'Group 3':{
          $maxKey = array_keys(array_count_values($drawnumber), max(array_count_values($drawnumber)))[0];
          $minKey = array_keys(array_count_values($drawnumber), min(array_count_values($drawnumber)))[0];
          if(in_array(2,array_count_values($drawnumber)) &&
          in_array($maxKey,$selected[0]) && in_array($minKey,$selected[1])){
            $count++;
          }
            break;
          }
          case 'Group 6':{
            sort($selected);
            sort($drawnumber);
            if(!in_array(2,array_count_values($drawnumber)) && count(array_intersect($selected[0],$drawnumber)) == 3){
              $count++;
            }
          }
        }
        return [
          'numwins' => $count ? $count : 0,
          'gameids' => $count ? [$gameId] : [],
          'status'  => $count ? 2 : 3
        ];
      }
      
      public static function span($selection,$drawnumber,$gameId){
         $count = 0;
         $selected = $selection['selection'];
         $label_id = $selection['label_id'];
         $max = max($drawnumber);
         $min = min($drawnumber);
         $span = $max - $min;
         if($span == $selected){
           $count++;
         }
        return [
          'numwins' => $count ? $count : 0,
          'gameids' => $count ? [$label_id] : [],
          'status'  => $count ? 2 : 3
        ];
      }


      ######  LONG DRAGON #############

      public static function GetBalls($gameId): string
      {
          $data = [
              '1149,1152,1155' => 1,
              '1150,1153,1156' => 2,
              '1151,1154,1157' => 3
          ];
          $found = [];
          foreach (array_keys($data) as $key) {
              if (in_array($gameId, explode(',', (string)$key))) {
                  $found[] = $data[$key];
              }
          }
          return count($found) == 0 ? '' : implode('', $found);
      }

      public static function RoadBetBSOEPC(array $selection, array $drawnumber, int $gameId){
        $count = 0;
        $ball = self::GetBalls($gameId) - 1;
        $data = [
            'Big' => $drawnumber[$ball] >= 5,
            'Small' => $drawnumber[$ball] <= 4,
            'Odd Sum' => $drawnumber[$ball] % 2 != 0,
            'even Sum' => $drawnumber[$ball] % 2 == 0,
            'Prime' => in_array($drawnumber[$ball],[1, 2, 3, 5, 7]),
            'Composite' => in_array($drawnumber[$ball],[0, 4, 6, 8, 9]),
        ];
        if($data[$selection[0]] == true){
            $count++;
        }
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status'  => $count ? 2 : 3
          ];

      }
    

      public static function RoadBet1st2nd3rd(array $selection, array $drawnumber, int $gameId){
        $count = 0;
      
        switch($gameId){
            case 1159:
            case 1164:
            case 1167:    
                $data = [
                    'Odd Sum' => array_sum(array_slice($drawnumber,0,2)) % 2 != 0,
                    'Even Sum' => array_sum(array_slice($drawnumber,0,2)) % 2 == 0,
                    'Tail Sum Big' => in_array(substr((string) array_sum(array_slice($drawnumber,0,2)), -1),[1, 2, 3, 5, 7]),
                    'Tail Sum Small' => in_array(substr((string) array_sum(array_slice($drawnumber,0,2)), -1),[0, 4, 6, 8, 9]),
                    'Tail Sum Prime' => in_array(substr((string) array_sum(array_slice($drawnumber,0,2)), -1),[1, 2, 3, 5, 7]),
                    'Tail Sum Composite' => in_array(substr((string) array_sum(array_slice($drawnumber,0,2)), -1),[0, 4, 6, 8, 9]),
                ];$data[$selection[0]] == true ? $count++ : null;
            break;
            case 1160:
            case 1165:
            case 1168: 
                    $data = [
                        'Odd Sum' => array_sum([$drawnumber[0],$drawnumber[2]]) % 2 != 0,
                        'Even even' => array_sum([$drawnumber[0],$drawnumber[2]]) % 2 == 0,
                        'Tail Sum Big' => in_array(substr((string) array_sum([$drawnumber[0],$drawnumber[2]]), -1),[1, 2, 3, 5, 7]),
                        'Tail Sum Small' => in_array(substr((string) array_sum([$drawnumber[0],$drawnumber[2]]), -1),[0, 4, 6, 8, 9]),
                        'Tail Sum Prime' => in_array(substr((string) array_sum([$drawnumber[0],$drawnumber[2]]), -1),[1, 2, 3, 5, 7]),
                        'Tail Sum Composite' => in_array(substr((string) array_sum([$drawnumber[0],$drawnumber[2]]), -1),[0, 4, 6, 8, 9]),
                    ];$data[$selection[0]] == true ? $count++ : null;
                break;
            case 1161:
            case 1166:
            case 1236: 
                $data = [
                    'Odd Sum' => array_sum([$drawnumber[1],$drawnumber[2]]) % 2 != 0,
                    'Even Sum' => array_sum([$drawnumber[1],$drawnumber[2]]) % 2 == 0,
                    'Tail Sum Big' => in_array(substr((string) array_sum([$drawnumber[1],$drawnumber[2]]), -1),[1, 2, 3, 5, 7]),
                    'Tail Sum Small' => in_array(substr((string) array_sum([$drawnumber[1],$drawnumber[2]]), -1),[0, 4, 6, 8, 9]),
                    'Tail Sum Prime' => in_array(substr((string) array_sum([$drawnumber[1],$drawnumber[2]]), -1),[1, 2, 3, 5, 7]),
                    'Tail Sum Composite' => in_array(substr((string) array_sum([$drawnumber[1],$drawnumber[2]]), -1),[0, 4, 6, 8, 9]),
                ];$data[$selection[0]] == true ? $count++ : null;
            break;
            case 1162:
            case 1163:
            case 1169:
                $data = [
                    'Odd Sum' => array_sum($drawnumber) % 2 != 0,
                    'Even Sum' => array_sum($drawnumber) % 2 == 0,
                    'Tail Sum Big' => in_array(substr((string) array_sum($drawnumber), -1),[1, 2, 3, 5, 7]),
                    'Tail Sum Small' => in_array(substr((string) array_sum($drawnumber), -1),[0, 4, 6, 8, 9]),
                    'Tail Sum Prime' => in_array(substr((string) array_sum($drawnumber), -1),[1, 2, 3, 5, 7]),
                    'Tail Sum Composite' => in_array(substr((string) array_sum($drawnumber), -1),[0, 4, 6, 8, 9]),
                ];$data[$selection[0]] == true ? $count++ : null;
            break;
        }
     
        return [
            'numwins' => $count ? $count : 0,
            'gameids' => $count ? [$gameId] : [],
            'status'  => $count ? 2 : 3
          ];

      }


}
