<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class BrickHelper
{

    public static function generateJwtToken()
    {
        $client = new Client();
        $response = $client->get('https://onebrick.io/v2/payments/auth/token', [
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

        $response = $client->post('https://onebrick.io/v2/payments/gs/va/close', [
            'body' => json_encode([
                "amount" => $userDonation->amount,
                "referenceId" => $orderId,
                "expiredAt" => "600",
                "description" => "Donation",
                "bankShortCode" => $bankShortCode,
                "displayName" => "Nusantara For Palestine"
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

        $response = $client->get('https://onebrick.io/v2/payments/gs/va/close?vaId=' . $vaId);

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

        $response = $client->post('https://onebrick.io/v2/payments/gs/va/close/status/' . $vaId, [
            'body' => json_encode([
                'action' => 'PAID'
            ])
        ]);

        return json_decode($response->getBody())->data;
    }
}
