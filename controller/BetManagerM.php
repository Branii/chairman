<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class BetManagerM extends BetControllerM
{
    public static function handleBetSlip(string $userId, array $betData, string $gameModel) {

        if (!parent::validateFields($betData))
            return ['type' => Response::INFO->value, 'message' => Response::MISSING_REQUIRED_FIELDS->value]; # validate vars

        if (!parent::isUserLoggedIn($userId))
            return ['type' => Response::INFO->value, 'message' => Response::NOT_LOGGED_IN->value]; # use login

        $userInformation = parent::getUserInformation($userId);
        if ($userInformation['balance'] < array_sum(array_column($betData, 'totalBetAmt')))
            return ['type' => Response::INFO->value, 'message' => Response::INSUFFICENT_FUNDS->value]; # get userinfo

        if ($betData[0]["betId"] <= TimerManagerM::getDrawPeriod(date("H:i:s"), $betData[0]['lottery_id']))
            return ['type' => Response::INFO->value,'message' => Response::BET_TIME_EXPIRED->value,
                'active_period' => TimerManagerM::getNextDrawPeriod(date("H:i:s"), $betData[0]['lottery_id'])
            ]; # check bet period

        $betDataObject = parent::updateUserBalance($betData, $userId, $userInformation, $gameModel); # update user balance
        if (isset($betDataObject['result']) && $betDataObject['result'] >= 1)
            return ['type' => Response::SUCCESS->value, 'message' => Response::BET_ALREADY_PLACED->value, 'balance' => Utilities::truncate($betDataObject['balance'])]; 

        if (!$betDataObject['result'] >= 1)
            Model::updateUserBalance($userId, parent::revertBalance($betData, $userId));
        return ['type' => Response::ERROR->value, 'message' => Response::BET_NOT_PLACED->value]; # could not bookslip

    }

}


