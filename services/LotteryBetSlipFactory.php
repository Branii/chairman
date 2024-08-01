<?php

class LotteryBetSlipFactory
{
    public static function createProcessor(string $type): LotteryBetSlipProcessor
    {
        return match ($type) {
            'lottery' => new LotteryBetSlipProcessor(),
            'sports', 'jackpot', 'casino' => null,
            default => throw new InvalidArgumentException("Unknown betslip processor type: $type"),
        };
    }
}
