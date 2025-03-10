<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class BrickHelper
{

    public static function generateJwtToken()
    {
        $client = new Client();
        $response = $client->get('https://sandbox.onebrick.io/v2/payments/auth/token', [
            'auth' => ['93379ea6-38b0-432c-be18-45b79f89dd73', 'OFMOThp17o9cwVzA82KBD28aeH2F3j']
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

        $response = $client->post('https://sandbox.onebrick.io/v2/payments/gs/va/close', [
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

        $response = $client->get('https://sandbox.onebrick.io/v2/payments/gs/va/close?vaId=' . $vaId);

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

        $response = $client->post('https://sandbox.onebrick.io/v2/payments/gs/va/close/status/' . $vaId, [
            'body' => json_encode([
                'action' => 'PAID'
            ])
        ]);

        return json_decode($response->getBody())->data;
    }
}
