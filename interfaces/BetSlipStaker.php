<?php 

interface BetSlipStaker {

  public static function stakeBet(string $userId, array $betData, string $gameModel) : array ;

}