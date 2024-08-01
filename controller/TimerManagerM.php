<?php

class TimerManagerM extends TimeSet {
  
  public static function getDrawCount(string $time, string $lotteryId) : string 
  {
        $times = parent::getTimeSet($lotteryId);
        $result = $times[$time] ?? null;
        if (!$result) {
            $lower_time = null;
            foreach (array_keys($times) as $time_key) {
                if ($time > $time_key) $lower_time = $time_key;
                else break;
            }
            $result = $lower_time ? $times[$lower_time] : null;
        }

        return $result;
  }
  
  public static function getDrawPeriod(string $time, string $lotteryId) : string
  {
        $times = parent::getTimeSet($lotteryId);
        $result = $times[$time] ?? null;
        if (!$result) {
            $lower_time = null;
            foreach (array_keys($times) as $time_key) {
                if ($time > $time_key) $lower_time = $time_key;
                else break;
            }
            $result = $lower_time ? date("Ymd") . $times[$lower_time] : null;
        }

        $endTime = self::getGameStopTimeAndTimeInSec($lotteryId)['endTime'];
        $lastInfos = self::getGamesLastDrawInfos($lotteryId);
        $isWithinTimeRange = self::isWithinTimeRange($endTime, $lotteryId);
        return $isWithinTimeRange ? $lastInfos['period']: $result;
  }
  
  public static function getNextDrawPeriod(string $time, string $lotteryId) 
  { 
        $times = parent::getTimeSet($lotteryId);
        $result = $times[$time] ?? null;
        $nextPeriod = null;
        if (!$result) {
            foreach (array_keys($times) as $time_key) {
                if ($time > $time_key) $result = $time_key;
            }
        }
        foreach ($times as $key => $val) {
            if ($nextPeriod){
              return date("Ymd").$val;
            } 
            if (strpos($key, $result) === 0) $nextPeriod = $key;
        }

      return null;
  }
  
  public static function getDrawDateTime(string $time, string $lotteryId) : string
  {
        $times = parent::getTimeSet($lotteryId);
        $result = $times[$time] ?? null;
        if (!$result) {
            $lower_time = null;
            foreach (array_keys($times) as $time_key) {
                if ($time > $time_key) $lower_time = $time_key;
                else break;
            }
            $result = $lower_time ? date("Y-m-d") . ' ' . $lower_time : '';
        }

        return $result;
  }

  public static function getNextPeriodAndNextTime(string $time, string $lotteryId) 
  {
        $times = parent::getTimeSet($lotteryId);
        $result = date("H:i:s") ?? null;
        $nextPeriodAndTime = [];
        $nextPeriod = false;
        if (!$result) {
            foreach (array_keys($times) as $time_key) {
                if ($time > $time_key) $result = $time_key;
                else break;
            }
        }
        foreach ($times as $key => $val) {
            if ($nextPeriod){
                $nextPeriodAndTime['nexPeriod'] = date("Ymd").$val;
                $nextPeriodAndTime['nexTime'] = $key  ?? null;
                break;
            } 
            if (strpos($key, $result) === 0) $nextPeriod = true;
        }

        return $nextPeriodAndTime;
  }

  public static function getDrawTime(string $time, string $lotteryId) : string
  {
        $times = parent::getTimeSet($lotteryId);
        $result = $times[$time] ?? null;
        if (!$result) {
            $lower_time = null;
            foreach (array_keys($times) as $time_key) {
                if ($time > $time_key) $lower_time = $time_key;
                else break;
            }
            $result = $lower_time ? $lower_time : '';
        }

        return $result;
  }

  public static function getNextDrawTime(string $time, string $lotteryId) : string
  {
        $times = parent::getTimeSet($lotteryId);
        $result = $times[$time] ?? null;
        $nextPeriod = null;
        if (!$result) {
            foreach (array_keys($times) as $time_key) {
                if ($time > $time_key) $result = $time_key;
            }
        }
        foreach ($times as $key => $val) {
            if ($nextPeriod){
                return $key  ?? null;
            } 
            if (strpos($key, $result) === 0) $nextPeriod = $key;
        }

        return '';
  }
  
  public static function getNextDrawDateTime(string $time, string $lotteryId) : string
  {
        $times = parent::getTimeSet($lotteryId);
        $result = $times[$time] ?? null;
        $nextPeriod = null;
        if (!$result) {
            foreach (array_keys($times) as $time_key) {
                if ($time > $time_key) $result = $time_key;
            }
        }
        foreach ($times as $key => $val) {
            if ($nextPeriod){
                return date("Y-m-d") . ' ' . $key ;
            } 
            if (strpos($key, $result) === 0) $nextPeriod = $key;
        }

        return null; 
  }
  
  public static function getDrawTimeMilliSeconds() : string
  {
    $dateTime = new DateTime();
    $time = $dateTime->format("H:i:s");
    $milliseconds = sprintf("%03d", $dateTime->format("u") / 1000);
    return "$time.$milliseconds";
  }
  
  public static function getSecondsElapsed($startTime, $endTime) : string //break 3600
  {
      $timeElapsed = abs(strtotime($endTime) - strtotime($startTime));
      return $timeElapsed;
  }
  
