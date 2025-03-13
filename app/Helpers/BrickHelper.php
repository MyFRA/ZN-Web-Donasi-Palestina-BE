<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BrickHelper
{

    public static function generateJwtToken()
    {
        $client = new Client();
        $response = $client->get('https://api.onebrick.io/v2/payments/auth/token', [
            'auth' => ['fab9d303-8891-4fb9-9acb-f668e4ead223', 'kYxiG5ox1butD1UnfaDpO07ptUZSZ1']
        ]);

        return json_decode($response->getBody())->data->accessToken;
    }

    public static function createCloseVa($jwtBrickToken, $orderId, $userDonation, $bankShortCode)
    {
        $client = new Client([
            'headers' => [
                'publicAccessToken' => ('Bearer ' . $jwtBrickToken),
                'Content-Type' => 'application/json',
            ]
        ]);

        $response = $client->post('https://api.onebrick.io/v2/payments/gs/va/close', [
            'body' => json_encode([
                "amount" => $userDonation->amount,
                "referenceId" => $orderId,
                "expiredAt" => "600",
                "description" => "Donation",
                "bankShortCode" => $bankShortCode,
                "displayName" => "Nurul Inaroh"
            ])
        ]);

        return json_decode($response->getBody())->data;
    }

    public static function createQrisVa($jwtBrickToken, $orderId, $userDonation, $bankShortCode)
    {
        $client = new Client([
            'headers' => [
                'publicAccessToken' => ('Bearer ' . $jwtBrickToken),
                'Content-Type' => 'application/json',
            ]
        ]);

        $response = $client->post('https://api.onebrick.io/v2/payments/gs/qris/dynamic', [
            'body' => json_encode([
                "referenceId" => 'test-qris-sandbox',
                "amount" => $userDonation->amount,
                "validityPeriod" => "86400",
            ])
        ]);

        return json_decode($response->getBody())->data;
    }

    public static function createEwallet($jwtBrickToken, $orderId, $userDonation, $bankShortCode)
    {
        $client = new Client([
            'headers' => [
                'publicAccessToken' => ('Bearer ' . $jwtBrickToken),
                'Content-Type' => 'application/json',
            ]
        ]);
        $response = $client->post('https://api.onebrick.io/v2/payments/gs/acceptance/ewallet', [
            'body' => json_encode([
                "amount" => $userDonation->amount,
                "referenceId" => $orderId,
                "ewalletCode" => $bankShortCode,
                "returnUrl" => config("app.WEB_CLIENT_URL") . '/success'
            ])
        ]);

        return json_decode($response->getBody())->data;
    }


    public static function checkPaymentStatus($vaId)
    {
        $client = new Client([
            'headers' => [
                'publicAccessToken' => ('Bearer ' . self::generateJwtToken()),
                'Content-Type' => 'application/json',
            ]
        ]);

        $response = $client->get('https://api.onebrick.io/v2/payments/gs/va/close?vaId=' . $vaId);

        return json_decode($response->getBody())->data;
    }

    public static function setPaymentStatus($vaId)
    {
        $client = new Client([
            'headers' => [
                'publicAccessToken' => ('Bearer ' . self::generateJwtToken()),
                'Content-Type' => 'application/json',
            ]
        ]);

        $response = $client->post('https://api.onebrick.io/v2/payments/gs/va/close/status/' . $vaId, [
            'body' => json_encode([
                'action' => 'PAID'
            ])
        ]);

        return json_decode($response->getBody())->data;
    }
}
