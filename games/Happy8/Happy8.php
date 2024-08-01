<?php

class Happy8 extends GamePlayFunctionHappy8
{

  public static function getGamePlayMethod(): array
  { //////////// THE INVOKE METHOD
    return parent::getGamePlayFunction(); ///////////////////////////////////////////
  } /////////////////////////////////////////////////////////////////////////////////

  public static function PickOne(array $selection, array $drawNumber, string $gameId): array
  {
    $count = 0;
    $newArray = array_merge($selection[0], $selection[1]);
    if (count(array_intersect($drawNumber, $newArray)) >= 1) {
      $count = 1;
    };
    return [
      'numwins' => $count ? $count : 0,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3,
    ];
  } //-> fn([1,2,3,4,5,6,7,8,9,10],[1,2,3,4,5,6,7,8,9,10,...20]) = true

  public static function PickTwo(array $selection, array $drawNumber, string $gameId): array
  {
    $count = 0;
    $newArray = array_merge($selection[0], $selection[1]);
    if (count(array_intersect($drawNumber, $newArray)) >= 2) {
      $count = 1;
    };
    return [
      'numwins' => $count ? $count : 0,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3,
    ];
  } //-> fn([1,2,3,4,5,6,7,8,9,10],[1,2,3,4,5,6,7,8,9,10...20]) = true

  public static function PickThree(array $selection, array $drawNumber, string $gameId): array
  {
    $count = 0;
    $newArray = array_merge($selection[0], $selection[1]);
    if (count(array_intersect($drawNumber, $newArray)) >= 3) {
      $count = 1;
    };
    return [
      'numwins' => $count ? $count : 0,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3,
    ];
  } //-> fn([1,2,3,4,5,6,7,8,9,10],[1,2,3,4,5,6,7,8,9,10...20]) = true

  public static function PickFour(array $selection, array $drawNumber, string $gameId): array
  {
    $count = 0;
    $newArray = array_merge($selection[0], $selection[1]);
    if (count(array_intersect($drawNumber, $newArray)) >= 4) {
      $count = 1;
    };
    return [
      'numwins' => $count ? $count : 0,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3,
    ];
  } //-> fn([1,2,3,4,5,6,7,8,9,10],[1,2,3,4,5,6,7,8,9,10...20]) = true

  public static function PickFive(array $selection, array $drawNumber, string $gameId): array
  {
    $count = 0;
    $newArray = array_merge($selection[0], $selection[1]);
    if (count(array_intersect($drawNumber, $newArray)) >= 5) {
      $count = 1;
    };
    return [
      'numwins' => $count ? $count : 0,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3,
    ];
  } //-> fn([1,2,3,4,5,6,7,8,9,10],[1,2,3,4,5,6,7,8,9,10...20]) = true

  public static function PickSix(array $selection, array $drawNumber, string $gameId): array
  {
    $count = 0;
    $newArray = array_merge($selection[0], $selection[1]);
    if (count(array_intersect($drawNumber, $newArray)) >= 6) {
      $count = 1;
    };
    return [
      'numwins' => $count ? $count : 0,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3,
    ];
  } //-> fn([1,2,3,4,5,6,7,8,9,10],[1,2,3,4,5,6,7,8,9,10...20]) = true

  public static function PickSeven(array $selection, array $drawNumber, string $gameId): array
  {
    $count = 0;
    $newArray = array_merge($selection[0], $selection[1]);
    if (count(array_intersect($drawNumber, $newArray)) >= 7) {
      $count = 1;
    };
    return [
      'numwins' => $count ? $count : 0,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3,
    ];
  } //-> fn([1,2,3,4,5,6,7,8,9,10],[1,2,3,4,5,6,7,8,9,10...20]) = true


  // happy 8 fun ------------------------------
  public static function FunOverUnder(array $selection, array $drawNumber, string $gameId): array
  {
    $count = 0;
    $superNum = array_filter($drawNumber, function ($num) {
      return is_numeric($num) && intval($num) >= 1 && intval($num) <= 40;
    });
    $duperNum = array_diff($drawNumber, $superNum);
    $data = [
      'Over'  => count($superNum) > count($duperNum),
      'Tie'   => count($superNum) == count($duperNum),
      'Under'    => count($duperNum) > count($superNum),
    ];
    $selected = $selection[0];
    if ($data[$selected[0]] == true) {
      $count = 1;
    }
    return [
      'numwins' => $count ? $count : 0,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3,
    ];
  }

