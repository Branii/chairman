<?php

class Eleven5 extends GamePlayFunction11x5
{

  public static function getGamePlayMethod(): array
  { //////////// THE INVOKE METHOD
    return parent::getGamePlayFunction(); /////////////////////////////////////////////
  } ///////////////////////////////////////////////////////////////////////////////////

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

  public static function f3straightJoint(array $selection, array $drawNumber, int $gameId):Array
  {
    $count = 0;
    $winningNumbers = array_slice($drawNumber, 0, 3);
  if(in_array($winningNumbers[0], $selection[0]) && in_array($winningNumbers[1], $selection[1]) && in_array($winningNumbers[2], $selection[2])){
       $count++;
     }
      return [
        'numwins' => $count,
        'gameids' => $count ? [$gameId] : [],
       'status' => $count ? 2 : 3
      ]; 

  } // fn -> [['02','01'],['03','04'],['05','07']],['01','03','08','04','05'] = true

  public static function f3groupJoint(array $selection, array $drawNumber,int $gameId):Array
  {
        $count = 0;
        $winningNumbers = array_slice($drawNumber, 0, 3);
      if (count(array_intersect($selection[0], $winningNumbers)) ==  3 ) {
        $count++;
      };
      return [
        'numwins' => $count,
        'gameids' => $count ? [$gameId] : [],
        'status' => $count ? 2 : 3
      ]; 
  } // fn -> ['03','04','02'],['04','03','02','04','05'] = true

  public static function f3straightManual(array $selection, array $drawNumber,int $gameId):Array
  {
    $winningNumbers = array_slice($drawNumber, 0, 3);
    sort($winningNumbers);
    foreach ($selection as $item) {
      $newArr = str_split($item[0], 2);
      $count =  implode(',', $newArr) === implode(',', $winningNumbers) ? 1 :0;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
    ]; 
  } // fn -> [['030402'],['010608'],['040902']],['04','03','02','04','05'] = true

  public static function f3groupManual(array $selection, array $drawNumber,int $gameId) :Array
  {
    $winningNumbers = array_slice($drawNumber, 0, 3);
    sort($winningNumbers);
    foreach ($selection as $item) {
      $newArr = str_split($item[0], 2);
      sort($newArr);
      $count = ($newArr == $winningNumbers)? 1 :0;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
    'status' => $count ? 2 : 3
    ]; 
  } // fn -> [['030405'],['010608'],['040902']],['04','03','05','04','05'] = true


  //############################# first 2 ###################################//

  public static function f2straightJoint(array $selection, array $drawNumber,int $gameId):Array
  {
      $count = 0;
      $winningNumbers = array_slice($drawNumber, 0, 2);
       if(in_array($winningNumbers[0], $selection[0]) && in_array($winningNumbers[1], $selection[1])){
          $count++;
       }
        return [
          'numwins' => $count,
          'gameids' => $count ? [$gameId] : [],
          'status' => $count ? 2 : 3
        ]; 

  } // fn -> [['01','02'],['03','05']],['01','03','08','04','05'] = true

