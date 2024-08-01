<?php 

interface BetProcessor {

    public static function getPendingBetSlips(string $betTable, string $drawPeriod): array ;

    public static function processPendingBetSlips(array $TotalBetSlips, string $drawtable, string $bettable, array $drawNumber): bool ;

}