  public static function FunOddEven(array $selection, array $drawNumber, string $gameId): array
  {
    $count = 0;
    $gameIds = [];
    $data = [
      'Odd'   => count(array_filter($drawNumber, fn ($num) => $num % 2 != 0)) > count(array_filter($drawNumber, fn ($num) => $num % 2 == 0)),
      'Tie'   => count(array_filter($drawNumber, fn ($num) => $num % 2 != 0)) == count(array_filter($drawNumber, fn ($num) => $num % 2 == 0)),
      'Even' => count(array_filter($drawNumber, fn ($num) => $num % 2 == 0)) > count(array_filter($drawNumber, fn ($num) => $num % 2 != 0))
    ];
    foreach ($selection[0] as $value) {
      if ($data[$value[0]] == true) {
        $gameIds[] = $value[1];
        $count++;
      }
    }
    return [
      'numwins' => $count ? $count : 0,
      'gameids' => $count ? $gameIds : [],
      'status' => $count ? 2 : 3,
    ];
  }

  public static function FunSum(array $selection, array $drawNumber, string $gameId)
  {
    $count = 0;
    $data = [
      'Big' => array_sum($drawNumber) > 810 ,
      'Odd' => array_sum($drawNumber) % 2 != 0 ,
      'Even' => array_sum($drawNumber) % 2 == 0 ,
      'Small' => array_sum($drawNumber) < 810 
    ];
    foreach ($selection[0] as $value) {
      if ($data[$value] == true) {
        $count++;
      }
    }
    return [
      'numwins' => $count ? $count : 0,
      'gameids' => $count ? array_fill(0, $count, $gameId) : [],
      'status' => $count ? 2 : 3,
    ];
  }

  ############################### HAPPY 8 Board Games ##################################


  public static function BigAndSmall(array $selection, array $drawNumber, string $gameId): array
  {
    $count = 0;
    $data = [
      'Big'   => array_sum($drawNumber) > 810,
      'Sum'   => array_sum($drawNumber) == 810,
      'Small' => array_sum($drawNumber) < 810
    ];
    if ($data[$selection[0]]) {
      $count++;
    }
    return [
      'numwins' => $count ? $count : 0,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3,
    ];
  }

  public static function SuperoirMiddelLower(array $selection, array $drawNumber, string $gameId) : array
  {
    $count = 0;
    $superNum = array_filter($drawNumber, function ($num) {
      return is_numeric($num) && intval($num) >= 1 && intval($num) <= 40;
    });
    $duperNum = array_diff($drawNumber, $superNum);
    $data = [
      'More Big' => count($superNum) > count($duperNum),
      'Tie'   => count($superNum) == count($duperNum),
      'More Small'    => count($duperNum) > count($superNum),
    ];
    if($data[$selection[0]]){
      $count++;
    }
    return [
      'numwins' => $count ? $count : 0,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3,
    ];
  }

  public static function OddTieEven(array $selection, array $drawNumber, string $gameId) : array
  {
    $count = 0;
    $data = [
      'More Odd'   => count(array_filter($drawNumber, fn ($num) => $num % 2 != 0)) > count(array_filter($drawNumber, fn ($num) => $num % 2 == 0)),
      'Tie'   => count(array_filter($drawNumber, fn ($num) => $num % 2 != 0)) == count(array_filter($drawNumber, fn ($num) => $num % 2 == 0)),
      'More EVen' => count(array_filter($drawNumber, fn ($num) => $num % 2 == 0)) > count(array_filter($drawNumber, fn ($num) => $num % 2 != 0))
    ];
    if($data[$selection[0]]){
      $count++;
    }
    return [
      'numwins' => $count ? $count : 0,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3,
    ];
  }

