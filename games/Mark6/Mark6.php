
<?php

use React\Cache\ArrayCache;

class Mark6  extends GamePlayFunctionM6
{

    public static function getGamePlayMethod(): array
    { //////////// THE INVOKE METHOD
        return parent::getGamePlayFunction(); /////////////////////////////////////////////
    } ///////////////////////////////////////////////////////////////////////////////////

    public static function ExtraNo(array $selection, array $drawNumber, int $gameId):array{
        $count = 0;
        $gameids = [];
       if (in_array(end($drawNumber), $selection[0]) ) {
           $count++;
           $gameids[] = $gameId;
       }
       return [
           'numwins' => $count,
           'gameids' => $count ? $gameids : [],
           'status' => $count ? '2' : '3'
       ];
    } // fn([1,2,3,4,5,6,7,8,9,10],[1,2,3,4,5,6,7]) = 1

    public static function ExtraHeadTail(array $selection, array $drawNumber, int $gameId): array
    { //more than 1   
        $lastNumber = end($drawNumber);
        $headValue  = (int)($lastNumber / 10); // Get the tens place of the last number
        $tailValue  = $lastNumber % 10;
        $data = [
            "0 HEAD" => $headValue === 0 ? "1" : "0",
            "1 HEAD" => $headValue === 1 ? "1" : "0",
            "2 HEAD" => $headValue === 2 ? "1" : "0",
            "3 HEAD" => $headValue === 3 ? "1" : "0",
            "4 HEAD" => $headValue === 4 ? "1" : "0",
            "0 TAIL" => $tailValue === 0 ? "1" : "0",
            "1 TAIL" => $tailValue === 1 ? "1" : "0",
            "2 TAIL" => $tailValue === 2 ? "1" : "0",
            "3 TAIL" => $tailValue === 3 ? "1" : "0",
            "4 TAIL" => $tailValue === 4 ? "1" : "0",
            "5 TAIL" => $tailValue === 5 ? "1" : "0",
            "6 TAIL" => $tailValue === 6 ? "1" : "0",
            "7 TAIL" => $tailValue === 7 ? "1" : "0",
            "8 TAIL" => $tailValue === 8 ? "1" : "0",
            "9 TAIL" => $tailValue === 9 ? "1" : "0",
        ];
        $count = 0;
        $gameids = [];
        foreach ($selection as $sel) {
            $key = $sel[0];
            if (isset($data[$key]) && $data[$key] === "1") {
                $count++;
                $gameids[] = $gameId;
            }
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];
    } // fn([1,2,6,7][,8,9,10],[1,2,3,4,5,6,2]) = 1

    public static function ComboZodiac(array $selection, array $drawNumber, int $gameId): array
    { ## review this method urgeent
        $zodiacsigns = [
            "Rat" => self::generateArray(1),
            "Ox" => self::generateArray(2),
            "Tiger" => self::generateArray(3),
            "Rabbit" => self::generateArray(4),
            "Dragon" => self::generateArray(5),
            "Snake" => self::generateArray(6),
            "Horse" => self::generateArray(7),
            "Goat" => self::generateArray(8),
            "Monkey" => self::generateArray(9),
            "Rooster" => self::generateArray(10),
            "Dog" => self::generateArray(11),
            "Pig" => self::generateArray(12)
        ];
        if (end($drawNumber) == 49) {
            return 6;
        }
        $count = 0;
        $gameids = [];
        foreach ($selection[0] as $selected_zodiac) {
            if (in_array(end($drawNumber),  $zodiacsigns[$selected_zodiac])) {
                $count++;
                $gameids[] = $gameId;
            }
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];
    } // fn(["Rat"],[1,2,3,4,5,6,2]) = 1

    public static function SpecialZodiac(array $selection, array $drawNumber,int $gameId):Array
    {

        $zodiacSigns = [
            "Rat" => self::generateArray(1),
            "Ox" => self::generateArray(2),
            "Tiger" => self::generateArray(3),
            "Rabbit" => self::generateArray(4),
            "Dragon" => self::generateArray(5),
            "Snake" => self::generateArray(6),
            "Horse" => self::generateArray(7),
            "Goat" => self::generateArray(8),
            "Monkey" => self::generateArray(9),
            "Rooster" => self::generateArray(10),
            "Dog" => self::generateArray(11),
            "Pig" => self::generateArray(12)
        ];
        if (end($drawNumber) == 49) {
            return ['status' => 6 ];
        }
        $count = 0;
        $gameids = [];
        foreach ($selection[0] as $selected_zodiac) {
            if (in_array(end($drawNumber), $zodiacSigns[$selected_zodiac])) {
                $count++;
                $gameids[] = $gameId;
            }
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];
    } // fn([1,2,3,4,5,6,7,8,9,10],[1,2,3,4,5,6,2]) = 1

    public static function FiveElement(array $selection, array $drawNumber,int $gameId):Array
    {

        $element = [
            "GOLD" => in_array(end($drawNumber), [1, 2, 9, 10, 23, 24, 31, 32, 39, 40]) ? 1 : 0,
            "WOOD" => in_array(end($drawNumber), [5, 6, 13, 14, 21, 22, 35, 36, 43, 44]) ? 1 :0,
            "WATER" => in_array(end($drawNumber), [11, 12, 19, 20, 27, 28, 41, 42, 49]) ? 1 : 0,
            "FIRE" => in_array(end($drawNumber), [7, 8, 15, 16, 29, 30, 37, 38, 45, 46]) ? 1 :0,
            "EARTH" => in_array(end($drawNumber), [3, 4, 18, 25, 26, 33, 34, 47, 48]) ? 1 : 0
        ];
        if(end($drawNumber)== 49){
            return ['status' => 6 ];
        } 
        $count = $element[$selection[0][0]];
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    } // fn(["GOLD"],[1,2,3,4,5,6,2]) = 1

    public static function FormExtraNo(array $selection, array $drawNumber,int $gameId): Array
    {
        $numberGroups = [
            'Big' => in_array(end($drawNumber),range(25, 48)) ? 1 :0, 
            'Small' => in_array(end($drawNumber),range(1, 24)) ? 1:0, 
            'Odd' => in_array(end($drawNumber),range(1, 49, 2)) ? 1 :0, 
            'Even' => in_array(end($drawNumber),range(2, 50, 2)) ? 1 :0, 
            'Big Odd' => in_array(end($drawNumber),range(25, 49, 2)) ? 1 :0, 
            'Big Even' => in_array(end($drawNumber),range(26, 50, 2)) ? 1 :0, 
            'Small Even' => in_array(end($drawNumber),range(2, 26, 2)) ? 1 :0, 
            'Small Odd' => in_array(end($drawNumber),range(1, 25, 2)) ? 1 :0 
        ];
        if(end($drawNumber)== 49){
            return ['status' => 6];
        } 
         $count = $numberGroups[$selection[0][0]];
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    } // fn(["Big"],[1,2,3,4,5,6,2]) = 1

    public static function SumExtraHeadTail(array $selection, array $drawNumber,int $gameId): Array
    {

        $numberGroups = [
            'Big' => [7, 8, 9, 10, 11, 12],
            'Small' => [1, 2, 3, 4, 5, 6],
            'Odd' => [1, 3, 5, 7, 9],
            'Even' => [0, 2, 4, 6, 8],
        ];
        if (end($drawNumber) == 49) {
            return ['status' =>6];
        }
        $count = 0;
        $gameids = [];
        foreach ($selection[0] as $betdata) {
            if ((in_array(array_sum(str_split(end($drawNumber))), $numberGroups[$betdata]))) {
                $count++;
                $gameids[] = $gameId;
            }
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];     
    } // fn(["Big"],[1,2,3,4,5,6,2]) = 1

