<?php

class DrawNumberGenerator {

    public static function cron5D() : array { // 5d
        $Five = range(0,9);
        shuffle($Five);
        return array_slice($Five,0,5);
    }

    public static function cronPK10() : array { // pk10
        $pk10 = range(1, 10);
        shuffle($pk10);
        return $pk10;
    }

    public static function cronFast3() : array { // fast3
        $fast3 = array_slice(range(1, 6), 0, 3);
        shuffle($fast3);
        sort($fast3);
        return $fast3;
    }

    public static function cronThreeD() : array { // threeD
        $threeD = array_slice(range(0, 9), 0, 3);
        shuffle($threeD);
        return $threeD;
    }

    public static function cronEleven5() : array { //eleven5
        $eleven5raw = array_map(function ($num) {
            return str_pad($num, 2, '0', STR_PAD_LEFT);
        }, range(1, 11));
        $eleven5 = array_slice($eleven5raw, 0, 5);
        shuffle($eleven5);
        return $eleven5;
    }

    public static function cronMark6() : array { // mark6
        $mark65raw = array_map(function ($num) {
            return str_pad($num, 2, '0', STR_PAD_LEFT);
        }, range(1, 49));
        $mark6 = array_slice($mark65raw, 0, 7);
        shuffle($mark6);
        return $mark6;
    }

    public static function cronHappy8() : array { //happy8
        $happy8raw = array_map(function ($num) {
            return str_pad($num, 2, '0', STR_PAD_LEFT);
        }, range(1, 80));
        shuffle($happy8raw);
        $happy8 = array_slice($happy8raw, 0, 20);
        sort($happy8);
        return $happy8;
    }

    # ------------------------------------------------------------#

    public static function generate(string $gameId) : string {
        $drawNumberGroup = [
            "1,4,5,6,7,8,9,36,37" => implode(",",self::cron5D()),
            "3,17,23,34,38" => implode(",", self::cronPK10()),
            "10,11,12,31,39" => implode(",", self::cronFast3()),
            "13,14,15,16,30" => implode(",", self::cronThreeD()),
            "27,28,33,40" => implode(",", self::cronEleven5()),
            "25,26,32,41" => implode(",", self::cronMark6()),
            "29,35,42" => implode(",", self::cronHappy8())
        ];
        return self::findGameDraw($drawNumberGroup, $gameId);
    }

    public static function findGameDraw(array $ClassIdGroups, string $ClassId): string {
        foreach ($ClassIdGroups as $group => $value) {
            if (in_array($ClassId, explode(",", $group))) {
                return $value;
            }
        }
        return null; 
    }

}