  public static function BOSOBESE(array $selection, array $drawNumber, string $gameId) : array
  {
    $count = 0;
    $data = [
      'Odd' => array_sum($drawNumber) % 2 != 0,
      'Even' => array_sum($drawNumber) % 2 == 0,
      'Big Odd' => array_sum($drawNumber) > 810 && array_sum($drawNumber) % 2 != 0 ,
      'Small Odd' => array_sum($drawNumber) < 810 && array_sum($drawNumber) % 2 != 0 ,
      'Big Even' => array_sum($drawNumber) > 810 && array_sum($drawNumber) % 2 == 0 ,
      'Small Even' => array_sum($drawNumber) < 810 && array_sum($drawNumber) % 2 == 0 
    ];
    if($data[$selection[0]]){
      $count++;
    }
    return [
      'numwins' => $count ? $count : 0,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3,
    ];
  }

  public static function GoldAndOthers(array $selection, array $drawNumber, string $gameId) : array
  {
    $count = 0;
    $data = [
      'Gold' => in_array(array_sum($drawNumber), range(210, 695)),
      'Wood' => in_array(array_sum($drawNumber), range(696, 763)),
      'Water' => in_array(array_sum($drawNumber), range(764, 855)),
      'Fire' => in_array(array_sum($drawNumber), range(856, 923)),
      'Earth' => in_array(array_sum($drawNumber), range(924, 1410))
    ];
    if($data[$selection[0]]){
      $count++;
    }
    return [
      'numwins' => $count ? $count : 0,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3,
    ];
  }

  // ##################  happy 8 Two Side Game ###################

  public static function Sum(array $selection, array $drawNumber, Int $gameId = null): array
  {
    $count = 0;
    $refund = 0;
    $data = [
      'Big' => array_sum($drawNumber) > 810,
      'Small' => array_sum($drawNumber) < 810,
      'Odd' => array_sum($drawNumber) % 2 != 0 ,
      'Even' => array_sum($drawNumber) % 2 == 0
    ];
    $selected = $selection['selection'];
    $gameId = $selection['label_id'];
    if(array_sum($drawNumber) == 810){
      $refund = 6;
    }else{
      if($data[$selected] == true){
        $count++;
      }
    }
    
    return [
      'numwins' => $count ? $count : 0,
      'gameids' => $count ? [$gameId] : [],
      'status' => ($count == 0 && $refund == 6) ? 6 : (($count >= 1 && $refund == 0) ? 2 : 3)
  ];
  }

  public static function SumPass(array $selection, array $drawNumber, Int $gameId = null): array
  {
    $count = 0;
    $refund = 0;
    $data = [
      'Big Even' => array_sum($drawNumber) > 810 && array_sum($drawNumber) % 2 == 0,
      'Small Even' => array_sum($drawNumber) < 810 && array_sum($drawNumber) % 2 == 0,
      'Big Odd' => array_sum($drawNumber) > 810 && array_sum($drawNumber) % 2 != 0,
      'Small Odd' => array_sum($drawNumber) < 810 && array_sum($drawNumber) % 2 != 0,
    ];
    $selected = $selection['selection'];
    $gameId = $selection['label_id'];
    if(array_sum($drawNumber) == 810){
      $refund = 6;
    }else{
      if($data[$selected] == true){
        $count++;
      };
    }
    
    return [
      'numwins' => $count ? $count : 0,
      'gameids' => $count ? [$gameId] : [],
      'status' => ($count == 0 && $refund == 6) ? 6 : (($count >= 1 && $refund == 0) ? 2 : 3)
  ];
  }

  public static function MoreFirstLast(array $selection, array $drawNumber, Int $gameId = null): array
  {
    $count = 0;
    $refund = 0;
    $superNum = array_filter($drawNumber, function ($num) {
      return is_numeric($num) && intval($num) >= 1 && intval($num) <= 40;
    });
    $duperNum = array_diff($drawNumber, $superNum);
    $data = [
      'More First' => count($superNum) > count($duperNum),
      'More Last' => count($superNum) < count($duperNum)
    ];
    
    $gameId = $selection['label_id'];
    $selected = $selection['selection'];
    if(count($superNum) == count($duperNum)){
      $refund = 6;
    }else{
      if($data[$selected] == true){
        $count++;
      };
    }
    
    return [
      'numwins' => $count ? $count : 0,
      'gameids' => $count ? [$gameId] : [],
      'status' => ($count == 0 && $refund == 6) ? 6 : (($count >= 1 && $refund == 0) ? 2 : 3)
  ];
  }