    public static function FormExtraTail(array $selection, array $drawNumber,int $gameId): Array
    {

        $numberGroups = [
            'Big' => [5, 6, 7, 8, 9],
            'Small' => [0, 1, 2, 3, 4],
            'Odd' => [1, 3, 5, 7, 9],
            'Even' => [0, 2, 4, 6, 8],
        ];
        if (end($drawNumber) == 49) {
            return ['status' => 6];
        }
         $count = 0;
         $gameids = [];
           $TailNumber = str_pad(end($drawNumber), 2, "0", STR_PAD_LEFT);
           foreach ($selection[0] as $betdata) {
            if (in_array($TailNumber[1], $numberGroups[$betdata])){ ;    
                $count++; 
                $gameids[] = $gameId;
              }
          }
          return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];;
    } // fn(["Big"],[1,2,3,4,5,6,2]) = 1

    public static function FormExtraZodiac(array $selection, array $drawNumber,int $gameId): Array
    {
        $numberGroups = [
            "Zodiac Sky"      => in_array(end($drawNumber),explode(",",
                implode(",",self::generateArray(2)).','. 
                implode(",",self::generateArray(4)).','.  
                implode(",",self::generateArray(7)).','. 
                implode(",",self::generateArray(9)).','. 
                implode(",",self::generateArray(12)))
            )? 1 :0,
            "Zodiac Ground"   => in_array(end($drawNumber),explode(",",
                implode(",",self::generateArray(1)).','. 
                implode(",",self::generateArray(3)).','. 
                implode(",",self::generateArray(6)).','. 
                implode(",",self::generateArray(8)).','. 
                implode(",",self::generateArray(10)).','. 
                implode(",",self::generateArray(11)))
            )? 1 :0,
            "Zodiac First"    =>in_array(end($drawNumber),explode(",",
                implode(",",self::generateArray(1)).','. 
                implode(",",self::generateArray(2)) .','. 
                implode(",",self::generateArray(3)) .','. 
                implode(",",self::generateArray(4)) .','. 
                implode(",",self::generateArray(5)) .','. 
                implode(",",self::generateArray(6)))
            )? 1 :0,
            "Zodiac Last"     => in_array(end($drawNumber),explode(",",
                implode(",",self::generateArray(7)) .','. 
                implode(",",self::generateArray(8)) .','. 
                implode(",",self::generateArray(9)).','. 
                implode(",",self::generateArray(10)).','. 
                implode(",",self::generateArray(11)).','. 
                implode(",",self::generateArray(12)))
            )? 1 :0,
            "Zodiac Poultry"  => in_array(end($drawNumber),explode(",",
                implode(",",self::generateArray(1)) .','. 
                implode(",",self::generateArray(7)) .','. 
                implode(",",self::generateArray(8)) .','. 
                implode(",",self::generateArray(10)) .','. 
                implode(",",self::generateArray(11)).','. 
                implode(",",self::generateArray(12)))
            )? 1 :0,
            "Zodiac Beast"    => in_array(end($drawNumber),explode(",",
                implode(",",self::generateArray(1)) .','. 
                implode(",",self::generateArray(3)) .','. 
                implode(",",self::generateArray(5)) .','. 
                implode(",",self::generateArray(6)).','. 
                implode(",",self::generateArray(4)).','. 
                implode(",",self::generateArray(9)))
            ) ? 1 :0
            ];
            if(end($drawNumber)== 49){
                return ['status' =>6];
               }
            $count  =  $numberGroups[$selection[0][0]];
            return [
                'numwins' => $count,
                'gameids' => $count ? [$gameId] : [],
                'status' => $count ? 2 : 3
            ];
    } // fn(["Zodiac Sky"],[1,2,3,4,5,6,2]) = 1

    public static function ColorBall(array $selection, array $drawNumber,int $gameId): Array
    {
        $colorGroups = [
            'Red Balls' => in_array(end($drawNumber),[1, 2, 7, 8, 12, 13, 18, 19, 23, 24, 29, 30, 34, 35, 40, 45, 46])? 1:0,
            'Blue Balls' =>in_array(end($drawNumber), [3, 4, 9, 10, 14, 15, 20, 25, 26, 31, 36, 37, 41, 42, 47, 48])? 1 :0,
            'Green Balls' =>in_array(end($drawNumber), [5, 6, 11, 16, 17, 21, 22, 27, 28, 32, 33, 38, 39, 43, 44, 49])? 1 :0
            ];
            if(end($drawNumber)== 49){
                return ['status' =>6];
            }
            $count  =  $colorGroups[$selection[0][0]];
            return [
                'numwins' => $count,
                'gameids' => $count ? [$gameId] : [],
                'status' => $count ? 2 : 3
             ];
    } // fn(["Red Balls"],[1,2,3,4,5,6,2]) = 1

    public static function TwoColorBalls(array $selection, array $drawNumber,int $gameId): Array
    {
        $colorGroups = [
            'Big Red' => in_array(end($drawNumber),[29, 30, 34, 35, 40, 45, 46]) ?1 :0 , 
            'Small Red' => in_array(end($drawNumber),[1, 2, 7, 8, 12, 13, 18, 19, 23, 24]) ?1 :0 ,
            'Odd Red' => in_array(end($drawNumber),[1, 7, 13, 19, 23, 29, 35, 45]) ?1 :0 ,
            'Even Red' =>in_array(end($drawNumber), [2, 8, 12, 18, 24, 30, 34, 40, 46]) ?1 :0 ,
            'Big Blue' => in_array(end($drawNumber),[25, 26, 31, 36, 37, 41, 42, 47, 48]) ?1 :0 ,
            'Small Blue' =>in_array(end($drawNumber), [3, 4, 9, 10, 14, 15, 20]) ?1 :0 ,
            'Odd Blue' => in_array(end($drawNumber),[3, 9, 15, 25, 31, 37, 41, 47]) ?1 :0 ,
            'Even Blue' => in_array(end($drawNumber),[4, 10, 14, 20, 26, 36, 42, 48]) ?1 :0 ,
            'Big Green' =>in_array(end($drawNumber) ,[27, 28, 32, 33, 38, 39, 43, 44]) ?1 :0 ,
            'Small Green' =>in_array(end($drawNumber) ,[5, 6, 11, 16, 17, 21, 22]) ? 1 :0,
            'Odd Green' =>in_array(end($drawNumber) ,[5, 11, 17, 21, 27, 33, 39, 43]) ?1 :0 ,
            'Even Green' => in_array(end($drawNumber),[6, 16, 22, 28, 32, 38, 44]) ?1 :0
        ];
        if(end($drawNumber)== 49){
            return ['status' =>6];
        }
        $count  =  $colorGroups[$selection[0][0]];
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
           'status' => $count ? 2 : 3
        ];
            
    } // fn(["Red Balls"],[1,2,3,4,5,6,2]) = 1

    public static function PickBallnumber(array $selection, array $drawNumber,int $gameId):array
    { //win 0r more
        $count = 0;
        $gameids = [];
        if(array_intersect($drawNumber, $selection[0])){
            $count++;
            $gameids[] = $gameId;
        };
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];
    } // fn([1,2,3,4,5,6,7,8,9,10],[1,2,3,4,5,6,7]) = 1

    public static function FixedPlaceOne(array $selection, array $drawNumber,int $gameId):Array
    {
        $count = in_array($drawNumber[0], $selection[0]) ? 1 : 0;
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
           'status' => $count ? 2 : 3
        ];  

    } // fn([1,2,3,4,5,6,7,8,9,10],[1,2,3,4,5,6,7]) = 1

    public static function FixedPlaceTwo(array $selection, array $drawNumber,int $gameId): Array
    {
        $count = (in_array($drawNumber[1], $selection[0])) ? "1" : "0";
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
           'status' => $count ? 2 : 3
        ];  
    } // fn([1,2,3,4,5,6,7,8,9,10],[1,2,3,4,5,6,7]) = 1

    public static function FixedPlaceThree(array $selection, array $drawNumber,int $gameId): Array
    {
        $count = (in_array($drawNumber[2], $selection[0])) ? "1" : "0";;
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
           'status' => $count ? 2 : 3
        ];  
    } // fn([1,2,3,4,5,6,7,8,9,10],[1,2,3,4,5,6,7]) = 1


    public static function FixedPlaceFourth(array $selection, array $drawNumber,int $gameId):Array
    {
        $count = (in_array($drawNumber[3], $selection[0]))? 1 : 0;
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
           'status' => $count ? 2 : 3
        ];  
    } // fn([1,2,3,4,5,6,7,8,9,10],[1,2,3,4,5,6,7]) = 1


    public static function FixedPlaceFive(array $selection, array $drawNumber,int $gameId):Array
    {
        $count = (in_array($drawNumber[4], $selection[0]))? 1 : 0;
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
           'status' => $count ? 2 : 3
        ];  
    } // fn([1,2,3,4,5,6,7,8,9,10],[1,2,3,4,5,6,7]) = 1

    public static function FixedPlaceSix(array $selection, array $drawNumber,int $gameId):Array
    {
        $count = (in_array($drawNumber[5], $selection[0]))? 1 : 0;
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
           'status' => $count ? 2 : 3
        ];  
    } // fn([1,2,3,4,5,6,7,8,9,10],[1,2,3,4,5,6,7]) = 1


    public static function winTwoORThree(array $selection, array $drawNumber,int $gameId): Array
    {
        $counter = count(array_intersect($selection[0],$drawNumber));
        $count =  ($counter >= 2) ? "1" : "0" ;
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
           'status' => $count ? 2 : 3
        ];  
    } // fn([1,2,3,4,5,6,7,8,9,10],[1,2,3,4,5,6,7]) = 1

    public static function WinThree(array $selection, array $drawNumber,int $gameId): Array
    { //win more
        $counter = count(array_intersect($selection[0],$drawNumber));
        $count =  ($counter >= 3) ? "1" : "0" ;
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
           'status' => $count ? 2 : 3
        ];  
    } // fn([1,2,3,4,5,6,7,8,9,10],[1,2,3,4,5,6,7]) = 1

    public static function  WinTwo(array $selection, array $drawNumber,int $gameId): Array
    {
        $counter = count(array_intersect($selection[0],$drawNumber));
        $count =($counter >= 2) ? "1" : "0" ;   
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
           'status' => $count ? 2 : 3
        ];  
    } // fn([1,2,3,4,5,6,7,8,9,10],[1,2,3,4,5,6,7]) = 1


    public static function BraveryThree(array $selection, array $drawNumber,int $gameId): Array
    {
        $winCount  =  in_array(implode(",",$selection[0]), $drawNumber);
        $winCount1 = count(array_intersect($selection[1], $drawNumber));
        $count     =  ($winCount >=1 && $winCount1 >= 2)? "1" : "0";
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
           'status' => $count ? 2 : 3
        ];  
    } // fn([1,2,3,4,5,6][7,8,9,10],[1,2,3,4,5,6,7]) = 1

    public static function BraveryTow(array $selection, array $drawNumber,int $gameId):Array
    {
        $winCount  =  in_array(implode(",",$selection[0]), $drawNumber);
        $winCount1 = count(array_intersect($selection[1], $drawNumber));
        $count     =   ($winCount >= 1 && $winCount1 >= 1) ? "1":"0";
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
           'status' => $count ? 2 : 3
          ];  
    } // fn([1,2,3,4,5,6][7,8,9,10],[1,2,3,4,5,6,7]) = 1

    public static function  WinFour(array $selection, array $drawNumber,int $gameId): Array
    {
        $counter = count(array_intersect($selection[0],$drawNumber));
        $count =($counter >= 4) ? "1" : "0" ;   
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
           'status' => $count ? 2 : 3
        ];  
    } // fn([1,2,3,4,5,6,7,8,9,10],[1,2,3,4,5,6,7]) = 1

    public static function OneZodaic(array $selection, array $drawNumber,int $gameId): Array
    {

        $zodiacSigns = [
            "Rat" => self::generateArray(1),
            "Ox" => self::generateArray(2),
            "Tiger" => self::generateArray(3),
            "Rabbit" => self::generateArray(4),
            "Dragon" => self::generateArray(5),
            "Snake" => self::generateArray(6),
            "Horse" => self::generateArray(7),
            "Goat" => self::generateArray(8),
            "Monkey" => self::generateArray(9),
            "Rooster" => self::generateArray(10),
            "Dog" => self::generateArray(11),
            "Pig" => self::generateArray(12)
        ];

        $gameids = [];
        $count = 0;
        foreach ($selection[0] as $betdata) {
            if (count(array_intersect($drawNumber, $zodiacSigns[$betdata]))) {
                $count++;
                $gameids[] = $gameId;
            }
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
           'status' => $count ? 2 : 3
        ];  ;
    } // fn(["Rat"],[1,2,3,4,5,6,2]) = 1


    public static function  BallColor(array $selection, array $drawNumber,int $gameId) :Array
    { // can win 0r  more

        $colorData = [
            'Red Balls'    => [1, 3, 7, 8, 12, 13, 18, 19, 23, 24, 29, 30, 34, 35, 40, 45, 46],
            'Blue Balls'   => [2, 4, 9, 10, 14, 15, 20, 25, 26, 31, 36, 37, 41, 42, 47, 48],
            'Green Balls'  => [5, 6, 11, 16, 17, 21, 22, 27, 28, 32, 33, 38, 39, 43, 44, 49]
        ];

        $ballData = [
            'Ball 1' => $drawNumber[0],
            'Ball 2' => $drawNumber[1],
            'Ball 3' => $drawNumber[2],
            'Ball 4' => $drawNumber[3],
            'Ball 5' => $drawNumber[4],
            'Ball 6' => $drawNumber[5]

        ];
        $select = explode(' ', $selection[0][0]);
        $color = $select[0] . ' ' . $select[1];
        $ball  = $select[2] . ' ' . $select[3];
        $count  = 0;
        $gameids = [];
        if(in_array($ballData[$ball],$colorData[$color])){
                $count++;
                $gameids [] = $gameId;
            }
                return [
                    'numwins' => $count,
                    'gameids' => $count ? $gameids : [],
                'status' => $count ? 2 : 3
                ];  
    } // fn(['{"1":["Red Balls","Blue Balls"]}'],[1,2,3,4,5,6,2]) = 1

    public static function  Sum(array $selection, array $drawNumber,int $gameId): array
    { //win 1 or 2
       
        $conditions = [
            (array_sum($drawNumber) > 175) ? "Big" : "Small",
            (array_sum($drawNumber) % 2 !== 0) ? "Odd" : "Even"
        ];
        if (array_sum($drawNumber) == 175) {
            return ['status' =>6];
        }
        $count = 0;
        $gameids = [];
      if (count(array_intersect($conditions, $selection[0]))){
         $count++;
         $gameids[] =$gameId;
       }
        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
           'status' => $count ? 2 : 3
        ];  
    } // fn(["Odd"],[1,2,3,4,5,6,2]) = 1


    //if zero is part of the winning number the odd changes
    public static function  TailNumber(Array $selection, Array $drawNumber,int $gameId): array {
        $TailNumber = array_map(fn($number) => $number % 10, $drawNumber);
        $count      = count(array_intersect($TailNumber, $selection[0])) ? 1 :0;
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
           'status' => $count ? 2 : 3
        ];  
        
    }

    public static function  Mismatch(Array $selection, Array $drawNumber,int $gameId): array {
        $counter = count(array_intersect($selection[0],$drawNumber));
        $count   =   ($counter == 0) ? "1" :  "0";
       return [
        'numwins' => $count,
        'gameids' => $count ? [$gameId] : [],
       'status' => $count ? 2 : 3
      ];  
        
    }

    //if zero is part of the winning number the odd changes
    public static function  TwoConsecTail(Array $selection, Array $drawNumber,int $gameId): array {
        $TailNumber = array_map(fn($number) => $number % 10, $drawNumber);
        $counter    = count(array_intersect($selection[0],$TailNumber));
        $count      =    ($counter >=2) ? "1" :"0";
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
           'status' => $count ? 2 : 3
          ];  
   } // fn([1,2,3,4,5,6,7,8,9,10],[1,2,3,4,5,6,7]) = 1


    //if zero is part of the winning number the odd changes
    public static function  ThreeConsecTail(Array $selection, Array $drawNumber,int $gameId): array {
        $TailNumber = array_map(fn($number) => $number % 10, $drawNumber);
        $counter    = count(array_intersect($selection[0],$TailNumber));
        $count      =    ($counter >= 3) ? "1" :  "0";
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
           'status' => $count ? 2 : 3
          ];  
       } // fn([1,2,3,4,5,6,7,8,9,10],[1,2,3,4,5,6,7]) = 1


    //if zero is part of the winning number the odd changes
    public static function  FourConsecTail(Array $selection, Array $drawNumber,int $gameId): array {
        $TailNumber = array_map(fn($number) => $number % 10, $drawNumber);
        $counter    = count(array_intersect($selection[0],$TailNumber));
        $count      =    ($counter >= 4) ? "1" :  "0";
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
           'status' => $count ? 2 : 3
          ];  
       } // fn([1,2,3,4,5,6,7,8,9,10],[1,2,3,4,5,6,7]) = 1


    //if zero is part of the winning number the odd changes
    public static function FiveConsecTail(Array $selection, Array $drawNumber,int $gameId): array {
        $TailNumber = array_map(fn($number) => $number % 10, $drawNumber);
        $counter    = count(array_intersect($selection[0],$TailNumber));
        $count      = ($counter >= 5) ? "1" :  "0";
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
           'status' => $count ? 2 : 3
          ];  
       }


       public static function  TwoNumber(Array $selection, Array $drawNumber,int $gameId): array {//reviewed
        $counter = count(array_intersect($selection[0],$drawNumber));
        $count   = ($counter >= 2) ? "1" :  "0";
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
           'status' => $count ? 2 : 3
          ];  
       }
    //at the user must select two for form one bet but if the one number is found in the
    //extra number to determine win.................
    //same as two sides
    public static function  WinExtraNo(Array $selection, Array $drawNumber,int $gameId): array {
        $count  = in_array(end($drawNumber), $selection[0]) && count(array_intersect($selection[0],$drawNumber)) > 0 ? "1" :"0";
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
           'status' => $count ? 2 : 3
          ];
    }

    public static function  OneBallZodaic(Array $selection, Array $drawNumber,int $gameId): array {

        $zodiacSigns = [
        "Rat" =>    in_array (implode(',',$drawNumber),self::generateArray(1))? 1:0,
        "Ox" =>     in_array (implode($drawNumber),self::generateArray(2))? 1:0,
        "Tiger" =>  in_array (implode($drawNumber),self:: generateArray(3))? 1:0,
        "Rabbit" => in_array (implode($drawNumber),self:: generateArray(4))? 1:0,
        "Dragon" => in_array (implode($drawNumber),self:: generateArray(5))? 1:0,
        "Snake" =>  in_array (implode($drawNumber),self::generateArray(6))? 1:0,
        "Horse" =>  in_array (implode($drawNumber), self::generateArray(7))? 1:0,
        "Goat" =>   in_array (implode($drawNumber),self::generateArray(8))? 1:0,
        "Monkey" => in_array (implode($drawNumber),self::generateArray(9))? 1:0,
        "Rooster"=> in_array (implode($drawNumber),self::generateArray(10))? 1:0,
        "Dog" =>    in_array (implode($drawNumber),self::generateArray(11))? 1:0,
        "Pig" =>    in_array (implode($drawNumber),self::generateArray(12))? 1:0
        ];
        $count =  $zodiacSigns[$selection[0][0]];
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
        'status' => $count ? 2 : 3
        ];  
    } // fn(["Rat"],[1,2,3,4,5,6,2]) = 1

    public static function  TwoZodaic(Array $selection, Array $drawNumber,int $gameId): array {
    
        $zodiacSigns = [
            "Rat" => self::generateArray(1),
            "Ox" => self::generateArray(2),
            "Tiger" => self::generateArray(3),
            "Rabbit" => self::generateArray(4),
            "Dragon" => self::generateArray(5),
            "Snake" => self::generateArray(6),
            "Horse" => self::generateArray(7),
            "Goat" => self::generateArray(8),
            "Monkey" => self::generateArray(9),
            "Rooster" => self::generateArray(10),
            "Dog" => self::generateArray(11),
            "Pig" => self::generateArray(12)
        ];

        $count = 0;
        $gameids = [];
        foreach ($selection[0] as $betdata) {
          if (count(array_intersect($drawNumber, $zodiacSigns[$betdata]))) {
            $count++;
            $gameids[] = $gameId;
          }
        }
        $count = ($count >= 2) ? '1' : '0';
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
           'status' => $count ? 2 : 3
          ];
    } // fn(["Rat"],[1,2,3,4,5,6,2]) = 1
    public static function  ThreeZodaic(Array $selection, Array $drawNumber,int $gameId): array {
        $zodiacSigns = [
            "Rat" =>self::generateArray(1),
            "Ox" => self::generateArray(2),
           "Tiger" =>self:: generateArray(3),
           "Rabbit" =>self:: generateArray(4),
           "Dragon" =>self:: generateArray(5),
           "Snake" => self::generateArray(6),
           "Horse" => self::generateArray(7),
           "Goat" => self::generateArray(8),
           "Monkey" => self::generateArray(9),
           "Rooster" => self::generateArray(10),
           "Dog" => self::generateArray(11),
           "Pig" => self::generateArray(12)
        ];
      
        $count = 0;
        $gameids = [];
        foreach ($selection[0] as $betdata) {
          if (count(array_intersect($drawNumber, $zodiacSigns[$betdata]))) {
            $count++;
            $gameids[] = $gameId;
          }
        }
        $count = ($count >= 3) ? '1' : '0';
        return [
            'numwins' => $count,
            'gameids' => $count ?  $gameids : [],
           'status' => $count ? 2 : 3
          ];
      
    } // fn(["Rat"],[1,2,3,4,5,6,2]) = 1

    public static function  FourZodaic(Array $selection, Array $drawNumber,int $gameId): array {
        $zodiacSigns = [
            "Rat" =>self::generateArray(1),
            "Ox" => self::generateArray(2),
           "Tiger" =>self:: generateArray(3),
           "Rabbit" =>self:: generateArray(4),
           "Dragon" =>self:: generateArray(5),
           "Snake" => self::generateArray(6),
           "Horse" => self::generateArray(7),
           "Goat" => self::generateArray(8),
           "Monkey" => self::generateArray(9),
           "Rooster" => self::generateArray(10),
           "Dog" => self::generateArray(11),
           "Pig" => self::generateArray(12)
        ];
      
        $count = 0;
        $gameids = [];
        foreach ($selection[0] as $betdata) {
          if (count(array_intersect($drawNumber, $zodiacSigns[$betdata]))) {
            $count++;
            $gameids[] = $gameId;
          }
        }
        $count =   ($count >= 4) ? '1' : '0';
        return [
            'numwins' => $count,
            'gameids' => $count ?  $gameids : [],
           'status' => $count ? 2 : 3
          ];
      
    }
