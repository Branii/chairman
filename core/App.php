<?php

class App
{

    public static function _(string $userId = null, array $betData = []): void
    {

        // Flight::before('start', function() { # middleware 
        //     $apiKey = apache_request_headers()['api_key'] ?? '';
        //     $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        //     $referrer = $_SERVER['HTTP_REFERER'] ?? '';
        //     if (!Utilities::isBrowserAndFromDomain($userAgent,$referrer) || !Utilities::isValidApiKey($apiKey)){
        //         Flight::json(['type' => Response::ERROR->value , 'message'=> Response::UNAUTHORIZED->value], ErrorCode::UNAUTHORIZED->value);
        //         Flight::stop();
        //     }
        // });

        Flight::route('/api/v1/limvo/bookbetslip/standard', function () use ($userId, $betData) {
            $response = BetManagerM::handleBetSlip($userId, $betData, 1);
            Flight::json($response);
        });

        Flight::route('/api/v1/limvo/bookbetslip/twoside', function () use ($userId, $betData) {
            $response = BetManagerM::handleBetSlip($userId, $betData, 2);
            Flight::json($response);
        });

        Flight::route('/api/v1/limvo/bookbetslip/roadbet', function () use ($userId, $betData) {
            $response = BetManagerM::handleBetSlip($userId, $betData, 3);
            Flight::json($response);
        });

        Flight::route('/api/v1/limvo/bookbetslip/dragon', function () use ($userId, $betData) {
            $response = BetManagerM::handleBetSlip($userId, $betData, 4);
            Flight::json($response);
        });

        Flight::route('/api/v1/limvo/bookbetslip/manytable', function () use ($userId, $betData) {
            $response = BetManagerM::handleBetSlip($userId, $betData, 5);
            Flight::json($response);
        });

        Flight::route('/api/v1/limvo/bookbetslip/boardgame', function () use ($userId, $betData) {
            $response = BetManagerM::handleBetSlip($userId, $betData, 6);
            Flight::json($response);
        });

        Flight::route('/api/v1/limvo/bookbetslip/fantan', function () use ($userId, $betData) {
            $response = BetManagerM::handleBetSlip($userId, $betData, 7);
            Flight::json($response);
        });

        Flight::route('/api/v1/limvo/bookbetslip/trend', function () use ($userId, $betData) {
            $response = BetManagerM::handleBetSlip($userId, $betData, 8);
            Flight::json($response);
        });

        //get draw data or draw number
        Flight::route('/api/v1/limvo/draw_data', function (){
            $lotteryId = Flight::request()->query['lottery_id'];
            $drawInfo  = isset(Flight::request()->query['drawInfo']) ? 'drawInfo' : 'drawNumber';
            $response = TimerManagerM::drawInfoController($drawInfo,$lotteryId);
            Flight::json($response);
        });

        Flight::route('/api/v1/limvo/draw_status', function () {
            $lotteryId = Flight::request()->query['lottery_id'];
            $token = Flight::request()->query['token'];
            $userId = TokenGenerator::TokenDecoder($token, 'iamtherealdude')->uid;
            $response = BetControllerM::userHasPendingBet($userId, $lotteryId);
            Flight::json($response);
        });

        Flight::map('notFound', function () {
            Flight::response()->status(ErrorCode::NOT_FOUND->value);
            Flight::json(['type' => Response::ERROR->value, 'message' => Response::RESOURCE_NOT_FOUND->value], ErrorCode::NOT_FOUND->value);
        });

        Flight::start();
    }

}

// base?lottery_id=1&token=?