  public static function MoreEvenOdd(array $selection, array $drawNumber, Int $gameId = null): array
  {
    $count = 0;
    $refund = 0;
    $superNum = array_filter($drawNumber, function ($num) {
      return is_numeric($num) && intval($num) >= 1 && intval($num) <= 40;
    });
    $duperNum = array_diff($drawNumber, $superNum);
    $data = [
      'More Even' => count(array_filter($drawNumber, fn ($num) => $num % 2 == 0)) > count(array_filter($drawNumber, fn ($num) => $num % 2 != 0)),
      'More Odd' => count(array_filter($drawNumber, fn ($num) => $num % 2 == 0)) < count(array_filter($drawNumber, fn ($num) => $num % 2 != 0))
    ];
    
    $selected = $selection['selection'];
    $gameId = $selection['label_id'];
    if(count($superNum) == count($duperNum)){
      $refund = 6;
    }else{
      if($data[$selected] == true){
        $count++;
      };
    }
    
    return [
      'numwins' => $count ? $count : 0,
      'gameids' => $count ? [$gameId] : [],
      'status' => ($count == 0 && $refund == 6) ? 6 : (($count >= 1 && $refund == 0) ? 2 : 3)
  ];
  }

  public static function GoldAndOthers1(array $selection, array $drawNumber, Int $gameId = null): array
  {
    $count = 0;
    $refund = 0;
    $data = [
      'Gold' => in_array(array_sum($drawNumber), range(210, 695)),
      'Wood' => in_array(array_sum($drawNumber), range(696, 763)),
      'Water' => in_array(array_sum($drawNumber), range(764, 855)),
      'Fire' => in_array(array_sum($drawNumber), range(856, 923)),
      'Earth' => in_array(array_sum($drawNumber), range(924, 1410))
    ];
    $selected = $selection['selection'];
    $gameId = $selection['label_id'];
   
    if($data[$selected] == true){
      $count++;
    };
  
    return [
      'numwins' => $count ? 1 : 0,
      'gameids' => $count ? [$gameId] : [],
      'status' =>  $count ? 2 : 3
  ];
  }

  public static function Ballnumbers(array $selection, array $drawNumber, Int $gameId = null): array
  { $count = 0;
    $selected = $selection['selection'];
    $gameId = $selection['label_id'];
    if(in_array($selected, $drawNumber)){
      $count++;
    }
    return [
      'numwins' => $count ? 1 : 0,
      'gameids' => $count ? [$gameId] : [],
      'status' =>  $count ? 2 : 3
    ];
  }

  ############################### HAPPY 8 ROAD BET | LONG DRAGON ##################################

  public static function SumBigSmallOddEven(array $selection, array $drawNumber, Int $gameId = null): array
  {
    $count = 0;
    $superNum = array_filter($drawNumber, function ($num) {
      return is_numeric($num) && intval($num) >= 1 && intval($num) <= 40;
    });
    $duperNum = array_diff($drawNumber, $superNum);
    $data = [
      'Big' =>   array_sum($drawNumber) > 810,
      'Small' => array_sum($drawNumber) < 810,
      'Even' =>  array_sum($drawNumber) % 2 == 0,
      'Odd' =>   array_sum($drawNumber) % 2 != 0,
      'More First' => count($superNum) > count($duperNum),
      'More Last' => count($superNum) < count($duperNum),
      'More Even' => count(array_filter($drawNumber, fn ($num) => $num % 2 == 0)) > count(array_filter($drawNumber, fn ($num) => $num % 2 != 0)),
      'More Odd' => count(array_filter($drawNumber, fn ($num) => $num % 2 != 0)) > count(array_filter($drawNumber, fn ($num) => $num % 2 == 0))
    ];
    // return array_sum($drawNumber) == 810 ? 'Tie' ? $data[$selection[0]];
    if($data[$selection[0]] == true){
      $count++;
    }
    return [
      'numwins' => $count ? 1 : 0,
      'gameids' => $count ? [$gameId] : [],
      'status' =>  $count ? 2 : 3
  ];
  }

  ##--------------------------happy8 fantan games -------------------------------


  public static function getColor(array $drawnumber)
  { $count = 0;
    $data = [
      454 => count(array_intersect(range(1, 20), $drawnumber)),
      455 => count(array_intersect(range(21, 40), $drawnumber)),
      456 => count(array_intersect(range(41, 60), $drawnumber)),
      457 => count(array_intersect(range(61, 80), $drawnumber))
    ];
    $maxValue = max($data);
    return array_keys($data, $maxValue);
  }