// fn(["Rat"],[1,2,3,4,5,6,2]) = 1

public static function  FiveZodaic(Array $selection, Array $drawNumber,int $gameId): array {
    $zodiacSigns = [
        "Rat" =>self::generateArray(1),
        "Ox" => self::generateArray(2),
       "Tiger" =>self:: generateArray(3),
       "Rabbit" =>self:: generateArray(4),
       "Dragon" =>self:: generateArray(5),
       "Snake" => self::generateArray(6),
       "Horse" => self::generateArray(7),
       "Goat" => self::generateArray(8),
       "Monkey" => self::generateArray(9),
       "Rooster" => self::generateArray(10),
       "Dog" => self::generateArray(11),
       "Pig" => self::generateArray(12)
    ];
  
    $count = 0;
    $gameids = [];
    foreach ($selection[0] as $betdata) {
      if (count(array_intersect($drawNumber, $zodiacSigns[$betdata]))) {
        $count++;
        $gameids[] = $gameId;
      }
    }
    $count =  ($count >= 5) ? '1' : '0';
    return [
        'numwins' => $count,
        'gameids' => $count ?  $gameids : [],
       'status' => $count ? 2 : 3
      ];
  
}
// fn(["Rat"],[1,2,3,4,5,6,2]) = 1


public static function SumZodaic(Array $selection, Array $drawNumber,int $gameId): array {

    $zodiacsigns = [
        "Rat" => self::generateArray(1),
        "Ox" => self::generateArray(2),
       "Tiger" =>self:: generateArray(3),
       "Rabbit" =>self:: generateArray(4),
       "Dragon" =>self:: generateArray(5),
       "Snake" => self::generateArray(6),
       "Horse" => self::generateArray(7),
       "Goat" => self::generateArray(8),
       "Monkey" => self::generateArray(9),
       "Rooster" => self::generateArray(10),
       "Dog" => self::generateArray(11),
       "Pig" => self::generateArray(12)
    ];
    
    // count the unique  zodiac signs 
    $uniqueZodiacSigns = [];
    foreach ($drawNumber as $number) {
      foreach ($zodiacsigns as $sign => $signNumbers) {
          if (in_array($number, $signNumbers) && !in_array($sign, $uniqueZodiacSigns)) {
              $uniqueZodiacSigns[] = $sign;
          }
      }
    }
        $betnumber = preg_replace('/[^0-9]/', '', $selection[0]);
        $foundZodiac = count($uniqueZodiacSigns);
        $count = 0;
        $gameids = [];
      if (in_array($foundZodiac ,$betnumber )){
        $count++;
        $gameids[] = $gameId; 
      };
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
            'status'  => $count ? 2 : 3
          ];
    
    
}
// fn(["2 Zodiac"],[1,2,3,4,5,6,2]) = 1


public static function OddEvenZodaic(Array $selection, Array $drawNumber,int $gameId): array {

    $zodiacsigns = [
        "Rat" =>self::generateArray(1),
        "Ox" => self::generateArray(2),
       "Tiger" =>self:: generateArray(3),
       "Rabbit" =>self:: generateArray(4),
       "Dragon" =>self:: generateArray(5),
       "Snake" => self::generateArray(6),
       "Horse" => self::generateArray(7),
       "Goat" => self::generateArray(8),
       "Monkey" => self::generateArray(9),
       "Rooster" => self::generateArray(10),
       "Dog" => self::generateArray(11),
       "Pig" => self::generateArray(12)
  ];
  
  
  $uniqueZodiacSigns = [];
  foreach ($drawNumber as $number) {
      foreach ($zodiacsigns as $sign => $signNumbers) {
          if (in_array($number, $signNumbers) && !in_array($sign, $uniqueZodiacSigns)) {
              $uniqueZodiacSigns[] = $sign;
          }
      }
  }
     $numberOfUniqueSigns = count($uniqueZodiacSigns);
     $result  = ($numberOfUniqueSigns % 2 !== 0) ? "Odd" : "Even";
       $count = 0;
        $gameids = [];
      if (in_array($result,$selection[0] )){
        $count++;
        $gameids[] = $gameId; 
      };
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
            'status'  => $count ? 2 : 3
          ];
  
}
// fn(["Odd"],[1,2,3,4,5,6,2]) = 1