  public static function f2groupJoint(array $selection, array $drawNumber,int $gameId): Array
  {
    $count = 0;
    $winningNumbers = array_slice($drawNumber, 0, 2);
   if(count(array_intersect($selection[0], $winningNumbers)) ==  2){
    $count++;
   }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
     'status' => $count ? 2 : 3
    ]; 

  } // fn -> ['03','04','02'],['04','03','02','04','05'] = true

  public static function f2straightManual(array $selection, array $drawNumber,int $gameId):Array
  {
    $winningNumbers = array_slice($drawNumber, 0, 2);
    sort($winningNumbers);
    foreach ($selection as $item) {
      $newArr = str_split($item[0], 2);
      $count = implode(',', $newArr) === implode(',', $winningNumbers) ? 1 :0;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
    ]; 
  } // fn -> [['030402'],['010608'],['040902']],['04','03','02','04','05'] = true

  public static function f2groupManual(array $selection, array $drawNumber,int $gameId):Array
  {
    $winningNumbers = array_slice($drawNumber, 0, 2);
    sort($winningNumbers);
    foreach ($selection as $item) {
      $newArr = str_split($item[0], 2);
      sort($newArr);
      $count =  ($newArr == $winningNumbers) ? 1: 0;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
    ]; 
  } // fn -> [['030405'],['010608'],['040902']],['04','03','05','04','05'] = true

  //############################# first 3 Any place ###################################//

  public static function anyPlace(array $selection, array $drawNumber,int $gameId): Array
  {
    $count = 0;
    $winningNumbers = array_slice($drawNumber, 0, 3);
    if(count(array_intersect($selection[0], $winningNumbers)) >= 1) {
      $count++;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
     'status' => $count ? 2 : 3
    ]; 

  } // fn -> ['03','04','02'],['04','03','02','04','05'] = true

  //############################# Fixed place ###################################//

  public static function fixedPlace(array $selection, array $drawNumber,$gameId): Array
  {
    $count = 0;
    $winningNumbers = array_slice($drawNumber, 0, 3);
   if(in_array($winningNumbers[0], $selection[0]) || in_array($winningNumbers[1], $selection[1]) || in_array($winningNumbers[2], $selection[2])) {
    $count++;
   }
   return [
    'numwins' => $count,
    'gameids' => $count ? [$gameId] : [],
   'status' => $count ? 2 : 3
  ]; 
  } // fn -> [['01','02'],['03','05']],['01','03','08','04','05'] = true


  //############################# Pick Joint ###################################//

  public static function pickJoint1x1(array $selection, array $drawNumber,int $gameId): Array
  {
    $count = 0;
    $winningNumbers = array_slice($drawNumber, 0, 5);
   if(count(array_intersect($selection[0], $winningNumbers)) == 1) {
    $count++;
   }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
    ]; 
    
  } // fn -> ['03','04','02'],['04','03','02','04','05'] = true

  public static function pickJoint2x2(array $selection, array $drawNumber,int $gameId): Array
  {
    $count = 0;
    $winningNumbers = array_slice($drawNumber, 0, 5);
   if(count(array_intersect($selection[0], $winningNumbers)) == 2) {
    $count++;
   }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
     'status' => $count ? 2 : 3
    ]; 
    
  } // fn -> ['03','04'],['04','03','02','04','05'] = true

  public static function pickJoint3x3(array $selection, array $drawNumber,int $gameId): Array
  {
    $count = 0;
    $winningNumbers = array_slice($drawNumber, 0, 5);
   if(count(array_intersect($selection[0], $winningNumbers)) == 3) {
    $count++;
   }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
     'status' => $count ? 2 : 3
    ]; 
    
  } // fn -> ['03','04','02'],['04','03','02','04','05'] = true

  public static function pickJoint4x4(array $selection, array $drawNumber,int $gameId): Array
  {
    $count = 0;
    $winningNumbers = array_slice($drawNumber, 0, 5);
   if(count(array_intersect($selection[0], $winningNumbers)) == 4) {
    $count++;
   }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
    ]; 
    
  } // fn -> ['03','04','02','01'],['04','03','02','04','05'] = true

  public static function pickJoint5x5(array $selection, array $drawNumber,int $gameId): Array
  {
    $count = 0;
    $winningNumbers = array_slice($drawNumber, 0, 5);
   if(count(array_intersect($selection[0], $winningNumbers)) == 5) {
    $count++;
   }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
     'status' => $count ? 2 : 3
     ]; 
    
  } // fn -> ['03','04','02','07','08'],['04','03','02','08','07'] = true

  public static function pickJoint5x6(array $selection, array $drawNumber,int $gameId):Array
  {
    $count = 0;
    $winningNumbers = array_slice($drawNumber, 0, 5);
   if(count(array_intersect($selection[0], $winningNumbers)) == 5) {
    $count++;
   }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
     'status' => $count ? 2 : 3
    ]; 
    
  } // fn -> ['03','04','02','07','08','01'],['04','03','02','08','07'] = true

  public static function pickJoint5x7(array $selection, array $drawNumber,int $gameId): Array
  {
    $count = 0;
    $winningNumbers = array_slice($drawNumber, 0, 5);
   if(count(array_intersect($selection[0], $winningNumbers)) == 5) {
    $count++;
   }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
    ]; 
  } // fn -> ['03','04','02','07','08','01','06'],['04','03','02','08','07'] = true

  public static function pickJoint5x8(array $selection, array $drawNumber,int $gameId): Array
  {
    $count = 0;
    $winningNumbers = array_slice($drawNumber, 0, 5);
   if(count(array_intersect($selection[0], $winningNumbers)) == 5) {
    $count++;
   }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
    ]; 
  } // fn -> ['03','04','02','07','08','01','06','09','04'],['04','03','02','08','07'] = true


  //############################# Pick Manual ###################################//

  public static function pickManual1x1(array $selection, array $drawNumber,int $gameId):Array
  {
    $count = 0;
    $winningNumbers = array_slice($drawNumber, 0, 5);
    foreach ($selection as $item) {
      $newArr = $item[0];
    if (in_array($newArr, $winningNumbers)){
      $count++;
     }
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
    ];
  } // fn -> [['03'],['04'],['02'],['07'],['08'],['01'],['06'],['09'],['04'],['05']],['04','03','02','08','07'] = true

  public static function pickManual2x2(array $selection, array $drawNumber,int $gameId):Array
  {
     $count  = 0;
    $winningNumbers = array_slice($drawNumber, 0, 5);
    foreach ($selection as $item) {
      $newArr = str_split($item[0], 2);
    if (count(array_intersect($newArr, $winningNumbers)) == 2){
      $count++;
    };
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
    ]; 
  } // fn -> [['0304'],['0207'],['0801'],['0609'],['0405']],['04','03','02','08','07'] = true

  public static function pickManual3x3(array $selection, array $drawNumber,int $gameId):Array
  {
    $count = 0;
    $winningNumbers = array_slice($drawNumber, 0, 5);
    foreach ($selection as $item) {
      $newArr = str_split($item[0], 2);
       if(count(array_intersect($newArr, $winningNumbers)) == 3){
        $count++;
       }
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
    ]; 
  } // fn -> [['030401'],['020705'],['080102'],['060904'],['040502']],['04','03','02','08','07'] = true

  public static function pickManual4x4(array $selection, array $drawNumber,int $gameId):Array
  {
    $count = 0;
    $winningNumbers = array_slice($drawNumber, 0, 5);
    foreach ($selection as $item) {
      $newArr = str_split($item[0], 2);
     if(count(array_intersect($newArr, $winningNumbers)) == 4){
        $count++;
     }
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
    ]; 
  } // fn -> [['03040102'],['02070508'],['08010203'],['06090405'],['04050206']],['04','03','02','08','07'] = true

  public static function pickManual5x5(array $selection, array $drawNumber,int $gameId):Array
  {
    $count = 0;
    $winningNumbers = array_slice($drawNumber, 0, 5);
    foreach ($selection as $item) {
      $newArr = str_split($item[0], 2);
      if(count(array_intersect($newArr, $winningNumbers)) == 5){
        $count++;
      }
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
    ]; 
  } // fn -> [['0304010203'],['0207050801'],['0801020302'],['0609040509'],['0405020604']],['04','03','02','08','07'] = true

  public static function pickManual5x6(array $selection, array $drawNumber): Bool
  {
    $winningNumbers = array_slice($drawNumber, 0, 5);
    foreach ($selection as $item) {
      $newArr = str_split($item[0], 2);
      return count(array_intersect($newArr, $winningNumbers)) == 5;
    }
    return false;
  } // fn -> [['0304010203'],['0207050801'],['0801020302'],['0609040509']],['04','03','02','08','07'] = true

  public static function pickManual5x7(array $selection, array $drawNumber,int $gameId):array
  {
    $count = 0;
    $winningNumbers = array_slice($drawNumber, 0, 5);
    foreach ($selection as $item) {
      $newArr = str_split($item[0], 2);
      if(count(array_intersect($newArr, $winningNumbers)) == 5){
        $count++;
      }
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
    ]; 
  } // fn -> [['01020304050607'],['01020304058607'],['09020304050607'],['01020304050609']],['04','03','02','08','07'] = true

  public static function pickManual5x8(array $selection, array $drawNumber,int $gameId):Array
  {
    $count = 0;
    $winningNumbers = array_slice($drawNumber, 0, 5);
    foreach ($selection as $item) {
      $newArr = str_split($item[0], 2);
      if(count(array_intersect($newArr, $winningNumbers)) == 5){
        $count++;
      }
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
    ]; 
  } // fn -> [['0102030405060708'],['0102030405860708'],['0902030405060708'],['0102030405060908']],['04','03','02','08','07'] = true


  //############################# Fixed Digit ###################################//


  public static function fixedDigit2x2(array $selection, array $drawNumber,int $gameId):Array
  {
    $count = 0;
    $winningNumbers = array_slice($drawNumber, 0, 5);
  if(count(array_intersect($winningNumbers, $selection[0])) == 1 && count(array_intersect($winningNumbers, $selection[1])) == 1){
    $count++;
  }
  return [
    'numwins' => $count,
    'gameids' => $count ? [$gameId] : [],
    'status' => $count ? 2 : 3
  ]; 
  } // fn -> [['03'],['04']],['04','03','02','08','07'] = true

  public static function fixedDigit3x3(array $selection, array $drawNumber,int $gameId):Array
  {
    $count = 0;
    $winningNumbers = array_slice($drawNumber, 0, 5);
    if(count(array_intersect($winningNumbers, $selection[0])) == 2 && count(array_intersect($winningNumbers, $selection[1])) == 1){
      $count++;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
    ]; 
  } // fn -> [['03','04'],['02']],['04','03','02','08','07'] = true

  public static function fixedDigit4x4(array $selection, array $drawNumber,int $gameId):Array
  {
    $count = 0;
    $winningNumbers = array_slice($drawNumber, 0, 5);
    $arrCombine = array_merge($selection[0], $selection[1]);
     if(count(array_intersect($winningNumbers, $arrCombine)) == 4){
      $count++;
     }
     return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
    ]; 
  } // fn -> [['03','04','01'],['02','08']],['04','03','02','08','07'] = true

  public static function fixedDigit5x5(array $selection, array $drawNumber,int $gameId):array
  {
    $count = 0;
    $winningNumbers = array_slice($drawNumber, 0, 5);
    $arrCombine = array_merge($selection[0], $selection[1]);
    if(count(array_intersect($winningNumbers, $arrCombine)) == 5){
      $count++;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
    ]; 
  } // fn -> [['03','04','01','02'],['02','08','07']],['04','03','02','08','07'] = true

  public static function fixedDigit5x6(array $selection, array $drawNumber,int $gameId):array
  {
    $count = 0;
    $winningNumbers = array_slice($drawNumber, 0, 5);
    $arrCombine = array_merge($selection[0], $selection[1]);
    if(count(array_intersect($winningNumbers, $arrCombine)) == 5){
      $count++;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
    ]; 
  } // fn -> [['03','04','01','02'],['02','08','07','06']],['04','03','02','08','07'] = true

  public static function fixedDigit5x7(array $selection, array $drawNumber,int $gameId):array
  {
    $count = 0;
    $winningNumbers = array_slice($drawNumber, 0, 5);
    $arrCombine = array_merge($selection[0], $selection[1]);
    if(count(array_intersect($winningNumbers, $arrCombine)) == 5){
      $count++;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
    ]; 
  } // fn -> [['03','04','01','02'],['02','08','07','06','09']],['04','03','02','08','07'] = true

  public static function fixedDigit5x8(array $selection, array $drawNumber,int $gameId):Array
  {
    $count = 0;
    $winningNumbers = array_slice($drawNumber, 0, 5);
    $arrCombine = array_merge($selection[0], $selection[1]);
    if(count(array_intersect($winningNumbers, $arrCombine)) == 5){
      $count++;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
    ]; 
  } // fn -> [['03','04','01','02'],['02','08','07','06','09','04']],['04','03','02','08','07'] = true

  //############################# Fun ###################################//

  public static function funOddEven(array $selection, array $drawNumber,int $gameId): Array
  {
    $winningNumbers = array_slice($drawNumber, 0, 5);
    $odd = count(array_intersect(['01', '03', '05', '07', '09', '11'], $winningNumbers));
    $eve = count(array_intersect(['02', '04', '06', '08', '10', '12'], $winningNumbers));
    $result = $odd . ' odd ' . $eve . ' Even';
    $count = 0;
    $gameid= [];
    foreach ($selection[0] as $item) {
      if ($item == $result){
        $count++;
        $gameids[] = $gameId;
      };
    };
    return [
      'numwins' => $count,
      'gameids' => $count ? $gameids : [],
     'status' => $count ? 2 : 3
    ]; 
  } // fn -> [['2 Odd 3 Even'],['4 Odd 1 Even']],['04','03','02','08','07'] = true

  public static function funTheMiddleNo(array $selection, array $drawNumber,int $gameId):Array
  {
    $count = 0;
    $winningNumbers = array_slice($drawNumber, 0, 5);
   if (in_array($winningNumbers[2], $selection[0])){
    $count++;
   };
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
     'status' => $count ? 2 : 3
    ]; 

  } // fn -> ['08'],['04','03','02','08','07'] = true

  //############################# Rapido,2Sides ###################################//

  // big > 30
  // small < 30
  // tie = 30
  // odd = 1,3,5,7,9
  // even = 2,4,6,8,



  //############################# Board Games ###################################//

  public static function UpperAndLowerPlate(array $selection, array $drawNumber,int $gameId):Array
  { // 
    $data = [
      'Offering' => count(array_intersect(['07', '08', '09', '10', '11'], $drawNumber)) > count(array_intersect(['01', '02', '03', '04', '05'], $drawNumber)) ? 1: 0,
      'Lower Plate' => count(array_intersect(['01', '02', '03', '04', '05'], $drawNumber)) > count(array_intersect(['07', '08', '09', '10', '11'], $drawNumber)) ? 1 : 0,
      'Tie' => count(array_intersect(['01', '02', '03', '04', '05'], $drawNumber)) == count(array_intersect(['07', '08', '09', '10', '11'], $drawNumber)) ? 1 : 0
    ];
    $count = 0;
    if($data[$selection[0]] == 1){
      $count++;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
    ]; 
  }

  public static function GuessTheNumberSum(array $selection, array $drawNumber,int $gameId):Array
  {
    $count = 0;
    if(array_sum($drawNumber) == $selection[0]){
      $count++;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
    ]; 
  }

  public static function GuessTheNumberMiddle(array $selection, array $drawNumber,int $gameId):array
  {
    $count = 0;
    sort($drawNumber);
  if($drawNumber[2] == $selection[0]){
     $count++;
  }
  return [
    'numwins' => $count,
    'gameids' => $count ? [$gameId] : [],
    'status' => $count ? 2 : 3
  ]; 
  }

  public static function OddandEvenDisk(array $selection, array $drawNumber,int $gameId):array
  {
    $data = [
      'Single Plate' => count(array_intersect(['01', '03', '05', '07', '09', '11'], $drawNumber)) > count(array_intersect(['02', '04', '06', '08', '10'], $drawNumber)) ? true : false,
      'Double Lotus' => count(array_intersect(['01', '03', '05', '07', '09', '11'], $drawNumber)) < count(array_intersect(['02', '04', '06', '08', '10'], $drawNumber)) ? true : false
    ];
    $count = 0;
    if($data[$selection[0]] == true){
      $count++;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
    ]; 
  }



  // board games type 2****************************************************************************



  public static function bull_bull_board(array $selection, array $drawNumber, int $gameIds): array
  {

      $gameid = [];
      $count = 0;
      $data = [
          1196 => empty(self::bullChecker($drawNumber,  [0, 10, 20])) ? true : false, // no bull
          1187 => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) == 1 : null, // bull 1
          1188 => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) == 2 : null, // bull 2
          1189 => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) == 3 : null, // bull 3
          1190 => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) == 4 : null, // bull 4
          1191 => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) == 5 : null, // bull 5
          1192 => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) == 6 : null, // bull 6
          1193 => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) == 7 : null, // bull 7
          1194 => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) == 8 : null, // bull 8
          1252 => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) == 9 : null, // bull 9
          1195 => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) == 0 : null // bull bull
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
          1183 => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) > 4 : false, // bull big
          1185 => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) < 5 : false, // bull small
          1184 => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) % 2 != 0 : false, // bull odd
          1186 => !empty(self::bullChecker($drawNumber, [0, 10, 20])) ? self::getBullNumber(self::bullChecker($drawNumber, [0, 10, 20]), $drawNumber) % 2 == 0 : false, // bull even
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

      $data = [5 => 1197, 4 => 1198, 3 => 1199, 2 => 1200, 1 => 1201];
      $filtered_keys = array_filter(array_keys($data), function ($key) use ($data, $selection) {
          return in_array($data[$key], $selection);
      });

      $maxValue = max($drawnumber);
      $positions = array_keys(array_reverse($drawnumber), $maxValue);
      $poss = array_filter($positions, fn ($position) => in_array($position + 1, $filtered_keys));
      $count = count($poss);
      $squaredNumbers = array_map(fn ($num) => $data[$num + 1], $poss);

      return [
          'numwins' => $count ? $count : 0,
          'gameids' => $count ? $squaredNumbers : [],
          'status' => $count ? 2 : 3
      ];
  }

  public static function board_minimum(array $selection, array $drawnumber, int $gameId): array
  {

      $data = [5 => 1202, 4 => 1203, 3 => 1204, 2 => 1205, 1 => 1206];
      $filtered_keys = array_filter(array_keys($data), function ($key) use ($data, $selection) {
          return in_array($data[$key], $selection);
      });
      $minValue = min($drawnumber);
      $positions = array_keys(array_reverse($drawnumber), $minValue);
      $poss = array_filter($positions, fn ($position) => in_array($position + 1, $filtered_keys));
      $count = count($poss);
      $squaredNumbers = array_map(fn ($num) => $data[$num + 1], $poss);

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
        1207 => self::DT(0, 4, $drawnumber) ==  1, // dragon
        1208 => self::DT(0, 4, $drawnumber) ==  2, // tiger
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





  //############################# ROAD BET 11X5 ###################################//

  public static function DT(Int $idx1, Int $idx2, array $drawNumber): String
  { // dragon|tiger|tie pattern
    $drawNumber = explode(",", implode(",", $drawNumber));
    $v1 = $drawNumber[$idx1];
    $v2 = $drawNumber[$idx2];
    return ($v1 > $v2) ? "303" : (($v1 == $v2) ? "Tie" : "304");
  }

  public static function DTT(Int $idx1, Int $idx2, array $drawNumber): String
  { // dragon|tiger|tie pattern
    $drawNumber = explode(",", implode(",", $drawNumber));
    $v1 = $drawNumber[$idx1];
    $v2 = $drawNumber[$idx2];
    return ($v1 > $v2) ? "Dragon" : (($v1 == $v2) ? "Tie" : "Tiger");
  }


  public static function SumAllDrawNumber(array $selection, array $drawNumber,int $gameId): Array
  {
    $data = [
      'Big' =>   array_sum($drawNumber) > 30 ? true : false,
      'Small' => array_sum($drawNumber) < 30 ? true : false,
      'Even' =>  array_sum($drawNumber) % 2 == 0 ? true : false,
      'Odd' =>   array_sum($drawNumber) % 2 != 0 ? true : false,
      'Dragon' => self::DTT(0, 4, $drawNumber) == "Dragon" ? true : false,
      'Tiger' =>  self::DTT(0, 4, $drawNumber)  == "Tiger" ? true : false
    ];
    if((array_sum($drawNumber)) == 30){
       return ['status' => 6] ;
    }
    $count = 0;
    if($data[$selection[0]] == true){
      $count++;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
    ]; 
  }


  public static function FirstBall(array $selection, array $drawNumber,int $gameId):array
  {
    $data = [
      'Big' =>  intval($drawNumber[0]) > 5 ? true : false,
      'Small' => intval($drawNumber[0]) < 6 ? true : false,
      'Even' => intval($drawNumber[0]) % 2 == 0 ? true : false,
      'Odd' => intval($drawNumber[0]) % 2 != 0 ? true : false
    ];
    $count = 0;
      if($data[$selection[0]] == true){
        $count++;
      }
      return [
        'numwins' => $count,
        'gameids' => $count ? [$gameId] : [],
       'status' => $count ? 2 : 3
      ]; 
  }

  public static function SecondBall(array $selection, array $drawNumber,int $gameId):array
  {
    $data = [
      'Big' =>  intval($drawNumber[1]) > 5 ? true : false,
      'Small' => intval($drawNumber[1]) < 6 ? true : false,
      'Even' => intval($drawNumber[1]) % 2 == 0 ? true : false,
      'Odd' => intval($drawNumber[1]) % 2 != 0 ? true : false
    ];
    $count = 0;
    if($data[$selection[0]] == true){
      $count++;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
     'status' => $count ? 2 : 3
    ]; 
  }

  public static function ThirdBall(array $selection, array $drawNumber,int $gameId):Array
  {
    $data = [
      'Big' =>  intval($drawNumber[2]) > 5 ? true : false,
      'Small' => intval($drawNumber[2]) < 6 ? true : false,
      'Even' => intval($drawNumber[2]) % 2 == 0 ? true : false,
      'Odd' => intval($drawNumber[2]) % 2 != 0 ? true : false
    ];
      $count = 0;
      if($data[$selection[0]] == true){
        $count++;
      }
      return [
        'numwins' => $count,
        'gameids' => $count ? [$gameId] : [],
       'status' => $count ? 2 : 3
       ]; 
  }

  public static function FourthBall(array $selection, array $drawNumber,int $gameId):array
  {
    $data = [
      'Big'   =>  intval($drawNumber[3]) > 5 ? true : false,
      'Small' => intval($drawNumber[3]) < 6 ? true : false,
      'Even'  => intval($drawNumber[3]) % 2 == 0 ? true : false,
      'Odd'   => intval($drawNumber[3]) % 2 != 0 ? true : false
    ];
    $count = 0;
    if($data[$selection[0]] == true){
      $count++;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status'   => $count ? 2 : 3
    ]; 
  }

  public static function FifthBall(array $selection, array $drawNumber,int $gameId):Array
  {
    $data = [
      'Big'   =>  intval($drawNumber[4]) > 5 ? true : false,
      'Small' => intval($drawNumber[4]) < 6 ? true : false,
      'Even'  => intval($drawNumber[4]) % 2 == 0 ? true : false,
      'Odd'   => intval($drawNumber[4]) % 2 != 0 ? true : false
    ];
    $count = 0;
    if($data[$selection[0]] == true){
      $count++;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
     ]; 
  }


  ################################ DRAGON & TIGER #################################

  public static function DRAGON_TIGER_FUNCTION(Int $index1, Int $index2, array $drawNumber): String
  { // dragon|tiger|tie pattern
    $drawNumber = explode(",", implode(",", $drawNumber));
    $v1 = $drawNumber[$index1];
    $v2 = $drawNumber[$index2];
    return ($v1 > $v2) ? "Dragon" : (($v1 == $v2) ? "Tie" : "Tiger");
  }

  public static function BigSmallFirstBall(array $selection, array $drawNumber,int $gameId): Array
  { // first ball
    $data = [
      'Big' =>  $drawNumber[0] > 5 ? true : false,
      'Small' => $drawNumber[0] < 6 ? true : false,
      'Even' => $drawNumber[0] % 2 == 0 ? true : false,
      'Odd' => $drawNumber[0] % 2 != 0 ? true : false,
    ];
    $count = 0;
    if($data[$selection[0]] == true){
      $count++;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
    ]; 
  }

  public static function BigSmallSecondBall(array $selection, array $drawNumber,int $gameId):Array
  { // second ball
    $data = [
      'Big' =>  $drawNumber[1] > 5 ? true : false,
      'Small' => $drawNumber[1] < 6 ? true : false,
      'Even' => $drawNumber[1] % 2 == 0 ? true : false,
      'Odd' => $drawNumber[1] % 2 != 0 ? true : false,
    ];
    $count = 0;
    if($data[$selection[0]] == true){
      $count++;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
    ]; 
  }

  public static function BigSmallThirdBall(array $selection, array $drawNumber,int $gameId): array
  { // third ball
    $data = [
      'Big' =>  $drawNumber[2] > 5 ? true : false,
      'Small' => $drawNumber[2] < 6 ? true : false,
      'Even' => $drawNumber[2] % 2 == 0 ? true : false,
      'Odd' => $drawNumber[2] % 2 != 0 ? true : false,
    ];
    $count = 0;
      if($data[$selection[0]] == true){
        $count++;
      }
      return [
        'numwins' => $count,
        'gameids' => $count ? [$gameId] : [],
        'status' => $count ? 2 : 3
      ]; 
  }

  public static function BigSmallFourthBall(array $selection, array $drawNumber,int $gameId): Array
  { // fourth ball
    $data = [
      'Big' =>  $drawNumber[3] > 5 ? true : false,
      'Small' => $drawNumber[3] < 6 ? true : false,
      'Even' => $drawNumber[3] % 2 == 0 ? true : false,
      'Odd' => $drawNumber[3] % 2 != 0 ? true : false
    ];
    $count = 0;
      if($data[$selection[0]] == true){
        $count++;
      }
      return [
        'numwins' => $count,
        'gameids' => $count ? [$gameId] : [],
       'status' => $count ? 2 : 3
      ]; 
  }

  public static function BigSmallFifthBall(array $selection, array $drawNumber,int $gameId): Array
  { // fifth ball
    $data = [
      'Big' =>  $drawNumber[4] > 5 ? true : false,
      'Small' => $drawNumber[4] < 6 ? true : false,
      'Even' => $drawNumber[4] % 2 == 0 ? true : false,
      'Odd' => $drawNumber[4] % 2 != 0 ? true : false
    ];
    $count = 0;
    if($data[$selection[0]] == true){
      $count++;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
     'status' => $count ? 2 : 3
    ]; 
  }

  public static function first_vrs_second(array $selection, array $drawNumber,int $gameId): array
  { // 1st vrs 2nd => 11
    $data = [
      'Dragon' => self::DRAGON_TIGER_FUNCTION(0, 1, $drawNumber) == "Dragon" ? true : false,
      'Tiger'  => self::DRAGON_TIGER_FUNCTION(0, 1, $drawNumber) == "Tiger" ? true : false
    ];
    $count = 0;
    if($data[$selection[0]] == true){
      $count++;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
    ]; 
  }

  public static function first_vrs_third(array $selection, array $drawNumber,int $gameId): Array
  { // 1st vrs 3rd => 12
    $data = [
      'Dragon' => self::DRAGON_TIGER_FUNCTION(0, 2, $drawNumber) == "Dragon" ? true : false,
      'Tiger'  => self::DRAGON_TIGER_FUNCTION(0, 2, $drawNumber) == "Tiger" ? true : false
    ];
    $count = 0;
    if($data[$selection[0]] == true){
      $count++;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
    ]; 
  }

  public static function first_vrs_fourth(array $selection, array $drawNumber,int $gameId): Array
  { // 1st vrs 4th => 13
    $data = [
      'Dragon' => self::DRAGON_TIGER_FUNCTION(0, 3, $drawNumber) == "Dragon" ? true : false,
      'Tiger'  => self::DRAGON_TIGER_FUNCTION(0, 3, $drawNumber) == "Tiger" ? true : false
    ];
    $count = 0;
    if($data[$selection[0]] == true){
      $count++;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
     ]; 
  }

  public static function first_vrs_fifth(array $selection, array $drawNumber,int $gameId): Array
  { // 1st vrs 5th => 14
    $data = [
      'Dragon' => self::DRAGON_TIGER_FUNCTION(0, 4, $drawNumber) == "Dragon" ? true : false,
      'Tiger'  => self::DRAGON_TIGER_FUNCTION(0, 4, $drawNumber) == "Tiger" ? true : false
    ];
    $count = 0;
    if($data[$selection[0]] == true){
      $count++;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
     ]; 
  }

  public static function second_vrs_third(array $selection, array $drawNumber,int $gameId): Array
  { // 2nd vrs 3rd => 15
    $data = [
      'Dragon' => self::DRAGON_TIGER_FUNCTION(1, 2, $drawNumber) == "Dragon" ? true : false,
      'Tiger'  => self::DRAGON_TIGER_FUNCTION(1, 2, $drawNumber) == "Tiger" ? true : false
    ];
    $count = 0;
    if($data[$selection[0]] == true){
      $count++;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
     ]; 
  }

  public static function second_vrs_fourth(array $selection, array $drawNumber,int $gameId):Array
  { // 2nd vrs 4th => 16
    $data = [
      'Dragon' => self::DRAGON_TIGER_FUNCTION(1, 3, $drawNumber) == "Dragon" ? true : false,
      'Tiger'  => self::DRAGON_TIGER_FUNCTION(1, 3, $drawNumber) == "Tiger" ? true : false
    ];
    $count = 0;
    if($data[$selection[0]] == true){
      $count++;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
     ]; 
  }

  public static function second_vrs_fifth(array $selection, array $drawNumber,int $gameId): Array
  { // 2nd vrs 5th => 17
    $data = [
      'Dragon' => self::DRAGON_TIGER_FUNCTION(1, 4, $drawNumber) == "Dragon" ? true : false,
      'Tiger'  => self::DRAGON_TIGER_FUNCTION(1, 4, $drawNumber) == "Tiger" ? true : false
    ];
    $count = 0;
    if($data[$selection[0]] == true){
      $count++;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
     ]; 
  }

  public static function third_vrs_fourth(array $selection, array $drawNumber,int $gameId): Array
  { // 1st vrs 2nd => 18
    $data = [
      'Dragon' => self::DRAGON_TIGER_FUNCTION(2, 3, $drawNumber) == "Dragon" ? true : false,
      'Tiger'  => self::DRAGON_TIGER_FUNCTION(2, 3, $drawNumber) == "Tiger" ? true : false
    ];
    $count = 0;
    if($data[$selection[0]] == true){
      $count++;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
      'status' => $count ? 2 : 3
     ]; 
  }

  public static function third_vrs_fifth(array $selection, array $drawNumber,int $gameId):Array
  { // 3rd vrs 5th => 19
    $data = [
      'Dragon' => self::DRAGON_TIGER_FUNCTION(2, 4, $drawNumber) == "Dragon" ? true : false,
      'Tiger'  => self::DRAGON_TIGER_FUNCTION(2, 4, $drawNumber) == "Tiger" ? true : false
    ];
    $count = 0;
    if($data[$selection[0]] == true){
      $count++;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
     'status' => $count ? 2 : 3
     ]; 
  }

  public static function fourth_vrs_fifth(array $selection, array $drawNumber,int $gameId): array
  { // 1st vrs 2nd => 20
    $data = [
      'Dragon' => self::DRAGON_TIGER_FUNCTION(3, 4, $drawNumber) == "Dragon" ? true : false,
      'Tiger'  => self::DRAGON_TIGER_FUNCTION(3, 4, $drawNumber) == "Tiger" ? true : false
    ];
    $count = 0;
    if($data[$selection[0]] == true){
      $count++;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
     'status' => $count ? 2 : 3
     ]; 
  }

  public static function sumBigSmallOddEven(array $selection, array $drawNumber,int $gameId):array
  { // => 21,22
    $data = [
      'Big' =>  array_sum($drawNumber) > 5 ? true : false,
      'Small' => array_sum($drawNumber) < 6 ? true : false,
      'Even' => array_sum($drawNumber) % 2 == 0 ? true : false,
      'Odd' => array_sum($drawNumber) % 2 != 0 ? true : false,
    ];
    $count = 0;
    if($data[$selection[0]] == true){
      $count++;
    }
    return [
      'numwins' => $count,
      'gameids' => $count ? [$gameId] : [],
     'status' => $count ? 2 : 3
     ]; 
  }


  // ****************************** 11X5  @ twosides****************************** //

  public static function twoSidesRapido(array $selection, array $drawNumber, Int $gameId = null) : array
  {
    $count = 0;
    $refund = 0;
    $positionString = $selection['position'];
    $gameId = $selection['label_id'];
    switch ($positionString) {
      case "Sum":
        $selected = $selection['selection'];
        $sum = array_sum($drawNumber);
        $data = [
          'Big' => $sum > 30,
          'Small' => $sum < 30,
          'Odd' => $sum % 2 != 0,
          'Even' => $sum % 2 == 0,
          'Dragon' => intval($drawNumber[0]) > intval($drawNumber[4]),
          'Tiger'  => intval($drawNumber[0]) < intval($drawNumber[4]),
          'Tail Big' => intval(str_split($sum)[1]) > 5,
          'Tail Small' => intval(str_split($sum)[1]) < 4
        ];
        if($sum == 30){
          $refund = 6;
        }else{
          if ($data[$selected] == true) {
            $count++;
          }
        }
        break;
      default:

        $position = intval($selection['position']) - 1;
        $posVal = intval($drawNumber[$position]);
        $selected = $selection['selection'];
        $dummyKey = count(str_split($selected, 1)) >= 3 ? 'dummyKey' : $selected;
        $sum = array_sum($drawNumber);
        $data = [
          'Big' => $posVal > 5,
          'Small' => $posVal < 6,
          'Odd' => $posVal % 2 != 0,
          'Even' => $posVal % 2 == 0,
          $dummyKey => $posVal == intval($selected)
        ];
        if($sum == 30){
          $refund = 6;
        }else{
          if ($data[$selected] == true) {
            $count++;
          }
        }
    }

    return [
      'numwins' => $count ? $count : 0,
      'gameids' => $count ? [$gameId] : [],
      'status' => ($count == 0 && $refund == 6) ? 6 : (($count >= 1 && $refund == 0) ? 2 : 3)
    ];
  
  }

  public static function pick(array $selection, array $drawNumber, Int $gameId = null) : array
  { // modified to fit padding 0
    $refund = 0;
    $count = 0;
    $selected  = $selection['selection'];
    $position  = $selection['position'];
    //$gameId = $selection['label_id'];
    switch ($pick = $position) {
      case 'first2group':
        if(count(array_intersect($selected[0], array_slice($drawNumber, 0, 2))) == 2){
          $count++;
        }
      case 'first3group':
        if(count(array_intersect($selected[0], array_slice($drawNumber, 0, 3))) == 3){
          $count++;
        }
      default:
        $winningNumbers = array_slice($drawNumber, 0, 5);
        $numericValue = intval(preg_replace('/[^0-9]/', '', $pick));
        if($numericValue < 6 ? count(array_intersect($selected[0], $winningNumbers)) >= $numericValue : (count(array_intersect($selected[0], $winningNumbers)) >= 5)){
          $count++;
        }
    }

    return [
      'numwins' => $count ? 1 : 0,
      'gameids' => $count ? [$gameId] : [],
      'status' =>  $count ? 2 : 3
    ];

  }

  public static function straightFirst2Group(array $selection, array $drawNumber, Int $gameId = null) : array
  {
    $count = 0;
    $winningNumbers = array_slice($drawNumber, 0, 2);
    $selection = $selection['selection'];
    //$gameId = $selection['label_id'];
    if(in_array($winningNumbers[0], $selection) && in_array($winningNumbers[1], $selection[1])){
      $count++;
    }

    return [
      'numwins' => $count ? 1 : 0,
      'gameids' => $count ? [$gameId] : [],
      'status' =>  $count ? 2 : 3
    ];
  }

  public static function straightFirst3Group(array $selection, array $drawNumber, Int $gameId = null) : array
  {
    $count = 0;
    $winningNumbers = array_slice($drawNumber, 0, 3);
    $selection = $selection['selection'];
    //$gameId = $selection['label_id'];
    if(in_array($winningNumbers[0], $selection[0]) && in_array($winningNumbers[1], $selection[1]) && in_array($winningNumbers[2], $selection[2])){
      $count++;
    }
    return [
      'numwins' => $count ? 1 : 0,
      'gameids' => $count ? [$gameId] : [],
      'status' =>  $count ? 2 : 3
    ];
  }



  ############################  Long Dragon #############################

  public static function getHead($number)
  {
    return (int) ($number / 10);
  }

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

  public static function Dragon(array $selection, array $drawNumber)
  {

    $gameId = $selection[1];
    $ball = self::GetBalls($gameId) == '' ? 2 : intval(self::GetBalls($gameId)) - 1;

    $data = [

      '69,70,71,72,73' => ($drawNumber[$ball] > 6 && $selection[0] == 'Big') ? true : ($drawNumber[$ball] < 6 && $selection[0] == 'Small'),
      '74,75,76,77,78' => ($drawNumber[$ball] % 2 !== 0 && $selection[0] == 'Odd') ? true : ($drawNumber[$ball] % 2 == 0 && $selection[0] == 'Even'),
      '79' => (array_sum($drawNumber) > 30 && $selection[0] == 'Big') ? true : (array_sum($drawNumber) < 30 && $selection[0] == 'Small'),
      '80' => (array_sum($drawNumber) % 2 !== 0 && $selection[0] == 'Odd') ? true : (array_sum($drawNumber) % 2 == 0  && $selection[0] == 'Even'),
      '81' => (self::getHead(array_sum($drawNumber)) > 5 && $selection[0] == 'Dragon') ? true : (self::getHead(array_sum($drawNumber)) < 6 && $selection[0] == 'Tiger'),

    ];

    foreach (array_keys($data) as $key) {
      if (in_array($gameId, explode(',', $key))) {
        return $data[$key];
      }
    }
  }
}
