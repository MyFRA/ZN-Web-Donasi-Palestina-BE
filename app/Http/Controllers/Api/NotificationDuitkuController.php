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
                    $userDonation = UserDonation::where('order_id', $merchantOrderId)->first();

                    if ($productDonationOrder) {
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
                    }

                    if ($userDonation) {
                        $userDonation->update([
                            'status' => 'success',
                            'payment_method' => ''
                        ]);

                        if (!DonationRecap::where('foreign_id', $userDonation->id)->where('type', 'user_donations')->first()) {
                            DonationRecap::create([
                                'foreign_id' => $userDonation->id,
                                'fullname' => $userDonation->fullname,
                                'type' => 'user_donations',
                                'amount' => $userDonation->amount,
                                'message' => $userDonation->message
                            ]);
                        }

                        if ($userDonation->email) {
                            try {
                                Mail::to($userDonation->email)->send(new EmailNotificationUserDonation($userDonation));
                            } catch (\Throwable $th) {
                            }

                            try {
                                if ($userDonation->whatsapp_number) {
                                    Http::post(config('app.ENGINE_URL') . '/send-message', [
                                        'session' => 'myfra',
                                        'to' => $userDonation->whatsapp_number,
                                        'text' => "Halo " . $userDonation->fullname . ",\n\nDonasi Anda untuk Yayasan Bali Lestari Malik membawa sinar kehidupan baru bagi anak-anak di Palestina. Terima kasih telah menjadi bagian dari perubahan positif. Semoga kebaikan Anda kembali berkali-kali lipat.\n\nBerikut adalah detail donasi kamu:\n\nNama : " . $userDonation->fullname . "\n\nEmail : " . $userDonation->email . "\n\nNomor Whatsapp : " . $userDonation->whatsapp_number . "\n\nPaket Donasi : " . $userDonation->availableDonation->short_description . "\n\nNominal Donasi : Rp" . number_format($userDonation->amount, 0, '.', '.') . "\n\nSalam Hangat " . $setting->company_name . ".\n\n Terima kasih!"
                                    ]);
                                }
                            } catch (\Throwable $th) {
                            }
                        }
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