public static function  ColorBalls(array $selection, array $drawNumber,int $gameId):array {
        $colors = [
            'Red Balls' => [1, 2, 7, 8, 12, 13, 18, 19, 23, 24, 29, 30, 34, 35, 40, 45, 46],
            'Blue Balls' => [3, 4, 9, 10, 14, 15, 20, 25, 26, 31, 36, 37, 41, 42, 47, 48],
            'Green Balls' => [5, 6, 11, 16, 17, 21, 22, 27, 28, 32, 33, 38, 39, 43, 44, 49]
        ];

        // Count occurrences of each color
    $drawnColors = [];
    foreach ($drawNumber as $number) {
        foreach ($colors as $color => $numbers) {
            if (in_array($number, $numbers)) {
                $drawnColors[] = $color;
                break;
            }
        }
    }
        $colorCount = array_count_values($drawnColors);
        $maxCount = max($colorCount);
        $colorsAtMax = array_keys($colorCount, $maxCount);
        $isTie = count($colorsAtMax) > 1;
        $lastColor = $drawnColors[array_key_last($drawnColors)];
        $count = 0;
        if ($isTie) {
            if (in_array($lastColor, $colorsAtMax)) {
                $count = in_array($lastColor, $selection[0]) ? 1 : 0;
            } else {
                $count = in_array('Tie', $selection[0])? 1 : 0;
            }
            } else {
            $count = in_array($colorsAtMax[0], $selection[0])? 1 : 0;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status'  => $count ? 2 : 3
            ];
}

    //####################### Helper Functions ############################
    public static function generateMapping($start)
    {
        $sequence = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $mapping = [];
        $length = count($sequence);
        $distance = 0;
        $index = $start;

        for ($i = 0; $i <= $length; $i++) {
            $mapping[$sequence[$index]] = $distance;
            $distance++;
            $index = $index === 0 ? $length - 1 : $index - 1;
        }

        return $mapping;
    }

    public static function generateArray($position)
    {
        $current_chinese_zodiac = 5;
        $sequenceMappingData = self::generateMapping($current_chinese_zodiac);
        $finalResults = [];
        $maxArrayLoop = $sequenceMappingData[$position] === 1 ? 5 : 4;

        for ($i = 1; $i <= $maxArrayLoop; $i++) {
            $number = 12 * $i - (12 - $sequenceMappingData[$position]);
            $formattedNumber = $number < 10 ? "$number" : "$number";
            $finalResults[] = $formattedNumber;
        }

        return $finalResults;
    }

    //####################### Helper Functions ############################





    //   ######################## mark 6 Boardgames ############################

    public static function  ExtraNumbers(array $selection, array $drawNumber,int $gameId): Array
    {

        $data = [
            'Extra Small' => (in_array(end($drawNumber), range(1, 24))) ? 1 : 0,
            'Extra Big' =>  in_array(end($drawNumber), range(25, 30)) ? 1 : 0,
            'Special Odd' =>  in_array(end($drawNumber), range(1, 49, 2)) ? 1 : 0,
            'Special Even' => in_array(end($drawNumber), range(2, 49, 2)) ? 1 : 0
        ];
        $count = 0;
        $gameids = [];
      if($data[$selection[0]]){
        $count++;
        $gameids[] = $gameId;
      }
      return [
        'numwins' => $count, 
        'gameids' => $count ? $gameids : [],
        'status' => $count ? 2 : 3
    ];

    } // fn(["Big"],[1,2,3,4,5,6,2]) = 1


    public static function ColorWaves(array $selection, array $drawNumber,int $gameId): Array
    {
        $gameData = [
            'Red Wave'    => [1, 3, 7, 8, 12, 13, 18, 19, 23, 24, 29, 30, 34, 35, 40, 45, 46],
            'Blue Wave'   => [2, 4, 9, 10, 14, 15, 20, 25, 26, 31, 36, 37, 41, 42, 47, 48],
            'Green Wave'  => [5, 6, 11, 16, 17, 21, 22, 27, 28, 32, 33, 38, 39, 43, 44, 49],
        ];
         $count = 0;
        // $gameids = [];
        foreach ($selection as $userSelection) {
        if(in_array(end($drawNumber), $gameData[$userSelection])){
            $count++;
        }
        }
        return [
            'numwins' => $count, 
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    } // fn(["Blue Wave"],[1,2,3,4,5,6,2]) = 1


    public static function GuessNumber(array $selection, array $drawNumber,int $gameId): Array
    {
        $count = 0;
        $gameId= [];
       if(in_array(end($drawNumber), $selection)){
        $count++;
        $gameids[] = $gameId;
       }
       return [
        'numwins' => $count, 
        'gameids' => $count ?  $gameids : [],
        'status' => $count ? 2 : 3
    ];

    } // fn(["10","12"],[1,2,3,4,5,6,2]) = 1

    public static function ElementSeven(array $selection, array $drawNumber,int $gameId):Array
  {
        $data = [
            'East' =>   in_array(end($drawNumber), range(1, 7)) ? 1 : 0,
            'South' =>  in_array(end($drawNumber), range(8, 14)) ? 1 : 0,
            'West' =>   in_array(end($drawNumber), range(1, 49, 2)) ? 1 : 0,
            'North' =>  in_array(end($drawNumber), range(22, 28)) ? 1 : 0,
            'Middle' =>  in_array(end($drawNumber), range(29, 35)) ? 1 : 0,
            'Send'  => in_array(end($drawNumber), range(36, 42)) ? 1 : 0,
            'White' => in_array(end($drawNumber), range(43, 49)) ? 1 : 0,
        ];
        $count  = 0;
        $gameids = [];
        if($data[$selection[0]]){
            $count++;
            $gameids[] = $gameId;
        }
        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];
    }


    //  ######################## mark 6 Road bet ############################


    public static  function  BigSmall(array $selection, array $drawNumber,int $gameId):Array
    {
        if(end($drawNumber) == 49) {
            return['status' => 6];
        }
        $count = 0;
        $gameids = [];
        if(in_array(end($drawNumber) >= 25 ? "Big" : "Small", $selection)){
             $count++;
             $gameids[] = $gameId;
        };
        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];  
    } // fn(["Big"],[1,2,3,4,5,6,2]) = 1

    public static function OddEven(array $selection, array $drawNumber,int $gameId): Array
    {

         if(end($drawNumber) == 49) {
            return['status' => 6];
        }
        $count = 0;
        $gameids = [];
        if(in_array(end($drawNumber) % 2 !== 0 ? "Odd" : "Even", $selection)){
             $count++;
             $gameids[] = $gameId;
        };
        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];  
       
    }

    public static function BigSmallSum(array $selection, array $drawNumber,int $gameId): Array
    {
        if(end($drawNumber) == 49) {
            return['status' => 6];
        }
        $count = 0;
        $gameids = [];
        if(in_array(((array_sum(str_split(end($drawNumber))) > 6) ? 'Big Sum' : 'Small Sum'), $selection)){
             $count++;
             $gameids[] = $gameId;
        };
        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];  
    
    }
    public static function OddEvenSum(array $selection, array $drawNumber,int $gameId): Array
    {
        if(end($drawNumber) == 49) {
            return['status' => 6];
        }
        $count = 0;
        $gameids = [];
        if(in_array(((array_sum(str_split(end($drawNumber))) % 2 !== 0) ? "Odd Sum" : "Even Sum"), $selection)){
             $count++;
             $gameids[] = $gameId;
        };
        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];  
    
    }

    public static function SkyGround(array $selection, array $drawNumber,int $gameId): Array
    {
        $data = [
            "Zodiac Sky" => in_array(
                end($drawNumber),
                explode(
                    ",",
                    implode(",", self::generateArray(2)) . ',' .
                        implode(",", self::generateArray(4)) . ',' .
                        implode(",", self::generateArray(7)) . ',' .
                        implode(",", self::generateArray(9)) . ',' .
                        implode(",", self::generateArray(12))
                )
            ) ? 1: 0,
            "Zodiac Ground" => in_array(
                end($drawNumber),
                explode(
                    ",",
                    implode(",", self::generateArray(1)) . ',' .
                        implode(",", self::generateArray(3)) . ',' .
                        implode(",", self::generateArray(6)) . ',' .
                        implode(",", self::generateArray(8)) . ',' .
                        implode(",", self::generateArray(10)) . ',' .
                        implode(",", self::generateArray(11))
                )
            ) ? 1: 0,
        ];

        if(end($drawNumber) == 49){
            return["status" => 6];
        }
         $count = $data[$selection[0]];  
        return [
            'numwins' => $count, 
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ]; 
    }


    public static function FirstLast(array $selection, array $drawNumber,int $gameId): Array
    {
        $data = [
            "Zodiac First" => in_array(
                end($drawNumber),
                explode(
                    ",",
                    implode(",", self::generateArray(1)) . ',' .
                        implode(",", self::generateArray(2)) . ',' .
                        implode(",", self::generateArray(3)) . ',' .
                        implode(",", self::generateArray(4)) . ',' .
                        implode(",", self::generateArray(5)) . ',' .
                        implode(",", self::generateArray(6))
                )
            ) ? 1 : 0,
            "Zodiac Last" => in_array(
                end($drawNumber),
                explode(
                    ",",
                    implode(",", self::generateArray(7)) . ',' .
                        implode(",", self::generateArray(8)) . ',' .
                        implode(",", self::generateArray(9)) . ',' .
                        implode(",", self::generateArray(10)) . ',' .
                        implode(",", self::generateArray(11)) . ',' .
                        implode(",", self::generateArray(12))
                )
            ) ? 1 : 0,
        ];
        if(end($drawNumber) == 49){
            return["status" => 6];
        }
        $count = $data[$selection[0]];  
        return [
            'numwins' => $count, 
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ]; 
    }

    public static function PoultryBeast(array $selection, array $drawNumber,int $gameId): Array
    {
        $data = [
            "Zodiac Poultry" => in_array(
                end($drawNumber),
                explode(
                    ",",
                    implode(",", self::generateArray(2)) . ',' .
                        implode(",", self::generateArray(7)) . ',' .
                        implode(",", self::generateArray(8)) . ',' .
                        implode(",", self::generateArray(10)) . ',' .
                        implode(",", self::generateArray(11)) . ',' .
                        implode(",", self::generateArray(12))
                )
            ) ? 1 : 0,

            "Zodiac Beast" => in_array(
                end($drawNumber),
                explode(
                    ",",
                    implode(",", self::generateArray(1)) . ',' .
                        implode(",", self::generateArray(3)) . ',' .
                        implode(",", self::generateArray(5)) . ',' .
                        implode(",", self::generateArray(6)) . ',' .
                        implode(",", self::generateArray(4)) . ',' .
                        implode(",", self::generateArray(9))
                )
            ) ? 1 : 0

        ];

        if(end($drawNumber) == 49){
            return["status" => 6];
        }
        $count = $data[$selection[0]];  
        return [
            'numwins' => $count, 
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ]; 
    }

    public static function TailBigSmall(array $selection, array $drawNumber,int $gameId):Array
    {

        $numberGroups = [
            'Tail Big' => [5, 6, 7, 8, 9],
            'Tail Small' => [0, 1, 2, 3, 4],
        ];
        if (end($drawNumber) == 49) {
            return["status" => 6];
        } 
            $count = 0;
            $gameids = [];
            $lastNumberAsString = (string)end($drawNumber);
            $lastDigit = intval($lastNumberAsString[strlen($lastNumberAsString) - 1]);
          if(in_array($lastDigit, $numberGroups[$selection[0]])){
             $count++;
             $gameids[] = $gameId;
          };
          return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids: [],
            'status' => $count ? 2 : 3
        ]; 
        
    }


    //ball1

    public static function BallOneBigSmall(array $selection, array $drawNumber,int $gameId):Array
    {
        $numberGroups = [
            'Big' => in_array($drawNumber[0], range(25, 49)) ? 1 : 0,
            'Small' => in_array($drawNumber[0], range(1, 24)) ? 1 : 0,

        ];
        $count = $numberGroups[$selection[0]];
        return [
            'numwins' => $count, 
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ]; 
    }

    public static function BallOneOddEven(array $selection, array $drawNumber,int $gameId ):Array
    {
        $count = 0;
        $gameids = [];
        if(in_array($drawNumber[0] % 2 !== 0 ? "Odd" : "Even", $selection)){
            $count++;
            $gameids[] = $gameId;
        }
        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ]; 
    }

    public static function BallOneBigSmallSum(array $selection, array $drawNumber,int $gameId):Array
    {
        $count = 0;
        $gameids = [];
        if(in_array(((array_sum(str_split(($drawNumber[0]))) > 5) ? 'Big Sum' : 'Small Sum'), $selection)){
            $count++;
            $gameids[] = $gameId;
        };
        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ]; 
    }

    public static function  BallOneOddEvenSum(array $selection, array $drawNumber,int $gameId):Array
    {
        $count = 0;
        $gameids = [];
      if( in_array(((array_sum(str_split(($drawNumber[0]))) % 2 !== 0) ? "Odd Sum" : "Even Sum"), $selection)) {
        $count++;
        $gameids[] = $gameId;
      }
        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ]; 
    }

    public static function BallOneTailBigSmall(array $selection, array $drawNumber,int $gameId): array
    {

        $numberGroups = [
            'Tail Big' => [5, 6, 7, 8, 9],
            'Tail Small' => [0, 1, 2, 3, 4],
        ];

        $lastNumberAsString = (string)($drawNumber[0]);
        $lastDigit = intval($lastNumberAsString[strlen($lastNumberAsString) - 1]);
        $count = 0;
        $gameids = [];
      if (in_array($lastDigit, $numberGroups[$selection[0]])){
        $count++;
        $gameids[] = $gameId;
      }

        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ]; 
    }



    // ball2

    public static function BallTwoBigSmall(array $selection, array $drawNumber,int $gameId): Array
    {
        $numberGroups = [
            'Big' => in_array($drawNumber[1], range(25, 49)) ? 1 : 0,
            'Small' => in_array($drawNumber[1], range(1, 24)) ? 1 : 0,
        ];
       $count = $numberGroups[$selection[0]];
        return [
            'numwins' => $count, 
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ]; 
    }

    public static function BallTwoOddEven(array $selection, array $drawNumber,int $gameId):Array
    {
        $count = 0;
        $gameids = [];
        if(in_array($drawNumber[1] % 2 !== 0 ? "Odd" : "Even", $selection)){
            $count++;
            $gameids[] = $gameId;
        }
        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ]; 
    }

    public static function BallTwoBigSmallSum(array $selection, array $drawNumber,int $gameId):Array
    {
        $count = 0;
        $gameids = [];
        if(in_array(((array_sum(str_split(($drawNumber[1]))) > 5) ? 'Big Sum' : 'Small Sum'), $selection)){
            $count++;
            $gameids[] = $gameId;
        };
        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ]; 
        //return in_array(((array_sum(str_split(($drawNumber[1]))) > 5) ? 'Big Sum' : 'Small Sum'), $selection) ? '1' : '0';
    }

    public static function BallTwoOddEvenSum(array $selection, array $drawNumber,int $gameId):Array
    {
        $count = 0;
        $gameids = [];
      if( in_array(((array_sum(str_split(($drawNumber[1]))) % 2 !== 0) ? "Odd Sum" : "Even Sum"), $selection)) {
        $count++;
        $gameids[] = $gameId;
      }
        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ]; 
      //  return in_array(((array_sum(str_split(($drawNumber[1]))) % 2 !== 0) ? "Odd Sum" : "Even Sum"), $selection) ? "1" : "0";
    }

    public static function BallTwoTailBigSmall(array $selection, array $drawNumber,int $gameId):Array
    {

       
        $numberGroups = [
            'Tail Big' => [5, 6, 7, 8, 9],
            'Tail Small' => [0, 1, 2, 3, 4],
        ];

        $lastNumberAsString = (string)($drawNumber[1]);
        $lastDigit = intval($lastNumberAsString[strlen($lastNumberAsString) - 1]);
        $count = 0;
        $gameids = [];
      if (in_array($lastDigit, $numberGroups[$selection[0]])){
        $count++;
        $gameids[] = $gameId;
      }

        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ]; 
    }


    // ball3

    public static function BallThreeBigSmall(array $selection, array $drawNumber,int $gameId): Array
    {
        $numberGroups = [
            'Big' => in_array($drawNumber[2], range(25, 49)) ? 1 : 0,
            'Small' => in_array($drawNumber[2], range(1, 24)) ? 1 : 0,
        ];
       $count = $numberGroups[$selection[0]];
        return [
            'numwins' => $count, 
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ]; 
    }

    public static function BallThreeOddEven(array $selection, array $drawNumber,int $gameId): Array
    {
        $count = 0;
        $gameids = [];
        if(in_array($drawNumber[2] % 2 !== 0 ? "Odd" : "Even", $selection)){
            $count++;
            $gameids[] = $gameId;
        }
        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ]; 
    }

    public static function BallThreeBigSmallSum(array $selection, array $drawNumber,int $gameId): Array
    {
        $count = 0;
        $gameids = [];
        if(in_array(((array_sum(str_split(($drawNumber[2]))) > 5) ? 'Big Sum' : 'Small Sum'), $selection)){
            $count++;
            $gameids[] = $gameId;
        };
        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ]; 
        //return in_array(((array_sum(str_split(($drawNumber[2]))) > 5) ? 'Big Sum' : 'Small Sum'), $selection) ? '1' : '0';
    }

    public static function BallThreeOddEvenSum(array $selection, array $drawNumber,int $gameId):Array
    {
        $count = 0;
        $gameids = [];
      if( in_array(((array_sum(str_split(($drawNumber[2]))) % 2 !== 0) ? "Odd Sum" : "Even Sum"), $selection)) {
        $count++;
        $gameids[] = $gameId;
      }
        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ]; 
      //  return in_array(((array_sum(str_split(($drawNumber[2]))) % 2 !== 0) ? "Odd Sum" : "Even Sum"), $selection) ? "1" : "0";
    }

    public static function BallThreeTailBigSmall(array $selection, array $drawNumber,int $gameId): Array
    {

        $numberGroups = [
            'Tail Big' => [5, 6, 7, 8, 9],
            'Tail Small' => [0, 1, 2, 3, 4],
        ];

        $lastNumberAsString = (string)($drawNumber[2]);
        $lastDigit = intval($lastNumberAsString[strlen($lastNumberAsString) - 1]);
        $count = 0;
        $gameids = [];
      if (in_array($lastDigit, $numberGroups[$selection[0]])){
        $count++;
        $gameids[] = $gameId;
      }
        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ]; 
    }


    //ball 4

    public static function BallFourBigSmall(array $selection, array $drawNumber,int $gameId): Array
    {
        $numberGroups = [
            'Big' => in_array($drawNumber[3], range(25, 49)) ? 1 : 0,
            'Small' => in_array($drawNumber[3], range(1, 24)) ? 1 : 0,

        ];
        $count = $numberGroups[$selection[0]];
        return [
            'numwins' => $count, 
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ]; 
    }

    public static function BallFourOddEven(array $selection, array $drawNumber,int $gameId): array
    {
        $count = 0;
        $gameids = [];
        if(in_array($drawNumber[3] % 2 !== 0 ? "Odd" : "Even", $selection)){
            $count++;
            $gameids[] = $gameId;
        }
        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ]; 
      //  return (in_array($drawNumber[3] % 2 !== 0 ? "Odd" : "Even", $selection) ? "1" : "0");
    }

    public static function BallFourBigSmallSum(array $selection, array $drawNumber,int $gameId):Array
    {

        $count = 0;
        $gameids = [];
        if(in_array(((array_sum(str_split(($drawNumber[3]))) > 5) ? 'Big Sum' : 'Small Sum'), $selection)){
            $count++;
            $gameids[] = $gameId;
        };
        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ]; 
     ///   return in_array(((array_sum(str_split(($drawNumber[3]))) > 5) ? 'Big Sum' : 'Small Sum'), $selection) ? '1' : '0';
    }

    public static function BallFourOddEvenSum(array $selection, array $drawNumber,int $gameId): Array
    {
        $count = 0;
        $gameids = [];
      if( in_array(((array_sum(str_split(($drawNumber[2]))) % 2 !== 0) ? "Odd Sum" : "Even Sum"), $selection)) {
        $count++;
        $gameids[] = $gameId;
      }
        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ]; 
        //return in_array(((array_sum(str_split(($drawNumber[3]))) % 2 !== 0) ? "Odd Sum" : "Even Sum"), $selection) ? "1" : "0";
    }

    public static function BallFourTailBigSmall(array $selection, array $drawNumber,int $gameId):Array
    {

        $numberGroups = [
            'Tail Big' => [5, 6, 7, 8, 9],
            'Tail Small' => [0, 1, 2, 3, 4],
        ];

        $lastNumberAsString = (string)($drawNumber[3]);
        $lastDigit = intval($lastNumberAsString[strlen($lastNumberAsString) - 1]);
        $count = 0;
        $gameids = [];
      if (in_array($lastDigit, $numberGroups[$selection[0]])){
        $count++;
        $gameids[] = $gameId;
      }

        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ]; 
    }

    //ball5


    public static function BallFiveBigSmall(array $selection, array $drawNumber,int $gameId): Array
    {
        $numberGroups = [
            'Big' => in_array($drawNumber[4], range(25, 49)) ? 1 : 0,
            'Small' => in_array($drawNumber[4], range(1, 24)) ? 1 : 0,

        ];
        $count = $numberGroups[$selection[0]];
        return [
            'numwins' => $count, 
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ]; 
    }

    public static function BallFiveOddEven(array $selection, array $drawNumber,int $gameId): Array
    {
        $count = 0;
        $gameids = [];
        if(in_array($drawNumber[4] % 2 !== 0 ? "Odd" : "Even", $selection)){
            $count++;
            $gameids[] = $gameId;
        }
        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ]; 
      //  return (in_array($drawNumber[4] % 2 !== 0 ? "Odd" : "Even", $selection) ? "1" : "0");
    }

    public static function BallFiveBigSmallSum(array $selection, array $drawNumber,int $gameId):Array
    {
        $count = 0;
        $gameids = [];
        if(in_array(((array_sum(str_split(($drawNumber[4]))) > 5) ? 'Big Sum' : 'Small Sum'), $selection)){
            $count++;
            $gameids[] = $gameId;
        };
        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ]; 
     //   return in_array(((array_sum(str_split(($drawNumber[4]))) > 5) ? 'Big Sum' : 'Small Sum'), $selection) ? '1' : '0';
    }

    public static function BallFiveOddEvenSum(array $selection, array $drawNumber,int $gameId):Array
    {
        $count = 0;
        $gameids = [];
      if( in_array(((array_sum(str_split(($drawNumber[4]))) % 2 !== 0) ? "Odd Sum" : "Even Sum"), $selection)) {
        $count++;
        $gameids[] = $gameId;
      }
        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ]; 
      //  return in_array(((array_sum(str_split(($drawNumber[4]))) % 2 !== 0) ? "Odd Sum" : "Even Sum"), $selection) ? "1" : "0";
    }

    public static function BallFiveTailBigSmall(array $selection, array $drawNumber,int $gameId): Array
    {

        $numberGroups = [
            'Tail Big' => [5, 6, 7, 8, 9],
            'Tail Small' => [0, 1, 2, 3, 4],
        ];

        $lastNumberAsString = (string)($drawNumber[4]);
        $lastDigit = intval($lastNumberAsString[strlen($lastNumberAsString) - 1]);
        $count = 0;
        $gameids = [];
      if (in_array($lastDigit, $numberGroups[$selection[0]])){
        $count++;
        $gameids[] = $gameId;
      }

        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ]; 
    }


    //ball6

    public static function BallSixBigSmall(array $selection, array $drawNumber,int $gameId): Array
    {
        $numberGroups = [
            'Big' => in_array($drawNumber[5], range(25, 49)) ? 1 : 0,
            'Small' => in_array($drawNumber[5], range(1, 24)) ? 1 : 0,
        ];
        $count = $numberGroups[$selection[0]];
        return [
            'numwins' => $count, 
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ]; 
    }

    public static function BallSixOddEven(array $selection, array $drawNumber,int $gameId): Array
    {
        $count = 0;
        $gameids = [];
        if(in_array($drawNumber[5] % 2 !== 0 ? "Odd" : "Even", $selection)){
            $count++;
            $gameids[] = $gameId;
        }
        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ]; 
      //  return (in_array($drawNumber[5] % 2 !== 0 ? "Odd" : "Even", $selection) ? "1" : "0");
    }

    public static function BallSixBigSmallSum(array $selection, array $drawNumber,int $gameId): Array
    {
        $count = 0;
        $gameids = [];
        if(in_array(((array_sum(str_split(($drawNumber[5]))) > 5) ? 'Big Sum' : 'Small Sum'), $selection)){
            $count++;
            $gameids[] = $gameId;
        };
        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ]; 
      //  return in_array(((array_sum(str_split(($drawNumber[5]))) > 5) ? 'Big Sum' : 'Small Sum'), $selection) ? '1' : '0';
    }

    public static function BallSixOddEvenSum(array $selection, array $drawNumber,int $gameId): array
    {
        $count = 0;
        $gameids = [];
      if( in_array(((array_sum(str_split(($drawNumber[5]))) % 2 !== 0) ? "Odd Sum" : "Even Sum"), $selection)) {
        $count++;
        $gameids[] = $gameId;
      }
        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ]; 
       
      //  return in_array(((array_sum(str_split(($drawNumber[5]))) % 2 !== 0) ? "Odd Sum" : "Even Sum"), $selection) ? "1" : "0";
    }

    public static function BallSixTailBigSmall(array $selection, array $drawNumber,int $gameId): Array
    {

        $numberGroups = [
            'Tail Big' => [5, 6, 7, 8, 9],
            'Tail Small' => [0, 1, 2, 3, 4],
        ];

        $lastNumberAsString = (string)($drawNumber[5]);
        $lastDigit = intval($lastNumberAsString[strlen($lastNumberAsString) - 1]);
        $count = 0;
        $gameids = [];
      if (in_array($lastDigit, $numberGroups[$selection[0]])){
        $count++;
        $gameids[] = $gameId;
      }

        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ]; 
    }


    //sum
    public static function SumBigSmall(array $selection, array $drawNumber,int $gameId): Array {
      
      $data = [
        "Big" => array_sum($drawNumber) >= 176 ? 1 : (array_sum($drawNumber) == 175 ? 6 : 0),
        "Small" => array_sum($drawNumber) <= 174 ? 1 : (array_sum($drawNumber) == 175 ? 6 : 0),   
      ];
      $count  =  $data[$selection[0]];
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
           'status' => $count ? 2 : 3
        ];  

    }

    public static function SumOddEven(array $selection, array $drawNumber,int $gameId): Array
    {
        if (array_sum($drawNumber) == 175) {
            return ['status' => 6];
          }
          $count = 0;
            $gameids = [];
        if(in_array((array_sum($drawNumber) % 2 !== 0) ? "Odd" : "Even", $selection)){
            $count++;
            $gameids[] = $gameId;
        }
        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];  
    }

    public static function SumBigSmallNoTie(array $selection, array $drawNumber, int $gameId): Array
    {
       
      $data = [  
        "Big (No Tie)" => array_sum($drawNumber) >= 175 ? 1 : 0,
        "Small (No Tie)" => array_sum($drawNumber) <= 175 ? 1 : 0
      ];
      $count  =   $data[$selection[0]];
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];  
    }


    //zodaic
    public static function OddEvenZodaics(array $selection, array $drawNumber,int $gameId): Array
    {

        $zodiacsigns = [
            "Rat" => self::generateArray(1),
            "Ox" => self::generateArray(2),
            "Tiger" => self::generateArray(3),
            "Rabbit" => self::generateArray(4),
            "Dragon" => self::generateArray(5),
            "Snake" => self::generateArray(6),
            "Horse" => self::generateArray(7),
            "Goat" => self::generateArray(8),
            "Monkey" => self::generateArray(9),
            "Rooster" => self::generateArray(10),
            "Dog" => self::generateArray(11),
            "Pig" => self::generateArray(12)
        ];


        $uniqueZodiacSigns = [];
        foreach ($drawNumber as $number) {
            foreach ($zodiacsigns as $sign => $signNumbers) {
                if (in_array($number, $signNumbers) && !in_array($sign, $uniqueZodiacSigns)) {
                    $uniqueZodiacSigns[] = $sign;
                }
            }
        }
        $numberOfUniqueSigns = count($uniqueZodiacSigns);
        $result  = ($numberOfUniqueSigns % 2 !== 0) ? "Odd" : "Even";
        $count = 0;
        $gameids = [];
        if(in_array($result, $selection)){
            $count++;
            $gameids[] =$gameId;
        }

        return [
            'numwins' => $count, 
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];  
    } // fn(["Odd"],[1,2,3,4,5,6,2]) = 1



    ####################### Two sides functions #############

    public static function RapidoBallNo(array $selection, array $drawNumber,int $gameId): Array
    { //id = 214,169,170
            $position = explode(" ",  $selection['position'])[1] - 1;
            $posVal = intval($drawNumber[$position]);
            $tailNumber = sprintf("%02d", $posVal)[1];
            $sumNumber = array_sum(str_split((int) $posVal));
            $selection =  $selection['selection'];
            $dummyKey = count(str_split($selection, 1)) == 2 ? $selection : 'dummyKey';
            $numberGroups =  [
            'Big' => $posVal >= 25 ? 1 : 0,
            'Small' => $posVal <= 24 ? 1 : 0,
            'Odd' => $posVal % 2 != 0 ? 1 : 0,
            'Even' => $posVal % 2 == 0 ? 1 : 0,
            'Big Sum' => $sumNumber >= 7 ? 1 : 0,
            'Small Sum' => $sumNumber <= 6 ? 1 : 0,
            'Odd Sum' => $sumNumber % 2 != 0 ? 1 : 0,
            'Even Sum' => $sumNumber % 2 == 0 ? 1 : 0,
            'Tail Big' => $tailNumber >= 5 ? 1 : 0,
            'Tail Small' => $tailNumber <= 4 ? 1 : 0,
            'Red Balls' => in_array($posVal, [1, 2, 7, 8, 12, 13, 18, 19, 23, 24, 29, 30, 34, 35, 40, 45, 46]) ? 1 : 0,
            'Blue Balls' => in_array($posVal, [3, 4, 9, 10, 14, 15, 20, 25, 26, 31, 36, 37, 41, 42, 47, 48]) ? 1 : 0,
            'Green Balls' => in_array($posVal, [5, 6, 11, 16, 17, 21, 22, 27, 28, 32, 33, 38, 39, 43, 44, 49]) ? 1 : 0,
            $dummyKey => $posVal == ($selection)
            ];

            $gameId = $selection['label_id'];
            $count  =  $numberGroups[$selection];
            return [
                'numwins' => $count,
                'gameids' => $count ? [$gameId] : [],
                'status' => $count ? 2 : 3
            ];

    }

    //extraNo
    public static function ExtraNo2sides(array $selection, array $drawNumber,int $gameId): Array
    {
        $sumNumber = array_sum(str_split(end($drawNumber)));
        $tailNumber = sprintf("%02d", end($drawNumber))[1];
        $selection = $selection['selection'];
        $numberGroups = [
            'Big' => in_array(end($drawNumber), range(25, 48)) ? 1 : 0,
            'Small' => in_array(end($drawNumber), range(1, 24)) ? 1 : 0,
            'Odd' => in_array(end($drawNumber), range(1, 9, 2)) ? 1 : 0,
            'Even' => in_array(end($drawNumber), range(0, 8, 2)) ? 1 : 0,
            'Big Odd' => in_array(end($drawNumber), range(25, 47, 2)) ? 1 : 0,
            'Big Even' => in_array(end($drawNumber), range(26, 48, 2)) ? 1 : 0,
            'Small Even' => in_array(end($drawNumber), range(2, 24, 2)) ? 1 : 0,
            'Small Odd' => in_array(end($drawNumber), range(1, 23, 2)) ? 1 : 0,
            'Big Sum'   => $sumNumber >= 7 ? 1 : 0,
            'Small Sum' => $sumNumber <= 6 ? 1 : 0,
            'Odd Sum'   => $sumNumber % 2 != 0 ? 1 : 0,
            'Even Sum'  => $sumNumber % 2 == 0 ? 1 : 0,
            'Tail Big'   => $tailNumber >= 5 ? 1 : 0,
            'Tail Small' => $tailNumber <= 4 ? 1 : 0,
            "Zodiac Sky" => in_array(
                end($drawNumber),
                explode(
                    ",",
                    implode(",", self::generateArray(2)) . ',' .
                        implode(",", self::generateArray(4)) . ',' .
                        implode(",", self::generateArray(7)) . ',' .
                        implode(",", self::generateArray(9)) . ',' .
                        implode(",", self::generateArray(12))
                )
            ) ? 1 : 0,
            "Zodiac Ground" => in_array(
                end($drawNumber),
                explode(
                    ",",
                    implode(",", self::generateArray(1)) . ',' .
                        implode(",", self::generateArray(3)) . ',' .
                        implode(",", self::generateArray(6)) . ',' .
                        implode(",", self::generateArray(8)) . ',' .
                        implode(",", self::generateArray(10)) . ',' .
                        implode(",", self::generateArray(11))
                )
            ) ? 1 : 0,
            "Zodiac First" => in_array(
                end($drawNumber),
                explode(
                    ",",
                    implode(",", self::generateArray(1)) . ',' .
                        implode(",", self::generateArray(2)) . ',' .
                        implode(",", self::generateArray(3)) . ',' .
                        implode(",", self::generateArray(4)) . ',' .
                        implode(",", self::generateArray(5)) . ',' .
                        implode(",", self::generateArray(6))
                )
            ) ? 1 : 0,
            "Zodiac Last" => in_array(
                end($drawNumber),
                explode(
                    ",",
                    implode(",", self::generateArray(7)) . ',' .
                        implode(",", self::generateArray(8)) . ',' .
                        implode(",", self::generateArray(9)) . ',' .
                        implode(",", self::generateArray(10)) . ',' .
                        implode(",", self::generateArray(11)) . ',' .
                        implode(",", self::generateArray(12))
                )
            ) ? 1 : 0,
            "Zodiac Poultry" => in_array(
                end($drawNumber),
                explode(
                    ",",
                    implode(",", self::generateArray(2)) . ',' .
                        implode(",", self::generateArray(7)) . ',' .
                        implode(",", self::generateArray(8)) . ',' .
                        implode(",", self::generateArray(10)) . ',' .
                        implode(",", self::generateArray(11)) . ',' .
                        implode(",", self::generateArray(12))
                )
            ) ? 1 : 0,
            "Zodiac Beast" => in_array(
                end($drawNumber),
                explode(
                    ",",
                    implode(",", self::generateArray(1)) . ',' .
                        implode(",", self::generateArray(3)) . ',' .
                        implode(",", self::generateArray(5)) . ',' .
                        implode(",", self::generateArray(6)) . ',' .
                        implode(",", self::generateArray(4)) . ',' .
                        implode(",", self::generateArray(9))
                )
            ) ? 1 : 0
        ];
        if(end($drawNumber) == 49){
            return["status" => 6];
        }
        $gameId = $selection['label_id'];
        $count  =  $numberGroups[$selection];
            return [
                'numwins' => $count,
                'gameids' => $count ? [$gameId] : [],
                'status' => $count ? 2 : 3
            ];

    } // fn -> '{"position":"4th","selection":"TailSmall"}',['05','09','09','08','01'], "any" = 1



    public static function ExtraNoo(array $selection, array $drawNumber,int $gameId):Array
    {
        if(end($drawNumber) == 49){
            return["status" => 6];
        }
        $gameId = $selection['label_id'];
        $count = 0;
        $gameids = [];
         if(end($drawNumber) == $selection['selection']){
            $count++;
            $gameids[] = $gameId;
         }
         return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function ExtraNoAllColor(array $selection, array $drawNumber,$gameId):array
    {
        $selection = $selection['selection'];
        $gameId = $selection['label_id'];
       $data = [
            'Red' => in_array(end($drawNumber), [1, 2, 7, 8, 12, 13, 18, 19, 23, 24, 29, 30, 34, 35, 40, 45, 46]) ? 1 : 0,
            'Blue' => in_array(end($drawNumber), [3, 4, 9, 10, 14, 15, 20, 25, 26, 31, 36, 37, 41, 42, 47, 48]) ? 1 : 0,
            'Green' => in_array(end($drawNumber), [5, 6, 11, 16, 17, 21, 22, 27, 28, 32, 33, 38, 39, 43, 44, 49]) ? 1 : 0,
        ];
        $count  = $data[$selection];
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function ExtraNoAll2ColoredBalls(array $selection, array $drawNumber,int $gameId): array
    {
        $selection = $selection['selection'];
        $gameId = $selection['label_id'];
        $data = [
            'Big Red' => in_array(end($drawNumber), [29, 30, 34, 35, 40, 45, 46]) ? 1 : 0,
            'Small Red' => in_array(end($drawNumber), [1, 2, 7, 8, 12, 13, 18, 19, 23, 24]) ? 1 : 0,
            'Odd Red' => in_array(end($drawNumber), [1, 7, 13, 19, 23, 29, 35, 45]) ? 1 : 0,
            'Even Red' => in_array(end($drawNumber), [2, 8, 12, 18, 24, 30, 34, 40, 46]) ? 1 : 0,
            'Big Blue' => in_array(end($drawNumber), [25, 26, 31, 36, 37, 41, 42, 47, 48]) ? 1 : 0,
            'Small Blue' => in_array(end($drawNumber), [3, 4, 9, 10, 14, 15, 20]) ? 1 : 0,
            'Odd Blue' => in_array(end($drawNumber), [3, 9, 15, 25, 31, 37, 41, 47]) ? 1 : 0,
            'Even Blue' => in_array(end($drawNumber), [4, 10, 14, 20, 26, 36, 42, 48]) ? 1 : 0,
            'Big Green' => in_array(end($drawNumber), [27, 28, 32, 33, 38, 39, 43, 44]) ? 1 : 0,
            'Small Green' => in_array(end($drawNumber), [5, 6, 11, 16, 17, 21, 22]) ? 1 : 0,
            'Odd Green' => in_array(end($drawNumber), [5, 11, 17, 21, 27, 33, 39, 43]) ? 1 : 0,
            'Even Green' => in_array(end($drawNumber), [6, 16, 22, 28, 32, 38, 44]) ? 1 : 0
        ];
        if(end($drawNumber) == 49){
            return["status" => 6];
        }
        $count  = $data[$selection];
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    } // fn -> '{"position":"4th","selection":"TailSmall"}',['05','09','09','08','01'], "any" = 1

    public static function ExtraNoAll4ColoredBalls(array $selection, array $drawNumber,int $gameId): Array
    {

        $selection = $selection['selection'];
        $gameId = $selection['label_id'];
        $data = [
            'Red Big Odd' => in_array(end($drawNumber), [29, 35, 45, 46]) ? 1 : 0,
            'Red Big Even' => in_array(end($drawNumber), [30, 34, 40, 46]) ? 1 : 0,
            'Red Small Odd' => in_array(end($drawNumber), [1, 7, 13, 19, 23]) ? 1 : 0,
            'Red Small Even' => in_array(end($drawNumber), [2, 8, 12, 18, 24]) ? 1 : 0,
            'Blue Big Odd' => in_array(end($drawNumber), [25, 31, 37, 41, 47]) ? 1 : 0,
            'Blue Big Even' => in_array(end($drawNumber), [26, 36, 42, 48]) ? 1 : 0,
            'Blue Small Odd' => in_array(end($drawNumber), [3, 9, 15]) ? 1 : 0,
            'Blue Small Even' => in_array(end($drawNumber), [4, 10, 14, 20]) ? 1 : 0,
            'Green Big Odd' => in_array(end($drawNumber), [27, 33, 39, 43]) ? 1 : 0,
            'Green Big Even' => in_array(end($drawNumber), [28, 32, 38, 44]) ? 1 : 0,
            'Green Small Odd' => in_array(end($drawNumber), [5, 11, 17, 21]) ? 1 : 0,
            'Green Small Even' => in_array(end($drawNumber), [6, 16, 22]) ? 1 : 0,
        ];

        if(end($drawNumber) == 49){
            return["status" => 6];
        }
        $count  = $data[$selection];
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    } // fn -> '{"position":"4th","selection":"TailSmall"}',['05','09','09','08','01'], "any" = 1

    public static function ExtraSpecialZodaicColor(array $selection, array $drawNumber,int $gameId):Array
    {
        $selection = $selection['selection'];
        $gameId = $selection['label_id'];
        $zodiacSigns = [
            "Rat" => in_array(end($drawNumber), self::generateArray(1)) ? 1 : 0,
            "Ox" => in_array(end($drawNumber), self::generateArray(2)) ? 1 : 0,
            "Tiger" => in_array(end($drawNumber), self::generateArray(3)) ? 1 : 0,
            "Rabbit" => in_array(end($drawNumber), self::generateArray(4)) ? 1 : 0,
            "Dragon" => in_array(end($drawNumber), self::generateArray(5)) ? 1 : 0,
            "Snake" => in_array(end($drawNumber), self::generateArray(6)) ? 1 : 0,
            "Horse" => in_array(end($drawNumber), self::generateArray(7)) ? 1 : 0,
            "Goat" => in_array(end($drawNumber), self::generateArray(8)) ? 1 : 0,
            "Monkey" => in_array(end($drawNumber), self::generateArray(9)) ? 1 : 0,
            "Rooster" => in_array(end($drawNumber), self::generateArray(10)) ? 1 : 0,
            "Dog" => in_array(end($drawNumber), self::generateArray(11)) ? 1 : 0,
            "Pig" => in_array(end($drawNumber), self::generateArray(12)) ? 1 : 0
        ];
        if(end($drawNumber) == 49){
            return["status" => 6];
        }
        $count  = $zodiacSigns[$selection];
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    } // fn(["Rat"],[1,2,3,4,5,6,2]) = 1


    public static function ExtraSpecialZodaicHeadTail(array $selection, array $drawNumber,int $gameId): Array
    { //more than 1   
        $lastNumber = end($drawNumber);
        $headValue = (int) ($lastNumber / 10); // Get the tens place of the last number
        $tailValue = $lastNumber % 10;
        $selection = $selection['selection'];
        $gameId = $selection['label_id'];
        list($selectedValue, $selectedType) = explode(" ", $selection);
        if ($lastNumber == 49) {
            return["status" => 6];
        } else
    if ($selectedType == "Head") {
           $count  = $headValue == $selectedValue ? 1 : 0;
        } else {
            $count = $tailValue == $selectedValue ? 1 : 0;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    } // fn([1,2,6,7][,8,9,10],[1,2,3,4,5,6,2]) = 1

    public static function ExtraComboZodiac(array $selection, array $drawNumber,int $gameId): Array
    {
        $selection = $selection['selection'];
        $gameId = $selection['label_id'];
        $zodiacsigns = [
            "Rat" => self::generateArray(1),
            "Ox" => self::generateArray(2),
            "Tiger" => self::generateArray(3),
            "Rabbit" => self::generateArray(4),
            "Dragon" => self::generateArray(5),
            "Snake" => self::generateArray(6),
            "Horse" => self::generateArray(7),
            "Goat" => self::generateArray(8),
            "Monkey" => self::generateArray(9),
            "Rooster" => self::generateArray(10),
            "Dog" => self::generateArray(11),
            "Pig" => self::generateArray(12)
        ];
        if (end($drawNumber) == 49) {
            return["status" => 6];
        }
        $count = 0;
        $gameids = [];
        foreach ($selection as $selected_zodiac) {
            if (in_array(end($drawNumber), $zodiacsigns[$selected_zodiac[0]])) {
                $count++;
                $gameids[] = $gameId;
            }
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];
    }


    public static function ExtraFiveElement(array $selection, array $drawNumber,int $gameId): Array
    {
        $selection = $selection['selection'];
        $gameId = $selection['label_id'];
        $element = [
            "Gold" => in_array(end($drawNumber), [1, 2, 9, 10, 23, 24, 31, 32, 39, 40]) ? 1 : 0,
            "Wood" => in_array(end($drawNumber), [5, 6, 13, 14, 21, 22, 35, 36, 43, 44]) ? 1 : 0,
            "Water" => in_array(end($drawNumber), [11, 12, 19, 20, 27, 28, 41, 42, 49]) ? 1 : 0,
            "Fire" => in_array(end($drawNumber), [7, 8, 15, 16, 29, 30, 37, 38, 45, 46]) ? 1 : 0,
            "Earth" => in_array(end($drawNumber), [3, 4, 17, 18, 25, 26, 33, 34, 47, 48]) ? 1 : 0
        ];
        if(end($drawNumber) == 49){
            return["status" => 6];
        }
        $count  = $element[$selection];
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    //ballnumber
    public static function TwoSidesPickOneBallNUmber(array $selection, array $drawNumber,int $gameId):Array
    {
        $gameId = $selection['label_id'];
        $count  = 0;
        $gameids = [] ;
        if(in_array($selection['selection'], $drawNumber)){
            $count++;
            $gameids[] = $gameId;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function TwoSideOneZodiacColors(array $selection, array $drawNumber,int $gameId) :array
    {
        $selection = $selection['selection'];
        $gameId = $selection['label_id'];
        $draw = array_map('intval', $drawNumber);
        $zodiacSigns = [
            "Rat" => count(array_intersect($draw, self::generateArray(1))) >= 1 ? 1 : 0,
            "Ox" => count(array_intersect($draw, self::generateArray(2))) >= 1 ? 1 : 0,
            "Tiger" => count(array_intersect($draw, self::generateArray(3))) >= 1 ? 1 : 0,
            "Rabbit" => count(array_intersect($draw, self::generateArray(4))) >= 1 ? 1 : 0,
            "Dragon" => count(array_intersect($draw, self::generateArray(5))) >= 1 ? 1 : 0,
            "Snake" => count(array_intersect($draw, self::generateArray(6))) >= 1 ? 1 : 0,
            "Horse" => count(array_intersect($draw, self::generateArray(7))) >= 1 ? 1 : 0,
            "Goat" => count(array_intersect($draw, self::generateArray(8))) >= 1 ? 1 : 0,
            "Monkey" => count(array_intersect($draw, self::generateArray(9))) >= 1 ? 1 : 0,
            "Rooster" => count(array_intersect($draw, self::generateArray(10))) >= 1 ? 1 : 0,
            "Dog" => count(array_intersect($draw, self::generateArray(11))) >= 1 ? 1 : 0,
            "Pig" => count(array_intersect($draw, self::generateArray(12))) >= 1 ? 1 : 0
        ];
        $count  = $zodiacSigns[$selection];
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
            'status' => $count ? 2 : 3
        ];
    }

    public static function TwoSidesOneZodiacColorBalls(array $selection, array $drawNumber,int $gameId): Array
    {
        $colors = [
            'Red Balls' => [1, 2, 7, 8, 12, 13, 18, 19, 23, 24, 29, 30, 34, 35, 40, 45, 46],
            'Blue Balls' => [3, 4, 9, 10, 14, 15, 20, 25, 26, 31, 36, 37, 41, 42, 47, 48],
            'Green Balls' => [5, 6, 11, 16, 17, 21, 22, 27, 28, 32, 33, 38, 39, 43, 44, 49]
        ];

        $drawnColors = [];
        foreach ($drawNumber as $number) {
            foreach ($colors as $color => $numbers) {
                if (in_array($number, $numbers)) {
                    $drawnColors[] = $color;
                    break;
                }
            }
        }

        // Count occurrences of each color
        $userSelection = $selection['selection'];
        $gameId = $selection['label_id'];
        $colorCount = array_count_values($drawnColors);
        $maxCount = max($colorCount);
        $colorsWithMaxCount = array_keys($colorCount, $maxCount);
        $result = 0;
        // Determine if it's a tie
        $isTie = count($colorsWithMaxCount) > 1;
        if ($isTie && $userSelection === "Tie") {
            $result = 1; // User wins by correctly predicting a tie
        } elseif (!$isTie && in_array($userSelection, $colorsWithMaxCount)) {
            $result = 1; // User wins by selecting the dominant color
        }
        $count  = 0;
        $gameids = [];
        if($result){
            $count++;
            $gameids[] = $gameId;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
           'status' => $count ? 2 : 3
          ];  
    }

    //specific No
    public static function TwoSidesFixedPlaceOne(array $selection, array $drawNumber,int $gameId):Array
    {
        $position = explode(" ", $selection['position'])[3] - 1;
        $posVal = intval($drawNumber[$position]);
        $selection = $selection['selection'];
        $gameId = $selection['label_id'];
        $count  = 0;
        $gameids = [];
        if($posVal == ($selection)){
            $count++;
            $gameids[] = $gameId;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
           'status' => $count ? 2 : 3
          ];  
    }


    //row zodaiac row tail
    public static function TwoSideTwoConsecZodaic(array $selection, array $drawNumber,int $gameId): Array
    {

        $zodiacSigns = [
            "Rat" => self::generateArray(1),
            "Ox" => self::generateArray(2),
            "Tiger" => self::generateArray(3),
            "Rabbit" => self::generateArray(4),
            "Dragon" => self::generateArray(5),
            "Snake" => self::generateArray(6),
            "Horse" => self::generateArray(7),
            "Goat" => self::generateArray(8),
            "Monkey" => self::generateArray(9),
            "Rooster" => self::generateArray(10),
            "Dog" => self::generateArray(11),
            "Pig" => self::generateArray(12)
        ];
        $draw = array_map('intval', $drawNumber);
        $selection = $selection['selection'];
        $gameId = $selection['label_id'];
        $count = 0;
        $gameids = [];
        foreach ($selection[0] as $betdata) {
            if (count(array_intersect($draw, $zodiacSigns[$betdata]))) {
                $count++;
                $gameids[] =$gameId;
            }
        }
        $count  = ($count >= 2) ? 1 : 0;
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
           'status' => $count ? 2 : 3
          ];  
    }
    public static function TwoSideThreeConsecZodaic(array $selection, array $drawNumber,int $gameId): Array
    {
        $zodiacSigns = [
            "Rat" => self::generateArray(1),
            "Ox" => self::generateArray(2),
            "Tiger" => self::generateArray(3),
            "Rabbit" => self::generateArray(4),
            "Dragon" => self::generateArray(5),
            "Snake" => self::generateArray(6),
            "Horse" => self::generateArray(7),
            "Goat" => self::generateArray(8),
            "Monkey" => self::generateArray(9),
            "Rooster" => self::generateArray(10),
            "Dog" => self::generateArray(11),
            "Pig" => self::generateArray(12)
        ];
        $draw = array_map('intval', $drawNumber);
        $selection = $selection['selection'];
        $gameId = $selection['label_id'];
        $count = 0;
        $gameids = [];
        foreach ($selection[0] as $betdata) {
            if (count(array_intersect($draw, $zodiacSigns[$betdata]))) {
                $count++;
                $gameids[] =$gameId;
            }
        }
         $count  =  ($count >= 3) ? 1 : 0;
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
           'status' => $count ? 2 : 3
          ];  
    }


    public static function TwoSideFourConsecZodaic(array $selection, array $drawNumber,int $gameId): Array
    {
        $zodiacSigns = [
            "Rat" => self::generateArray(1),
            "Ox" => self::generateArray(2),
            "Tiger" => self::generateArray(3),
            "Rabbit" => self::generateArray(4),
            "Dragon" => self::generateArray(5),
            "Snake" => self::generateArray(6),
            "Horse" => self::generateArray(7),
            "Goat" => self::generateArray(8),
            "Monkey" => self::generateArray(9),
            "Rooster" => self::generateArray(10),
            "Dog" => self::generateArray(11),
            "Pig" => self::generateArray(12)
        ];
        $draw = array_map('intval', $drawNumber);
        $selection = $selection['selection'];
        $gameId = $selection['label_id'];
        $count = 0;
        $gameids = [];
        foreach ($selection[0] as $betdata) {
            if (count(array_intersect($draw, $zodiacSigns[$betdata]))) {
                $count++;
                $gameids[] =$gameId;
            }
        }
        $count  =  ($count >= 4) ? 1 : 0;
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
           'status' => $count ? 2 : 3
          ];  
    }

    public static function TwoSideFiveConsecZodaic(array $selection, array $drawNumber,int $gameId): array
    {
        $zodiacSigns = [
            "Rat" => self::generateArray(1),
            "Ox" => self::generateArray(2),
            "Tiger" => self::generateArray(3),
            "Rabbit" => self::generateArray(4),
            "Dragon" => self::generateArray(5),
            "Snake" => self::generateArray(6),
            "Horse" => self::generateArray(7),
            "Goat" => self::generateArray(8),
            "Monkey" => self::generateArray(9),
            "Rooster" => self::generateArray(10),
            "Dog" => self::generateArray(11),
            "Pig" => self::generateArray(12)
        ];

        $draw = array_map('intval', $drawNumber);
        $selection = $selection['selection'];
        $gameId = $selection['label_id'];
        $count = 0;
        $gameids = [];
        foreach ($selection[0] as $betdata) {
            if (count(array_intersect($draw, $zodiacSigns[$betdata]))) {
                $count++;
                $gameids[] =$gameId;
            }
        };
        $count  =  ($count >= 5) ? 1 : 0;
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
           'status' => $count ? 2 : 3
          ];  
    }


    public static function TwoConsecTailNo(array $selection, array $drawNumber,int $gameId): Array
    {

        $data =  [
            "0 Tail" => [0],
            "1 Tail" => [1],
            "2 Tail" => [2],
            "3 Tail" => [3],
            "4 Tail" => [4],
            "5 Tail" => [5],
            "6 Tail" => [6],
            "7 Tail" => [7],
            "8 Tail" => [8],
            "9 Tail" => [9]
        ];

        $TailNumber = array_map(fn ($number) => $number % 10, $drawNumber);
        $selection = $selection['selection'];
        $count = 0;
        $gameids = [];
        foreach ($selection[0] as $numbers) {
            if (count(array_intersect($data[$numbers], $TailNumber))) {
                $count++;
                $gameids[] = $gameId;
            }
        }
        $count  = ($count >= 2) ? 1 : 0;
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
           'status' => $count ? 2 : 3
          ];  
    }


    //if zero is part of the winning number the odd changes
    public static function TwoSideThreeConsecTailNo(array $selection, array $drawNumber,int $gameId): array
    {
        $data =  [
            "0 Tail" => [0],
            "1 Tail" => [1],
            "2 Tail" => [2],
            "3 Tail" => [3],
            "4 Tail" => [4],
            "5 Tail" => [5],
            "6 Tail" => [6],
            "7 Tail" => [7],
            "8 Tail" => [8],
            "9 Tail" => [9]
        ];

        $TailNumber = array_map(fn ($number) => $number % 10, $drawNumber);
        $selection = $selection['selection'];
        $count = 0;
        $gameids = [];
        foreach ($selection[0] as $numbers) {
            if (count(array_intersect($data[$numbers], $TailNumber))) {
                $count++;
                $gameids[] = $gameId;
            }
        }
        $count  = ($count >=3) ? 1 : 0;
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
           'status' => $count ? 2 : 3
          ];  
    }


    //if zero is part of the winning number the odd changes
    public static function TwoSideFourConsecTailNo(array $selection, array $drawNumber,int $gameId): Array
    {
        $data =  [
            "0 Tail" => [0],
            "1 Tail" => [1],
            "2 Tail" => [2],
            "3 Tail" => [3],
            "4 Tail" => [4],
            "5 Tail" => [5],
            "6 Tail" => [6],
            "7 Tail" => [7],
            "8 Tail" => [8],
            "9 Tail" => [9]
        ];

        $TailNumber = array_map(fn ($number) => $number % 10, $drawNumber);
        $selection = $selection['selection'];
        $count = 0;
        $gameids = [];
        foreach ($selection[0] as $numbers) {
            if (count(array_intersect($data[$numbers], $TailNumber))) {
                $count++;
                $gameids[] = $gameId;
            }
        }
        $count  = ($count >= 4) ? 1 : 0;
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
           'status' => $count ? 2 : 3
          ];  
    }


    //if zero is part of the winning number the odd changes
    public static function TwoSideFiveConsecTailNo(array $selection, array $drawNumber,int $gameId): Array
    {
        $data =  [
            "0 Tail" => [0],
            "1 Tail" => [1],
            "2 Tail" => [2],
            "3 Tail" => [3],
            "4 Tail" => [4],
            "5 Tail" => [5],
            "6 Tail" => [6],
            "7 Tail" => [7],
            "8 Tail" => [8],
            "9 Tail" => [9]
        ];

        $TailNumber = array_map(fn ($number) => $number % 10, $drawNumber);
        $selection = $selection['selection'];
        $count = 0;
        $gameids = [];
        foreach ($selection[0] as $numbers) {
            if (count(array_intersect($data[$numbers], $TailNumber))) {
                $count++;
                $gameids[] = $gameId;
            }
        }
        $count  = ($count >= 5) ? 1 : 0;
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
           'status' => $count ? 2 : 3
          ];  
    }



    //row no
    public static function TwoSideWinTwoORThree(array $selection, array $drawNumber,int $gameId): Array
    {
        $count = 0;
        $gameids = [];
        $counter = count(array_intersect($drawNumber, $selection[0]));
       if($counter >= 2){
        $count++;
        $gameids[] = $gameId;
       }
       return [
        'numwins' => $count,
        'gameids' => $count ? $gameids : [],
       'status' => $count ? 2 : 3
      ];  
    }

    public static function TwoSideWinThree(array $selection, array $drawNumber,int $gameId): Array
    { //win more
        $count = 0;
        $gameids = [];
        $counter = count(array_intersect($drawNumber, $selection[0]));
        if($counter >= 3){
            $count++;
            $gameids[] = $gameId;
           }
           return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
           'status' => $count ? 2 : 3
          ];  
    }

    public static function  TwoSideWinTwo(array $selection, array $drawNumber,int $gameId): Array
    {
        $count = 0;
        $gameids = [];
        $counter = count(array_intersect($drawNumber, $selection[0]));
        if($counter >= 2){
            $count++;
            $gameids[] = $gameId;
           }
           return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
           'status' => $count ? 2 : 3
          ];  
    }

    public static function  TwosideTwoNumber(array $selection, array $drawNumber,int $gameId): Array
    {
        $count = 0;
        $gameids = [];
        $counter = count(array_intersect($drawNumber, $selection[0]));
        if($counter >= 2){
            $count++;
            $gameids[] = $gameId;
           }
           return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
           'status' => $count ? 2 : 3
          ];  
    }


    public static function  TwoSideWinExtraNo(array $selection, array $drawNumber,int $gameId):Array
    {
        $count = 0;
        $gameids = [];
      if (in_array(end($drawNumber), $selection[0]) && count(array_intersect($drawNumber, $selection[0])) > 0 ){
        $count++;
        $gameids[] = $gameId;
      }

      return [
        'numwins' => $count,
        'gameids' => $count ? $gameids : [],
       'status' => $count ? 2 : 3
      ];  
  
    }

    public static function  TwoSideWinFour(array $selection, array $drawNumber,int $gameId): Array
    {
        $count = 0;
        $gameids = [];
        $counter = count(array_intersect($drawNumber, $selection[0]));
        if($counter >= 4){
            $count++;
            $gameids[] = $gameId;
           }
           return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
           'status' => $count ? 2 : 3
          ];  
    }
    //zodiac and tail 

    public static function ZodiacTailZodiac(array $selection, array $drawNumber,int $gameId) :Array
    {
        $selection = $selection['selection'];
        $gameId = $selection['label_id'];
        $draw = array_map('intval', $drawNumber);
        $zodiacSigns = [
            "Rat" => count(array_intersect($draw, self::generateArray(1))) >= 1 ? 1 : 0,
            "Ox" => count(array_intersect($draw, self::generateArray(2))) >= 1 ? 1 : 0,
            "Tiger" => count(array_intersect($draw, self::generateArray(3))) >= 1 ? 1 : 0,
            "Rabbit" => count(array_intersect($draw, self::generateArray(4))) >= 1 ? 1 : 0,
            "Dragon" => count(array_intersect($draw, self::generateArray(5))) >= 1 ? 1 : 0,
            "Snake" => count(array_intersect($draw, self::generateArray(6))) >= 1 ? 1 : 0,
            "Horse" => count(array_intersect($draw, self::generateArray(7))) >= 1 ? 1 : 0,
            "Goat" => count(array_intersect($draw, self::generateArray(8))) >= 1 ? 1 : 0,
            "Monkey" => count(array_intersect($draw, self::generateArray(9))) >= 1 ? 1 : 0,
            "Rooster" => count(array_intersect($draw, self::generateArray(10))) >= 1 ? 1 : 0,
            "Dog" => count(array_intersect($draw, self::generateArray(11))) >= 1 ? 1 : 0,
            "Pig" => count(array_intersect($draw, self::generateArray(12))) >= 1 ? 1 : 0
        ];
         $count  = $zodiacSigns[$selection];
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
           'status' => $count ? 2 : 3
          ];  
    }

    public static function ZodaicZodiacNo(array $selection, array $drawNumber,int $gameId):Array
    {

        $zodiacsigns = [
            "Rat" => self::generateArray(1),
            "Ox" => self::generateArray(2),
            "Tiger" => self::generateArray(3),
            "Rabbit" => self::generateArray(4),
            "Dragon" => self::generateArray(5),
            "Snake" => self::generateArray(6),
            "Horse" => self::generateArray(7),
            "Goat" => self::generateArray(8),
            "Monkey" => self::generateArray(9),
            "Rooster" => self::generateArray(10),
            "Dog" => self::generateArray(11),
            "Pig" => self::generateArray(12)
        ];

        // count the unique  zodiac signs 
        $uniqueZodiacSigns = [];
        foreach ($drawNumber as $number) {
            foreach ($zodiacsigns as $sign => $signNumbers) {
                if (in_array($number, $signNumbers) && !in_array($sign, $uniqueZodiacSigns)) {
                    $uniqueZodiacSigns[] = $sign;
                }
            }
        }
        $foundZodiac = count($uniqueZodiacSigns);
        list($selectedValue, $selectedType) = explode(" ", $selection['selection']);
        $gameId = $selection['label_id'];
        if ($selectedType == "Sum") {
            $result = ($foundZodiac % 2 !== 0) ? "Odd" : "Even";
            $count = ($result == $selectedValue) ? 1 : 0;
        } else {
            $count = $foundZodiac == $selectedValue ? 1 : 0;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
           'status' => $count ? 2 : 3
          ];  

    }

    public static function TwoSideZodaicTails(array $selection, array $drawNumber,int $gameId): Array
    {
        $TailNumber = array_map(fn ($number) => $number % 10, $drawNumber);
        $selection = $selection['selection'];
        $gameId = $selection['label_id'];
        list($selectedValue, $selectedType) = explode(" ", $selection);
        if ($selectedType == "Tail") {
         $count  =  in_array($selectedValue, $TailNumber) ? 1 : 0;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? [$gameId] : [],
           'status' => $count ? 2 : 3
          ]; 
    }


    //sum

    public static function TwoSidesSum(array $selection, array $drawNumber,int $gameId):Array
    { //win 1 or 2

        $data = [
            "Sum Big" => array_sum($drawNumber) >= 176 ? 1 : (array_sum($drawNumber) == 175 ? 6 : 0),
            "Sum Small" => array_sum($drawNumber) <= 174 ? 1 : (array_sum($drawNumber) == 175 ? 6 : 0),
            "Sum Odd" => array_sum($drawNumber) % 2 !== 0 ? 1 : 0,
            "Sum Even" => array_sum($drawNumber) % 2 == 0 ? 1 : 0,
            "Big(No Tie)" => array_sum($drawNumber) >= 175 ? 1 : 0,
            "Small(No Tie)" => array_sum($drawNumber) <= 175 ? 1 : 0
        ];
        $count  = 0;
        $gameids = [];
        $gameId = $selection['label_id'];
        if($data[$selection['selection']]){
            $count++;
            $gameids[] = $gameId;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
           'status' => $count ? 2 : 3
          ]; 
    }

    //mismatch
    public static function TwoSidesMismatch(array $selection, array $drawNumber,int $gameId):Array
    { //must be checked
        $count  = 0;
        $gameids = [];
        $counter = count(array_intersect($drawNumber, $selection[0]));
        if($counter == 0){
            $count++;
            $gameids[] = $gameId;
        }
        return [
            'numwins' => $count,
            'gameids' => $count ? $gameids : [],
           'status' => $count ? 2 : 3
          ]; 
    }

    //optional 

    public static function Optional(array $selection, array $drawNumber,int $gameId): array
    {
        $count  = 0;
        $gameids = [];
      if(in_array($selection['selection'], $drawNumber)){
        $count++;
        $gameids[] = $gameId;
      }
      return [
        'numwins' => $count,
        'gameids' => $count ? $gameids : [],
       'status' => $count ? 2 : 3
      ]; 
    }


    ///fantan games\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

   public static function FantanMain (array $selection, array $drawNumber, int $gameId){
        $zodiacSigns = [
            "554" => self::generateArray(1),
            "555" => self::generateArray(2),
            "556" => self::generateArray(3),
            "557" => self::generateArray(4),
            "561" => self::generateArray(5),
            "558" => self::generateArray(6),
            "559" => self::generateArray(7),
            "560" => self::generateArray(8),
            "564" => self::generateArray(9),
            "679" => self::generateArray(10),
            "562" => self::generateArray(11),
            "563" => self::generateArray(12)
        ];
        if(end($drawNumber)== 49){
            return ['status' => 6 ];
        } 
            $count = 0;
            $gameids = [];
            if (in_array(end($drawNumber), $zodiacSigns[$selection[0]])) {
                $count++;
                $gameids[] = $gameId;
            }
            return [
                'numwins' => $count,
                'gameids' => $count ? $gameids : [],
                'status' => $count ? 2 : 3
            ];
    }

    public static function fantanBsoe(array $selection, array $drawNumber, int $gameId){
    
        $numberGroups = [
          '565' => in_array(end($drawNumber),range(25, 48)) ? 1 :0, 
          '566' => in_array(end($drawNumber),range(1, 24)) ? 1:0, 
          '567' => (end($drawNumber)) % 2 != 0 ? 1 :0, 
          '568' => (end($drawNumber)) % 2 == 0 ? 1 :0, 
         ];
      if(end($drawNumber)== 49){
          return ['status' => 6];
      } 
      $count = 0;
      $gameids = [];
      if($numberGroups[$selection[0]] == 1){
          $count++;
          $gameids[] = $gameId;
      }
      return [
          'numwins' => $count,
          'gameids' => $count ? $gameids : [],
          'status' => $count ? 2 : 3
      ];

}

public static function fantanSpecialcode(array $selection, array $drawNumber, int $gameId)
{
    $count = 0;
    $gameids= [];
    if (end($drawNumber) == $selection[0]) {
        $count++;
        $gameids[] = $gameId;
    };
    echo $count;
    return [
        'numwins' => $count ? $count : 0,
        'gameids' => $count ? $gameids : [],
        'status' => $count ? 2 : 3,
    ];
}


        


}

// var_dump((newmark6::OneBallZodaic([["Rat"]],[1,2,3,4,6,7]))); // 1