  public static function getTimeRemaining(string $time, string $lotteryId) : int
  {
     $nextTime = self::getNextDrawTime($time,$lotteryId);
     $interval =  strtotime($nextTime) - strtotime(date("H:i:s"));
     return strlen((string)$interval) > 5 ? 00 : $interval;
  }
  
  public static function getCurrentDrawNumber(string $time, string $lotteryId) 
  {
    $endTime = self::getGameStopTimeAndTimeInSec($lotteryId)['endTime'];
    $lastInfos = self::getGamesLastDrawInfos($lotteryId);
    $isWithinTimeRange = self::isWithinTimeRange($endTime, $lotteryId);

    if($isWithinTimeRange){
      $drawPeriod = self::getDrawPeriod($time, $lotteryId);
      $res = Model::getCurrentDrawNumber($lotteryId, $drawPeriod)['draw_number'] ?? 'Not found.';
      $drawNumber =  [
        "type" => $res ? "success" : "faild",
        "drawinfo" => [
            "draw_number" => json_decode($res)
        ]
      ];

    }else{
        $lastInfos = self::getGamesLastDrawInfos($lotteryId);
        $drawNumber =  [
            "type" => $lastInfos ? "success" : "failed",
            "drawinfo" => [
                "draw_number" => json_decode($lastInfos['draw_number'])
            ]
          ];

    }
   return $drawNumber;

  }

  public static function getGamesLastDrawInfos(string $lotteryId) : array {
    return Model::getGamesLastDrawInfos($lotteryId) ?? ['Not found.'];
  }
  
  public static function getGameStopTimeAndTimeInSec(string $lotteryId) : array
  {
    $lotteryIdGroups = [
        ['ids' => ["1", "3", "4", "6", "7", "10", "13", "25", "27", "29", "30", "31", "32",
        "33", "34", "35", "36", "37", "38", "39", "40", "41", "42"], 'totalTime' => 60, 'endTime' => '00:00:00'], //23:59:00
        ['ids' => ["9", "11", "14", "17"], 'totalTime' => 90, 'endTime' => '00:00:00'], //23:58:30
        ['ids' => ["8", "12", "15", "16", "23"], 'totalTime' => 180, 'endTime' => 'today 00:00:00'], //23:57:03
        ['ids' => ["5", "26", "28"], 'totalTime' => 300, 'endTime' => '00:00:00'] //23:55:00
    ];

    foreach ($lotteryIdGroups as $group) {
        if (in_array($lotteryId, $group['ids'])) {
            return ['totalTime' => $group['totalTime'], 'endTime' => $group['endTime']];
        }
    }

    return [];
  }

  public static function drawInfoController(string $type, string $lotteryId) {

   $time = date("H:i:s");
   return $type == 'drawNumber' ? self::getCurrentDrawNumber($time,$lotteryId) : 
   self::getCurrentDrawInfo($time,$lotteryId);

  }
  
  public static function getCurrentDrawInfo(string $time, string $lotteryId) {

    $gameStopTime_x_totalTimeInSec = self::getGameStopTimeAndTimeInSec($lotteryId);
    $lastInfos = self::getGamesLastDrawInfos($lotteryId);
    $isWithinTimeRange = self::isWithinTimeRange($gameStopTime_x_totalTimeInSec['endTime'], $lotteryId);

    $drawPeriod = $isWithinTimeRange ? $lastInfos['period'] : self::getDrawPeriod($time, $lotteryId);
    $drawDateTime = $isWithinTimeRange ? $lastInfos['time_added'] : self::getDrawDateTime($time, $lotteryId);
    $drawCount = $isWithinTimeRange ? $lastInfos['time_added'] : self::getDrawCount($time, $lotteryId);
    $timeLeft = $isWithinTimeRange ? strtotime("01:00:00") - strtotime(date("H:i:s")) : self::getTimeRemaining($time, $lotteryId);
    $totalTime = $isWithinTimeRange ? 3600 : $gameStopTime_x_totalTimeInSec['totalTime'];
    $isClosed = $isWithinTimeRange ? 0  : 1;

    $drawInfo = [
        "type" => "success",
        "drawinfo" => [
            "draw_date" => $drawPeriod,
            "draw_time" => $drawDateTime,
            "request_time" => self::getDrawTimeMilliSeconds(),
            "draw_datetime" => $drawDateTime,
        ],
        "drawCount" => $drawCount,
        "timeLeft" => $timeLeft,
        "currentTime" => (new DateTime())->format('H:i:s'),
        "totaltime" => $totalTime,
        "currentPeriod" => $drawPeriod,
        'nexDrawPeriod' => self::getNextDrawPeriod($time, $lotteryId),
        'gameStatus' => $isClosed 
    ];

    return $drawInfo ?? [];
  }

  public static function isWithinTimeRange($endTime, $lotteryId) : bool {
    $currentTime = new DateTime();
    $endTime = new DateTime($endTime); // e.g., "00:00:00" today
    $startTime = new DateTime("00:59:10"); // "01:00:00" today
    $isWithinTimeRange = $currentTime >= $endTime && $currentTime < $startTime;
    return $isWithinTimeRange;
  }

}