  public static function Happy8BSOE(array $selection, array $drawnumber, Int $gameId): array
  {

    $drawnumbSum = array_sum($drawnumber);
    $count = 0;
    $refund = 0;
    $gameids = [];
    if ($drawnumbSum == 810) {
      $refund = 6;
    } else {
      $data = [
        450 => $drawnumbSum >= 811 && $drawnumbSum  <= 1410,
        451 => $drawnumbSum >= 210 && $drawnumbSum  <= 809,
        452 => $drawnumbSum % 2 != 0,
        453 => $drawnumbSum % 2 == 0
      ];

      if ($data[$selection[0]] == true) {
        $count++;
        $gameids[] = $gameId;
      }
    }
    return [
      'numwins' => $count ? $count : 0,
      'gameids' => $count ? $gameids : [],
      'status' => ($count == 0 && $refund == 6) ? 6 : (($count >= 1 && $refund == 0) ? 2 : 3)
    ];
  }

  public static function happy8color(array $selection, array $drawnumber, Int $gameId): array
  {

    $count = 0;
    $refund = 0;
    $gameids = [];
    $intNums = array_map('intval', $drawnumber);
    $result = self::getColor($intNums);
    if (count($result) == 4 || array_sum($intNums) == 810) {
      $refund = 6;
    } else {
      if(in_array($selection[0], $result)) {
        $count++;
        $gameids[] = $gameId;
      }
    }

    return [
      'numwins' => $count ? $count : 0,
      'gameids' => $count ? $gameids : [],
      'status' => ($count == 0 && $refund == 6) ? 6 : (($count >= 1 && $refund == 0) ? 2 : 3)
    ];
  }

  public static function happy8fiveElement(array $selection, array $drawnumber, Int $gameId): array
  {
    $sum = array_sum($drawnumber);
    $count = 0;
    $refund = 0;
    $data = [
      458 => in_array($sum, range(925, 1410)),
      459 => in_array($sum, range(210, 695)),
      460 => in_array($sum, range(969, 763)),
      461 => in_array($sum, range(764, 856)),
      469 => in_array($sum, range(857, 924))
    ];

    if ($sum == 810) {
      $refund = 6;
    } else {
      if ($data[$selection[0]] == true) {
        $count++;
        $gameids[] = $gameId;
      }
    }

    return [
      'numwins' => $count ? 1 : 0,
      'gameids' => $count ? $gameids : [],
      'status' => ($count == 0 && $refund == 6) ? 6 : (($count >= 1 && $refund == 0) ? 2 : 3)
    ];
  }

  public static function Happy8fantanOne(array $selection, array $drawNumber, int $gameId)
  {

    $sum = array_sum($drawNumber);
    $remainder =  array_sum(str_split($sum, 1)) % 4;
    $results = [
      0 => ["529", "524", "516", "523", "515", "518", "521", "510", "511", "512"],
      1 => ["526", "519", "517", "520", "518", "521", "511", "512", "513"],
      2 => ["527", "519", "514", "522", "515", "523", "510", "512", "513"],
      3 => ["529", "524", "516",  "523", "515",  "518", "521", "510", "511", "512"]
    ];
    $count = 0;
    $possibleWins = $results[$remainder] ?? [];
    $count  = in_array($selection[0], $possibleWins) ? 1 : 0;
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status'  => $count ? 2 : 3
    ];
  }

  public static function Happy8fantan2(array $selection, array $drawnumber, int $gameId): array
  {
    $count = 0;
    $gameids = [];
    $sum = array_sum($drawnumber);
    $remainder =  array_sum(str_split($sum, 1)) % 4;
    $data = [
      0 => [549, 551, 537, 543, 540, 539, 541],
      1 => [546, 550, 530, 544, 545, 543, 534],
      2 => [547, 551, 534, 532, 533, 531, 475],
      3 => [548, 550, 538, 537, 535, 536, 542]
    ];

    if (in_array($selection[0], $data[$remainder])) {
      $count++;
      $gameids[] = $gameId;
    };

    return [
      'numwins' => $count ? $count : 0,
      'gameids' => $count ? $gameids : [],
      'status' => $count ? 2 : 3,
    ];
  }
}


