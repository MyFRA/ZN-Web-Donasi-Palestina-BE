<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\EmailNotificationUserDonation;
use App\Mail\EmailNotificationUserProductDonationOrder;
use App\Models\DonationRecap;
use App\Models\ProductDonationOrder;
use App\Models\Setting;
use App\Models\UserDonation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotificationDuitkuController extends Controller
{
    public function notification(Request $req)
    {
        try {
            $apiKey = config('app.DUITKU_MERCHANT_KEY'); // API key anda
            $merchantCode = isset($req['merchantCode']) ? $req['merchantCode'] : null;
            $amount = isset($req['amount']) ? $req['amount'] : null;
            $merchantOrderId = isset($req['merchantOrderId']) ? $req['merchantOrderId'] : null;
            $productDetail = isset($req['productDetail']) ? $req['productDetail'] : null;
            $additionalParam = isset($req['additionalParam']) ? $req['additionalParam'] : null;
            $paymentCode = isset($req['paymentCode']) ? $req['paymentCode'] : null;
            $resultCode = isset($req['resultCode']) ? $req['resultCode'] : null;
            $merchantUserId = isset($req['merchantUserId']) ? $req['merchantUserId'] : null;
            $reference = isset($req['reference']) ? $req['reference'] : null;
            $signature = isset($req['signature']) ? $req['signature'] : null;
            $publisherOrderId = isset($req['publisherOrderId']) ? $req['publisherOrderId'] : null;
            $spUserHash = isset($req['spUserHash']) ? $req['spUserHash'] : null;
            $settlementDate = isset($req['settlementDate']) ? $req['settlementDate'] : null;
            $issuerCode = isset($req['issuerCode']) ? $req['issuerCode'] : null;

            //log callback untuk debug 
            // file_put_contents('callback.txt', "* Callback *\r\n", FILE_APPEND | LOCK_EX);

            if (!empty($merchantCode) && !empty($amount) && !empty($merchantOrderId) && !empty($signature)) {
                $params = $merchantCode . $amount . $merchantOrderId . $apiKey;
                $calcSignature = md5($params);

                if ($signature == $calcSignature) {
                    $productDonationOrder = ProductDonationOrder::where('order_id', $merchantOrderId)->first();

                    $productDonationOrder->update([
                        'payment_status' => 'success',
                        'shipment_status' => 'Payment Received'
                    ]);

                    if (!DonationRecap::where('foreign_id', $productDonationOrder->id)->where('type', 'product_donation_orders')->first()) {
                        DonationRecap::create([
                            'foreign_id' => $productDonationOrder->id,
                            'fullname' => $productDonationOrder->full_name,
                            'type' => 'product_donation_orders',
                            'amount' => $productDonationOrder->total,
                            'message' => $productDonationOrder->message
                        ]);
                    }
                } else {
                    // file_put_contents('callback.txt', "* Bad Signature *\r\n\r\n", FILE_APPEND | LOCK_EX);
                    // throw new Exception('Bad Signature');
                }
            } else {
                // file_put_contents('callback.txt', "* Bad Parameter *\r\n\r\n", FILE_APPEND | LOCK_EX);
                // throw new Exception('Bad Parameter');
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
